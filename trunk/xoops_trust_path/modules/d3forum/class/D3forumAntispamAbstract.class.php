<?php

class D3forumAntispamAbstract {

var $errors = array() ;

function getErrors4Html()
{
	$ret = '' ;
	foreach( $this->errors as $error ) {
		$ret .= '<span style="color:#f00;">'.htmlspecialchars($error).'</span><br />' ;
	}

	return $ret ;
}

function getHtml4Assign()
{
	return array(
		'html_in_form' => '' ,
		'js_global' => '' ,
		'js_in_validate_function' => '' ,
	) ;
}

function checkValidate()
{
	return true ;
}

}

?>