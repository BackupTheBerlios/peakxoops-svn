<?php

require_once XOOPS_TRUST_PATH.'/modules/pico/class/FormProcessByHtml.class.php' ;

class PicoFormProcessBySmartyBase
{
	var $mypluginname ;
	var $mydirname ;
	var $mod_url ;
	var $content4disp ;
	var $content_uri ;
	var $session_index ;
	var $form_processor ;
	var $form_body ;
	var $form_body4disp ;
	var $extra_form = '' ;
	var $error_html = '' ;

	function PicoFormProcessBySmartyBase()
	{
		return $this->__construct() ;
	}


	function __construct()
	{
		$this->mypluginname = 'base' ;
	}


	function init( $params , &$smarty )
	{
		$this->mydirname = $smarty->_tpl_vars['mydirname'] ;
		$this->mod_url = $smarty->_tpl_vars['mod_url'] ;
		$this->content4disp = $smarty->_tpl_vars['content'] ;
		$this->content_uri = pico_common_unhtmlspecialchars( XOOPS_URL.'/modules/'.$this->mydirname.'/'.$this->content4disp['link'] ) ;
		$this->session_index = $this->mydirname . '_' . $this->content4disp['id'] . '_' . $this->mypluginname ;

	}


	function checkCurrentPage()
	{
		global $xoopsModule ;

		// session clear in contentmanager or makecontent
		if( in_array( $_GET['page'] , array( 'contentmanager' , 'makecontent' ) ) ) {
			unset( $_SESSION[ $this->session_index ] ) ;
			return false ;
		}

		// check this contents is in main area of pico
		if( ! is_object( @$xoopsModule ) ) return false ;
		if( $xoopsModule->getVar('dirname') != $this->mydirname ) return false ;
		if( intval( @$GLOBALS['content_id'] ) != $this->content4disp['id'] ) return false ;

		return true ;
	}


	function readLanguage( $filename = null )
	{
		if( empty( $filename ) ) $filename = $this->mypluginname ;
	
		// read language files for this plugin
		$langmanpath = XOOPS_TRUST_PATH.'/libs/altsys/class/D3LanguageManager.class.php' ;
		require_once( $langmanpath ) ;
		$langman =& D3LanguageManager::getInstance() ;
		$langman->read( $filename . '.php' , $mydirname , 'pico' ) ;
	}


	function fetchFormBody( $params , &$smarty )
	{
		// get captured form
		if( ! empty( $params['name'] ) && ! empty( $smarty->_smarty_vars['capture'][$params['name']] ) ) {
			$this->form_body = $smarty->_smarty_vars['capture'][$params['name']] ;
		} else if( sizeof( $smarty->_smarty_vars['capture'] ) > 0 ) {
			$this->form_body = $smarty->_smarty_vars['capture']['default'] ;
		} else {
			echo '<em>confirm <{capture}><{/capture}> block exists before this tag</em>' ;
			$this->form_body = '' ;
		}
		$this->form_body4disp = $this->form_body ;
	}


	function reload()
	{
		if( ! headers_sent() ) {
			header( 'Location: ' . $this->content_uri ) ;
		} else {
			redirect_header( htmlspecialchars( $this->content_uri , ENT_QUOTES ) , 3 , '&nbsp;' ) ;
		}
		exit ;
	}


	function replaceFormTag()
	{
		$this->form_body4disp = str_replace( '<form>' , '<form action="'.htmlspecialchars($this->content_uri,ENT_QUOTES).'" method="post">' , $this->form_body4disp ) ;
	}


	function getTokenName()
	{
		return $this->mypluginname.'_confirm' ;
	}


	function getTokenValue( $time = null )
	{
		if( empty( $time ) ) $time = time() ;
		return md5( gmdate( 'YmdH' , $time ) . XOOPS_DB_PREFIX . XOOPS_DB_NAME . XOOPS_ROOT_PATH ) ;
	}


	function validateToken()
	{
		$value = @$_POST[ $this->getTokenName() ] ;
		if( $value == $this->getTokenValue() ) return true ;
		if( $value == $this->getTokenValue( time() - 3600 ) ) return true ;
		if( $value == $this->getTokenValue( time() - 7200 ) ) return true ;
		return false ;
	}


	function processConfirm()
	{
		// display confirm
		$this->extra_form = '<form action="'.htmlspecialchars($this->content_uri,ENT_QUOTES).'" method="post">'._MD_PICO_FORMMAIL_BLOCK_POSTCONFIRM.'<input type="hidden" name="'.$this->getTokenName().'" value="'.$this->getTokenValue().'" /></form>' ;
	}


	function displayFinished()
	{
		echo '<div class="resultMsg form_finished">'._MD_PICO_FORMMAIL_MSG_SENTSUCCESSFULLY.'</div>' ;
	}


	function displayConfirm()
	{
		echo @$this->extra_form ;
		echo @$this->error_html ;
		echo @$this->form_body4disp ;
	}


	function displayDefault()
	{
		echo @$this->form_body4disp ;
	}


	function processError( $errors )
	{
		$this->error_html = _MD_PICO_FORMMAIL_BLOCK_ERROR_BEGIN ;
		foreach( $errors as $error ) {
			$constname = strtoupper( '_MD_PICO_FORMMAIL_ERRFMT_' . str_replace( ' ' , '_' , $error['message'] ) ) ;
			if( defined( $constname ) ) {
				$this->error_html .= sprintf( constant( $constname ) , $error['label4disp'] ) ;
			} else {
				$this->error_html .= '<li>' . $error['message'] . ':' . $error['label4disp'] . '</li>' ;
			}
		}
		$this->error_html .= _MD_PICO_FORMMAIL_BLOCK_ERROR_END ;
	}


	function execute( $params , &$smarty )
	{
		// initials
		$this->init( $params , $smarty ) ;
		if( ! $this->checkCurrentPage() ) return ;
		$this->readLanguage( 'formmail' ) ;
		$this->fetchFormBody( $params , $smarty ) ;

		// Form Processor
		$this->form_processor =& new FormProcessByHtml() ;
		$this->form_processor->setFieldsByForm( $this->form_body ) ;

		// process post (then redirect)
		if( ! empty( $_POST ) ) {
			if( isset( $_POST[ $this->getTokenName() ] ) ) {
				if( $this->validateToken() && isset( $_SESSION[ $this->session_index ]['data'] ) ) {
					$this->form_processor->importSession( $_SESSION[ $this->session_index ]['data'] ) ;
					$errors = $this->form_processor->getErrors() ;
					if( empty( $errors ) ) {
						$this->executeLast() ;
						// clear data part of session
						unset( $_SESSION[ $this->session_index ]['data'] ) ;
						$_SESSION[ $this->session_index ]['step'] = 'finished' ;
					}
				}
			} else {
				$_SESSION[ $this->session_index ]['data'] = $this->form_processor->fetchPost() ;
				$_SESSION[ $this->session_index ]['step'] = 'confirm' ;
			}
			$this->reload() ;
		}

		// process get
		if( isset( $_SESSION[ $this->session_index ]['data'] ) ) {
			$this->form_processor->importSession( $_SESSION[ $this->session_index ]['data'] ) ;
			$errors = $this->form_processor->getErrors() ;
			if( empty( $errors ) ) {
				$this->processConfirm() ; // confirm
			} else {
				$this->processError( $errors ) ; // errors
			}

			// replace value="" / selected="selected"
			$this->form_body4disp = $this->form_processor->replaceValues( $this->form_body4disp ) ;
		}
		$this->replaceFormTag() ;

		// display
		switch( @$_SESSION[ $this->session_index ]['step'] ) {
			case 'finished' :
				$this->displayFinished() ;
				break ;
			case 'confirm' :
				$this->displayConfirm() ;
				break ;
			default :
				$this->displayDefault() ;
				break ;
		}
	}


	// abstract
	function executeLast()
	{
		// send a mail
		// store into db
		// etc.
	}

}

?>