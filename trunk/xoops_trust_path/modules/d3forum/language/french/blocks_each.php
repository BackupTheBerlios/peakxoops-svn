<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) ) $mydirname = 'd3forum' ;
$constpref = '_MB_' . strtoupper( $mydirname ) ;

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( $constpref.'_LOADED' ) ) {


// Appended by Xoops Language Checker -GIJOE- in 2007-04-05 12:11:23
define($constpref.'_ALT_UNSOLVED','Unsolved topic');
define($constpref.'_ALT_MARKED','Marked topic');

define( $constpref.'_LOADED' , 1 ) ;

// definitions for displaying blocks 
define($constpref."_FORUM","Forum");
define($constpref."_TOPIC","Sujet");
define($constpref."_REPLIES","R�ponses");
define($constpref."_VIEWS","Lectures");
define($constpref."_VOTESCOUNT","Votes");
define($constpref."_VOTESSUM","Points");
define($constpref."_LASTPOST","Derni�res contributions");
define($constpref."_LASTUPDATED","D�rni�res mises � jour");
define($constpref."_LINKTOSEARCH","Rechercher dans le forum");
define($constpref."_LINKTOLISTCATEGORIES","Index Categories");
define($constpref."_LINKTOLISTFORUMS","Index Forum");
define($constpref."_LINKTOLISTTOPICS","Index Sujet");

}

?>