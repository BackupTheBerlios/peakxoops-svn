<?php


class MyBlocksAdminForXoops22 extends MyBlocksAdmin {

function MyBlocksAadminForXoops22()
{
}


function &getInstance()
{
	static $instance;
	if (!isset($instance)) {
		$instance = new MyBlocksAdminForXoops22();
	}
	return $instance;
}



function list_blocks( $target_mid , $target_dirname )
{
	global $xoopsGTicket ;

	$myts =& MyTextSanitizer::getInstance() ;

	// main query
	$db =& Database::getInstance();
	$sql = "SELECT bid,name,show_func,func_file,template FROM ".$db->prefix("newblocks")." WHERE mid='$target_mid'";
	$result = $db->query($sql);
	$block_arr = array();
	while( list( $bid , $bname , $show_func , $func_file , $template ) = $db->fetchRow( $result ) ) {
		$block_arr[$bid] = array(
			'name' => $bname ,
			'show_func' => $show_func ,
			'func_file' => $func_file ,
			'template' => $template
		) ;
	}

	// cachetime options
	$cachetimes = array('0' => _NOCACHE, '30' => sprintf(_SECONDS, 30), '60' => _MINUTE, '300' => sprintf(_MINUTES, 5), '1800' => sprintf(_MINUTES, 30), '3600' => _HOUR, '18000' => sprintf(_HOURS, 5), '86400' => _DAY, '259200' => sprintf(_DAYS, 3), '604800' => _WEEK, '2592000' => _MONTH);

	// displaying TH
	echo "
	<h4 style='text-align:left;'>"._MD_A_MYBLOCKSADMIN_BLOCKADMIN."</h4>
	<form action='?mode=admin&amp;lib=altsys&amp;page=myblocksadmin&amp;dirname=$target_dirname' name='blockadmin' method='post'>
		<table width='95%' class='outer' cellpadding='4' cellspacing='1'>
		<tr valign='middle'>
			<th>"._MD_A_MYBLOCKSADMIN_TITLE."</th>
			<th align='center' nowrap='nowrap'>"._MD_A_MYBLOCKSADMIN_SIDE."</th>
			<th align='center'>"._MD_A_MYBLOCKSADMIN_WEIGHT."</th>
			<th align='center'>"._MD_A_MYBLOCKSADMIN_VISIBLEIN."</th>
			<th align='center'>"._MD_A_MYBLOCKSADMIN_BCACHETIME."</th>
			<th align='right'>"._MD_A_MYBLOCKSADMIN_ACTION."</th>
		</tr>\n" ;

	// get block instances
	$crit = new Criteria("bid", "(".implode(",",array_keys($block_arr)).")", "IN");
	$criteria = new CriteriaCompo($crit);
	$criteria->setSort('visible DESC, side ASC, weight');
	$instance_handler =& xoops_gethandler('blockinstance');
	$instances =& $instance_handler->getObjects($criteria, true, true);

	//Get modules and pages for visible in
	$module_list[_AM_SYSTEMLEVEL]["0-2"] = _AM_ADMINBLOCK;
	$module_list[_AM_SYSTEMLEVEL]["0-1"] = _AM_TOPPAGE;
	$module_list[_AM_SYSTEMLEVEL]["0-0"] = _AM_ALLPAGES;
	$criteria = new CriteriaCompo(new Criteria('hasmain', 1));
	$criteria->add(new Criteria('isactive', 1));
	$module_handler =& xoops_gethandler('module');
	$module_main =& $module_handler->getObjects($criteria, true, true);
	if (count($module_main) > 0) {
		foreach (array_keys($module_main) as $mid) {
			$module_list[$module_main[$mid]->getVar('name')][$mid."-0"] = _AM_ALLMODULEPAGES;
			$pages = $module_main[$mid]->getInfo("pages");
			if ($pages == false) {
				$pages = $module_main[$mid]->getInfo("sub");
			}
			if (is_array($pages) && $pages != array()) {
				foreach ($pages as $id => $pageinfo) {
					$module_list[$module_main[$mid]->getVar('name')][$mid."-".$id] = $pageinfo['name'];
				}
			}
		}
	}

	// blocks displaying loop
	$class = 'even' ;
	$block_configs = $this->get_block_configs() ;
	foreach( array_keys( $instances ) as $i ) {
		$sseln = $ssel0 = $ssel1 = $ssel2 = $ssel3 = $ssel4 = "";
		$scoln = $scol0 = $scol1 = $scol2 = $scol3 = $scol4 = "#FFFFFF";

		$weight = $instances[$i]->getVar("weight") ;
		$title = htmlspecialchars($instances[$i]->getVar("title",'n'),ENT_QUOTES) ;
		$bcachetime = $instances[$i]->getVar("bcachetime") ;
		$bid = $instances[$i]->getVar("bid") ;
		$name = htmlspecialchars( $block_arr[$bid]['name'] , ENT_QUOTES ) ;

		$visiblein = $instances[$i]->getVisibleIn();

		// visible and side
		if ( $instances[$i]->getVar("visible") != 1 ) {
			$sseln = " checked='checked'";
			$scoln = "#FF0000";
		} else switch( $instances[$i]->getVar("side") ) {
			default :
			case XOOPS_SIDEBLOCK_LEFT :
				$ssel0 = " checked='checked'";
				$scol0 = "#00FF00";
				break ;
			case XOOPS_SIDEBLOCK_RIGHT :
				$ssel1 = " checked='checked'";
				$scol1 = "#00FF00";
				break ;
			case XOOPS_CENTERBLOCK_LEFT :
				$ssel2 = " checked='checked'";
				$scol2 = "#00FF00";
				break ;
			case XOOPS_CENTERBLOCK_RIGHT :
				$ssel4 = " checked='checked'";
				$scol4 = "#00FF00";
				break ;
			case XOOPS_CENTERBLOCK_CENTER :
				$ssel3 = " checked='checked'";
				$scol3 = "#00FF00";
				break ;
		}

		// bcachetime
		$cachetime_options = '' ;
		foreach( $cachetimes as $cachetime => $cachetime_name ) {
			if( $bcachetime == $cachetime ) {
				$cachetime_options .= "<option value='$cachetime' selected='selected'>$cachetime_name</option>\n" ;
			} else {
				$cachetime_options .= "<option value='$cachetime'>$cachetime_name</option>\n" ;
			}
		}

		$module_options = '' ;
		foreach( $module_list as $mname => $module ) {
			$module_options .= "<optgroup label='$mname'>\n" ;
			foreach( $module as $mkey => $mval ) {
				if( in_array( $mkey , $visiblein ) ) {
					$module_options .= "<option value='$mkey' selected='selected'>$mval</option>\n" ;
				} else {
					$module_options .= "<option label='$mval' value='$mkey'>$mval</option>\n" ;
				}
			}
			$module_options .= "</optgroup>\n" ;
		}

		// delete link if it is cloned block
		$delete_link = "<br /><a href='?mode=admin&amp;lib=altsys&amp;page=myblocksadmin&amp;dirname=$target_dirname&amp;op=delete&amp;bid=$bid'>"._DELETE."</a>" ;

		// displaying part
		echo "
		<tr valign='middle'>
			<td class='$class'>
				$name
				<br />
				<input type='text' name='title[$i]' value='$title' size='20' />
			</td>
			<td class='$class' align='center' nowrap='nowrap' width='125px'>
				<div style='float:left;background-color:$scol0;'>
					<input type='radio' name='side[$i]' value='".XOOPS_SIDEBLOCK_LEFT."' style='background-color:$scol0;' $ssel0 />
				</div>
				<div style='float:left;'>-</div>
				<div style='float:left;background-color:$scol2;'>
					<input type='radio' name='side[$i]' value='".XOOPS_CENTERBLOCK_LEFT."' style='background-color:$scol2;' $ssel2 />
				</div>
				<div style='float:left;background-color:$scol3;'>
					<input type='radio' name='side[$i]' value='".XOOPS_CENTERBLOCK_CENTER."' style='background-color:$scol3;' $ssel3 />
				</div>
				<div style='float:left;background-color:$scol4;'>
					<input type='radio' name='side[$i]' value='".XOOPS_CENTERBLOCK_RIGHT."' style='background-color:$scol4;' $ssel4 />
				</div>
				<div style='float:left;'>-</div>
				<div style='float:left;background-color:$scol1;'>
					<input type='radio' name='side[$i]' value='".XOOPS_SIDEBLOCK_RIGHT."' style='background-color:$scol1;' $ssel1 />
				</div>
				<br />
				<br />
				<div style='float:left;width:40px;'>&nbsp;</div>
				<div style='float:left;background-color:$scoln;'>
					<input type='radio' name='side[$i]' value='-1' style='background-color:$scoln;' $sseln />
				</div>
				<div style='float:left;'>"._NONE."</div>
			</td>
			<td class='$class' align='center'>
				<input type='text' name=weight[$i] value='$weight' size='3' maxlength='5' style='text-align:right;' />
			</td>
			<td class='$class' align='center'>
				<select name='bmodule[$i][]' size='5' multiple='multiple'>
					$module_options
				</select>
			</td>
			<td class='$class' align='center'>
				<select name='bcachetime[$i]' size='1'>
					$cachetime_options
				</select>
			</td>
			<td class='$class' align='right'>
				<a href='?mode=admin&amp;lib=altsys&amp;page=myblocksadmin&amp;dirname=$target_dirname&amp;op=edit&amp;bid=$bid'>"._EDIT."</a>{$delete_link}
				<input type='hidden' name='id[$i]' value='$i' />
			</td>
		</tr>\n" ;

		$class = ( $class == 'even' ) ? 'odd' : 'even' ;
	}

	// list block classes for add (not instances)
	foreach( $block_arr as $bid => $block ) {

		$description4show = '' ;
		foreach( $block_configs as $bconf ) {
			if( $block['show_func'] == $bconf['show_func'] && $block['func_file'] == $bconf['file'] && ( empty( $bconf['template'] ) || $block['template'] == $bconf['template'] ) ) {
				if( ! empty( $bconf['description'] ) ) $description4show = $myts->makeTboxData4Show( $bconf['description'] ) ;
			}
		}

		echo "
		<tr>
			<td class='$class' align='left'>
				".$myts->makeTboxData4Edit($block['name'])."
			</td>
			<td class='$class' align='left' colspan='4'>
				$description4show
			</td>
			<td class='$class' align='center'>
				<input type='submit' name='addblock[$bid]' value='"._ADD."' />
			</td>
		</tr>
		\n" ;
		$class = ( $class == 'even' ) ? 'odd' : 'even' ;
	}

	echo "
		<tr>
			<td class='foot' align='center' colspan='6'>
				<input type='hidden' name='fct' value='blocksadmin' />
				<input type='hidden' name='op' value='order' />
				".$xoopsGTicket->getTicketHtml( __LINE__ , 1800 , 'myblocksadmin' )."
				<input type='submit' name='submit' value='"._SUBMIT."' />
			</td>
		</tr>
		</table>
	</form>\n" ;
}




function list_groups( $target_mid , $target_dirname , $target_mname )
{
	// query for getting blocks
	$db =& Database::getInstance();
	$sql = "SELECT i.instanceid,i.title FROM ".$db->prefix("block_instance")." i LEFT JOIN ".$db->prefix("newblocks")." b ON i.bid=b.bid WHERE b.mid='$target_mid'" ;
	$result = $db->query( $sql ) ;

	$item_list = array() ;
	while( list( $iid , $title ) = $db->fetchRow( $result ) ) {
		$item_list[ $iid ] = $title ;
	}

	$form = new MyXoopsGroupPermForm( _MD_A_MYBLOCKSADMIN_PERMFORM , 1 , 'block_read' , '' ) ;
	// skip system (TODO)
	if( $target_mid > 1 ) {
		$form->addAppendix( 'module_admin' , $target_mid , $target_mname . ' ' . _MD_A_MYBLOCKSADMIN_PERM_MADMIN ) ;
		$form->addAppendix( 'module_read' , $target_mid , $target_mname .' ' . _MD_A_MYBLOCKSADMIN_PERM_MREAD ) ;
	}
	foreach( $item_list as $item_id => $item_name) {
			$form->addItem( $item_id , $item_name ) ;
	}
	echo $form->render() ;
}





function update_blockinstance($id, $bside, $bweight, $bvisible, $btitle, $bcontent, $bctype, $bcachetime, $bmodules, $options=array(), $bid=null)
{
	global $xoopsDB ;

	$instance_handler =& xoops_gethandler('blockinstance');
	$block_handler =& xoops_gethandler('block') ;
	if ($id > 0) {
		// update
		$instance =& $instance_handler->get($id);
		if( $bside >= 0 ) $instance->setVar('side', $bside);
		if( ! empty($options) ) $instance->setVar('options', $options);
	} else {
		// insert
		$instance =& $instance_handler->create();
		$instance->setVar( 'bid' , $bid ) ;
		$instance->setVar('side', $bside);
		$block = $block_handler->get( $bid ) ;
		$instance->setVar('options', $block->getVar("options") );
		if( empty( $btitle ) ) $btitle = $block->getVar("name") ;
	}
	$instance->setVar('weight', $bweight);
	$instance->setVar('visible', $bvisible);
	$instance->setVar('title', $btitle);
	// if( isset( $bcontent ) ) $instance->setVar('content', $bcontent);
	// if( isset( $bctype ) ) $instance->setVar('c_type', $bctype);
	$instance->setVar('bcachetime', $bcachetime);

	if ($instance_handler->insert($instance)) {
		$GLOBALS['xoopsDB']->query("DELETE FROM ".$GLOBALS['xoopsDB']->prefix('block_module_link')." WHERE block_id=".$instance->getVar('instanceid'));
		foreach ($bmodules as $mid) {
			$page = explode('-', $mid);
			$mid = $page[0];
			$pageid = $page[1];
			$GLOBALS['xoopsDB']->query("INSERT INTO ".$GLOBALS['xoopsDB']->prefix('block_module_link')." VALUES (".$instance->getVar('instanceid').", ".intval($mid).", ".intval($pageid).")");
		}
		return _MD_A_MYBLOCKSADMIN_DBUPDATED;
	}
	return 'Failed update of block instance. ID:'.$id;
}



function do_order()
{
	if( isset( $_POST['addblock'] ) && is_array( $_POST['addblock'] ) ) {

		// addblock
		foreach( $_POST['addblock'] as $bid => $val ) {
			$this->update_blockinstance( 0, 0, 0, 0, '', null , null , 0, array(), array(), intval( $bid ) );
		}

	} else {

		// else change order
		if ( !empty($_POST['side']) ) { $side = $_POST['side']; }
		if ( !empty($_POST['visible']) ) { $visible = $_POST['visible']; }
		if ( !empty($_POST['id']) ) { $id = $_POST['id']; } else { $id = array(); }

		foreach (array_keys($id) as $i) {
			// separate side and visible
			if( $side[$i] < 0 ) {
				$visible[$i] = 0 ;
				$side[$i] = -1 ;  // for not to destroy the original position
			} else {
				$visible[$i] = 1 ;
			}

			$bmodule = (isset($_POST['bmodule'][$i]) && is_array($_POST['bmodule'][$i])) ? $_POST['bmodule'][$i] : array(-1) ;
	
			$this->update_blockinstance($i, $side[$i], $_POST['weight'][$i], $visible[$i], $_POST['title'][$i], null , null , $_POST['bcachetime'][$i], $bmodule, array());

		}
	}

	return _MD_A_MYBLOCKSADMIN_DBUPDATED ;
}


}

?>