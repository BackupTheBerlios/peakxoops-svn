<?php

// <--- BASIC PROPERTY --->
define ('_MI_PLZXOO_NAME','plzXoo');
define ('_MI_PLZXOO_NAME_DESC','plzXoo Module');

// <--- SUBMENU PROPERTY --->
define ( '_MI_PLZXOO_SUBMENU_QUESTION','Post a new question' );

// <--- ADMENU PROPERTY --->
define('_MI_PLZXOO_ADMENU_1','Categories');
define('_MI_PLZXOO_ADMENU_2','Create a new category');
define('_MI_PLZXOO_ADMENU_3','Permissions');
define('_MI_PLZXOO_ADMENU_MYBLOCKSADMIN','Blocks');
define('_MI_PLZXOO_ADMENU_MYTPLSADMIN','Templates');

// <--- BLOCKS PROPERTY --->
define('_MI_PLZXOO_BNAME1','Question List');

// <--- CONFIGS PROPERTY --->
define ( '_MI_PLZXOO_POINTS','Points' );
define ( '_MI_PLZXOO_POINTS_DESC','Set points separated with "|".<br />":" means maximum items of the point<br />eg) 0|10:5|20:1 means that 20pts can be added into just an answer, 10pts can be added into max 5 answers. rest of answers will be 0pt' );
define ( '_MI_PLZXOO_POINTS2POSTS','Add plzXoo\'s points into users\'s posts' );
define ( '_MI_PLZXOO_POINTS2POSTS_DESC','' );

// <--- NOTIFICATIONS PROPERTY --->
define( '_MI_PLZXOO_GLOBAL_NOTIFY' , 'Global' ) ;
define( '_MI_PLZXOO_GLOBAL_NOTIFYDSC' , 'About whole of this module' ) ;
define( '_MI_PLZXOO_CATEGORY_NOTIFY' , 'Category' ) ;
define( '_MI_PLZXOO_CATEGORY_NOTIFYDSC' , 'About the category selected' ) ;
define( '_MI_PLZXOO_QUESTION_NOTIFY' , 'Question' ) ;
define( '_MI_PLZXOO_QUESTION_NOTIFYDSC' , 'About the question selected' ) ;
define( '_MI_PLZXOO_GLOBAL_NEWQ_NOTIFY' , 'New Question' ) ;
define( '_MI_PLZXOO_GLOBAL_NEWQ_NOTIFYCAP' , 'Notify a question is posted or modified' ) ;
define( '_MI_PLZXOO_GLOBAL_NEWQ_NOTIFYDSC' , 'Notify a question is posted or modified' ) ;
define( '_MI_PLZXOO_GLOBAL_NEWQ_NOTIFYSBJ' , '[{X_SITENAME}] {X_MODULE}: Updated question' ) ;
define( '_MI_PLZXOO_CATEGORY_NEWQ_NOTIFY' , 'New Question' ) ;
define( '_MI_PLZXOO_CATEGORY_NEWQ_NOTIFYCAP' , 'Notify a question in this category is posted or modified' ) ;
define( '_MI_PLZXOO_CATEGORY_NEWQ_NOTIFYDSC' , 'Notify a question in this category is posted or modified' ) ;
define( '_MI_PLZXOO_CATEGORY_NEWQ_NOTIFYSBJ' , '[{X_SITENAME}] {X_MODULE}: Category: Updated question' ) ;
define( '_MI_PLZXOO_QUESTION_NEWA_NOTIFY' , 'New Answer' ) ;
define( '_MI_PLZXOO_QUESTION_NEWA_NOTIFYCAP' , 'Notify an answer for this question is posted or modified' ) ;
define( '_MI_PLZXOO_QUESTION_NEWA_NOTIFYDSC' , 'Notify an answer for this question is posted or modified' ) ;
define( '_MI_PLZXOO_QUESTION_NEWA_NOTIFYSBJ' , '[{X_SITENAME}] {X_MODULE}: Updated answer' ) ;



?>