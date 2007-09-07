<?php

class FormProcessByHtml
{
	var $fields = array() ;
	var $form_html = '' ;

	function FormProcessByHtml()
	{
		return $this->__construct() ;
	}


	function __construct()
	{
	}


	function setFieldsByForm( $form_html )
	{
		// initialize
		$this->fields = array() ;
		$this->form_html = $form_html ;

		// get name="..." from the form
		preg_match_all( '#<[^>]+name=([\'"]?)([0-9a-zA-Z_-]+(|\[\]))\\1[^>]*>#iU' , $this->form_html , $matches , PREG_SET_ORDER ) ;
		$tags = array() ;
		foreach( $matches as $match ) {
			$tags[ $match[2] ] = $match[0] ;
		}

		// parse HTML and file label
		foreach( $tags as $field_name => $tag ) {

			// tag kind
			if( strncasecmp( $tag , '<textarea' , 9 ) === 0 ) {
				$tag_kind = 'textarea' ;
			} else if( strncasecmp( $tag , '<select' , 7 ) === 0 ) {
				$tag_kind = 'select' ;
			} else if( stristr( $tag , 'type="checkbox"' ) ) {
				$tag_kind = 'checkbox' ;
			} else if( stristr( $tag , 'type="radio"' ) ) {
				$tag_kind = 'radio' ;
			} else if( stristr( $tag , 'type="hidden"' ) ) {
				$tag_kind = 'hidden' ;
			} else if( stristr( $tag , 'type="text"' ) ) {
				$tag_kind = 'text' ;
			} else if( stristr( $tag , 'type="submit"' ) ) {
				$tag_kind = 'submit' ;
			} else {
				continue ;
			}

			// get id of the tag
			$id = '' ;
			if( preg_match( '/id\s*\=\s*"([^"]+)"/' , $tag , $regs ) ) {
				$id = trim( $regs[1] ) ;
			}

			// get classes of the tag
			$classes = array() ;
			if( preg_match( '/class\s*\=\s*"([^"]+)"/' , $tag , $regs ) ) {
				$classes = array_map( 'trim' , explode( ' ' , trim( $regs[1] ) ) ) ;
			}

			// required
			$required = in_array( 'required' , $classes ) ? true : false ;

			// type
			$type = 'string' ;
			foreach( array( 'int' , 'double' , 'singlebytes' , 'email' , 'telephone' , 'array' ) as $eachtype ) {
				if( in_array( $eachtype , $classes ) ) {
					$type = $eachtype ;
					break ;
				}
			}

			// judge whether the field is array or not
			/* if( substr( $field_name , -2 ) == '[]' ) {
				$field_name = substr( $field_name , 0 , -2 ) ;
				$type = 'array' ;
			} */

			// get label
			if( preg_match( '#for\s*\=\s*([\'"]?)'.preg_quote($id).'\\1\>(.*)\<\/label\>#iU' , $this->form_html , $regs ) ) {
				$label = @$regs[2] ;
			} else {
				$label = $field_name ;
			}

			$this->fields[ $field_name ] = array(
				'tag' => $tag ,
				'tag_kind' => $tag_kind ,
				'id' => $id ,
				'classes' => $classes ,
				'label' => $label ,
				'required' => $required ,
				'type' => $type ,
				'errors' => array() ,
			) ;
		}
	}


	function importSession( $session_data , $check_fields = true )
	{
		if( $check_fields ) {
			foreach( array_keys( $this->fields ) as $field_name ) {
				if( isset( $session_data[ $field_name ] ) ) {
					$this->fields[ $field_name ] = $session_data[ $field_name ] ;
				}
			}
		} else {
			$this->fields = $session_data ;
		}
	}


	function fetchPost()
	{
		$myts =& MyTextSanitizer::getInstance() ;

		foreach( $this->fields as $field_name => $attribs ) {
			$value = $this->stripMQGPC( @$_POST[ $field_name ] ) ;

			// missing required
			if( $attribs['required'] == true && $value === '' ) {
				$this->fields[ $field_name ]['errors'][] = in_array( $attribs['tag_kind'] , array( 'text' , 'textarea' ) ) ? 'missing required' : 'missing selected' ;
			}

			// tag_kind validation
			if( $attribs['tag_kind'] == 'select' && ! $this->validateSelectOption( $attribs['tag'] , $value ) ) {
				$this->fields[ $field_name ]['errors'][] = 'missing selected' ;
			}

			// default type conversion array=>string
			if( is_array( $value ) && $attribs['type'] != 'array' ) {
				$value = implode( ',' , $value ) ;
			}

			// type checks & conversions
			switch( $attribs['type'] ) {
				case 'int' :
					$value = intval( $value ) ;
					break ;

				case 'double' :
					$value = doubleval( $value ) ;
					break ;

				case 'telephone' :
					$value = $this->convertZenToHan( $value ) ;
					$value = preg_replace( '/[^()0-9+.-]/' , '' , $value ) ;
					break ;

				case 'email' :
					$value = $this->convertZenToHan( $value ) ;
					if( ! empty( $value ) && ! $this->checkEmailAddress( $value ) ) {
						$this->fields[ $field_name ]['errors'][] = 'invalid email' ;
					}
					break ;

				case 'singlebytes' :
					$value = $this->convertZenToHan( $value ) ;
					break ;

				case 'array' :
					if( ! is_array( $value ) ) {
						$value = array( $value ) ;
					}
					break ;

				default :
					break ;
			}

			$this->fields[ $field_name ]['value'] = $value ;
		}

		return $this->fields ;
	}


	function stripMQGPC( $data )
	{
		if( ! get_magic_quotes_gpc() ) return $data ;
	
		if( is_array( $data ) ) {
			return array_map( array( $this , 'stripMQGPC' ) , $data ) ;
		} else {
			return stripslashes( $data ) ;
		}
	}


	function getErrors()
	{
		$ret = array() ;
		foreach( $this->fields as $field_name => $attribs ) {
			if( ! empty( $attribs['errors'] ) && is_array( $attribs['errors'] ) ) {
				foreach( $attribs['errors'] as $error_msg ) {
					$ret[] = array(
						'name' => $field_name ,
						'label4disp' => htmlspecialchars( $attribs['label'] , ENT_QUOTES ) ,
						'message' => $error_msg ,
					) ;
				}
			}
		}

		return $ret ;
	}


	function replaceValues( $form_html = null )
	{
		if( empty( $form_html ) ) $form_html = $this->form_html ;
	
		foreach( $this->fields as $field_name => $attribs ) {
			switch( $attribs['tag_kind'] ) {
				case 'textarea' :
					$form_html = $this->replaceContentTextarea( $form_html , $attribs ) ;
					break ;
				case 'select' :
					$form_html = $this->replaceSelectedOptions( $form_html , $attribs ) ;
					break ;
				case 'text' :
					$form_html = $this->replaceValueTextbox( $form_html , $attribs ) ;
					break ;
				default :
					break ;
			}
		}
		return $form_html ;
	}


	function replaceValueTextbox( $form_html , $attribs )
	{
		$old_tag = $attribs['tag'] ;
		$value4html = htmlspecialchars($attribs['value'],ENT_QUOTES) ;

		if( stristr( $attribs['tag'] , 'value=' ) ) {
			$new_tag = preg_replace( '/value\=\"(.*)\"/' , 'value="'.$value4html.'"' , $old_tag ) ;
		} else {
			$new_tag = str_replace( '/>' , 'value="'.$value4html.'" />' , $old_tag ) ;
		}
		
		return str_replace( $old_tag , $new_tag , $form_html ) ;
	}


	function replaceContentTextarea( $form_html , $attribs )
	{
		$value4html = htmlspecialchars($attribs['value'],ENT_QUOTES) ;

		list( $before , $content_html_tmp ) = explode( $attribs['tag'] , $form_html , 2 ) ;
		list( $content_html , $after ) = explode( '</textarea>' , $content_html_tmp , 2 ) ;
		return $before . $attribs['tag'] . $value4html . '</textarea>' . $after ;
	}


	function replaceSelectedOptions( $form_html , $attribs )
	{
		$value4html = htmlspecialchars($attribs['value'],ENT_QUOTES) ;

		list( $before , $options_html_tmp ) = explode( $attribs['tag'] , $form_html , 2 ) ;
		list( $options_html , $after ) = explode( '</select>' , $options_html_tmp , 2 ) ;
		$new_options_html = str_replace( 'selected="selected"' , '' , $options_html ) ;
		$new_options_html = str_replace( 'value="'.$value4html.'"' , 'value="'.$value4html.'" selected="selected"' , $new_options_html ) ;

		return $before . $attribs['tag'] . $new_options_html . '</select>' . $after ;
	}


	function validateSelectOption( $tag , $value )
	{
		$value4html = htmlspecialchars($value,ENT_QUOTES) ;

		list( $before , $options_html_tmp ) = explode( $tag , $this->form_html , 2 ) ;
		list( $options_html , $after ) = explode( '</select>' , $options_html_tmp , 2 ) ;
		if( strstr( $options_html , 'value="'.$value4html.'"' ) ) return true ;
		else false ;
	}


	function renderForMail( $field_separator = "\n" , $mid_separator = "\n" )
	{
		$ret = '' ;
		foreach( $this->fields as $field_name => $attribs ) {
			$ret .= $field_separator . $attribs['label'] . $mid_separator . $attribs['value'] ;
		}
		
		return $ret ;
	}


	function convertZenToHan( $text )
	{
		if( function_exists( 'mb_convert_kana' ) ) {
			return mb_convert_kana( $text , 'as' ) ;
		}
		return $text ;
	}


	// http://www.ilovejackdaniels.com/php/email-address-validation/
	function checkEmailAddress( $email )
	{
		// First, we check that there's one @ symbol, and that the lengths are right
		if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
			// Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
			return false;
		}

		// Split it into sections to make life easier
		$email_array = explode("@", $email);
		$local_array = explode(".", $email_array[0]);
		for ($i = 0; $i < sizeof($local_array); $i++) {
			if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
				return false;
			}
		}
		if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
			$domain_array = explode(".", $email_array[1]);
			if (sizeof($domain_array) < 2) {
				return false; // Not enough parts to domain
			}
			for ($i = 0; $i < sizeof($domain_array); $i++) {
				if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) {
					return false;
				}
			}
		}
		return true;
	}
}

?>