<?php
// Module Info

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( 'MYALBUM_MI_LOADED' ) ) {






// Appended by Xoops Language Checker -GIJOE- in 2004-10-04 16:06:33
define('_ALBM_CFG_DEFAULTORDER','Ordre par défaut dans la vue d\'une catégorie');

// Appended by Xoops Language Checker -GIJOE- in 2004-06-24 17:58:59
define('_ALBM_CFG_USESITEIMG','Utiliser [siteimg] dans l\'intégration des images (ImageManager Integration)');
define('_ALBM_CFG_DESCUSESITEIMG','L\'intégrateur d\'image demande [siteimg] à la place de [img].<br />Vous devez altérer module.textsanitizer.php oubien chaque module pour activer la balise [siteimg]');

// Appended by Xoops Language Checker -GIJOE- in 2004-05-19 13:56:06
define('_ALBM_CFG_MIDDLEPIXEL','Taille maximum de l\'image dans une vue singulière');
define('_ALBM_CFG_DESCMIDDLEPIXEL','Spécifier (largeur)x(hauteur)<br />par exemple : 480x480');

// Appended by Xoops Language Checker -GIJOE- in 2004-05-17 18:42:55
define('_ALBM_CFG_DESCPERPAGE','Entrer les nombres sélectionables en les séparant par \'|\'<br />par exemple : 10|20|50|100');

// Appended by Xoops Language Checker -GIJOE- in 2004-05-05 15:14:39
define('_ALBM_CFG_ALLOWNOIMAGE','Autoriser les soumissions sans image');
define('_ALBM_CFG_ALLOWEDEXTS','Les extensions qui sont acceptées');
define('_ALBM_CFG_DESCALLOWEDEXTS','Entre les extensions en les séparent par le \'|\'. (par exemple : \'jpg|jpeg|gif|png\') .<br />Tous les caractères doivent être petits. N\'insérer pas de blanc');
define('_ALBM_CFG_ALLOWEDMIME','Les types MIME qui peuvent être uploadés');
define('_ALBM_CFG_DESCALLOWEDMIME','Inscrivez les type MIME en les séparant par le \'|\'. (par exemple : \'image/gif|image/jpeg|image/png\')<br />Si vous voulez être regarder par le type MIME, soyez vide ici.');
define('_ALBM_MYALBUM_ADMENU_IMPORT','Importer des images');
define('_ALBM_MYALBUM_ADMENU_EXPORT','Exporter des images');
define('_ALBM_MYALBUM_ADMENU_MYBLOCKSADMIN','Administrations des blocs et des groupes');

define( 'MYALBUM_MI_LOADED' , 1 ) ;

// The name of this module
define("_ALBM_MYALBUM_NAME","MyAlbum");//I did not change this --sebhtml

// A brief description of this module
define("_ALBM_MYALBUM_DESC","Créer une section de photos où les utilisateurs peuvent chercher/soumettre/noter des photos.");

// Names of blocks for this module (Not all module has blocks)
define("_ALBM_BNAME_RECENT","Photos récentes");
define("_ALBM_BNAME_HITS","Top Photos");
define("_ALBM_BNAME_RANDOM","Choisissez une photo");

// Config Items
define( "_ALBM_CFG_PHOTOSPATH" , "Chemin pour les photos" ) ;
define( "_ALBM_CFG_DESCPHOTOSPATH" , "chemin ou est installé XOOPS.<br />(le premier caractere doit être '/'. Le dernier caractère ne doit pas être '/'.)<br />Les permissions de ce repertoire sont 777 or 707 sur UNIX." ) ;
define( "_ALBM_CFG_THUMBSPATH" , "chemin pour les vignettes" ) ;
define( "_ALBM_CFG_DESCTHUMBSPATH" , "Pareil à 'Chemin de photos'." ) ;
define( "_ALBM_CFG_USEIMAGICK" , "Utiliser ImageMagick pour traiter les photos" ) ;
define( "_ALBM_CFG_DESCIMAGICK" , "Impossible de 'redimensionner', 'faire pivoter la photo' ou 'créer des vignettes' avec GD.<br />You'd better use ImageMagick if you can." ) ;
define( "_ALBM_CFG_IMAGICKPATH" , "Chemin de ImageMagick" ) ;
define( "_ALBM_CFG_DESCIMAGICKPATH" , "le chemin complet pour 'convertir'<br />(Le dernier caractère ne peut pas être '/'.)" ) ;
define( "_ALBM_CFG_POPULAR" , "Clics pour être populaire" ) ;
define( "_ALBM_CFG_NEWDAYS" , "Nombre de jour ou la photo est affichée 'Nouveauté'&'Mise à jour'" ) ;
define( "_ALBM_CFG_NEWPHOTOS" , "Nombre de nouvelles photos sur la Page principale" ) ;
define( "_ALBM_CFG_PERPAGE" , "Nombre de photos affichées par page" ) ;
define( "_ALBM_CFG_MAKETHUMB" , "Créer les vignettes" ) ;
define( "_ALBM_CFG_THUMBWIDTH" , "Largeur des vignettes" ) ;
define( "_ALBM_CFG_DESCMAKETHUMB" , "Quand vous changez 'Non' en 'Oui', 'recréer des meilleures vignettes''." ) ;
define( "_ALBM_CFG_WIDTH" , "Largeur maximale de la photo" ) ;
define( "_ALBM_CFG_DESCWIDTH" , "Si vous utilisez ImageMagick, Cela signifie la taille pour la redimensionner.<br />Sinon, cela signifie la taille de la largeur." ) ;
define( "_ALBM_CFG_HEIGHT" , "Hauteur maximale de la photo" ) ;
define( "_ALBM_CFG_DESCHEIGHT" , "Pareil que 'Largeur maximale de la photo'." ) ;
define( "_ALBM_CFG_FSIZE" , "Taille maximale du fichier" ) ;
define( "_ALBM_CFG_DESCFSIZE" , "La taille limite des fichiers uploader." ) ;
define( "_ALBM_CFG_NEEDADMIT" , "Necessite une validation" ) ;
define( "_ALBM_CFG_ADDPOSTS" , "Ajout au nombre d'envoi de l'utilisateur des photos soumises." ) ;
define( "_ALBM_CFG_DESCADDPOSTS" , "Normallement, 0 ou 1. En-dessous de 0 signifie 0" ) ;

// Sub menu titles
define("_ALBM_TEXT_SMNAME1","Soumettre");
define("_ALBM_TEXT_SMNAME2","Populaire");
define("_ALBM_TEXT_SMNAME3","Top Votes");
define("_ALBM_TEXT_SMNAME4","Mes Photos");

// Names of admin menu items
define("_ALBM_MYALBUM_ADMENU0","Photos soumises");
define("_ALBM_MYALBUM_ADMENU1","Gestionnaire de photos");
define("_ALBM_MYALBUM_ADMENU2","Ajouter/Éditer Categories");
define("_ALBM_MYALBUM_ADMENU3","Contrôle de module");
define("_ALBM_MYALBUM_ADMENU4","Ajout de photos en masse (batch)");
define("_ALBM_MYALBUM_ADMENU5","Recréer les vignettes");


// Appended by Xoops Language Checker -GIJOE- in 2003-10-21 17:48:33
define('_ALBM_CFG_DESCTHUMBWIDTH','La hauteur de la vignette sera calculée à partir du rapport hauteur/largeur ainsi que de la largeur.');

// Appended by Xoops Language Checker -GIJOE- in 2003-11-27 10:43:20
define('_ALBM_CFG_IMAGINGPIPE','Paquet traitant les images');
define('_ALBM_CFG_DESCIMAGINGPIPE','Les installations de php sous munies de GD. Cependant, GD est moins bon que les deux autres librairies.<br />Vous devriez utiliser ImageMagick ou NetPBM si vous le pouvez');
define('_ALBM_CFG_FORCEGD2','Forcer conversion avec GD2');
define('_ALBM_CFG_DESCFORCEGD2','Même si la version de GD est  imbriquée, il force la conversion avec GD2 pour les couleurs vraies<br />Quelques interpréteurs PHP échouent à la création de vignettes avec GD2<br />Cette configuration est significative seulement avec GD');
define('_ALBM_CFG_NETPBMPATH','Chemin vers NetPBM');
define('_ALBM_CFG_DESCNETPBMPATH','Le chemin complet vers \'pnmscale\'.<br />(Le dernier caractère ne doit pas être le \'/\'.)<br />Cette configuration est significative seulement avec NetPBM');
define('_ALBM_CFG_THUMBSIZE','Taille de la vignette (pixel)');
define('_ALBM_CFG_THUMBRULE','Règle de calcul pour la construction des vignettes');
define('_ALBM_CFG_CATONSUBMENU','Enregistrer les catégories du haut dans les sous-menus');
define('_ALBM_CFG_NAMEORUNAME','Afficher le nom de l\'auteur');
define('_ALBM_CFG_DESCNAMEORUNAME','Choisissez quel \'nom\' est affiché');
define('_ALBM_OPT_USENAME','Nom d\'utilisateur');
define('_ALBM_OPT_USEUNAME','Nom de connection');
define('_ALBUM_OPT_CALCFROMWIDTH','largeur:spécifiée  hauteur:automatique');
define('_ALBUM_OPT_CALCFROMHEIGHT','width:automatique  hauteur:spécifiée');
define('_ALBUM_OPT_CALCWHINSIDEBOX','mettre la taille spécifiée au carré');

// Appended by Xoops Language Checker -GIJOE- in 2003-12-03 16:33:03
define('_ALBM_BNAME_RECENT_P','Vignettes des photos récentes');
define('_ALBM_BNAME_HITS_P','Vignettes des photos les plus populaires');

// Appended by Xoops Language Checker -GIJOE- in 2004-01-27 15:37:03
define('_ALBM_CFG_VIEWCATTYPE','Type de vue d\'une catégorie');
define('_ALBM_CFG_COLSOFTABLEVIEW','Nom de colonne dans la vue du tableau');
define('_ALBM_OPT_VIEWLIST','Vue en liste');
define('_ALBM_OPT_VIEWTABLE','Vue en tableau');
define('_ALBM_MYALBUM_ADMENU_GPERM','Permissions globales');
define('_MI_MYALBUM_GLOBAL_NOTIFY','Globalité');
define('_MI_MYALBUM_GLOBAL_NOTIFYDSC','Option de notification globale avec myAlbum-P');
define('_MI_MYALBUM_CATEGORY_NOTIFY','Catégorie');
define('_MI_MYALBUM_CATEGORY_NOTIFYDSC','Options de notifications qui s\'appliquent à la catégorie de photos courante.');
define('_MI_MYALBUM_PHOTO_NOTIFY','Photo');
define('_MI_MYALBUM_PHOTO_NOTIFYDSC','Options de notifications qui s\'appliquent à la photo courante.');
define('_MI_MYALBUM_GLOBAL_NEWPHOTO_NOTIFY','Nouvelle photo');
define('_MI_MYALBUM_GLOBAL_NEWPHOTO_NOTIFYCAP','Alerter moi quand une photos est ajoutée');
define('_MI_MYALBUM_GLOBAL_NEWPHOTO_NOTIFYDSC','Recevoir une alerte lors de l\'ajout de n\'importe quelle photo');
define('_MI_MYALBUM_GLOBAL_NEWPHOTO_NOTIFYSBJ','[{X_SITENAME}] {X_MODULE}: alerte : nouvelle photo');
define('_MI_MYALBUM_CATEGORY_NEWPHOTO_NOTIFY','Nouvelle photo');
define('_MI_MYALBUM_CATEGORY_NEWPHOTO_NOTIFYCAP','Alerter moi quand une photos est ajoutée dans la catégorie courante');
define('_MI_MYALBUM_CATEGORY_NEWPHOTO_NOTIFYDSC','Recevoir une alerte lors de l\'ajout de n\'importe quelle photo dans la catégorie courante');
define('_MI_MYALBUM_CATEGORY_NEWPHOTO_NOTIFYSBJ','[{X_SITENAME}] {X_MODULE}: alerte : nouvelle photo');

}

?>
