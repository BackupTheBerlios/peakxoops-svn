<?php

function smarty_function_pico( $params , &$smarty )
{
	$dirname = @$params['dir'] . @$params['dirname'] ;
	$content_id = @$params['id'] + @$params['content_id'] ;
	$template = @$params['template'] ;

	if( empty( $content_id ) ) {
		echo 'error smarty_function_pico [specify id]';
		return ;
	}

	if( empty( $dirname ) ) $dirname = $smarty->get_template_vars( 'mydirname' ) ;
	require_once XOOPS_TRUST_PATH.'/modules/pico/include/common_functions.php' ;
	require_once XOOPS_TRUST_PATH.'/modules/pico/blocks/content.php' ;

	$block = b_pico_content_show( array( $dirname , $content_id , $template ) ) ;

	echo @$block['content'] ;
}

?>