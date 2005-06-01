<?php

	// a plugin for piCal (Don't refer this plugin!)

	if( ! defined( 'XOOPS_ROOT_PATH' ) ) exit ;

	/*
		$db : db instance
		$myts : MyTextSanitizer instance
		$this->year : year
		$this->month : month
		$this->user_TZ : user's timezone (+1.5 etc)
		$this->server_TZ : server's timezone (-2.5 etc)
		$tzoffset_s2u : the offset from server to user
		$now : the result of time()
		$plugin = array('dirname'=>'dirname','name'=>'name','dotgif'=>'*.gif')
		$just1gif : 0 or 1
		
		$plugin_returns[ DATE ][]
	*/

	// for Duplicatable
	if( ! preg_match( '/^(\D+)(\d*)$/' , $plugin['dirname'] , $regs ) ) echo ( "invalid dirname: " . htmlspecialchars( $plugin['dirname'] ) ) ;
	$mydirnumber = $regs[2] === '' ? '' : intval( $regs[2] ) ;

	// カテゴリー関連のWHERE条件取得
	$whr_categories = $this->get_where_about_categories() ;

	// CLASS関連のWHERE条件取得
	$whr_class = $this->get_where_about_class() ;

	// 範囲の取得
	$range_start_s = mktime(0,0,0,$this->month,0,$this->year) ;
	$range_end_s = mktime(0,0,0,$this->month+1,1,$this->year) ;

	// 全日イベント以外の処理
	$result = mysql_query( "SELECT summary,id,start FROM $this->table WHERE admission > 0 AND start >= $range_start_s AND start < $range_end_s AND ($whr_categories) AND ($whr_class) AND allday <= 0" , $this->conn ) ;

	while( list( $title , $id , $server_time ) = $db->fetchRow( $result ) ) {
		$user_time = $server_time + $tzoffset_s2u ;
		if( date( 'n' , $user_time ) != $this->month ) continue ;
		$target_date = date('j',$user_time) ;
		$tmp_array = array(
			'dotgif' => $plugin['dotgif'] ,
			'dirname' => $plugin['dirname'] ,
			'link' => XOOPS_URL."/modules/{$plugin['dirname']}/index.php?caldate={$this->year}-{$this->month}-{$target_date}&amp;smode=Daily" ,
			'id' => $id ,
			'server_time' => $server_time ,
			'user_time' => $user_time ,
			'name' => 'id' ,
			'title' => $this->text_sanitizer_for_show( $title )
		) ;
		if( $just1gif ) {
			// just 1 gif per a plugin & per a day
			$plugin_returns[ $target_date ][ $plugin['dirname'] ] = $tmp_array ;
		} else {
			// multiple gifs allowed per a plugin & per a day
			$plugin_returns[ $target_date ][] = $tmp_array ;
		}
	}

	// 全日イベント専用の処理
	$result = mysql_query( "SELECT summary,id,start,end FROM $this->table WHERE admission > 0 AND start >= $range_start_s AND start < $range_end_s AND ($whr_categories) AND ($whr_class) AND allday > 0" , $this->conn ) ;

	while( list( $title , $id , $start_s , $end_s ) = $db->fetchRow( $result ) ) {
		if( $start_s < $range_start_s ) $start_s = $range_start_s ;
		if( $end_s > $range_end_s ) $end_s = $range_end_s ;

		while( $start_s < $end_s ) {
			$user_time = $start_s + $tzoffset_s2u ;
			if( date( 'n' , $user_time ) == $this->month ) {
				$target_date = date('j',$user_time) ;
				$tmp_array = array(
					'dotgif' => $plugin['dotgif'] ,
					'dirname' => $plugin['dirname'] ,
					'link' => XOOPS_URL."/modules/{$plugin['dirname']}/index.php?caldate={$this->year}-{$this->month}-{$target_date}&amp;smode=Daily" ,
					'id' => $id ,
					'server_time' => $server_time ,
					'user_time' => $user_time ,
					'name' => 'id' ,
					'title' => $this->text_sanitizer_for_show( $title )
				) ;
				if( $just1gif ) {
					// just 1 gif per a plugin & per a day
					$plugin_returns[ $target_date ][ $plugin['dirname'] ] = $tmp_array ;
				} else {
					// multiple gifs allowed per a plugin & per a day
					$plugin_returns[ $target_date ][] = $tmp_array ;
				}
			}
			$start_s += 86400 ;
		}
	}


?>