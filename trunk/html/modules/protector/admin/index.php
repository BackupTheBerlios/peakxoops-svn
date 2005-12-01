<?php
require_once( '../../../include/cp_header.php' ) ;
require_once( XOOPS_ROOT_PATH.'/class/pagenav.php' ) ;
require_once( '../include/gtickets.php' ) ;


// GET vars
$pos = empty( $_GET[ 'pos' ] ) ? 0 : intval( $_GET[ 'pos' ] ) ;
$num = empty( $_GET[ 'num' ] ) ? 20 : intval( $_GET[ 'num' ] ) ;

// Table Name
$log_table = $xoopsDB->prefix( "protector_log" ) ;


// UPDATE stage
if( ! empty( $_POST['action'] ) ) {
	// Checking Referer deeply against CSRF
	if( strpos( $_SERVER['HTTP_REFERER'] , XOOPS_URL.'/modules/protector/admin/' ) !== 0 ) {
		die( "Turn your REFERER on" ) ;
	}

	if( $_POST['action'] == 'preferences' ) {
		// Ticket check
		if ( ! $xoopsGTicket->check() ) {
			redirect_header(XOOPS_URL.'/',3,$xoopsGTicket->getErrors());
		}

		// update configs about ban IP
		$config_handler =& xoops_gethandler('config');

		$criteria = new CriteriaCompo(new Criteria('conf_modid', 2, '<'));
		$criteria->add(new Criteria('conf_name', 'bad_ips'));
		list( $config ) = $config_handler->getConfigs( $criteria );
		$config->setVar( 'conf_value' , serialize( explode( '|' , trim( $_POST['bad_ips'] ) ) ) ) ;
		$config_handler->insertConfig( $config ) ;

		$criteria = new CriteriaCompo(new Criteria('conf_modid', 2, '<'));
		$criteria->add(new Criteria('conf_name', 'enable_badips'));
		list( $config ) = $config_handler->getConfigs( $criteria );
		$config->setVar( 'conf_value' , empty( $_POST['enable_badips'] ) ? 0 : 1 ) ;
		$config_handler->insertConfig( $config ) ;

		redirect_header( "index.php" , 2 , _AM_MSG_PRUPDATED ) ;
		exit ;

	} else if( $_POST['action'] == 'delete' && isset( $_POST['ids'] ) && is_array( $_POST['ids'] ) ) {
		// Ticket check
		if ( ! $xoopsGTicket->check() ) {
			redirect_header(XOOPS_URL.'/',3,$xoopsGTicket->getErrors());
		}

		// remove records
		foreach( $_POST['ids'] as $lid ) {
			$lid = intval( $lid ) ;
			$xoopsDB->query( "DELETE FROM $log_table WHERE lid='$lid'" ) ;
		}
		redirect_header( "index.php" , 2 , _AM_MSG_REMOVED ) ;
		exit ;
	}
}


// query for listing
$rs = $xoopsDB->query( "SELECT count(lid) FROM $log_table" ) ;
list( $numrows ) = $xoopsDB->fetchRow( $rs ) ;
$prs = $xoopsDB->query( "SELECT l.lid, l.uid, l.ip, l.agent, l.type, l.description, UNIX_TIMESTAMP(l.timestamp), u.uname FROM $log_table l LEFT JOIN ".$xoopsDB->prefix("users")." u ON l.uid=u.uid ORDER BY timestamp DESC LIMIT $pos,$num" ) ;

// Page Navigation
$nav = new XoopsPageNav( $numrows , $num , $pos , 'pos' , "num=$num" ) ;
$nav_html = $nav->renderNav( 10 ) ;

// Number selection
$num_options = '' ;
$num_array = array( 20 , 100 , 500 , 2000 ) ;
foreach( $num_array as $n ) {
	if( $n == $num ) {
		$num_options .= "<option value='$n' selected='selected'>$n</option>\n" ;
	} else {
		$num_options .= "<option value='$n'>$n</option>\n" ;
	}
}

// beggining of Output
xoops_cp_header();
include( './mymenu.php' ) ;

// check $xoopsModule
if( ! is_object( $xoopsModule ) ) redirect_header( XOOPS_URL.'/user.php' , 1 , _NOPERM ) ;

// title
echo "<h3 style='text-align:left;'>".$xoopsModule->name()."</h3>\n" ;

// edit configs about IP ban
if( $xoopsConfig['enable_badips'] ) {
	$checked_banip_yes = "checked='checked'" ;
	$checked_banip_no = "" ;
} else {
	$checked_banip_yes = "" ;
	$checked_banip_no = "checked='checked'" ;
}
echo "
<form name='ConfigForm' action='' method='POST'>
".$xoopsGTicket->getTicketHtml(__LINE__)."
<input type='hidden' name='action' value='preferences' />
<table width='95%' class='outer' cellpadding='4' cellspacing='1'>
  <tr valign='top' align='left'>
    <td class='head'>
      "._AM_TH_BADIPS."
    </td>
    <td class='even'>
      <textarea name='bad_ips' id='bad_ips' rows='5' cols='50'>".htmlspecialchars(implode('|',$xoopsConfig['bad_ips']),ENT_QUOTES)."</textarea>
    </td>
  </tr>
  <tr valign='top' align='left'>
    <td class='head'>
      "._AM_TH_ENABLEIPBANS."
    </td>
    <td class='even'>
      <input type='radio' name='enable_badips' value='1' $checked_banip_yes />"._YES."
      &nbsp;
      <input type='radio' name='enable_badips' value='0' $checked_banip_no />"._NO."
    </td>
  </tr>
  <tr valign='top' align='left'>
    <td class='head'>
    </td>
    <td class='even'>
      <input type='submit' value='"._GO."' />
    </td>
  </tr>
</table>
</form>
" ;

// header of log listing
echo "
<table width='95%' border='0' cellpadding='4' cellspacing='0'><tr><td>
<form action='' method='GET' style='margin-bottom:0px;'>
  <table width='95%' border='0' cellpadding='4' cellspacing='0'>
    <tr>
      <td align='left'>
        <select name='num' onchange='submit();'>$num_options</select>
      </td>
      <td align='right'>
        $nav_html
      </td>
    </tr>
  </table>
</form>
<form name='MainForm' action='' method='POST' style='margin-top:0px;'>
".$xoopsGTicket->getTicketHtml(__LINE__)."
<input type='hidden' name='action' value='' />
<table width='95%' class='outer' cellpadding='4' cellspacing='1'>
  <tr valign='middle'>
    <th width='5'><input type='checkbox' name='dummy' onclick=\"with(document.MainForm){for(i=0;i<length;i++){if(elements[i].type=='checkbox'){elements[i].checked=this.checked;}}}\" /></th>
    <th>"._AM_TH_DATETIME."</th>
    <th>"._AM_TH_USER."</th>
    <th>"._AM_TH_IP."<br />"._AM_TH_AGENT."</th>
    <th>"._AM_TH_TYPE."</th>
    <th>"._AM_TH_DESCRIPTION."</th>
  </tr>
" ;

// body of log listing
$oddeven = 'odd' ;
while( list( $lid , $uid , $ip , $agent , $type , $description , $timestamp , $uname ) = $xoopsDB->fetchRow( $prs ) ) {
	$oddeven = ( $oddeven == 'odd' ? 'even' : 'odd' ) ;

	$ip = htmlspecialchars( $ip , ENT_QUOTES ) ;
	$type = htmlspecialchars( $type , ENT_QUOTES ) ;
	$description = htmlspecialchars( $description , ENT_QUOTES ) ;
	$uname = htmlspecialchars( ( $uid ? $uname : _GUESTS ) , ENT_QUOTES ) ;

	// make agent shorten
	if( preg_match( '/MSIE\s+([0-9.]+)/' , $agent , $regs ) ) {
		$agent_short = 'IE ' . $regs[1] ;
	} else if( stristr( $agent , 'Gecko' ) !== false ) {
		$agent_short = strrchr( $agent , ' ' ) ;
	} else {
		$agent_short = substr( $agent , 0 , strpos( $agent , ' ' ) ) ;
	}
	$agent4disp = htmlspecialchars( $agent , ENT_QUOTES ) ;
	$agent_desc = $agent == $agent_short ? $agent4disp : htmlspecialchars( $agent_short , ENT_QUOTES ) . "<img src='../images/dotdotdot.gif' alt='$agent4disp' title='$agent4disp' />" ;

	echo "
  <tr>
    <td class='$oddeven'><input type='checkbox' name='ids[]' value='$lid' /></td>
    <td class='$oddeven'>".formatTimestamp($timestamp)."</td>
    <td class='$oddeven'>$uname</td>
    <td class='$oddeven'>$ip<br />$agent_desc</td>
    <td class='$oddeven'>$type</td>
    <td class='$oddeven' width='100%'>$description</td>
  </tr>\n" ;
}

// footer of log listing
echo "
  <tr>
    <td colspan='8' align='left'>"._AM_LABEL_REMOVE."<input type='button' value='"._AM_BUTTON_REMOVE."' onclick='if(confirm(\""._AM_JS_REMOVECONFIRM."\")){document.MainForm.action.value=\"delete\"; submit();}' /></td>
  </tr>
</table>
</form>
</td></tr></table>
" ;

xoops_cp_footer();
?>
