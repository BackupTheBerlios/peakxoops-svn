<?php

require_once XOOPS_TRUST_PATH.'/modules/pico/class/FormProcessByHtml.class.php' ;

function smarty_function_formmail( $params , &$smarty )
{
	global $xoopsModule ;

	// get tpl_vars ($mod_url or $content) they are "for disp"
	$mydirname = $smarty->_tpl_vars['mydirname'] ;
	$mod_url = $smarty->_tpl_vars['mod_url'] ;
	$content4disp = $smarty->_tpl_vars['content'] ;
	$session_index = $mydirname . '_formmail_' . $content4disp['id'] ;

	// session clear in contentmanager or makecontent
	if( in_array( $_GET['page'] , array( 'contentmanager' , 'makecontent' ) ) ) {
		unset( $_SESSION[ $session_index ] ) ;
		return ;
	}

	// check this contents is in main area of pico
	if( ! is_object( @$xoopsModule ) ) return ;
	if( $xoopsModule->getVar('dirname') != 'pico' ) return ;
	if( intval( @$GLOBALS['content_id'] ) != $content4disp['id'] ) return ;

	// read language files for formmail
	$langmanpath = XOOPS_TRUST_PATH.'/libs/altsys/class/D3LanguageManager.class.php' ;
	require_once( $langmanpath ) ;
	$langman =& D3LanguageManager::getInstance() ;
	$langman->read( 'formmail.php' , $mydirname , 'pico' ) ;

	// get captured form
	if( ! empty( $params['name'] ) && ! empty( $smarty->_smarty_vars['capture'][$params['name']] ) ) {
		$form_body = $smarty->_smarty_vars['capture'][$params['name']] ;
	} else if( sizeof( $smarty->_smarty_vars['capture'] ) > 0 ) {
		$form_body = $smarty->_smarty_vars['capture']['default'] ;
	} else {
		echo '<b>confirm <{capture}><{/capture}> block exists before this tag</b>' ;
		return ;
	}
	// replace <form> tag
	$form_body4disp = str_replace( '<form>' , '<form action="'.$mod_url.'/'.$content4disp['link'].'" method="post">' , $form_body ) ;

	$form_processor =& new FormProcessByHtml() ;
	$form_processor->setFieldsByForm( $form_body ) ;

	// process post
	if( ! empty( $_POST ) ) {
		$_SESSION[ $session_index ] = $form_processor->fetchPost() ;
	} else if( isset( $_SESSION[ $session_index ] ) ) {
		$form_processor->importSession( @$_SESSION[ $session_index ] ) ;
	}

	// display stage
	if( isset( $_SESSION[ $session_index ] ) ) {
		$errors = $form_processor->getErrors() ;
		if( empty( $errors ) ) {
			// display confirm
			echo '<form action="'.$mod_url.'/index.php?page=formmail&amp;content_id='.$content4disp['id'].'" method="post">'._MD_PICO_FORMMAIL_BLOCK_POSTCONFIRM.'</form>' ;
		} else {
			// display errors
			echo _MD_PICO_FORMMAIL_BLOCK_ERROR_BEGIN ;
			foreach( $errors as $error ) {
				$constname = strtoupper( '_MD_PICO_FORMMAIL_ERRFMT_' . str_replace( ' ' , '_' , $error['message'] ) ) ;
				if( defined( $constname ) ) {
					printf( constant( $constname ) , $error['label4disp'] ) ;
				} else {
					echo '<li>' . $error['message'] . ':' . $error['label4disp'] . '</li>' ;
				}
			}
			echo _MD_PICO_FORMMAIL_BLOCK_ERROR_END ;
		}
		// replace value="" / selected="selected"
		$form_body4disp = $form_processor->replaceValues( $form_body4disp ) ;
	}

//	var_dump( $_SESSION[ $session_index ] ) ;

	echo $form_body4disp ;

}

?>