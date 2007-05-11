<?php

eval( ' function xoops_module_install_'.$mydirname.'( $module ) { return dbtheme_oninstall_base( $module , "'.$mydirname.'" ) ; } ' ) ;


if( ! function_exists( 'dbtheme_oninstall_base' ) ) {

function dbtheme_oninstall_base( $module , $mydirname )
{
	// transations on module install

	global $ret ; // TODO :-D

	// for Cube 2.1
	if( defined( 'XOOPS_CUBE_LEGACY' ) ) {
		$root =& XCube_Root::getSingleton();
		$root->mDelegateManager->add( 'Legacy.Admin.Event.ModuleInstall.' . ucfirst($mydirname) . '.Success' , 'dbtheme_message_append_oninstall' ) ;
		$ret = array() ;
	} else {
		if( ! is_array( $ret ) ) $ret = array() ;
	}

	$db =& Database::getInstance() ;
	$mid = $module->getVar('mid') ;

	// TABLES (loading mysql.sql)
	$sql_file_path = dirname(__FILE__).'/sql/mysql.sql' ;
	$prefix_mod = $db->prefix() . '_' . $mydirname ;
	if( file_exists( $sql_file_path ) ) {
		$ret[] = "SQL file found at <b>".htmlspecialchars($sql_file_path)."</b>.<br /> Creating tables...";

		if( file_exists( XOOPS_ROOT_PATH.'/class/database/oldsqlutility.php' ) ) {
			include_once XOOPS_ROOT_PATH.'/class/database/oldsqlutility.php' ;
			$sqlutil =& new OldSqlUtility ;
		} else {
			include_once XOOPS_ROOT_PATH.'/class/database/sqlutility.php' ;
			$sqlutil =& new SqlUtility ;
		}

		$sql_query = trim( file_get_contents( $sql_file_path ) ) ;
		$sqlutil->splitMySqlFile( $pieces , $sql_query ) ;
		$created_tables = array() ;
		if( is_array( $pieces ) ) foreach( $pieces as $piece ) {
			$prefixed_query = $sqlutil->prefixQuery( $piece , $prefix_mod ) ;
			if( ! $prefixed_query ) {
				$ret[] = "Invalid SQL <b>".htmlspecialchars($piece)."</b><br />";
				return false ;
			}
			if( ! $db->query( $prefixed_query[0] ) ) {
				$ret[] = '<b>'.htmlspecialchars( $db->error() ).'</b><br />' ;
				//var_dump( $db->error() ) ;
				return false ;
			} else {
				if( ! in_array( $prefixed_query[4] , $created_tables ) ) {
					$ret[] = 'Table <b>'.htmlspecialchars($prefix_mod.'_'.$prefixed_query[4]).'</b> created.<br />';
					$created_tables[] = $prefixed_query[4];
				} else {
					$ret[] = 'Data inserted to table <b>'.htmlspecialchars($prefix_mod.'_'.$prefixed_query[4]).'</b>.</br />';
				}
			}
		}
	}

	// IMPORT THE SELECTED THEME AS THIS MODULE'S TEMPLATES
	$tplfile_handler =& xoops_gethandler( 'tplfile' ) ;


	/*************** BEGIN DBTHEME SPECIFIC PART ******************/
	// set weight=0
	$db->queryF( "UPDATE ".$db->prefix("modules")." SET weight=0 WHERE mid=$mid" ) ;
	// set tpl_path
	$module_handler =& xoops_gethandler( 'module' ) ;
	$module =& $module_handler->getByDirname( $mydirname ) ;
	$config_handler =& xoops_gethandler( 'config' ) ;
	$mod_config =& $config_handler->getConfigsByCat( 0 , $module->getVar( 'mid' ) ) ;
	if( file_exists( dirname(__FILE__).'/templates/theme.html' ) ) {
		$tpl_path = dirname(__FILE__).'/templates' ;
	} else if( ! empty( $mod_config['base_theme'] ) ) {
		$tpl_path = XOOPS_ROOT_PATH.'/themes/'.$mod_config['base_theme'] ;
	} else {
		$tpl_path = XOOPS_ROOT_PATH.'/themes/'.$GLOBALS['xoopsConfig']['theme_set'] ;
	}
	/*************** END DBTHEME SPECIFIC PART ******************/


	$tpl_path = XOOPS_ROOT_PATH.'/themes/'.$GLOBALS['xoopsConfig']['theme_set'] ;
	if( $handler = @opendir( $tpl_path . '/' ) ) {
		while( ( $file = readdir( $handler ) ) !== false ) {
			if( substr( $file , 0 , 1 ) == '.' ) continue ;
			$file_path = $tpl_path . '/' . $file ;
			if( is_file( $file_path ) && in_array( strrchr( $file , '.' ) , array( '.html' , '.css' , '.js' ) ) ) {
				$mtime = intval( @filemtime( $file_path ) ) ;
				$tplfile =& $tplfile_handler->create() ;

				/*************** BEGIN DBTHEME SPECIFIC PART ******************/
				// modify the theme/css
				$tpl_source = file_get_contents( $file_path ) ;
				$searches = array() ;
				$replacements = array() ;
				if( strrchr( $file , '.' ) == '.html' ) {
					// CSS hooking
					$searches[] = '/\"\<\{\$xoops_imageurl\}\>([0-9a-zA-Z_-]+)\.(css|html|js)\"/' ;
					$replacements[] = '"<{$xoops_url}>/modules/dbtheme/?template=$1.$2'.'"' ;
				} else if( strrchr( $file , '.' ) == '.css' ) {
					// url() hooking
					$searches[] = '#url\(\s*([\"\']?)([0-9a-z./]{3})#i' ;
					$replacements[] = 'url($1<{$xoops_imageurl}>$2' ;
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
					$ret[] = '<span style="color:#ff0000;">ERROR: Could not insert template <b>'.htmlspecialchars($mydirname.'_'.$file).'</b> to the database.</span><br />';
				} else {
					$tplid = $tplfile->getVar( 'tpl_id' ) ;
					$ret[] = 'Template <b>'.htmlspecialchars($mydirname.'_'.$file).'</b> added to the database. (ID: <b>'.$tplid.'</b>)<br />';
					// generate compiled file
					include_once XOOPS_ROOT_PATH.'/class/xoopsblock.php' ;
					include_once XOOPS_ROOT_PATH.'/class/template.php' ;
					if( ! xoops_template_touch( $tplid ) ) {
						$ret[] = '<span style="color:#ff0000;">ERROR: Failed compiling template <b>'.htmlspecialchars($mydirname.'_'.$file).'</b>.</span><br />';
					} else {
						$ret[] = 'Template <b>'.htmlspecialchars($mydirname.'_'.$file).'</b> compiled.</span><br />';
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

function dbtheme_message_append_oninstall( &$module_obj , &$log )
{
	if( is_array( @$GLOBALS['ret'] ) ) {
		foreach( $GLOBALS['ret'] as $message ) {
			$log->add( strip_tags( $message ) ) ;
		}
	}

	// use mLog->addWarning() or mLog->addError() if necessary
}

}

?>