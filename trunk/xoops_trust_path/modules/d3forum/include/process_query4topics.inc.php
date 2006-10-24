<?php

	$query4assign = array() ;

	// TXT
	if( ! empty( $_GET['txt'] ) ) {
		$txt = $myts->stripSlashesGPC( $_GET['txt'] ) ;
		$query4assign['txt'] = htmlspecialchars( $txt , ENT_QUOTES ) ;
		$query4nav .= "&amp;txt=".rawurlencode( $txt ) ;
		$txt4sql = addslashes( $txt ) ;
		$whr_txt = "fp.subject LIKE '%$txt4sql%' OR fp.post_text LIKE '%$txt4sql%'" ;
	} else {
		$query4assign['txt'] = '' ;
		$whr_txt = '1' ;
	}
	
	// SOLVED
	$solved_options = array(
		0 => '----' ,
		1 => _MD_D3FORUM_OPT_SOLVEDYES ,
		2 => _MD_D3FORUM_OPT_SOLVEDNO ,
	) ;
	$solved_sqls = array(
		0 => '1' ,
		1 => 't.topic_solved=1' ,
		2 => 't.topic_solved=0' ,
	) ;
	if( empty( $xoopsModuleConfig['use_solved' ] ) ) {
		// disable "solved function"
		$query4assign['solved'] = 0 ;
		$whr_solved = $solved_sqls[0] ;
	} else {
		if( ! empty( $solved_options[ @$_GET['solved'] ] ) ) {
			$query4assign['solved'] = intval( $_GET['solved'] ) ;
			$query4nav .= "&amp;solved=".intval( $_GET['solved'] ) ;
			$whr_solved = $solved_sqls[ $query4assign['solved'] ] ;
		} else {
			$query4assign['solved'] = 0 ;
			$whr_solved = $solved_sqls[0] ;
		}
	}

	// ORDER
	$odr_options = array(
		1 => _MD_D3FORUM_ODR_LASTPOSTDSC ,
		2 => _MD_D3FORUM_ODR_LASTPOSTASC ,
		3 => _MD_D3FORUM_ODR_CREATETOPICDSC ,
		4 => _MD_D3FORUM_ODR_CREATETOPICASC ,
		5 => _MD_D3FORUM_ODR_REPLIESDSC ,
		6 => _MD_D3FORUM_ODR_REPLIESASC ,
		7 => _MD_D3FORUM_ODR_VIEWSDSC ,
		8 => _MD_D3FORUM_ODR_VIEWSASC ,
		9 => _MD_D3FORUM_ODR_VOTESDSC ,
		10 => _MD_D3FORUM_ODR_VOTESASC ,
		11 => _MD_D3FORUM_ODR_POINTSDSC ,
		12 => _MD_D3FORUM_ODR_POINTSASC ,
	) ;
	$odr_sqls = array(
		1 => 't.topic_last_post_time desc' ,
		2 => 't.topic_last_post_time' ,
		3 => 't.topic_first_post_time desc' ,
		4 => 't.topic_first_post_time' ,
		5 => 't.topic_posts_count desc' ,
		6 => 't.topic_posts_count' ,
		7 => 't.topic_views desc' ,
		8 => 't.topic_views' ,
		9 => 't.topic_votes_count desc' ,
		10 => 't.topic_votes_count' ,
		11 => 't.topic_votes_sum desc' ,
		12 => 't.topic_votes_sum' ,
	) ;
	if( ! empty( $odr_options[ @$_GET['odr'] ] ) ) {
		$query4assign['odr'] = intval( $_GET['odr'] ) ;
		$query4nav .= "&amp;odr=".intval( $_GET['odr'] ) ;
		$odr_query = $odr_sqls[ $query4assign['odr'] ] ;
	} else {
		$query4assign['odr'] = 1 ;
		$odr_query = 'u2t.u2t_marked DESC,t.topic_sticky DESC,' . $odr_sqls[1] ;
	}

	// POS
	$pos = intval( @$_GET['pos'] ) <= 0 ? 0 : intval( $_GET['pos'] ) ;
	
	// LIMIT
	$num = $xoopsModuleConfig['topics_per_page'] < 5 ? 5 : intval( $xoopsModuleConfig['topics_per_page'] ) ;

?>