<?php
require_once( '../../../include/cp_header.php' ) ;
require_once( '../include/gtickets.php' ) ;


// COPY TABLES
if( ! empty( $_POST['copy'] ) && ! empty( $_POST['old_prefix'] ) ) {

	// Ticket check
	if ( ! $xoopsGTicket->check() ) {
		redirect_header(XOOPS_URL.'/',3,$xoopsGTicket->getErrors());
	}

	$new_prefix = empty( $_POST['new_prefix'] ) ? 'x' . substr( md5( time() ) , -5 ) : $_POST['new_prefix'] ;
	$old_prefix = $_POST['old_prefix'] ;

	$srs = $xoopsDB->queryF( 'SHOW TABLE STATUS FROM `'.XOOPS_DB_NAME.'`' ) ;

	if( ! $xoopsDB->getRowsNum( $srs ) ) die( "You are not allowed to copy tables" ) ;

	$count = 0;
	while( $row_table = $xoopsDB->fetchArray( $srs ) ) {
		$count ++ ;
		$old_table = $row_table['Name'] ;
		if( substr( $old_table , 0 , strlen( $old_prefix ) + 1 ) !== $old_prefix . '_' ) continue ;

		$new_table = $new_prefix . substr( $old_table , strlen( $old_prefix ) ) ;

		$crs = $xoopsDB->queryF( 'SHOW CREATE TABLE '.$old_table ) ;
		if( ! $xoopsDB->getRowsNum( $crs ) ) {
			echo "error: SHOW CREATE TABLE ($old_table)<br />\n" ;
			continue ;
		}
		$row_create = $xoopsDB->fetchArray( $crs ) ;
		$create_sql = preg_replace( "/^CREATE TABLE `$old_table`/" , "CREATE TABLE `$new_table`" , $row_create['Create Table'] , 1 ) ;

		$crs = $xoopsDB->queryF( $create_sql ) ;
		if( ! $crs ) {
			echo "error: CREATE TABLE ($new_table)<br />\n" ;
			continue ;
		}

		$irs = $xoopsDB->queryF( "INSERT INTO `$new_table` SELECT * FROM `$old_table`" ) ;
		if( ! $irs ) {
			echo "error: INSERT INTO ($new_table)<br />\n" ;
			continue ;
		}

	}

	$_SESSION['protector_logger'] = $xoopsLogger->dumpQueries() ;

	redirect_header( 'prefix_manager.php' , 1 , _AM_MSG_DBUPDATED ) ;
	exit ;

// DROP TABLES
} else if( ! empty( $_POST['delete'] ) && ! empty( $_POST['prefix'] ) ) {

	// Ticket check
	if ( ! $xoopsGTicket->check() ) {
		redirect_header(XOOPS_URL.'/',3,$xoopsGTicket->getErrors());
	}

	$prefix = $_POST['prefix'] ;

	// check if prefix is working
	if( $prefix == XOOPS_DB_PREFIX ) die( "You can't drop working tables" ) ;

	// check if prefix_xoopscomments exists
	$check_rs = $xoopsDB->queryF( "SELECT * FROM {$prefix}_xoopscomments LIMIT 1" ) ;
	if( ! $check_rs ) die( "This is not a prefix for XOOPS" ) ;

	// get table list
	$srs = $xoopsDB->queryF( 'SHOW TABLE STATUS FROM `'.XOOPS_DB_NAME.'`' ) ;
	if( ! $xoopsDB->getRowsNum( $srs ) ) die( "You are not allowed to delete tables" ) ;

	while( $row_table = $xoopsDB->fetchArray( $srs ) ) {
		$table = $row_table['Name'] ;
		if( substr( $table , 0 , strlen( $prefix ) + 1 ) !== $prefix . '_' ) continue ;
		$drs = $xoopsDB->queryF( "DROP TABLE `$table`" ) ;
	}

	$_SESSION['protector_logger'] = $xoopsLogger->dumpQueries() ;

	redirect_header( 'prefix_manager.php' , 1 , _AM_MSG_DBUPDATED ) ;
	exit ;
}


// beggining of Output
xoops_cp_header();
include( './mymenu.php' ) ;

// query
$srs = $xoopsDB->queryF( "SHOW TABLE STATUS FROM `".XOOPS_DB_NAME.'`' ) ;
if( ! $xoopsDB->getRowsNum( $srs ) ) {
	die( "You are not allowed to copy tables" ) ;
	xoops_cp_footer() ;
	exit ;
}

// search prefixes
$tables = array() ;
$prefixes = array() ;
while( $row_table = $xoopsDB->fetchArray( $srs ) ) {
	if( substr( $row_table["Name"] , -6 ) === '_users' ) {
		$prefixes[] = array(
				'name' => substr( $row_table["Name"] , 0 , -6 ) ,
				'updated' => $row_table["Update_time"]
			) ;
	}
	$tables[] = $row_table["Name"] ;
}


// table
echo "
<h3>"._AM_H3_PREFIXMAN."</h3>
<table class='outer' width='95%'>
	<tr>
		<th>PREFIX</th>
		<th>TABLES</th>
		<th>UPDATED</th>
		<th>COPY</th>
		<th>DELETE</th>
	</tr>
" ;

foreach( $prefixes as $prefix ) {

	// count the number of tables with the prefix
	$table_count = 0 ;
	$has_xoopscomments = false ;
	foreach( $tables as $table ) {
		if( $table == $prefix['name'] . '_xoopscomments' ) $has_xoopscomments = true ;
		if( substr( $table , 0 , strlen( $prefix['name'] ) + 1 ) === $prefix['name'] . '_' ) $table_count ++ ;
	}

	// check if prefix_xoopscomments exists
	if( ! $has_xoopscomments ) continue ;

	$prefix4disp = htmlspecialchars( $prefix['name'] , ENT_QUOTES ) ;
	$ticket_input = $xoopsGTicket->getTicketHtml( __LINE__ ) ;

	if( $prefix['name'] == XOOPS_DB_PREFIX ) {
		$del_button = '' ;
		$style_append = 'background-color:#FFFFFF' ;
	} else {
		$del_button = "<input type='submit' name='delete' value='delete' onclick='return confirm(\""._AM_CONFIRM_DELETE."\")' />" ;
		$style_append = '' ;
	}

	echo "
	<tr>
		<td class='odd' style='$style_append;'>$prefix4disp</td>
		<td class='odd' style='text-align:right;$style_append;'>$table_count</td>
		<td class='odd' style='text-align:right;$style_append;'>{$prefix['updated']}</td>
		<td class='odd' style='text-align:center;$style_append;' nowrap='nowrap'>
			<form action='' method='POST' style='margin:0px;'>
				$ticket_input
				<input type='hidden' name='old_prefix' value='$prefix4disp' />
				<input type='text' name='new_prefix' size='8' maxlength='16' />
				<input type='submit' name='copy' value='copy' />
			</form>
		</td>
		<td class='odd' style='text-align:center;$style_append;'>
			<form action='' method='POST' style='margin:0px;'>
				$ticket_input
				<input type='hidden' name='prefix' value='$prefix4disp' />
				$del_button
			</form>
		</td>
	</tr>\n" ;

}

echo "
</table>
<p>".sprintf(_AM_TXT_HOWTOCHANGEDB,XOOPS_ROOT_PATH,XOOPS_DB_PREFIX)."</p>

" ;

// Display Log if exists
if( ! empty( $_SESSION['protector_logger'] ) ) {
	echo $_SESSION['protector_logger'] ;
	$_SESSION['protector_logger'] = '' ;
	unset( $_SESSION['protector_logger'] ) ;
}

xoops_cp_footer();
?>
