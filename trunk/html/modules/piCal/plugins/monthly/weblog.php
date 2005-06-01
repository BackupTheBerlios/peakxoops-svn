<?php
    // a plugin for weblog

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

    $add_whr = "" ;
    $group_by = " group by blog_id " ;
    $tempfunc = create_function( '$file' , '@include $file;return $modversion;' ) ;
    $modversion = $tempfunc( XOOPS_ROOT_PATH . "/modules/" . $plugin['dirname'] . "/xoops_version.php" ) ;
    if( ! empty( $modversion ) ) {
        if( "weblog" == strtolower($modversion['name']) ){
            if( $modversion['version'] >= 1.42 ){
                require_once XOOPS_ROOT_PATH . "/modules/" . $plugin['dirname'] . "/class/entry.php" ;
                $add_whr = weblog_create_permittionsql() ;
            }else{
                $add_whr = "" ;
            }
            $group_by = " group by blog_id " ;
        }
        unset($modversion);
    }

    // query (added 86400 second margin "begin" & "end")
    $weblog_minical_sql = "SELECT title,blog_id,`created` FROM ".$db->prefix($plugin['dirname']). " as bl," . $db->prefix('users') . " as u," . $db->prefix('groups_users_link') . " as g WHERE `created` >= $range_start_s AND `created` < $range_end_s and private!='Y' AND bl.user_id=u.uid AND bl.user_id=g.uid " . $add_whr . $group_by ;
    $result = $db->query($weblog_minical_sql) ;
    while( list( $title , $blog_id , $server_time ) = $db->fetchRow( $result ) ) {
        $user_time = $server_time + $tzoffset_s2u ;
        if( date( 'n' , $user_time ) != $this->month ) continue ;
        $target_date = date('j',$user_time) ;
        $tmp_array = array(
            'dotgif' => $plugin['dotgif'] ,
            'dirname' => $plugin['dirname'] ,
            'link' => XOOPS_URL."/modules/" . $plugin['dirname'] . "/details.php?blog_id=" . $blog_id ,
            'id' => $blog_id . $server_time ,
            'server_time' => $server_time ,
            'user_time' => $user_time ,
            'name' => 'blog_id' ,
            'title' => $myts->makeTboxData4Show( $title )
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