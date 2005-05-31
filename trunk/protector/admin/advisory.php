<?php
require_once( '../../../include/cp_header.php' ) ;

// beggining of Output
xoops_cp_header();
include( './mymenu.php' ) ;


// open table for ADVISORY
echo "<br />\n<div style='border: 2px solid #2F5376;padding:8px;width:95%;' class='bg4'>\n" ;

// register_globals
echo "<dl><dt>'register_globals' : " ;
$safe = ! ini_get( "register_globals" ) ;
if( $safe ) {
	echo "off &nbsp; <span style='color:green;font-weight:bold;'>ok</span></dt>\n" ;
} else {
	echo "on  &nbsp; <span style='color:red;font-weight:bold;'>"._AM_ADV_NOTSECURE."</span></dt>\n" ;
	echo "<dd>"._AM_ADV_REGISTERGLOBALS."<br /><br />
			".XOOPS_ROOT_PATH."/.htaccess<br /><br />
			<b>php_flag &nbsp; register_globals &nbsp; off</b>
		</dd>" ;
}
echo "</dl>\n" ;


// allow_url_fopen
echo "<dl><dt>'allow_url_fopen' : " ;
$safe = ! ini_get( "allow_url_fopen" ) ;
if( $safe ) {
	echo "off &nbsp; <span style='color:green;font-weight:bold;'>ok</span></dt>\n" ;
} else {
	echo "on  &nbsp; <span style='color:red;font-weight:bold;'>"._AM_ADV_NOTSECURE."</span></dt>\n" ;
	echo "<dd>"._AM_ADV_ALLOWURLFOPEN."</dd>" ;
}
echo "</dl>\n" ;


// XOOPS_DB_PREFIX
echo "<dl><dt>'XOOPS_DB_PREFIX' : " ;
$safe = strtolower( XOOPS_DB_PREFIX ) != 'xoops' ;
if( $safe ) {
	echo XOOPS_DB_PREFIX." &nbsp; <span style='color:green;font-weight:bold;'>ok</span></dt>\n" ;
} else {
	echo XOOPS_DB_PREFIX." &nbsp; <span style='color:red;font-weight:bold;'>"._AM_ADV_NOTSECURE."</span></dt>\n" ;
	echo "<dd>"._AM_ADV_DBPREFIX."</dd>" ;
}
echo "<br /> &nbsp; <a href='prefix_manager.php'>"._AM_ADV_LINK_TO_PREFIXMAN."</a>" ;
echo "</dl>\n" ;


// patch to mainfile.php
echo "<dl><dt>'mainfile.php' : " ;
if( ! defined( 'PROTECTOR_PRECHECK_INCLUDED' ) ) {
	echo "missing precheck &nbsp; <span style='color:red;font-weight:bold;'>"._AM_ADV_NOTSECURE."</span></dt>\n" ;
	echo "<dd>"._AM_ADV_MAINUNPATCHED."</dd>" ;
} else if( ! defined( 'PROTECTOR_POSTCHECK_INCLUDED' ) ) {
	echo "missing postcheck &nbsp; <span style='color:red;font-weight:bold;'>"._AM_ADV_NOTSECURE."</span></dt>\n" ;
	echo "<dd>"._AM_ADV_MAINUNPATCHED."</dd>" ;
} else {
	echo "patched &nbsp; <span style='color:green;font-weight:bold;'>ok</span></dt>\n" ;
}
echo "</dl>\n" ;

// rescue password
echo "<dl><dt>'"._AM_ADV_RESCUEPASSWORD."' : " ;
$result = $xoopsDB->query( "SELECT conf_value FROM ".$xoopsDB->prefix("config")." WHERE conf_title='_MI_PROTECTOR_PASSWD_BIP'" ) ;
list( $password ) = $xoopsDB->fetchRow( $result ) ;
if( empty( $password ) || substr( $password , 3 ) == md5( XOOPS_DB_PREFIX ) ) {
	echo "<span style='color:red;font-weight:bold;'>"._AM_ADV_RESCUEPASSWORDUNSET."</span></dt>\n" ;
} else {
	echo "<span style='color:green;font-weight:bold;'>ok</span></dt>\n" ;
}
echo "</dl>\n" ;

// close table for ADVISORY
echo "</div><br />\n" ;



// open table for ADVISORY
echo "<br />\n<div style='border: 2px solid #2F5376;padding:8px;width:95%;' class='bg4'>\n" ;

echo "<h3>"._AM_ADV_SUBTITLECHECK."</h3>\n" ;

if( empty( $password ) ) {
	echo "<p>"._AM_ADV_AT1STSETPASSWORD."</p>\n" ;
} else {
	// Check contaminations
	$uri_contami = XOOPS_URL."/index.php?xoopsConfig%5Bnocommon%5D=1" ;
	echo "<dl><dt>"._AM_ADV_CHECKCONTAMI.":</dt>\n" ;
	echo "<dd><a href='$uri_contami' target='_blank'>$uri_contami</a></dd>" ;
	echo "</dl>\n" ;
	
	// Check isolated comments
	$uri_isocom = XOOPS_URL."/index.php?cid=".urlencode(",password /*") ;
	echo "<dl><dt>"._AM_ADV_CHECKISOCOM.":</dt>\n" ;
	echo "<dd><a href='$uri_isocom' target='_blank'>$uri_isocom</a></dd>" ;
	echo "</dl>\n" ;
}
// close table for ADVISORY
echo "</div>\n" ;



xoops_cp_footer();
?>