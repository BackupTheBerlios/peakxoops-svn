<?php

require_once( '../../../include/cp_header.php' ) ;
require_once( '../class/piCal.php' ) ;
require_once( '../class/piCal_xoops.php' ) ;


// for "Duplicatable"
$mydirname = basename( dirname( dirname( __FILE__ ) ) ) ;
if( ! preg_match( '/^(\D+)(\d*)$/' , $mydirname , $regs ) ) echo ( "invalid dirname: " . htmlspecialchars( $mydirname ) ) ;
$mydirnumber = $regs[2] === '' ? '' : intval( $regs[2] ) ;

require_once( XOOPS_ROOT_PATH."/modules/$mydirname/include/gtickets.php" ) ;

// SERVER, GET 変数の取得
$PHP_SELF = $_SERVER[ 'PHP_SELF' ] ;
$action = isset( $_POST[ 'action' ] ) ? $_POST[ 'action' ] : '' ;
$type = isset( $_GET[ 'type' ] ) ? trim( $_GET[ 'type' ] ) : 'monthly' ;


// MySQLへの接続
$conn = $xoopsDB->conn ;	// 本来はprivateメンバなので将来的にはダメ

// 各種パスの設定
$mod_path = XOOPS_ROOT_PATH."/modules/$mydirname" ;
$mod_url = XOOPS_URL."/modules/$mydirname" ;

// オブジェクトの生成
$cal = new piCal_xoops( "" , $xoopsConfig['language'] , true ) ;

// 各プロパティの設定
$cal->conn = $conn ;
include( '../include/read_configs.php' ) ;
$cal->base_url = $mod_url ;
$cal->base_path = $mod_path ;
$cal->images_url = "$mod_url/images/$skin_folder" ;
$cal->images_path = "$mod_path/images/$skin_folder" ;
$pi_table = $xoopsDB->prefix( "pical_plugins" ) ;


// XOOPS関連の初期化
$myts =& MyTextSanitizer::getInstance();


// データベース更新などがからむ処理
if( ! empty( $_POST['update'] ) ) {

	// Ticket Check
	if ( ! $xoopsGTicket->check() ) {
		redirect_header(XOOPS_URL.'/',3,$xoopsGTicket->getErrors());
	}

	// new
	if( ! empty( $_POST['pi_types'][0] ) ) {
		$pi_type4sql = addslashes( $_POST['pi_types'][0] ) ;
		$pi_weight4sql = intval( $_POST['pi_weight'][0] ) ;
		$pi_title4sql = addslashes( $_POST['pi_titles'][0] ) ;
		$pi_dirname4sql = addslashes( $_POST['pi_dirnames'][0] ) ;
		$pi_file4sql = addslashes( $_POST['pi_files'][0] ) ;
		$pi_dotgif4sql = addslashes( $_POST['pi_dotgifs'][0] ) ;

		if( ! mysql_query( "INSERT INTO $pi_table SET pi_type='$pi_type4sql', pi_weight='$pi_weight4sql', pi_title='$pi_title4sql', pi_dirname='$pi_dirname4sql', pi_file='$pi_file4sql', pi_dotgif='$pi_dotgif4sql', pi_enabled='1'" , $conn ) ) die( mysql_error() ) ;
	}

	// バッチアップデート
	foreach( array_keys( $_POST['pi_titles'] ) as $pi_id ) {
		if( $pi_id <= 0 ) continue ;
		if( ! empty( $_POST['deletes'][$pi_id] ) ) {
			if( ! mysql_query( "DELETE FROM $pi_table WHERE pi_id=$pi_id" , $conn ) ) die( mysql_error() ) ;
		} else {
			$pi_type4sql = addslashes( $_POST['pi_types'][$pi_id] ) ;
			$pi_weight4sql = intval( $_POST['pi_weight'][$pi_id] ) ;
			$pi_title4sql = addslashes( $_POST['pi_titles'][$pi_id] ) ;
			$pi_title4sql = addslashes( $_POST['pi_titles'][$pi_id] ) ;
			$pi_dirname4sql = addslashes( $_POST['pi_dirnames'][$pi_id] ) ;
			$pi_file4sql = addslashes( $_POST['pi_files'][$pi_id] ) ;
			$pi_dotgif4sql = addslashes( $_POST['pi_dotgifs'][$pi_id] ) ;
			$pi_enabled4sql = ! empty( $_POST['pi_enableds'][$pi_id] ) ? 1 : 0 ;
	
			if( ! mysql_query( "UPDATE $pi_table SET pi_type='$pi_type4sql', pi_weight='$pi_weight4sql', pi_title='$pi_title4sql', pi_dirname='$pi_dirname4sql', pi_file='$pi_file4sql', pi_dotgif='$pi_dotgif4sql', pi_enabled='$pi_enabled4sql' WHERE pi_id=$pi_id" , $conn ) ) die( mysql_error() ) ;
		}
	}

	// remove cache of piCal minical_ex
	if( $handler = opendir( XOOPS_CACHE_PATH . '/' ) ) {
		while( ( $file = readdir( $handler ) ) !== false ) {
			if( substr( $file , 0 , 16 ) == 'piCal_minical_ex' ) {
				@unlink( XOOPS_CACHE_PATH . '/' . $file ) ;
			}
		}
	}

	$mes = urlencode( sprintf( _AM_PI_UPDATED ) ) ;
	$cal->redirect( "mes=$mes" ) ;
	exit ;

}



// メイン出力部
xoops_cp_header();
include( './mymenu.php' ) ;

	echo "<h4>"._MI_PICAL_ADMENU_PLUGINS."</h4>\n" ;

	if( ! empty( $_GET['mes'] ) ) echo "<p><font color='blue'>".htmlspecialchars($_GET['mes'],ENT_QUOTES)."</font></p>" ;

	// type options
	$type_options = "<option value=''>----</option>\n" ;
	// monthly
	$type_options .= "<option value='monthly'>"._AM_PI_VIEWMONTHLY."</option>\n" ;
	$type_options .= "<option value='weekly'>"._AM_PI_VIEWWEEKLY."</option>\n" ;
	$type_options .= "<option value='daily'>"._AM_PI_VIEWDAILY."</option>\n" ;
	// block - minicalex (mcx . $bid)
	$type_rs = $xoopsDB->query( "SELECT bid,title FROM ".$xoopsDB->prefix("newblocks")." WHERE mid='".$xoopsModule->getVar('mid')."' AND show_func='pical_minical_ex_show'" ) ;
	while( list( $bid , $title ) = $xoopsDB->fetchRow( $type_rs ) ) {
		$type_options .= "<option value='mcx{$bid}'>".$myts->makeTboxData4Show($title)."</option>\n" ;
	}

	// dirname options
	$dirname_options = "<option value=''>----</option>\n" ;
	$dn_rs = $xoopsDB->query( "SELECT dirname FROM ".$xoopsDB->prefix("modules") ) ;
	while( list( $dirname ) = $xoopsDB->fetchRow( $dn_rs ) ) {
		$dirname_options .= "<option value='$dirname'>$dirname</option>\n" ;
	}

	// plugin file options
	$file_options = "<option value=''>----</option>\n" ;
	$plugins_dir = $cal->base_path . '/' . $cal->plugins_path_monthly ;
	$dir_handle = opendir( $plugins_dir ) ;
	while( ( $file = readdir( $dir_handle ) ) !== false ) {
		if( is_file( "$plugins_dir/$file" ) ) {
			list( $node , $ext ) = explode( '.' , $file ) ;
			if( $ext != 'php' ) continue ;
			$file4disp = htmlspecialchars( $file , ENT_QUOTES ) ;
			$file_options .= "<option value='$file4disp'>$file4disp</option>\n" ;
		}
	}
	closedir( $dir_handle ) ;

	// dotgif options
	$dotgif_options = '' ;
	$dir_handle = opendir( $cal->images_path ) ;
	while( ( $file = readdir( $dir_handle ) ) !== false ) {
		if( is_file( "$cal->images_path/$file" ) ) {
			list( $node , $ext ) = explode( '.' , $file ) ;
			if( $ext != 'gif' && $ext != 'png' && $ext != 'jpg' ) continue ;
			if( substr( $node , 0 , 3 ) != 'dot' ) continue ;
			$file4disp = htmlspecialchars( $file , ENT_QUOTES ) ;
			$dotgif_options .= "<option value='$file4disp'>$file4disp</option>\n" ;
		}
	}
	closedir( $dir_handle ) ;

	// プラグインデータ取得
	$prs = $xoopsDB->query( "SELECT * FROM $pi_table ORDER BY pi_type, pi_weight" ) ;

	// TH Part
	echo "
	<form name='MainForm' action='$PHP_SELF' method='post' style='margin:10px;'>
	".$xoopsGTicket->getTicketHtml( __LINE__ )."
	<table width='95%' class='outer' cellpadding='4' cellspacing='1'>
	  <tr valign='middle'>
	    <th>"._AM_PI_TH_TYPE."</th>
	    <th>"._AM_PI_TH_DIRNAME."<br /> &nbsp; "._AM_PI_TH_FILE."</th>
	    <th>"._AM_PI_TH_TITLE."<br /> &nbsp "._AM_PI_TH_DOTGIF."</th>
	    <th colspan='2'>"._AM_PI_TH_OPERATION."</th>
	  </tr>
	" ;

	// リスト出力部
	$oddeven = 'odd' ;
	while( $plugin = mysql_fetch_object( $prs ) ) {
		$oddeven = ( $oddeven == 'odd' ? 'even' : 'odd' ) ;

		$pi_id = intval( $plugin->pi_id ) ;
		$enable_checked = $plugin->pi_enabled ? "checked='checked'" : "" ;
		$pi_title = $myts->makeTBoxData4Edit( $plugin->pi_title ) ;
		$del_confirm = 'confirm("' . sprintf( _AM_FMT_CATDELCONFIRM , $pi_title ) . '")' ;
		echo "
	  <tr>
	    <td class='$oddeven' align='right'>
	      <select name='pi_types[$pi_id]'>
	        ".make_selected($type_options,$plugin->pi_type)."
	      </select>
	      &nbsp; <br />
	      <input type='text' name='pi_weight[$pi_id]' value='$plugin->pi_weight' size='3' style='text-align:right;' />
	    </td>
	    <td class='$oddeven'>
	      <select name='pi_dirnames[$pi_id]'>
	        ".make_selected($dirname_options,$plugin->pi_dirname)."
	      </select>
	      <br /> &nbsp; 
	      <select name='pi_files[$pi_id]'>
	        ".make_selected($file_options,$plugin->pi_file)."
	      </select>
	    </td>
	    <td class='$oddeven'>
	      <input type='text' name='pi_titles[$pi_id]' value='$pi_title' size='12' />
	      <br /> &nbsp; 
	      <select name='pi_dotgifs[$pi_id]'>$dotgif_options
	        ".make_selected($dotgif_options,$plugin->pi_dotgif)."
	      </select>
	    </td>
	    <td class='$oddeven'>
	      <input type='checkbox' value='1' name='pi_enableds[$pi_id]' $enable_checked />"._AM_PI_ENABLED."
	    </td>
	    <td class='$oddeven'>
	      <input type='checkbox' value='1' name='deletes[$pi_id]' />"._AM_PI_DELETE."
	    </td>
	  </tr>
		\n" ;
	}

	// 新規入力部
	echo "
	  <tr>
	    <td colspan='5'><br /></td>
	  </tr>
	  <tr>
	    <td class='$oddeven' align='right'>
	      <select name='pi_types[0]'>$type_options</select>
	      &nbsp; <br />
	      <input type='text' name='pi_weight[$pi_id]' value='0' size='3' style='text-align:right;' />
	    </td>
	    <td class='$oddeven'>
	      <select name='pi_dirnames[0]'>$dirname_options</select>
	      <br /> &nbsp; 
	      <select name='pi_files[0]'>
	        ".make_selected($file_options,"piCal.php")."
	      </select>
	    </td>
	    <td class='$oddeven'>
	      <input type='text' name='pi_titles[0]' value='' size='12' />
	      <br /> &nbsp; 
	      <select name='pi_dotgifs[0]'>
	        ".make_selected($dotgif_options,"dot8x8blue.gif")."
	      </select>
	    </td>
	    <td class='$oddeven' colspan='2'>
	      "._AM_PI_NEW."
	    </td>
	  </tr>
		\n" ;

	// テーブルフッタ部
	echo "
	  <tr>
	    <td colspan='5' align='right' class='head'><input type='submit' name='update' value='"._AM_BTN_UPDATE."' /></td>
	  </tr>
	  <tr>
	    <td colspan='5' align='right' valign='bottom' height='50'>".PICAL_COPYRIGHT."</td>
	  </tr>
	</table>
	</form>
	" ;

xoops_cp_footer();


function make_selected( $options , $current )
{
	return str_replace( "value='{$current}'>" , "value='{$current}' selected='selected'>" , $options ) ;

}


?>
