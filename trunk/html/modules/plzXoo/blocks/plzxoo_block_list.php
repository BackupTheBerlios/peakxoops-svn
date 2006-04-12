<?php

function plzxoo_block_list_show( $options )
{
	$max_rows = empty( $options[1] ) ? 5 : intval( $options[1] ) ; // 表示件数
	$longest_subject = empty( $options[2] ) ? 50 : intval( $options[2] ) ; // 質問名の最大長
	
	$db =& Database::getInstance() ;
	
	$result = $db->query( "SELECT q.subject,q.qid,q.cid,q.input_date,c.name,q.uid,u.uname,COUNT(a.aid) FROM ".$db->prefix("plzxoo_question")." q LEFT JOIN ".$db->prefix("plzxoo_category")." c ON q.cid=c.cid LEFT JOIN ".$db->prefix("users")." u ON q.uid=u.uid LEFT JOIN ".$db->prefix("plzxoo_answer")." a ON q.qid=a.qid WHERE status=1 GROUP BY a.qid ORDER BY q.input_date DESC LIMIT $max_rows" ) ;
	
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

	return '
	<input type="hidden" name="options[0]" value="plzXoo" id="mydirname" />
	<br />
	<label for="max_rows">'._MB_PLZXOO_MAX_ROWS.'</label>
	<input type="text" name="options[1]" value="'.$max_rows.'" id="max_rows" />
	<br />
	<label for="longest_subject">'._MB_PLZXOO_LONGEST_SUBJECT.'</label>
	<input type="text" name="options[2]" value="'.$longest_subject.'" id="longest_subject" />
	' ;

}

?>
