<?php

If( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( 'MYALBUM_AM_LOADED' ) ) {




// Appended by Xoops Language Checker -GIJOE- in 2004-05-17 18:42:56
define('_AM_TH_DATE','Derni��e mise � jour');
define('_AM_TH_BATCHUPDATE','Mettre � jour les photos s��ectionn��s');
define('_AM_OPT_NOCHANGE','- AUCUN CHANGEMENT -');
define('_AM_JS_UPDATECONFIRM','Voulez-vous vraiment mettre � jour les items s��ectionn��?');

// Appended by Xoops Language Checker -GIJOE- in 2004-05-05 15:14:39
define('_AM_H3_FMT_CATEGORIES','Gestionnaire de cat��ories(%s)');
define('_AM_CAT_TH_TITLE','Nom');
define('_AM_CAT_TH_PHOTOS','Images');
define('_AM_CAT_TH_OPERATION','Op��ation');
define('_AM_CAT_TH_IMAGE','Image ');
define('_AM_CAT_TH_PARENT','Cat��orie parente');
define('_AM_CAT_TH_IMGURL','URL de l\'image');
define('_AM_CAT_MENU_NEW','Cr��tion d\'une cat��orie');
define('_AM_CAT_MENU_EDIT','��dition d\'une cat��orie');
define('_AM_CAT_INSERTED','Une cat��orie a ��� ajout��');
define('_AM_CAT_UPDATED','la cat��orie a ��� modifi��');
define('_AM_CAT_BTN_BATCH','Appliquer');
define('_AM_CAT_LINK_MAKETOPCAT','Cr��r une nouvelle cat��orie au sommet');
define('_AM_CAT_LINK_ADDPHOTOS','Ajouter une image dans cette cat��orie');
define('_AM_CAT_LINK_EDIT','��diter cette cat��orie');
define('_AM_CAT_LINK_MAKESUBCAT','Cr��r une nouvelle cat��orie dans cette cat��orie');
define('_AM_CAT_FMT_NEEDADMISSION','%s images ont besoin d\'une admission');
define('_AM_CAT_FMT_CATDELCONFIRM','%s sera supprim� avec ses sous-cat��ories, images, commentaires. ��tes-vous s��?');
define('_AM_H3_FMT_ADMISSION','Admission des images (%s)');
define('_AM_H3_FMT_PHOTOMANAGER','Gestionnaire de photos (%s)');
define('_AM_H3_FMT_IMPORTTO','Importer des image d\'un autre module vers %s');
define('_AM_H3_FMT_EXPORTTO','Exporter les image de %s vers d\'aures modules');
define('_AM_FMT_EXPORTTOIMAGEMANAGER','Exporte les images vers le gestionnaire d\'image de XOOPS');
define('_AM_FMT_EXPORTIMSRCCAT','Source');
define('_AM_FMT_EXPORTIMDSTCAT','Destination');
define('_AM_CB_EXPORTRECURSIVELY','avec les images dans ces sous-cat��ories');
define('_AM_CB_EXPORTTHUMB','Exporter les vignettes au lieu des images');
define('_AM_MB_EXPORTCONFIRM','Vouslez-vous exporter?');
define('_AM_FMT_EXPORTSUCCESS','Vous avez exporter %s images.');

// Appended by Xoops Language Checker -GIJOE- in 2004-04-07 15:04:25
define('_AM_ALBM_IMPORT','Importation des image d\'autres modules');
define('_AM_FMT_IMPORTTO','Importer dans %s ');
define('_AM_FMT_IMPORTFROMMYALBUMP','Importation de "%s" en tant que type de module de myAlbum-P');
define('_AM_FMT_IMPORTFROMIMAGEMANAGER','Importation � partir du gestionnaire d\'image de XOOPS');
define('_AM_CB_IMPORTRECURSIVELY','Importer les sous-cat��ories r��ursivement');
define('_AM_RADIO_IMPORTCOPY','Copier les images (les commentaires ne seront pas copi��)');
define('_AM_RADIO_IMPORTMOVE','Bouger les images (les commentaires seront boug��)');
define('_AM_MB_IMPORTCONFIRM','Voulez-vous importer?');
define('_AM_FMT_IMPORTSUCCESS','Vous zavez importer %s images');

define( 'MYALBUM_AM_LOADED' , 1 ) ;

// Module Checker
define( "_AM_H3_FMT_MODULECHECKER" , "v��ificateur de myAlbum-P" ) ;

define( "_AM_H4_ENVIRONMENT" , "V��ification de l'environnement" ) ;
define( "_AM_MB_PHPDIRECTIVE" , "Directive PHP" ) ;
define( "_AM_MB_BOTHOK" , "Tous ok" ) ;
define( "_AM_MB_NEEDON" , "Besoin de'une activation" ) ;


define( "_AM_H4_TABLE" , "V��ification des tables" ) ;
define( "_AM_MB_PHOTOSTABLE" , "Table des photos" ) ;
define( "_AM_MB_DESCRIPTIONTABLE" , "Table des descriptions" ) ;
define( "_AM_MB_CATEGORIESTABLE" , "Table des cat��ories" ) ;
define( "_AM_MB_VOTEDATATABLE" , "Table des votes" ) ;
define( "_AM_MB_COMMENTSTABLE" , "Table des commentaires" ) ;
define( "_AM_MB_NUMBEROFPHOTOS" , "Nombre de photos" ) ;
define( "_AM_MB_NUMBEROFDESCRIPTIONS" , "Nombre de descriptions" ) ;
define( "_AM_MB_NUMBEROFCATEGORIES" , "Nombre de cat��ories" ) ;
define( "_AM_MB_NUMBEROFVOTEDATA" , "Nombre de votes" ) ;
define( "_AM_MB_NUMBEROFCOMMENTS" , "Nombre de commentaires" ) ;


define( "_AM_H4_CONFIG" , "V��ificaiton de la configuration" ) ;
define( "_AM_MB_PIPEFORIMAGES" , "Tunnel pour les images" ) ;
define( "_AM_MB_DIRECTORYFORPHOTOS" , "R��ertoire pour les photos" ) ;
define( "_AM_MB_DIRECTORYFORTHUMBS" , "R��ertoire pour les vignettes" ) ;
define( "_AM_ERR_LASTCHAR" , "Erreur: Le dernier caract��e ne doit pas ��re le '/'" ) ;
define( "_AM_ERR_FIRSTCHAR" , "Erreur: Le premier caract��e doit ��re le '/'" ) ;
define( "_AM_ERR_PERMISSION" , "Erreur: chmod 777 ce r��ertoire � sa cr��tion en utilisant ssh ou ftp." ) ;
define( "_AM_ERR_NOTDIRECTORY" , "Erreur: Ce n'est pas un r��ertoire." ) ;
define( "_AM_ERR_READORWRITE" , "Erreur: Ce r��ertoire ne peut ��re ��rit ou lu. Vous devrier faire un chmod 777." ) ;
define( "_AM_ERR_SAMEDIR" , "Erreur: Le chemin des photos ne doit pas ��re le m��e que celui des vignettes" ) ;
define( "_AM_LNK_CHECKGD2" , "V��ifier que 'GD2' fonctionne correctement avec votre installation de PHP avec GD imbriqu�" ) ;
define( "_AM_MB_CHECKGD2" , "Si la page en lien avec ici ne fonctionne pas, vous devriez arr��er de travailler sur votre GD2 en mode couleurs vraies" ) ;
define( "_AM_MB_GD2SUCCESS" , "Succ��!<br />malgr� tout, Vous pouvez utiliser GD2 dans votre environnement" ) ;


define( "_AM_H4_PHOTOLINK" , "V��ification des liens photo-vignette" ) ;
define( "_AM_MB_NOWCHECKING" , "V��ification en cours ." ) ;
define( "_AM_FMT_PHOTONOTREADABLE" , "la photo principale (%s) n'est pas lisible." ) ;
define( "_AM_FMT_THUMBNOTREADABLE" , "la vignette (%s) n'est pas lisible." ) ;
define( "_AM_FMT_NUMBEROFDEADPHOTOS" , "%s photos mortes ont ��� trouv��s." ) ;
define( "_AM_FMT_NUMBEROFDEADTHUMBS" , "%s vignettes devraient ��re reconstruites." ) ;
define( "_AM_FMT_NUMBEROFREMOVEDTMPS" , "%s fichier-poubelles onmt ��� supprim��." ) ;
define( "_AM_LINK_REDOTHUMBS" , "Reconstruction des vignettes" ) ;
define( "_AM_LINK_TABLEMAINTENANCE" , "Maintenir le tableau" ) ;



// Redo Thumbnail
define( "_AM_H3_FMT_RECORDMAINTENANCE" , "Maintenance des photos avec myAlbum-P" ) ;

define( "_AM_FMT_CHECKING" , "v��ification de %s ..." ) ;

define( "_AM_FORM_RECORDMAINTENANCE" , "reconstructions de vignettes pour la maintenance" ) ;

define( "_AM_MB_FAILEDREADING" , "lectures ��hou��." ) ;
define( "_AM_MB_CREATEDTHUMBS" , "Une vignette a ��� cr��e" ) ;
define( "_AM_MB_BIGTHUMBS" , "La vignette n'a pas ��� construite." ) ;
define( "_AM_MB_SKIPPED" , "Au suivant." ) ;
define( "_AM_MB_SIZEREPAIRED" , "(Correction du champs taille de l'enregistrement.)" ) ;
define( "_AM_MB_RECREMOVED" , "Cette enregistrement a ��� enlev�." ) ;
define( "_AM_MB_PHOTONOTEXISTS" , "La photo principale n'existe pas." ) ;
define( "_AM_MB_PHOTORESIZED" , "la photos principale a ��� redimensionn��." ) ;

define( "_AM_TEXT_RECORDFORSTARTING" , "Nombre d'enregistrement d��utant par " ) ;
define( "_AM_TEXT_NUMBERATATIME" , "Nombre d'enregistrement effectu� � chaque fois" ) ;
define( "_AM_LABEL_DESCNUMBERATATIME" , "Un nombre trop ��ev� ne donnera pas un beau travail." ) ;

define( "_AM_RADIO_FORCEREDO" , "Recreer les vignette existantes" ) ;
define( "_AM_RADIO_REMOVEREC" , "Enlever les enregistrements qui ne poss��ent pas de photo" ) ;
define( "_AM_RADIO_RESIZE" , "Redimensionner les photos plus grandes que l'option dans les pr����ences" ) ;

define( "_AM_MB_FINISHED" , "Fin" ) ;
define( "_AM_LINK_RESTART" , "Red��arrer" ) ;
define( "_AM_SUBMIT_NEXT" , "Au suivant" ) ;



// Batch Register
define( "_AM_H3_FMT_BATCHREGISTER" , "myAlbum-P en lot" ) ;



// Appended by Xoops Language Checker -GIJOE- in 2003-12-03 15:27:11
define('_ALBM_INDEX_BLOCKSADMIN','administration des blocs de myAlbum-P');

// Appended by Xoops Language Checker -GIJOE- in 2004-01-27 15:37:03
define('_AM_TH_SUBMITTER','Auteur(e)');
define('_AM_TH_TITLE','Titre');
define('_AM_TH_DESCRIPTION','Description');
define('_AM_TH_CATEGORIES','Cat��orie');
define('_AM_ALBM_GROUPPERM_GLOBAL','Permissions globales');
define('_AM_ALBM_GROUPPERM_GLOBALDESC','Configurer les privil��e de groupe pour tout le module');
define('_AM_ALBM_GPERMUPDATED','Les permissions ont ��� mises � jour avec succ��');

}

?>
