<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( 'MYALBUM_MB_LOADED' ) ) {

define( 'MYALBUM_MB_LOADED' , 1 ) ;

//%%%%%%		Module Name 'myAlbum-P'		%%%%%

// New in myAlbum-P

// only "Y/m/d" , "d M Y" , "M d Y" can be interpreted
define( "_ALBM_DTFMT_YMDHI" , "d M Y H:i" ) ;

define( "_ALBM_NEXT_BUTTON" , "Next" ) ;
define( "_ALBM_REDOLOOPDONE" , "Done." ) ;

define( "_ALBM_BTN_SELECTALL" , "Select All" ) ;
define( "_ALBM_BTN_SELECTNONE" , "Select None" ) ;
define( "_ALBM_BTN_SELECTRVS" , "Select Reverse" ) ;

define( "_ALBM_FMT_PHOTONUM" , "%s every page" ) ;

define( "_ALBM_AM_ADMISSION" , "Admit Photos" ) ;
define( "_ALBM_AM_ADMITTING" , "Admitted photo(s)" ) ;
define( "_ALBM_AM_LABEL_ADMIT" , "Admit the photos you checked" ) ;
define( "_ALBM_AM_BUTTON_ADMIT" , "Admit" ) ;
define( "_ALBM_AM_BUTTON_EXTRACT" , "extract" ) ;

define( "_ALBM_AM_PHOTOMANAGER" , "Photo Manager" ) ;
define( "_ALBM_AM_PHOTONAVINFO" , "Photo No. %s-%s (out of %s photos hit)" ) ;
define( "_ALBM_AM_LABEL_REMOVE" , "Remove the photos checked" ) ;
define( "_ALBM_AM_BUTTON_REMOVE" , "Remove!" ) ;
define( "_ALBM_AM_JS_REMOVECONFIRM" , "Remove OK?" ) ;
define( "_ALBM_AM_LABEL_MOVE" , "Change category of the checked photos" ) ;
define( "_ALBM_AM_BUTTON_MOVE" , "Move" ) ;
define( "_ALBM_AM_BUTTON_UPDATE" , "Modify" ) ;
define( "_ALBM_AM_DEADLINKMAINPHOTO" , "The main image don't exist" ) ;

define( "_ALBM_RADIO_ROTATETITLE" , "Image rotation" ) ;
define( "_ALBM_RADIO_ROTATE0" , "no turn" ) ;
define( "_ALBM_RADIO_ROTATE90" , "turn right" ) ;
define( "_ALBM_RADIO_ROTATE180" , "turn 180 degree" ) ;
define( "_ALBM_RADIO_ROTATE270" , "turn left" ) ;


// New MyAlbum 1.0.1 (and 1.2.0)
define("_ALBM_MOREPHOTOS","More Photos from %s");
define("_ALBM_REDOTHUMBS","Redo Thumbnails (<a href='redothumbs.php'>re-start</a>)");
define("_ALBM_REDOTHUMBSINFO","Too large a number may lead to server time out.");
define("_ALBM_REDOTHUMBSNUMBER","Number of thumbs at a time");
define("_ALBM_REDOING","Redoing: ");
define("_ALBM_BACK","Return");
define("_ALBM_ADDPHOTO","Add Photo");


// New MyAlbum 1.0.0
define("_ALBM_PHOTOBATCHUPLOAD","Register photos uploaded to the server already");
define("_ALBM_PHOTOUPLOAD","Photo Upload");
define("_ALBM_PHOTOEDITUPLOAD","Photo Edit and Re-upload");
define("_ALBM_MAXPIXEL","Max pixel size");
define("_ALBM_MAXSIZE","Max file size(byte)");
define("_ALBM_PHOTOTITLE","Title");
define("_ALBM_PHOTOPATH","Path");
define("_ALBM_TEXT_DIRECTORY","Directory");
define("_ALBM_DESC_PHOTOPATH","Type the full path of the directory including photos to be registered");
define("_ALBM_MES_INVALIDDIRECTORY","Invalid directory is specified.");
define("_ALBM_MES_BATCHDONE","%s photo(s) have been registered.");
define("_ALBM_MES_BATCHNONE","No photo was detected in the directory.");
define("_ALBM_PHOTODESC","Description");
define("_ALBM_PHOTOCAT","Category");
define("_ALBM_SELECTFILE","Select photo");
define("_ALBM_NOIMAGESPECIFIED","Error: No photo was uploaded");
define("_ALBM_FILEERROR","Error: Photos are too big or there is a problem with the configuration");
define("_ALBM_FILEREADERROR","Error: Photos are not readable.");

define("_ALBM_BATCHBLANK","Leave title blank to use file names as title");
define("_ALBM_DELETEPHOTO","Delete?");
define("_ALBM_VALIDPHOTO","Valid");
define("_ALBM_PHOTODEL","Delete photo?");
define("_ALBM_DELETINGPHOTO","Deleting photo");
define("_ALBM_MOVINGPHOTO","Moving photo");

define("_ALBM_POSTERC","Poster: ");
define("_ALBM_DATEC","Date: ");
define("_ALBM_EDITNOTALLOWED","You're not allowed to edit this comment!");
define("_ALBM_ANONNOTALLOWED","Anonymous users are not allowed to post.");
define("_ALBM_THANKSFORPOST","Thanks for your submission!");
define("_ALBM_DELNOTALLOWED","You're not allowed to delete this comment!");
define("_ALBM_GOBACK","Go Back");
define("_ALBM_AREYOUSURE","Are you sure you want to delete this comment and all comments under it?");
define("_ALBM_COMMENTSDEL","Comment(s) Deleted Successfully!");

// End New

define("_ALBM_THANKSFORINFO","Thank you for the information. We'll look into your request shortly.");
define("_ALBM_BACKTOTOP","Back to Photo Top");
define("_ALBM_THANKSFORHELP","Thank you for helping to maintain this directory's integrity.");
define("_ALBM_FORSECURITY","For security reasons your user name and IP address will also be temporarily recorded.");

define("_ALBM_MATCH","Match");
define("_ALBM_ALL","ALL");
define("_ALBM_ANY","ANY");
define("_ALBM_NAME","Name");
define("_ALBM_DESCRIPTION","Description");

define("_ALBM_MAIN","Main");
define("_ALBM_NEW","New");
define("_ALBM_UPDATED","Updated");
define("_ALBM_POPULAR","Popular");
define("_ALBM_TOPRATED","Top Rated");

define("_ALBM_POPULARITYLTOM","Popularity (Least to Most Hits)");
define("_ALBM_POPULARITYMTOL","Popularity (Most to Least Hits)");
define("_ALBM_TITLEATOZ","Title (A to Z)");
define("_ALBM_TITLEZTOA","Title (Z to A)");
define("_ALBM_DATEOLD","Date (Old Photos Listed First)");
define("_ALBM_DATENEW","Date (New Photos Listed First)");
define("_ALBM_RATINGLTOH","Rating (Lowest Score to Highest Score)");
define("_ALBM_RATINGHTOL","Rating (Highest Score to Lowest Score)");
define("_ALBM_LIDASC","Record Number (Smaller to Bigger)");
define("_ALBM_LIDDESC","Record Number (Smaller is latter)");

define("_ALBM_NOSHOTS","No Screenshots Available");
define("_ALBM_EDITTHISPHOTO","Edit This Photo");

define("_ALBM_DESCRIPTIONC","Description");
define("_ALBM_EMAILC","Email");
define("_ALBM_CATEGORYC","Category");
define("_ALBM_SUBCATEGORY","Sub-category");
define("_ALBM_LASTUPDATEC","Last Update");
define("_ALBM_HITSC","Hits");
define("_ALBM_RATINGC","Rating");
define("_ALBM_ONEVOTE","1 vote");
define("_ALBM_NUMVOTES","%s votes");
define("_ALBM_ONEPOST","1 post");
define("_ALBM_NUMPOSTS","%s posts");
define("_ALBM_COMMENTSC","Comments");
define("_ALBM_RATETHISPHOTO","Rate it");
define("_ALBM_MODIFY","Modify");
define("_ALBM_VSCOMMENTS","View/Send Comments");

define("_ALBM_DIRECTCATSEL","SELECT A CATEGORY");
define("_ALBM_THEREARE","There are <b>%s</b> Images in our Database.");
define("_ALBM_LATESTLIST","Latest Listings");

define("_ALBM_VOTEAPPRE","Your vote is appreciated.");
define("_ALBM_THANKURATE","Thank you for taking the time to rate a photo here at %s.");
define("_ALBM_VOTEONCE","Please do not vote for the same resource more than once.");
define("_ALBM_RATINGSCALE","The scale is 1 - 10, with 1 being poor and 10 being excellent.");
define("_ALBM_BEOBJECTIVE","Please be objective, if everyone receives a 1 or a 10, the ratings aren't very useful.");
define("_ALBM_DONOTVOTE","Do not vote for your own resource.");
define("_ALBM_RATEIT","Rate It!");

define("_ALBM_RECEIVED","We received your Photo. Thank you!");
define("_ALBM_ALLPENDING","All photos are posted pending verification.");

define("_ALBM_RANK","Rank");
define("_ALBM_CATEGORY","Category");
define("_ALBM_HITS","Hits");
define("_ALBM_RATING","Rating");
define("_ALBM_VOTE","Vote");
define("_ALBM_TOP10","%s Top 10"); // %s is a photo category title

define("_ALBM_SORTBY","Sort by:");
define("_ALBM_TITLE","Title");
define("_ALBM_DATE","Date");
define("_ALBM_POPULARITY","Popularity");
define("_ALBM_CURSORTEDBY","Photos currently sorted by: %s");
define("_ALBM_FOUNDIN","Found in:");
define("_ALBM_PREVIOUS","Previous");
define("_ALBM_NEXT","Next");
define("_ALBM_NOMATCH","No photo matches your request");

define("_ALBM_CATEGORIES","Categories");

define("_ALBM_SUBMIT","Submit");
define("_ALBM_CANCEL","Cancel");

define("_ALBM_MUSTREGFIRST","Sorry, you don't have permission to perform this action.<br>Please register or login first!");
define("_ALBM_MUSTADDCATFIRST","Sorry, there are no categories to add to yet.<br>Please create a category first!");
define("_ALBM_NORATING","No rating selected.");
define("_ALBM_CANTVOTEOWN","You cannot vote on the resource you submitted.<br>All votes are logged and reviewed.");
define("_ALBM_VOTEONCE2","Vote for the selected resource only once.<br>All votes are logged and reviewed.");

//%%%%%%	Module Name 'MyAlbum' (Admin)	  %%%%%

define("_ALBM_PHOTOSWAITING","Photos Waiting for Validation");
define("_ALBM_PHOTOMANAGER","Photo Management");
define("_ALBM_CATEDIT","Add, Modify, and Delete Categories");
define("_ALBM_GROUPPERM_GLOBAL","Global Permissions");
define("_ALBM_CHECKCONFIGS","Check Configs & Environment");
define("_ALBM_BATCHUPLOAD","Batch Register");
define("_ALBM_GENERALSET","Preferences");
define("_ALBM_REDOTHUMBS2","Rebuild Thumbnails");

define("_ALBM_SUBMITTER","Submitter");
define("_ALBM_DELETE","Delete");
define("_ALBM_NOSUBMITTED","No New Submitted Photos.");
define("_ALBM_ADDMAIN","Add a MAIN Category");
define("_ALBM_IMGURL","Image URL (OPTIONAL Image height will be resized to 50): ");
define("_ALBM_ADD","Add");
define("_ALBM_ADDSUB","Add a SUB-Category");
define("_ALBM_IN","in");
define("_ALBM_MODCAT","Modify Category");
define("_ALBM_DBUPDATED","Database Updated Successfully!");
define("_ALBM_MODREQDELETED","Modification Request Deleted.");
define("_ALBM_IMGURLMAIN","Image URL (OPTIONAL and Only valid for main categories. Image height will be resized to 50): ");
define("_ALBM_PARENT","Parent Category:");
define("_ALBM_SAVE","Save Changes");
define("_ALBM_CATDELETED","Category Deleted.");
define("_ALBM_CATDEL_WARNING","WARNING: Are you sure you want to delete this Category and ALL its Photos and Comments?");
define("_ALBM_YES","Yes");
define("_ALBM_NO","No");
define("_ALBM_NEWCATADDED","New Category Added Successfully!");
define("_ALBM_ERROREXIST","ERROR: The Photo you provided is already in the database!");
define("_ALBM_ERRORTITLE","ERROR: You need to enter a TITLE!");
define("_ALBM_ERRORDESC","ERROR: You need to enter a DESCRIPTION!");
define("_ALBM_WEAPPROVED","We approved your link submission to the photo database.");
define("_ALBM_THANKSSUBMIT","Thank you for your submission!");
define("_ALBM_CONFUPDATED","Configuration Updated Successfully!");

}

?>