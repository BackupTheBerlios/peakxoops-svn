<?php

require '../../mainfile.php';
require_once XOOPS_ROOT_PATH.'/class/template.php' ;
require_once dirname( __FILE__ ) .'/include/functions.php';
require_once dirname( __FILE__ ) .'/include/wap_ua.inc.php';

$mydirname = basename( dirname( __FILE__ ) ) ;
if( ! preg_match( '/^(\D+)(\d*)$/' , $mydirname , $regs ) ) echo ( "invalid dirname: " . htmlspecialchars( $mydirname ) ) ;
$mydirnumber = $regs[2] === '' ? '' : intval( $regs[2] ) ;

// WAP
$wap_type = wap_ua() ;

// template object
$tpl = new XoopsTpl();
$tpl->xoops_setTemplateDir(XOOPS_ROOT_PATH.'/themes');
$tpl->xoops_setCaching(2);
$tpl->xoops_setCacheTime(0);


$hlman =& xoops_getmodulehandler('headline') ;
$hlid = isset($_GET['id']) ? intval($_GET['id']) : 0;
//$xoopsOption['template_main'] = "xhld{$mydirnumber}_index.html";
//include XOOPS_ROOT_PATH.'/header.php';
$headlines =& $hlman->getObjects(new Criteria('headline_display', 1));
$count = count($headlines);
/*for ($i = 0; $i < $count; $i++) {
	$tpl->append('feed_sites', array('id' => $headlines[$i]->getVar('headline_id'), 'name' => $headlines[$i]->getVar('headline_name'), 'syndication' => $headlines[$i]->getVar('headline_syndication')));
}*/
$tpl->assign('mod_url', XOOPS_URL.'/modules/'.$mydirname);

$dtfmt_short = empty( $xoopsModuleConfig["dtfmt_short"] ) ? '' : $xoopsModuleConfig["dtfmt_short"] ;

if( $hlid == 0 ) {
	if( ! empty( $xoopsModuleConfig["index_viewmode"] ) ) {
		$hlid = $headlines[0]->getVar('headline_id');
	} else {
		$items = array() ;
		for ($i = 0; $i < $count; $i++) {
			$renderer =& xhld_getrenderer($headlines[$i],$mydirname);
			$itemsperfeed = empty( $xoopsModuleConfig["mixed_mode"] ) ? 100 : $headlines[$i]->getVar('headline_mainmax') ;
			$tmp_data = $renderer->getRawDataAsArray( false , $itemsperfeed , $xoopsModuleConfig["mixed_maxlen"] ) ;
			if( ! empty( $tmp_data ) ) {
				$no_pubdate_counter = $i ;
				$num_counter = 0 ;
				foreach( $tmp_data['items'] as $item ) {
					$num_counter ++ ;
					if( empty( $item['pubdate'] ) ) {
						$item['pubdate'] = '' ;
						$no_pubdate_counter += $count ;
						$sort_weight = - $no_pubdate_counter ;
					} else {
						$sort_weight = $item['pubdate'] ;
					}
					$items[] = array(
						'id' => $headlines[$i]->getVar('headline_id') ,
						'num' => $num_counter ,
						'site_name' => $tmp_data['site_name'] ,
						'site_url' => $tmp_data['site_url'] ,
						'site_id' => $tmp_data['site_id'] ,
						'channel_data' => $tmp_data['channel_data'] ,
						'image_data' => empty( $tmp_data['image_data'] ) ? array() : $tmp_data['image_data'] ,
						'title' => $item['title'] ,
						'link' => $item['link'] ,
						'sort_weight' => $sort_weight ,
						'pubdate' => $item['pubdate'] ,
						'pubdate_utz' => xoops_getUserTimestamp( $item['pubdate'] ) ,
						'date_short' => empty( $item['pubdate'] ) ? '' : date( $dtfmt_short , xoops_getUserTimestamp( $item['pubdate'] ) ) ,
						'date' => empty( $item['pubdate'] ) ? '' : formatTimestamp( $item['pubdate'] , 'm' ) /* ,
						'description' => empty( $item['description'] ) ? '' : $item['description'] ,
						'content' => empty( $item['content'] ) ? '' : $item['content'] */
					) ;
				}
			}
		}
		// order by pubdate desc
		usort( $items , create_function( '$a,$b' , 'return $a["sort_weight"] < $b["sort_weight"] ? 1 : -1 ;' ) ) ;

		$mixlist['maxitem'] = $xoopsModuleConfig["mixed_maxitem"] ;
		$mixlist['items'] = $items ;
		$mixlist['mod_url'] = XOOPS_URL.'/modules/'.$mydirname ;
		$mixlist['dtfmt_short'] = $dtfmt_short ;
		$tpl->assign('mixlist', $mixlist);
	}
}

// headline_id specified 
if( $hlid > 0 ) {
	$headline =& $hlman->get($hlid);

	if (is_object($headline)) {
		$renderer =& xhld_getrenderer($headline,$mydirname);
		$data = $renderer->getRawDataAsArray( false ) ;

		// num is 1 origin instead of 0 origin
		$num = empty( $_GET['num'] ) ? 1 : intval( $_GET['num'] ) ;

		// item preparing
		$item = empty( $data['items'][$num-1] ) ? $data['items'][0] : $data['items'][$num-1] ;
		if( $item['pubdate'] > 0 ) {
			$item['date_short'] = date( $dtfmt_short , xoops_getUserTimestamp( $item['pubdate'] ) ) ;
			$item['date'] = formatTimestamp( $item['pubdate'] , 'm' ) ;
		}
		// strip tags other than <BR>
		$item['description'] = str_replace( '[br]' , '<BR>' , strip_tags( str_replace( array('<br />','<br>','<BR />','<BR>') , '[br]' , $item['description'] ) ) ) ;

		// navigation
		if( $num > 1 ) {
			$tpl->assign('prev_num',$num-1);
		}
		if( ! empty( $data['items'][$num+1] ) ) {
			$tpl->assign('next_num',$num+1);
		}

		$tpl->assign('hlid' , $hlid ) ;
		$tpl->assign('num' , $num ) ;
		$tpl->assign('hl_site_name' , strip_tags( $data['site_name'] ) ) ;
		$tpl->assign('item' , $item ) ;
	}
}


// convert encoding for WAP
if( $xoopsConfig['language'] == 'japanese' && function_exists( 'mb_convert_encoding' ) ) {

	// remove output bufferings
	if( function_exists( 'ob_get_level' ) ) {
		while( ob_get_level() > 0 ) {
			ob_end_clean() ;
		}
	}

	$charset = 'Shift_JIS' ;
	mb_http_output( $charset ) ;
	ob_start( 'mb_output_handler' ) ;

} else {
	$charset = _CHARSET ;
}

// output part
$tpl->assign('charset', $charset);
$tpl->assign('sitename', $xoopsConfig['sitename']);
$tpl->assign('site_url', XOOPS_URL);

switch( $wap_type ) {
	case 'HDML' :
		$header = 'Content-Type:text/x-hdml; charset='.$charset ;
		$tpl_file = dirname(__FILE__)."/templates/xhld_hdml.html" ;
		break ;
	case 'C-HTML' :
		$header = 'Content-Type:text/html; charset='.$charset ;
		$tpl_file = dirname(__FILE__)."/templates/xhld_chtml.html" ;
		break ;
	case 'MML' :
		$header = 'Content-Type:text/html; charset='.$charset ;
		$tpl_file = dirname(__FILE__)."/templates/xhld_mml.html" ;
		break ;
	default :
	case 'WAP2.0' :
		$header = 'Content-Type:text/html; charset='.$charset ;
		$tpl_file = dirname(__FILE__)."/templates/xhld_wap2.html" ;
		break ;
}

header( $header ) ;
if( file_exists( $tpl_file ) ) {
	$tpl->display( $tpl_file ) ;
} else {
	$tpl->display( $tpl_file . '.dist' ) ;
}
exit ;

//include XOOPS_ROOT_PATH.'/footer.php';
?>