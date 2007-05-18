<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) ) $mydirname = 'd3forum' ;
$constpref = '_MI_' . strtoupper( $mydirname ) ;

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( $constpref.'_LOADED' ) ) {



// Appended by Xoops Language Checker -GIJOE- in 2007-05-18 17:34:37
define($constpref.'_ADMENU_MYLANGADMIN','Languages');
define($constpref.'_SHOW_BREADCRUMBS','Display breadcrumbs');
define($constpref.'_ANTISPAM_GROUPS','Groups should be checked anti-SPAM');
define($constpref.'_ANTISPAM_GROUPSDSC','Usually set all blank.');
define($constpref.'_ANTISPAM_CLASS','Class name of anti-SPAM');
define($constpref.'_ANTISPAM_CLASSDSC','Default value is "default". If you disable anti-SPAM against guests even, set it blank');

// Appended by Xoops Language Checker -GIJOE- in 2007-03-26 11:39:17
define($constpref.'_ADMENU_MYTPLSADMIN','Templates');
define($constpref.'_ADMENU_MYBLOCKSADMIN','Blocks/Permissions');
define($constpref.'_ADMENU_MYPREFERENCES','Preferences');

define( $constpref.'_LOADED' , 1 ) ;

// The name of this module
define($constpref."_NAME","Forum");

// A brief description of this module
define($constpref."_DESC","Module Forums pour XOOPS");

// Names of blocks for this module (Not all module has blocks)
define($constpref."_BNAME_LIST_TOPICS","Sujets");
define($constpref."_BDESC_LIST_TOPICS","Ce block peut être utilisé de manière polyvalente. Bien sûr, vous pouvez le dupliquer.");
define($constpref."_BNAME_LIST_POSTS","Posts");
define($constpref."_BNAME_LIST_FORUMS","Forums");

define($constpref.'_ADMENU_CATEGORYACCESS','Permissions des Catégories');
define($constpref.'_ADMENU_FORUMACCESS','Permissions des Forums');
define($constpref.'_ADMENU_ADVANCEDADMIN','Avancé');

// configurations
define($constpref.'_TOP_MESSAGE','Message en-tête du forum');
define($constpref.'_TOP_MESSAGEDEFAULT','<h1 class="d3f_title">Forum Top</h1><p class="d3f_welcome">Pour consulter les messages, choisissez la catégorie et le forum que vous voulez visiter ci-dessous. </p>');
define($constpref.'_ALLOW_HTML','Autoriser HTML');
define($constpref.'_ALLOW_HTMLDSC','N\'activez pas cette option au hazard. Ceci peut être une cause de vulnérabilité et permettre à un utilisateur malveillant insertion d\'un script.');
define($constpref.'_ALLOW_TEXTIMG','Autoriser l\'affichage d\'images externes dans les messages');
define($constpref.'_ALLOW_TEXTIMGDSC','Si un utilisateur malveillant poste une image externe utilisant [img], il peut connaitre les adresses IP ou Agents-Clients des utilisateurs de votre site.');
define($constpref.'_ALLOW_SIG','Autoriser Signature');
define($constpref.'_ALLOW_SIGDSC','Permet aux utilisateurs d\'associer une signature à leur message');
define($constpref.'_ALLOW_SIGIMG','Autoriser l\'affichage d\'images externes dansla signature');
define($constpref.'_ALLOW_SIGIMGDSC','Si un utilisateur malveillant poste une image externe utilisant [img], il peut connaitre les adresses IP ou Agents-Clients des utilisateurs de votre site');
define($constpref.'_USE_VOTE','Activer l\'option de VOTE');
define($constpref.'_USE_SOLVED','Activer l\'option de RESOLU');
define($constpref.'_ALLOW_MARK','Activer l\'option Post-it');
define($constpref.'_ALLOW_HIDEUID','Autoriser un utilisateur à poster ou pas avec son nom');
define($constpref.'_POSTS_PER_TOPIC','Maximum de messages dans un Sujet');
define($constpref.'_POSTS_PER_TOPICDSC','Un Sujet peut avoir un nombre limité de messages postés.');
define($constpref.'_HOT_THRESHOLD','Seuil d\'un Sujet Populaire');
define($constpref.'_HOT_THRESHOLDDSC','Valeur à partir de laquelle un Sujet est considéré populaire.');
define($constpref.'_TOPICS_PER_PAGE','Nombre de Sujets par page du forum');
define($constpref.'_TOPICS_PER_PAGEDSC','');
define($constpref.'_VIEWALLBREAK','Sujets par page de l\'ensemble des forums');
define($constpref.'_VIEWALLBREAKDSC','');
define($constpref.'_SELFEDITLIMIT','Délai requit pour l\'édition par les utilisateurs, en secondes.');
define($constpref.'_SELFEDITLIMITDSC','Pour autoriser les utilisateurs à editer leurs messages, ajoutez une valeur en secondes. Et pour interdire l\'édition, ajoutez 0.');
define($constpref.'_SELFDELLIMIT','Délai requit pour la suppression par les utilisateurs, en secondes.');
define($constpref.'_SELFDELLIMITDSC','Pour autoriser les utilisateurs à supprimer leurs messages, ajoutez une valeur en secondes. Et pour interdire la suppresion, ajoutez 0. Aucun message parent ne peut être effacé.');
define($constpref.'_CSS_URI','URI du fichier CSS pour ce module');
define($constpref.'_CSS_URIDSC','Chemin absolu ou relatif. Par défaut: index.css');
define($constpref.'_IMAGES_DIR','Repértoire pour les fichiers image');
define($constpref.'_IMAGES_DIRDSC','Le chemin relatif devrait être dans le dossier de module. Par défaut: images');
define($constpref.'_ANONYMOUS_NAME','Nom Anonyme');
define($constpref.'_ANONYMOUS_NAMEDSC','');
define($constpref.'_ICON_MEANINGS','Les sens d\'icônes');
define($constpref.'_ICON_MEANINGSDSC','Spécifier les ALT des icônes. Chaque ALT devrait être séparé par (|). Le premier ALT correspond à "posticon0.gif".');
define($constpref.'_ICON_MEANINGSDEF','aucun|normal|mécontent|heureux|augmenter|baisser|rapport|question');
define($constpref.'_GUESTVOTE_IVL','Vote des invités');
define($constpref.'_GUESTVOTE_IVLDSC','Ajoutez 0, pour neutraliser le vote des utilisateurs invités. Ou ajoutez une valeur en secondes pour permettre un deuxième vote de même IP.');


// Notify Categories
define($constpref.'_NOTCAT_TOPIC', 'Ce Sujet'); 
define($constpref.'_NOTCAT_TOPICDSC', 'Notifications sur le Sujet actuel');
define($constpref.'_NOTCAT_FORUM', 'Ce Forum'); 
define($constpref.'_NOTCAT_FORUMDSC', 'Notifications sur le Forum actuel');
define($constpref.'_NOTCAT_CAT', 'Cette Categorie');
define($constpref.'_NOTCAT_CATDSC', 'Notifications sur la Categorie actuelle');
define($constpref.'_NOTCAT_GLOBAL', 'Ce module');
define($constpref.'_NOTCAT_GLOBALDSC', 'Notifications globales sur le module forums');

// Each Notifications
define($constpref.'_NOTIFY_TOPIC_NEWPOST', 'Nouveau message dans ce Sujet');
define($constpref.'_NOTIFY_TOPIC_NEWPOSTCAP', 'Notifiez-moi des nouveaux messages dans le Sujet actuel.');
define($constpref.'_NOTIFY_TOPIC_NEWPOSTSBJ', '[{X_SITENAME}] {X_MODULE}:{TOPIC_TITLE} Nouveau message dans le Sujet');

define($constpref.'_NOTIFY_FORUM_NEWPOST', 'Nouveau message dans ce Forum');
define($constpref.'_NOTIFY_FORUM_NEWPOSTCAP', 'Notifiez-moi des nouveaux messages dans le Forum actuel.');
define($constpref.'_NOTIFY_FORUM_NEWPOSTSBJ', '[{X_SITENAME}] {X_MODULE}:{FORUM_TITLE} Nouveau message dans ce Forum');

define($constpref.'_NOTIFY_FORUM_NEWTOPIC', 'Nouveau Sujet dans ce forum');
define($constpref.'_NOTIFY_FORUM_NEWTOPICCAP', 'Notifiez-moi des nouveaux Sujets dans le Forum actuel.');
define($constpref.'_NOTIFY_FORUM_NEWTOPICSBJ', '[{X_SITENAME}] {X_MODULE}:{FORUM_TITLE} Nouveau Sujet dans ce Forum');

define($constpref.'_NOTIFY_CAT_NEWPOST', 'Nouveau message dans cette Categorie');
define($constpref.'_NOTIFY_CAT_NEWPOSTCAP', 'Notifiez-moi des nouveaux messages dans la Categorie actuelle.');
define($constpref.'_NOTIFY_CAT_NEWPOSTSBJ', '[{X_SITENAME}] {X_MODULE}:{CAT_TITLE} Nouveau message dans cette Categorie');

define($constpref.'_NOTIFY_CAT_NEWTOPIC', 'Nouveau Sujet dans cette Categorie');
define($constpref.'_NOTIFY_CAT_NEWTOPICCAP', 'Notifiez-moi des nouveaux Sujets dans la Categorie actuelle.');
define($constpref.'_NOTIFY_CAT_NEWTOPICSBJ', '[{X_SITENAME}] {X_MODULE}:{CAT_TITLE} Nouveau Sujet dans cette category');

define($constpref.'_NOTIFY_CAT_NEWFORUM', 'Nouveau Forum dans cette Categorie');
define($constpref.'_NOTIFY_CAT_NEWFORUMCAP', 'Notifiez-moi des nouveaux Forums dans la Categorie actuelle.');
define($constpref.'_NOTIFY_CAT_NEWFORUMSBJ', '[{X_SITENAME}] {X_MODULE}:{CAT_TITLE} Nouveau Forum dans cette Categorie');

define($constpref.'_NOTIFY_GLOBAL_NEWPOST', 'Nouveau message dans ce module');
define($constpref.'_NOTIFY_GLOBAL_NEWPOSTCAP', 'Notifiez-moi des nouveaux messages dans ce module.');
define($constpref.'_NOTIFY_GLOBAL_NEWPOSTSBJ', '[{X_SITENAME}] {X_MODULE}: New post');

define($constpref.'_NOTIFY_GLOBAL_NEWTOPIC', 'Nouveau Sujet dans ce module');
define($constpref.'_NOTIFY_GLOBAL_NEWTOPICCAP', 'Notifiez-moi des nouveaux Sujets dans ce module.');
define($constpref.'_NOTIFY_GLOBAL_NEWTOPICSBJ', '[{X_SITENAME}] {X_MODULE}: New topic');

define($constpref.'_NOTIFY_GLOBAL_NEWFORUM', 'Nouveau Forum dans ce module');
define($constpref.'_NOTIFY_GLOBAL_NEWFORUMCAP', 'Notifiez-moi des nouveaux Forums dans ce module.');
define($constpref.'_NOTIFY_GLOBAL_NEWFORUMSBJ', '[{X_SITENAME}] {X_MODULE}: New forum');

define($constpref.'_NOTIFY_GLOBAL_NEWPOSTFULL', 'Nouveau Message (Texte Complet)');
define($constpref.'_NOTIFY_GLOBAL_NEWPOSTFULLCAP', 'Notifiez-moi de tout nouveau message (avec texte intégral du message).');
define($constpref.'_NOTIFY_GLOBAL_NEWPOSTFULLSBJ', '[{X_SITENAME}] {POST_TITLE}');
define($constpref.'_NOTIFY_GLOBAL_WAITING', 'Nouveau message en attente');
define($constpref.'_NOTIFY_GLOBAL_WAITINGCAP', 'Informez-moi de nouveaux messages attendant l\'approbation. Pour des admins seulement');
define($constpref.'_NOTIFY_GLOBAL_WAITINGSBJ', '[{X_SITENAME}] {X_MODULE}: Nouveau message en attente');

}

?>