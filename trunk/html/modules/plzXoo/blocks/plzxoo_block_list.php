<?php

function plzxoo_block_list_show( $options )
{
	$max_rows = empty( $options[1] ) ? 5 : intval( $options[1] ) ; // 表示件数
	$longest_subject = empty( $options[2] ) ? 50 : intval( $options[2] ) ; // 質問名の最大長
	$display_closed = empty( $options[3] ) ? false : true ; // 締め切った質問も表示するか
	$category_limit = preg_match( '/^[0-9, ]+$/' , @$options[4] ) ? $options[4] : 0 ; // category limit

	$db =& Database::getInstance() ;

	$whr_status = $display_closed ? 'q.status IN (1,2)' : 'q.status=1' ;
	$whr_category = $category_limit ? 'q.cid IN ('.$category_limit.')' : '1' ;

	$result = $db->query( "SELECT q.subject,q.qid,q.cid,q.input_date,c.name,q.uid,u.uname,q.size FROM ".$db->prefix("plzxoo_question")." q LEFT JOIN ".$db->prefix("plzxoo_category")." c ON q.cid=c.cid LEFT JOIN ".$db->prefix("users")." u ON q.uid=u.uid WHERE ($whr_status) AND ($whr_category) ORDER BY q.input_date DESC LIMIT $max_rows" ) ;

	$ret = array('dummy'=>true) ;
	while( list($subject,$qid,$cid,$input_date,$category_name,$uid,$uname,$answer_num) = $db->fetchRow($result) ) {
		$ret['questions'][] = array(
			'subject' => htmlspecialchars( xoops_substr( $subject , 0 , $longest_subject ) , ENT_QUOTES ) ,
			'qid' => intval( $qid ) ,
			'cid' => intval( $cid ) ,
			'input_date' => intval( $input_date ) ,
			'category_name' => htmlspecialchars( $category_name , ENT_QUOTES ) ,
			'uid' => intval( $uid ) ,
			'uname' => htmlspecialchars( $uname , ENT_QUOTES ) ,
			'answer_num' => intval( $answer_num ) ,
		) ;
	}

	return $ret ;
}



function plzxoo_block_list_edit( $options )
{
	$max_rows = empty( $options[1] ) ? 5 : intval( $options[1] ) ; // 表示件数
	$longest_subject = empty( $options[2] ) ? 50 : intval( $options[2] ) ; // 質問名の最大長
	if( empty( $options[3] ) ) {
		$display_closed_yes = '' ;
		$display_closed_no = 'checked="checked"' ;
	} else {
		$display_closed_yes = 'checked="checked"' ;
		$display_closed_no = '' ;
	}
	$cid_limit = empty( $options[4] ) ? 0 : trim( $options[4] ) ; // category limit

	return '
	<input type="hidden" name="options[0]" value="plzXoo" id="mydirname" />
	<br />
	<label for="max_rows">'._MB_PLZXOO_MAX_ROWS.'</label>
	<input type="text" name="options[1]" value="'.$max_rows.'" id="max_rows" />
	<br />
	<label for="longest_subject">'._MB_PLZXOO_LONGEST_SUBJECT.'</label>
	<input type="text" name="options[2]" value="'.$longest_subject.'" id="longest_subject" />
	<br />
	'._MB_PLZXOO_DISPLAY_CLOSED.': &nbsp;
	<label for="display_closed_yes">'._YES.'</label>
	<input type="radio" name="options[3]" value="1" id="display_closed_yes" '.$display_closed_yes.' /> &nbsp;
	<label for="display_closed_no">'._NO.'</label>
	<input type="radio" name="options[3]" value="0" id="display_closed_no" '.$display_closed_no.' />
	<br />
	<label for="cid_limit">'._MB_PLZXOO_CATEGORY_LIMIT.'</label>
	<input type="text" name="options[4]" value="'.htmlspecialchars($cid_limit,ENT_QUOTES).'" id="cid_limit" />
	' ;

}

?>
