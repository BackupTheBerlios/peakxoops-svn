<?php

include dirname(dirname(__FILE__)).'/include/common_prepend.php' ;


// branches (TODO viewallforum)
if( ! empty( $_GET['post_id'] ) ) {
	include dirname(dirname(__FILE__)).'/include/viewpost.php' ;
} else if( ! empty( $_GET['topic_id'] ) ) {
	include dirname(dirname(__FILE__)).'/include/listposts.php' ;
} else if( ! empty( $_GET['forum_id'] ) ) {
	include dirname(dirname(__FILE__)).'/include/listtopics.php' ;
} else if( ! empty( $_GET['cat_id'] ) ) {
	include dirname(dirname(__FILE__)).'/include/listforums.php' ;
} else {
	include dirname(dirname(__FILE__)).'/include/listcategories.php' ;
}


$xoopsTpl->assign(
	array(
		'mydirname' => $mydirname ,
		'mod_url' => XOOPS_URL.'/modules/'.$mydirname ,
		'mod_imageurl' => XOOPS_URL.'/modules/'.$mydirname.'/'.$xoopsModuleConfig['images_dir'] ,
		'mod_config' => $xoopsModuleConfig ,
		'uid' => $uid ,
		'postorder' => $postorder ,
		'icon_meanings' => $d3forum_icon_meanings ,
		'forum_jumpbox_options' => d3forum_make_jumpbox_options( $mydirname , $whr_read4cat , $whr_read4forum , @$forum_row['forum_id'] ) ,
		'xoops_module_header' => "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"".$xoopsModuleConfig['css_uri']."\" />" . $xoopsTpl->get_template_vars( "xoops_module_header" ) ,
	)
) ;

include XOOPS_ROOT_PATH.'/footer.php';

?>