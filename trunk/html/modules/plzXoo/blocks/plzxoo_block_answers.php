<?php

function plzxoo_block_answers_show( $options )
{
	$max_rows = empty( $options[1] ) ? 5 : intval( $options[1] ) ; // 表示件数
	$longest_subject = empty( $options[2] ) ? 50 : intval( $options[2] ) ; // 質問名の最大長
	$single_answer_per_question = empty( $options[3] ) ? false : true ; // 締め切った質問も表示するか
	$category_limit = preg_match( '/^[0-9, ]+$/' , @$options[4] ) ? $options[4] : 0 ; // category limit

	$db =& Database::getInstance() ;

	if( $single_answer_per_question ) {
		$grp_single = 'GROUP BY a.qid' ;
		$select_input_date = 'MAX(a.input_date)' ;
	} else {
		$grp_single = '' ;
		$select_input_date = 'a.input_date' ;
	}

	$whr_category = $category_limit ? 'q.cid IN ('.$category_limit.')' : '1' ;

	$result = $db->query( "SELECT q.subject,q.qid,q.cid,c.name,q.uid,u.uname,q.size,a.uid,$select_input_date,a.body FROM ".$db->prefix("plzxoo_answer")." a LEFT JOIN ".$db->prefix("plzxoo_question")." q ON q.qid=a.qid LEFT JOIN ".$db->prefix("plzxoo_category")." c ON q.cid=c.cid LEFT JOIN ".$db->prefix("users")." u ON a.uid=u.uid WHERE ($whr_category) AND q.status IN (1,2) $grp_single ORDER BY a.input_date DESC LIMIT $max_rows" ) ;

	$ret = array('dummy'=>true) ;
	while( list($question_subject,$qid,$cid,$category_name,$question_uid,$answer_uname,$answer_num,$answer_uid,$input_date,$answer_body) = $db->fetchRow($result) ) {
		$ret['answers'][] = array(
			'question_subject' => htmlspecialchars( xoops_substr( $question_subject , 0 , $longest_subject ) , ENT_QUOTES ) ,
			'qid' => intval( $qid ) ,
			'cid' => intval( $cid ) ,
			'input_date' => intval( $input_date ) ,
			'input_date_formatted' => formatTimestamp( $input_date , 'm' ) ,
			'input_date_utime' => xoops_getUserTimestamp( $input_date ) ,
			'category_name' => htmlspecialchars( $category_name , ENT_QUOTES ) ,
			'question_uid' => intval( $question_uid ) ,
			'answer_uname' => htmlspecialchars( $answer_uname , ENT_QUOTES ) ,
			'answer_num' => intval( $answer_num ) ,
			'answer_uid' => intval( $answer_uid ) ,
			'answer_body' => intval( $answer_body ) ,
		) ;
	}

	return $ret ;
}



function plzxoo_block_answers_edit( $options )
{
	$max_rows = empty( $options[1] ) ? 5 : intval( $options[1] ) ; // 表示件数
	$longest_subject = empty( $options[2] ) ? 50 : intval( $options[2] ) ; // 質問名の最大長
	if( empty( $options[3] ) ) {
		$single_answer_per_question_yes = '' ;
		$single_answer_per_question_no = 'checked="checked"' ;
	} else {
		$single_answer_per_question_yes = 'checked="checked"' ;
		$single_answer_per_question_no = '' ;
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
	'._MB_PLZXOO_SINGLE_ANSWER_PER_QUESTION.': &nbsp;
	<label for="single_answer_per_question_yes">'._YES.'</label>
	<input type="radio" name="options[3]" value="1" id="single_answer_per_question_yes" '.$single_answer_per_question_yes.' /> &nbsp;
	<label for="single_answer_per_question_no">'._NO.'</label>
	<input type="radio" name="options[3]" value="0" id="single_answer_per_question_no" '.$single_answer_per_question_no.' />
	<br />
	<label for="cid_limit">'._MB_PLZXOO_CATEGORY_LIMIT.'</label>
	<input type="text" name="options[4]" value="'.htmlspecialchars($cid_limit,ENT_QUOTES).'" id="cid_limit" />
	' ;

}

?>
