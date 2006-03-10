<?php
// ------------------------------------------------------------------------- //
//                          compilehookadmin.php                             //
//                    - XOOPS templates admin module -                       //
//                          GIJOE <http://www.peak.ne.jp/>                   //
// ------------------------------------------------------------------------- //

include_once( '../../../include/cp_header.php' ) ;

include_once "../include/gtickets.php" ;


//
// DEFINITIONS
//

$compile_hooks = array(

	'enclosebycomment' => array(
		'pre' => '<!-- begin tplsadmin %s -->' ,
		'post' => '<!-- end tplsadmin %s -->' ,
		'success_msg' => '%d�ĤΥ���ѥ��륭��å����񤭴����ޤ���' ,
		'dt' => '�ƥ�ץ졼��̾�򥳥��ȤȤ���������' ,
		'dd' => '�ƥƥ�ץ졼�Ȥγ���������ӽ�λ���ˡ�HTML�����Ȥη��ǥƥ�ץ졼��̾�������ޤ�ޤ����ǥ�����Ū�ʱƶ��⾯�ʤ��Τǡ�HTML�Υ����������ɤ��ɤߤ��ʤ������ˤ�����Ǥ���' ,
		'conf_msg' => '���ߤΥ���ѥ���ѥ���å���ե�����˥����Ȥ������ߤޤ�����' ,
	) ,

	'enclosebybordereddiv' => array(
		'pre' => '<div class="tplsadmin_frame" style="border:1px solid black;word-wrap:break-word;">' ,
		'post' => '<br /><a href="'.XOOPS_URL.'/modules/tplsadmin/admin/mytplsform.php?tpl_file=%1$s" style="color:red;">Edit:<br />%1$s</a></div>' ,
		'success_msg' => '%d�ĤΥ���ѥ��륭��å����񤭴����ޤ���' ,
		'dt' => '�ƥ�ץ졼�Ȥ��ȤǰϤ�' ,
		'dd' => '�ƥƥ�ץ졼�����Τ�div�ȤǰϤߡ������ƥ�ץ졼�Ȥ��Խ����̤ؤΥ�󥯤������ߤޤ����ǥ���������뤳�Ȥ⤢��ޤ������Ǥ�ľ��Ū���Խ���Ȥ��Ǥ��ޤ���' ,
		'conf_msg' => '���ߤΥ���ѥ���ѥ���å���ե������div�Ȥ������ߤޤ�����' ,
	) ,

	'hooksavevars' => array(
		'pre' => '<?php include_once "'.XOOPS_ROOT_PATH.'/modules/tplsadmin/include/compilehook.inc.php" ; tplsadmin_save_tplsvars(\'%s\',$this) ; ?>' ,
		'post' => '' ,
		'success_msg' => '%d�ĤΥ���ѥ��륭��å����񤭴����ޤ���' ,
		'dt' => '�ƥ�ץ졼���ѿ�����������å���������' ,
		'dd' => '�ƥ�ץ졼���ѿ����������������뤿������ʳ�������ѥ���ѥ���å���˥��å���������Ǥ��顢�ƥڡ�����ɽ�����뤳�Ȥǡ��ƥ�ץ졼���ѿ��������Ѥ���Ƥ����ޤ���Ŭ���ʥ����ߥ󥰤ǡ����Υܥ��󤫤�����������Ƥ������������Υ��å��򳰤��ݤϡ�����ѥ��륭��å���򥯥ꥢ���Ƥ���������' ,
		'conf_msg' => '���ߤΥ���ѥ���ѥ���å���ե�����ˡ��ƥ�ץ졼���ѿ�����������å��������ߤޤ�����' ,
	) ,

) ;


//
// EXECUTE STAGE
//

// clearing files in templates_c/
if( ! empty( $_POST['clearcache'] ) || ! empty( $_POST['cleartplsvars'] ) ) {
	// Ticket Check
	if ( ! $xoopsGTicket->check() ) {
		redirect_header(XOOPS_URL.'/',3,$xoopsGTicket->getErrors());
	}

	if( $handler = opendir( XOOPS_COMPILE_PATH . '/' ) ) {
		while( ( $file = readdir( $handler ) ) !== false ) {
	
			if( ! empty( $_POST['clearcache'] ) ) {
				// judging template cache '*.html.php'
				if( substr( $file , -9 ) !== '.html.php' ) continue ;
			} else {
				// judging tplsvars cache 'tplsvars_*'
				if( substr( $file , 0 , 9 ) !== 'tplsvars_' ) continue ;
			}
	
			$file_path = XOOPS_COMPILE_PATH . '/' . $file ;
			@unlink( $file_path ) ;
		}
		redirect_header( 'compilehookadmin.php' , 1 , "����å���򥯥ꥢ���ޤ���" ) ;
		exit ;
	} else {
		die( 'XOOPS_COMPILE_PATH cannot be opened' ) ;
	}
}

// append hooking commands
foreach( $compile_hooks as $command => $compile_hook ) {
	if( ! empty( $_POST[$command] ) ) {
		// Ticket Check
		if ( ! $xoopsGTicket->check() ) {
			redirect_header(XOOPS_URL.'/',3,$xoopsGTicket->getErrors());
		}
	
		if( $handler = opendir( XOOPS_COMPILE_PATH . '/' ) ) {
			$file_count = 0 ;
			while( ( $file = readdir( $handler ) ) !== false ) {
		
				// skip /. /.. and hidden files
				if( $file{0} == '.' ) continue ;

				// skip if the extension is not .php
				if( substr( $file , -4 ) != '.php' ) continue ;

				$file_path = XOOPS_COMPILE_PATH . '/' . $file ;
				$file_bodies = file( $file_path ) ;

				// remove lines inserted by compilehookadmin
				if( strstr( $file_bodies[0] , 'tplsadmin' ) ) {
					array_shift( $file_bodies ) ;
				}
				if( strstr( $file_bodies[count($file_bodies)-1] , 'tplsadmin' ) ) {
					array_pop( $file_bodies ) ;
					$file_bodies[count($file_bodies)-1] = rtrim( $file_bodies[count($file_bodies)-1] ) ;
				}
		
				// get the name of the source template from Smarty's comment
				if( preg_match( '/compiled from (\S+)/' , $file_bodies[1] , $regs ) ) {
					$tpl_name = $regs[1] ;
				} else {
					$tpl_name = '__FILE__' ;
				}
		
				$fw = fopen( $file_path , 'w' ) ;
		
				// insert "pre" command before the compiled cache
				if( $compile_hook['pre'] ) {
					fwrite( $fw , sprintf( $compile_hook['pre'] , htmlspecialchars( $tpl_name , ENT_QUOTES ) ) . "\r\n" ) ;
				}
		
				// rest of template cache
				foreach( $file_bodies as $line ) {
					fwrite( $fw , $line ) ;
				}

				// insert "post" command after the compiled cache
				if( $compile_hook['post'] ) {
					fwrite( $fw , "\r\n" . sprintf( $compile_hook['post'] , htmlspecialchars( $tpl_name , ENT_QUOTES ) ) ) ;
				}
		
				fclose( $fw ) ;
	
				$file_count ++ ;
			}

			if( $file_count > 0 ) {
				redirect_header( 'compilehookadmin.php' , 3 , sprintf( $compile_hook['success_msg'] , $file_count ) ) ;
				exit ;
			} else {
				redirect_header( 'compilehookadmin.php' , 3 , "����ѥ��륭��å��夬��������Ƥ��ޤ�����ˡ��Խ���Ū�Υڡ�������̤�ɽ��������ѥ��륭��å��夬��������Ƥ��顢���٤��Υ��ޥ�ɤ�¹Ԥ��Ƥ���������" ) ;
				exit ;
			}

		} else {
			die( 'XOOPS_COMPILE_PATH cannot be opened' ) ;
		}
	}
}



//
// EXAMINE STAGE
//

// count template vars & compiled caches
$compilecache_num = 0 ;
$tplsvars_num = 0 ;
if( $handler = opendir( XOOPS_COMPILE_PATH . '/' ) ) {
	while( ( $file = readdir( $handler ) ) !== false ) {
		if( strncmp( $file , 'tplsvars_' , 9 ) === 0 ) $tplsvars_num ++ ;
		else if( substr( $file , -9 ) === '.html.php' ) $compilecache_num ++ ;
	}
}

// get tplsets
$sql = "SELECT tplset_name,COUNT(distinct tpl_file) FROM ".$xoopsDB->prefix("tplset")." LEFT JOIN ".$xoopsDB->prefix("tplfile")." ON tplset_name=tpl_tplset GROUP BY tpl_tplset ORDER BY tpl_tplset='default' DESC,tpl_tplset" ;
$srs = $xoopsDB->query($sql);
$tplset_options = "<option value=''>----</option>\n" ;
while( list( $tplset , $tpl_count ) = $xoopsDB->fetchRow( $srs ) ) {
	$tplset4disp = htmlspecialchars( $tplset , ENT_QUOTES ) ;
	$tplset_options .= "<option value='$tplset4disp'>$tplset4disp ($tpl_count)</option>\n" ;
}




//
// FORM STAGE
//

xoops_cp_header() ;
include( './mymenu.php' ) ;

echo "
	<form action='' method='post' class='odd' style='margin: 40px;'>
\n" ;

foreach( $compile_hooks as $command => $compile_hook ) {
	echo "
		<p>
			<dl>
				<dt>
					{$compile_hook['dt']}
					<input type='submit' name='$command' id='$command' value='"._GO."' onclick='return confirm(\"{$compile_hook['conf_msg']}\");' />
				</dt>
				<dd>
					{$compile_hook['dd']}
				</dd>
			</dl>
		</p>
	\n" ;
}

echo "
		<p>
			compiled caches: $compilecache_num
			<input type='submit' name='clearcache' value='"._DELETE."' onclick='return confirm(\"������Ƥ�����Ǥ���?\");' />

		</p>
		<p>
			template vars: $tplsvars_num
			<input type='submit' name='cleartplsvars' value='"._DELETE."' onclick='return confirm(\"������Ƥ�����Ǥ���?\");' />

		</p>
		".$xoopsGTicket->getTicketHtml( __LINE__ )."
	</form>

	<form action='get_tplsvarsinfo.php' method='post' class='odd' style='margin: 40px;' target='_blank'>
		<p>
			<dl>
				<dt>
					�ƥ�ץ졼���ѿ������DreamWeaver�Ѥ˼�������
				</dt>
				<dd>
					�ޤ��� Macromedia Extension Manager �����󥹥ȡ��뤵��Ƥ��뤳�Ȥ��ǧ������ư���Ƥ����Ƥ���������<br />
					��������ɤ����ե��������ष�ơ���ĥ��mxi�Υե������¹Ԥ��뤳�Ȥǡ����Ȥ���DreamWeaver��Extension�Ȥ��ƥ��󥹥ȡ��뤵��ޤ���DreamWeaver�Ƶ�ư��ˡ�Snippet�������ѤǤ��ޤ���
					<input type='submit' name='as_dw_extension_zip' value='zip' />
					<input type='submit' name='as_dw_extension_tgz' value='tar.gz' />
				</dd>
			</dl>
		</p>
	</form>

	<form action='get_templates.php' method='post' class='odd' style='margin: 40px;' target='_blank'>
		<p>
			<dl>
				<dt>
					�ƥ�ץ졼�Ȥ��������ɤ���
				</dt>
				<dd>
					<select name='tplset'>$tplset_options</select>
					<input type='submit' name='download_zip' value='zip' />
					<input type='submit' name='download_tgz' value='tar.gz' />
				</dd>
			</dl>
		</p>
	</form>

	<form action='put_templates.php' method='post' enctype='multipart/form-data' class='odd' style='margin: 40px;'>
		<p>
			<dl>
				<dt>
					�ƥ�ץ졼�Ȥ򥢥åץ��ɤ���
				</dt>
				<dd>
					�ƥ�ץ졼�ȥե������ޤȤ᤿zip�ե�����ǥ��åץ��ɤ��Ƥ���������
					<br />
					<select name='tplset'>$tplset_options</select>
					<input type='file' name='tplset_archive' />
					<input type='submit' value='"._SUBMIT."' />
				</dd>
			</dl>
		</p>
	</form>
\n" ;


xoops_cp_footer() ;
?>
