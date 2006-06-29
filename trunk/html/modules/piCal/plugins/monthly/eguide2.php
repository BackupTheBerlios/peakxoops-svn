<?php

	// a plugin for eguide 1.6 by nobu

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

	// set range (added 86400 second margin "begin" & "end")
	$range_start_s = mktime(0,0,0,$this->month,0,$this->year) ;
	$range_end_s = mktime(0,0,0,$this->month+1,1,$this->year) ;

	// query
	$result = $db->query( "SELECT title,e.eid,exid,IF(exdate,exdate,edate),summary, IF(x.reserved,x.reserved,o.reserved)/persons*100, closetime FROM ".
			      $db->prefix("eguide")." e LEFT JOIN ".
			      $db->prefix("eguide_opt")." o ON e.eid=o.eid LEFT JOIN ".
			      $db->prefix("eguide_extent")." x ON e.eid=eidref WHERE ((edate BETWEEN $range_start_s AND $range_end_s AND exdate IS NULL) OR exdate BETWEEN $range_start_s AND $range_end_s) AND IF(exdate,exdate,edate) BETWEEN $range_start_s AND $range_end_s ORDER BY exdate,edate" ) ;

function eguide_marker($full) {
    global $marker;
    if (empty($marker)) {
	$module_handler =& xoops_gethandler('module');
	$module =& $module_handler->getByDirname('eguide');
	$config_handler =& xoops_gethandler('config');
	$config =& $config_handler->getConfigsByCat(0, $module->getVar('mid'));
	$marker = preg_split('/,|[\r\n]+/',$config['maker_set']);
    }
    $tmp = $marker;
    while(list($k,$v) = array_splice($tmp, 0, 2)) {
	if ($full<$k) return $v;
    }
    return '';
}

while( list( $title , $id , $sub, $edate , $description , $full, $close) = $db->fetchRow( $result ) ) {
    if (($edate-$close)<$now) $full = -1;
    $mark = eguide_marker($full);
		$server_time = $edate ;
		$user_time = $server_time + $tzoffset_s2u ;
		if( date( 'n' , $user_time ) != $this->month ) continue ;
		$target_date = date('j',$user_time) ;
		$param ="eid=$id".(empty($sub)?'':"&amp;sub=$sub");
		$tmp_array = array(
			'dotgif' => $plugin['dotgif'] ,
			'dirname' => $plugin['dirname'] ,
			'link' => XOOPS_URL."/modules/{$plugin['dirname']}/event.php?$param&amp;caldate={$this->year}-{$this->month}-$target_date" ,
			'id' => $id ,
			'server_time' => $server_time ,
			'user_time' => $user_time ,
			'name' => 'eid' ,
			'title' => "$mark ".$myts->makeTboxData4Show( $title )
		) ;
		if( $just1gif ) {
			// just 1 gif per a plugin & per a day
			$plugin_returns[ $target_date ][ $plugin['dirname'] ] = $tmp_array ;
		} else {
			// multiple gifs allowed per a plugin & per a day
			$plugin_returns[ $target_date ][] = $tmp_array ;
		}
	}


?>