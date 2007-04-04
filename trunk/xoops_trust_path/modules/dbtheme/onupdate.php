<?php

eval( ' function xoops_module_update_'.$mydirname.'( $module ) { return dbtheme_onupdate_base( $module , "'.$mydirname.'" ) ; } ' ) ;


if( ! function_exists( 'dbtheme_onupdate_base' ) ) {

function dbtheme_onupdate_base( $module , $mydirname )
{
	// transations on module update

	global $msgs ; // TODO :-D

	// for Cube 2.1
	if( defined( 'XOOPS_CUBE_LEGACY' ) ) {
		$root =& XCube_Root::getSingleton();
		$root->mDelegateManager->add( 'Legacy.Admin.Event.ModuleUpdate.' . ucfirst($mydirname) . '.Success', 'dbtheme_message_append_onupdate' ) ;
		$msgs = array() ;
	} else {
		if( ! is_array( $msgs ) ) $msgs = array() ;
	}

	$db =& Database::getInstance() ;
	$mid = $module->getVar('mid') ;

	// TABLES (write here ALTER TABLE etc. if necessary)

	// configs (Though I know it is not a recommended way...)
	$check_sql = "SHOW COLUMNS FROM ".$db->prefix("config")." LIKE 'conf_title'" ;
	if( ( $result = $db->query( $check_sql ) ) && ( $myrow = $db->fetchArray( $result ) ) && @$myrow['Type'] == 'varchar(30)' ) {
		$db->queryF( "ALTER TABLE ".$db->prefix("config")." MODIFY `conf_title` varchar(255) NOT NULL default '', MODIFY `conf_desc` varchar(255) NOT NULL default ''" ) ;
	}

	// IMPORT THE SELECTED THEME AS THIS MODULE'S TEMPLATES
	$tplfile_handler =& xoops_gethandler( 'tplfile' ) ;


	/*************** BEGIN DBTHEME SPECIFIC PART ******************/
	if( file_exists( dirname(__FILE__).'/templates/theme.html' ) ) {
		$tpl_path = dirname(__FILE__).'/templates' ;
	} else {
		$tpl_path = XOOPS_ROOT_PATH.'/themes/'.$GLOBALS['xoopsConfig']['theme_set'] ;
	}
	/*************** END DBTHEME SPECIFIC PART ******************/


	if( $handler = @opendir( $tpl_path . '/' ) ) {
		while( ( $file = readdir( $handler ) ) !== false ) {
			if( substr( $file , 0 , 1 ) == '.' ) continue ;
			$file_path = $tpl_path . '/' . $file ;
			if( is_file( $file_path ) && in_array( strrchr( $file , '.' ) , array( '.html' , '.css' , '.js' ) ) ) {
				$mtime = intval( @filemtime( $file_path ) ) ;
				$tplfile =& $tplfile_handler->create() ;

				/*************** BEGIN DBTHEME SPECIFIC PART ******************/
				$tpl_source = file_get_contents( $file_path ) ;
				$searches = array() ;
				$replacements = array() ;
				if( strrchr( $file , '.' ) == '.html' ) {
					// CSS hooking
					$searches[] = '/\"\<\{\$xoops_themecss\}\>"/' ;
					$replacements[] = '"<{$xoops_url}>/modules/dbtheme/?template=style.css'.'"' ;
					$searches[] = '/\"\<\{\$xoops_imageurl\}\>([0-9a-zA-Z_-]+)\.(css|html|js)\"/' ;
					$replacements[] = '"<{$xoops_url}>/modules/dbtheme/?template=$1.$2'.'"' ;
				} else if( strrchr( $file , '.' ) == '.css' ) {
					// url() hooking
					$searches[] = '/url\(([a-z]{3})/' ;
					$replacements[] = 'url(<{$xoops_imageurl}>$1' ;
				}
				$tplfile->setVar( 'tpl_source' , preg_replace( $searches , $replacements , $tpl_source ) ) ;
				$mtime = time() ;
				/*************** END DBTHEME SPECIFIC PART ******************/

//				$tplfile->setVar( 'tpl_source' , file_get_contents( $file_path ) , true ) ;
				$tplfile->setVar( 'tpl_refid' , $mid ) ;
				$tplfile->setVar( 'tpl_tplset' , 'default' ) ;
				$tplfile->setVar( 'tpl_file' , $mydirname . '_' . $file ) ;
				$tplfile->setVar( 'tpl_desc' , '' , true ) ;
				$tplfile->setVar( 'tpl_module' , $mydirname ) ;
				$tplfile->setVar( 'tpl_lastmodified' , $mtime ) ;
				$tplfile->setVar( 'tpl_lastimported' , 0 ) ;
				$tplfile->setVar( 'tpl_type' , 'module' ) ;
				if( ! $tplfile_handler->insert( $tplfile ) ) {
					$msgs[] = '<span style="color:#ff0000;">ERROR: Could not insert template <b>'.htmlspecialchars($mydirname.'_'.$file).'</b> to the database.</span>';
				} else {
					$tplid = $tplfile->getVar( 'tpl_id' ) ;
					$msgs[] = 'Template <b>'.htmlspecialchars($mydirname.'_'.$file).'</b> added to the database. (ID: <b>'.$tplid.'</b>)';
					// generate compiled file
					include_once XOOPS_ROOT_PATH.'/class/xoopsblock.php' ;
					include_once XOOPS_ROOT_PATH.'/class/template.php' ;
					if( ! xoops_template_touch( $tplid ) ) {
						$msgs[] = '<span style="color:#ff0000;">ERROR: Failed compiling template <b>'.htmlspecialchars($mydirname.'_'.$file).'</b>.</span>';
					} else {
						$msgs[] = 'Template <b>'.htmlspecialchars($mydirname.'_'.$file).'</b> compiled.</span>';
					}
				}
			}
		}
		closedir( $handler ) ;
	}
	include_once XOOPS_ROOT_PATH.'/class/xoopsblock.php' ;
	include_once XOOPS_ROOT_PATH.'/class/template.php' ;
	xoops_template_clear_module_cache( $mid ) ;

	return true ;
}

function dbtheme_message_append_onupdate( &$module_obj , &$log )
{
	if( is_array( @$GLOBALS['msgs'] ) ) {
		foreach( $GLOBALS['msgs'] as $message ) {
			$log->add( strip_tags( $message ) ) ;
		}
	}

	// use mLog->addWarning() or mLog->addError() if necessary
}

}

?>