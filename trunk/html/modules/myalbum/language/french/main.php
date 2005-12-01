<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( 'MYALBUM_MB_LOADED' ) ) {




// Appended by Xoops Language Checker -GIJOE- in 2005-08-31 15:23:36
define('_ALBM_STORETIMESTAMP','Don\'t touch timestamp');
define('_ALBM_TELLAFRIEND','Tell a friend');
define('_ALBM_SUBJECT4TAF','A photo for you!');

// Appended by Xoops Language Checker -GIJOE- in 2004-10-04 16:06:33
define('_ALBM_LIDASC','NumñÓo d\'enregistrement (les grands sont rñÄents)');
define('_ALBM_LIDDESC','NumñÓo d\'enregistrement (les petits sont vieux)');

// Appended by Xoops Language Checker -GIJOE- in 2004-05-17 18:42:55
define('_ALBM_BTN_SELECTALL','SñÍectionner  tout');
define('_ALBM_BTN_SELECTNONE','SñÍectionner rien');
define('_ALBM_BTN_SELECTRVS','SñÍection inverse');
define('_ALBM_FMT_PHOTONUM','%s pour chaque page');
define('_ALBM_AM_BUTTON_UPDATE','Modifier');
define('_ALBM_NOIMAGESPECIFIED','Erreur : aucune photos n\'a ñÕé transfñÓñÆ');
define('_ALBM_FILEREADERROR','Erreur : la photos n\'est pas lisible');
define('_ALBM_DIRECTCATSEL','SñÍectionner une catñÈorie');

define( 'MYALBUM_MB_LOADED' , 1 ) ;

//%%%%%%		Module Name 'MyAlbum-P'		%%%%%

// New in MyAlbum-p

// only "Y/m/d" , "d M Y" , "M d Y" can be interpreted
define( "_ALBM_DTFMT_YMDHI" , "d M Y H:i" ) ;

define( "_ALBM_NEXT_BUTTON" , "Suivant" ) ;
define( "_ALBM_REDOLOOPDONE" , "Fait." ) ;

define( "_ALBM_AM_ADMISSION" , "Accepter Photos" ) ;
define( "_ALBM_AM_ADMITTING" , "Photo(s)acceptñÆ(s)" ) ;
define( "_ALBM_AM_LABEL_ADMIT" , "Accepter les photos que vous avez selectionné" ) ;
define( "_ALBM_AM_BUTTON_ADMIT" , "Accepter" ) ;
define( "_ALBM_AM_BUTTON_EXTRACT" , "Extraire" ) ;

define( "_ALBM_AM_PHOTOMANAGER" , "Gestionnaire de photos" ) ;
define( "_ALBM_AM_PHOTONAVINFO" , "Photo No. %s-%s (sur %s photos)" ) ;
define( "_ALBM_AM_LABEL_REMOVE" , "Supprimer les photos selectionnñÆs" ) ;
define( "_ALBM_AM_BUTTON_REMOVE" , "Retirer!" ) ;
define( "_ALBM_AM_JS_REMOVECONFIRM" , "Retirer OK?" ) ;
define( "_ALBM_AM_LABEL_MOVE" , "Changer la catñÈorie des photos selectionnñÆs" ) ;
define( "_ALBM_AM_BUTTON_MOVE" , "Deplacer" ) ;
define( "_ALBM_AM_DEADLINKMAINPHOTO" , "L'image principale n'existent pas" ) ;

define( "_ALBM_RADIO_ROTATETITLE" , "Image rotation" ) ;
define( "_ALBM_RADIO_ROTATE0" , "Pas de rotation" ) ;
define( "_ALBM_RADIO_ROTATE90" , "Rotation à droite" ) ;
define( "_ALBM_RADIO_ROTATE180" , "Rotation de 180 degrñÔ" ) ;
define( "_ALBM_RADIO_ROTATE270" , "Rotation à gauche" ) ;


// New MyAlbum 1.0.1 (and 1.2.0)
define("_ALBM_MOREPHOTOS","D'autres photos de %s");
define("_ALBM_REDOTHUMBS","Reconstruction des miniatures (<a href='redothumbs.php'>Lancer</a>)");
define("_ALBM_REDOTHUMBS2","Reconstruction des miniatures");
define("_ALBM_REDOTHUMBSINFO","Trop d'images peuvent entraûÏer le non-traitement de l'opñÓation");
define("_ALBM_REDOTHUMBSNUMBER","Nombre de miniatures en ce moment");
define("_ALBM_REDOING","Reconstruite : ");
define("_ALBM_NEXT","Prochain");
define("_ALBM_BACK","Retour");
define("_ALBM_ADDPHOTO","Ajouter une photo");


// New MyAlbum 1.0.0
define("_ALBM_PHOTOBATCHUPLOAD","Photo dñËà prñÔente sur le serveur");
define("_ALBM_PHOTOUPLOAD","Photo chargñÆ");
define("_ALBM_PHOTOEDITUPLOAD","La photo a ñÕé ñÅité et Re-tñÍñÄhargñÆ ");
define("_ALBM_MAXPIXEL","Taille maximale en pixel");
define("_ALBM_MAXSIZE","Taille maximale du fichier");
define("_ALBM_PHOTOTITLE","Titre");
define("_ALBM_PHOTOPATH","chemin");
define("_ALBM_TEXT_DIRECTORY","Repertoire");
define("_ALBM_DESC_PHOTOPATH","Taper le chemin complet du repertoire contenant les photos à enregistrer");
define("_ALBM_MES_INVALIDDIRECTORY","Un rñÑertoire invalide a ñÕé proposé.");
define("_ALBM_MES_BATCHDONE","%s photo(s) sont enregistrñÆs.");
define("_ALBM_MES_BATCHNONE","Pas de photo dñÕectñÆs dans ce repertoire.");
define("_ALBM_PHOTODESC","Description");
define("_ALBM_PHOTOCAT","CatñÈorie");
define("_ALBM_SELECTFILE","Selectionner la photo");
define("_ALBM_FILEERROR","Erreur : Photo non envoyñÆ ou photo trop grande");

define("_ALBM_BATCHBLANK","Laisser le titre blanc pour utiliser le nom de la photo");
define("_ALBM_DELETEPHOTO","Supprimer?");
define("_ALBM_VALIDPHOTO","Valider");
define("_ALBM_PHOTODEL","supprimer la photo?");
define("_ALBM_DELETINGPHOTO","Effacer la photo");
define("_ALBM_MOVINGPHOTO","DñÑlacer la photo");

define("_ALBM_POSTERC","ExpñÅiteur: ");
define("_ALBM_DATEC","Date: ");
define("_ALBM_EDITNOTALLOWED","Vous n'óÕes pas autorisé à modifier ce commentaire!");
define("_ALBM_ANONNOTALLOWED","Les utilisateurs anonymes ne sont pas autorisñÔ à ñÄrire.");
define("_ALBM_THANKSFORPOST","Merci pour votre soumission!");
define("_ALBM_DELNOTALLOWED","Vous n'óÕes pas autorisé à supprimer ce commentaire!");
define("_ALBM_GOBACK","Retour");
define("_ALBM_AREYOUSURE","ŽÊtes-vous s•Ó que vous voulez supprimer ce commentaire et tous ses descendants?");
define("_ALBM_COMMENTSDEL","Commentaire(s) supprimé(s) avec succïÔ!");

// End New

define("_ALBM_THANKSFORINFO","Merci pour votre information. Nous examinerons votre requóÕe trïÔ rapidement.");
define("_ALBM_BACKTOTOP","Retour au sommet des photos");
define("_ALBM_THANKSFORHELP","Merci de nous aider à maintenir l'intñÈrité de cet album.");
define("_ALBM_FORSECURITY","Pour des raisons de sñÄurité, votre nom et votre adresse IP vont óÕre temporairement mñÎorisñÔ.");

define("_ALBM_MATCH","Correspondance");
define("_ALBM_ALL","Tout");
define("_ALBM_ANY","N'Importe lequel");
define("_ALBM_NAME","Nom");
define("_ALBM_DESCRIPTION","Description");

define("_ALBM_MAIN","Principal");
define("_ALBM_POPULAR","Populaires");
define("_ALBM_TOPRATED","Meilleur performance");

define("_ALBM_POPULARITYLTOM","Popularité (De la moins vue à la plus vue)");
define("_ALBM_POPULARITYMTOL","Popularité (De la plus vue à la moins vue)");
define("_ALBM_TITLEATOZ","Titre (A to Z)");
define("_ALBM_TITLEZTOA","Titre (Z to A)");
define("_ALBM_DATEOLD","Date (De la plus ancienne à la plus rñÄente)");
define("_ALBM_DATENEW","Date (De la plus rñÄente à la plus ancienne)");
define("_ALBM_RATINGLTOH","Classement (du moins coté au plus coté)");
define("_ALBM_RATINGHTOL","Classement (du plus coté au moins coté) ");

define("_ALBM_NOSHOTS","Pas de vignette disponible");
define("_ALBM_EDITTHISPHOTO","ŽÉditer cette Photo");

define("_ALBM_DESCRIPTIONC","Description: ");
define("_ALBM_EMAILC","Courriel: ");
define("_ALBM_CATEGORYC","CatñÈorie: ");
define("_ALBM_SUBCATEGORY","Sous-catñÈories: ");
define("_ALBM_LASTUPDATEC","DerniïÓe mise à jour: ");
define("_ALBM_HITSC","Affichages: ");
define("_ALBM_RATINGC","Pointage: ");
define("_ALBM_ONEVOTE","1 vote");
define("_ALBM_NUMVOTES","%s votes");
define("_ALBM_ONEPOST","1 commentaire");
define("_ALBM_NUMPOSTS","%s commentaires");
define("_ALBM_COMMENTSC","Commentaires: ");
define("_ALBM_RATETHISPHOTO","Voter pour cette photo");
define("_ALBM_MODIFY","Modifier");
define("_ALBM_VSCOMMENTS","Voir/Envoyer un commenaires");

define("_ALBM_THEREARE","Il y a <b>%s</b> Photos dans notre base de donnñÆs, <a href='submit.php'>ajouter une nouvelle photo</a>.");
define("_ALBM_LATESTLIST","DerniïÓes listes");

define("_ALBM_VOTEAPPRE","Votre vote est apprñÄié.");
define("_ALBM_THANKURATE","Merci d'avoir pris le temps de coter une photo sur ce site %s.");
define("_ALBM_VOTEONCE","S'il vous plaûÕ, ne votez pas deux fois pour la móÎe ressource.");
define("_ALBM_RATINGSCALE","L'ñÄhelle est 1 à 10, 1 ñÕant lamentable, 10 excellent.");
define("_ALBM_BEOBJECTIVE","Soyez objectif, si chaque ressource reíÐit un 1 ou un 10, les cotes n'auront aucun sens.");
define("_ALBM_DONOTVOTE","Ne votez pas pour vos propres ressources.");
define("_ALBM_RATEIT","Donnez une cote!");

define("_ALBM_RECEIVED","Nous avons reíÖ votre photo. Merci!");
define("_ALBM_ALLPENDING","Toutes les photos attendent d'abord d'óÕre vñÓifiñÆs.");

define("_ALBM_RANK","Rang");
define("_ALBM_CATEGORY","CatñÈorie");
define("_ALBM_HITS","Affichages");
define("_ALBM_RATING","Pointage");
define("_ALBM_VOTE","Vote");
define("_ALBM_TOP10","%s Classement 10"); // %s is a photo category title

define("_ALBM_SORTBY","classer par:");
define("_ALBM_TITLE","Titre");
define("_ALBM_DATE","Date");
define("_ALBM_POPULARITY","Popularité");
define("_ALBM_CURSORTEDBY","Les Photos sont actuellement classñÆs par: %s");
define("_ALBM_FOUNDIN","Trouvé dans:");
define("_ALBM_PREVIOUS","Precedente");
define("_ALBM_NEXT","Suivante");
define("_ALBM_NOMATCH","Aucune correspondance pour votre recherche");

define("_ALBM_CATEGORIES","CatñÈories");

define("_ALBM_SUBMIT","Soumettre");
define("_ALBM_CANCEL","Annuler");

define("_ALBM_MUSTREGFIRST","DñÔolé, vous n'óÕes pas autorisé à effectuer cette opñÓation.<br>Enregistrez-vous ou connectez-vous d'abord!");
define("_ALBM_MUSTADDCATFIRST","DñÔolé, vous n'avez pas encore de catñÈories.<br>Ajoutez d'abord une catñÈorie!");
define("_ALBM_NORATING","Aucun pointage sñÍectionné.");
define("_ALBM_CANTVOTEOWN","Vous ne pouvez pas voter pour une ressource que vous avez soumise.<br>Tous les votes sont enregistrñÔ et passñÔ en revue.");
define("_ALBM_VOTEONCE2","Ne votez pour une ressource qu'une seule fois.<br>Tous les votes sont enregistrñÔ et passñÔ en revue.");

//%%%%%%	Module Name 'MyAlbum' (Admin)	  %%%%%

define("_ALBM_PHOTOSWAITING","Photos en attente de validation");
define("_ALBM_PHOTOMANAGER","Gestionnaire de photos");
define("_ALBM_CATEDIT","Ajouter, Modifier, et supprimer CatñÈories");
define("_ALBM_CHECKCONFIGS","Contr‡Íe de module");
define("_ALBM_BATCHUPLOAD","TñÍñÄhargement En lots");
define("_ALBM_GENERALSET","myAlbum-P Configuration gñÏñÓale");

define("_ALBM_SUBMITTER","Envoyé par");
define("_ALBM_DELETE","Supprimer");
define("_ALBM_NOSUBMITTED","Aucune nouvelle photo soumise.");
define("_ALBM_ADDMAIN","Ajouter une catñÈorie principale");
define("_ALBM_IMGURL","Image URL (Optionnel La hauteur de l'image sera rñÅuite à 50): ");
define("_ALBM_ADD","Ajouter");
define("_ALBM_ADDSUB","Ajouter une SOUS-CatñÈorie");
define("_ALBM_IN","dans");
define("_ALBM_MODCAT","Modifier la CatñÈorie");
define("_ALBM_DBUPDATED","Base de donnñÆs mise à jour avec succñÔ!");
define("_ALBM_MODREQDELETED","Demande de Modification SupprimñÆ.");
define("_ALBM_IMGURLMAIN","Image URL (Optionnel et uniquement valide pour les catñÈories principales. La hauteur sera ramenñÆ à 50): ");
define("_ALBM_PARENT","CatñÈorie parente:");
define("_ALBM_SAVE","Sauver Changements");
define("_ALBM_CATDELETED","CatñÈorie supprimñÆ.");
define("_ALBM_CATDEL_WARNING","AVERTISSEMENT: ŽÊtes vous s•Ó que vous vouler supprimer cette CatñÈorie et toutes ses photos et tous ses commentaires?");
define("_ALBM_YES","Oui");
define("_ALBM_NO","Non");
define("_ALBM_NEWCATADDED","Nouvelle CatñÈorie ajoutñÆ avec succïÔ");
define("_ALBM_ERROREXIST","ERREUR: La photo soumise est dñËà dans la base de donnñÆs!");
define("_ALBM_ERRORTITLE","ERREUR: Vous devez fournir un TITRE!");
define("_ALBM_ERRORDESC","ERREUR: Vous devez fournir une DESCRIPTION!");
define("_ALBM_WEAPPROVED","Nous avons approuvé votre soumission à notre base de photos.");
define("_ALBM_THANKSSUBMIT","Merci pour votre soumission!");
define("_ALBM_CONFUPDATED","Configuration mise à jour avec succïÔ!");

// Appended by Xoops Language Checker -GIJOE- in 2004-01-27 15:37:03
define('_ALBM_NEW','Nouveau');
define('_ALBM_UPDATED','Mis à jour');
define('_ALBM_GROUPPERM_GLOBAL','Permissions globales');

}

?>
