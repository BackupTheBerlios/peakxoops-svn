<?php

If( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( 'MYALBUM_AM_LOADED' ) ) {




// Appended by Xoops Language Checker -GIJOE- in 2004-05-17 18:42:56
define('_AM_TH_DATE','Dernière mise à jour');
define('_AM_TH_BATCHUPDATE','Mettre à jour les photos sélectionnées');
define('_AM_OPT_NOCHANGE','- AUCUN CHANGEMENT -');
define('_AM_JS_UPDATECONFIRM','Voulez-vous vraiment mettre à jour les items sélectionnés?');

// Appended by Xoops Language Checker -GIJOE- in 2004-05-05 15:14:39
define('_AM_H3_FMT_CATEGORIES','Gestionnaire de catégories(%s)');
define('_AM_CAT_TH_TITLE','Nom');
define('_AM_CAT_TH_PHOTOS','Images');
define('_AM_CAT_TH_OPERATION','Opération');
define('_AM_CAT_TH_IMAGE','Image ');
define('_AM_CAT_TH_PARENT','Catégorie parente');
define('_AM_CAT_TH_IMGURL','URL de l\'image');
define('_AM_CAT_MENU_NEW','Création d\'une catégorie');
define('_AM_CAT_MENU_EDIT','Édition d\'une catégorie');
define('_AM_CAT_INSERTED','Une catégorie a été ajoutée');
define('_AM_CAT_UPDATED','la catégorie a été modifiée');
define('_AM_CAT_BTN_BATCH','Appliquer');
define('_AM_CAT_LINK_MAKETOPCAT','Créer une nouvelle catégorie au sommet');
define('_AM_CAT_LINK_ADDPHOTOS','Ajouter une image dans cette catégorie');
define('_AM_CAT_LINK_EDIT','Éditer cette catégorie');
define('_AM_CAT_LINK_MAKESUBCAT','Créer une nouvelle catégorie dans cette catégorie');
define('_AM_CAT_FMT_NEEDADMISSION','%s images ont besoin d\'une admission');
define('_AM_CAT_FMT_CATDELCONFIRM','%s sera supprimé avec ses sous-catégories, images, commentaires. Êtes-vous sûr?');
define('_AM_H3_FMT_ADMISSION','Admission des images (%s)');
define('_AM_H3_FMT_PHOTOMANAGER','Gestionnaire de photos (%s)');
define('_AM_H3_FMT_IMPORTTO','Importer des image d\'un autre module vers %s');
define('_AM_H3_FMT_EXPORTTO','Exporter les image de %s vers d\'aures modules');
define('_AM_FMT_EXPORTTOIMAGEMANAGER','Exporte les images vers le gestionnaire d\'image de XOOPS');
define('_AM_FMT_EXPORTIMSRCCAT','Source');
define('_AM_FMT_EXPORTIMDSTCAT','Destination');
define('_AM_CB_EXPORTRECURSIVELY','avec les images dans ces sous-catégories');
define('_AM_CB_EXPORTTHUMB','Exporter les vignettes au lieu des images');
define('_AM_MB_EXPORTCONFIRM','Vouslez-vous exporter?');
define('_AM_FMT_EXPORTSUCCESS','Vous avez exporter %s images.');

// Appended by Xoops Language Checker -GIJOE- in 2004-04-07 15:04:25
define('_AM_ALBM_IMPORT','Importation des image d\'autres modules');
define('_AM_FMT_IMPORTTO','Importer dans %s ');
define('_AM_FMT_IMPORTFROMMYALBUMP','Importation de "%s" en tant que type de module de myAlbum-P');
define('_AM_FMT_IMPORTFROMIMAGEMANAGER','Importation à partir du gestionnaire d\'image de XOOPS');
define('_AM_CB_IMPORTRECURSIVELY','Importer les sous-catégories récursivement');
define('_AM_RADIO_IMPORTCOPY','Copier les images (les commentaires ne seront pas copiés)');
define('_AM_RADIO_IMPORTMOVE','Bouger les images (les commentaires seront bougés)');
define('_AM_MB_IMPORTCONFIRM','Voulez-vous importer?');
define('_AM_FMT_IMPORTSUCCESS','Vous zavez importer %s images');

define( 'MYALBUM_AM_LOADED' , 1 ) ;

// Module Checker
define( "_AM_H3_FMT_MODULECHECKER" , "vérificateur de myAlbum-P" ) ;

define( "_AM_H4_ENVIRONMENT" , "Vérification de l'environnement" ) ;
define( "_AM_MB_PHPDIRECTIVE" , "Directive PHP" ) ;
define( "_AM_MB_BOTHOK" , "Tous ok" ) ;
define( "_AM_MB_NEEDON" , "Besoin de'une activation" ) ;


define( "_AM_H4_TABLE" , "Vérification des tables" ) ;
define( "_AM_MB_PHOTOSTABLE" , "Table des photos" ) ;
define( "_AM_MB_DESCRIPTIONTABLE" , "Table des descriptions" ) ;
define( "_AM_MB_CATEGORIESTABLE" , "Table des catégories" ) ;
define( "_AM_MB_VOTEDATATABLE" , "Table des votes" ) ;
define( "_AM_MB_COMMENTSTABLE" , "Table des commentaires" ) ;
define( "_AM_MB_NUMBEROFPHOTOS" , "Nombre de photos" ) ;
define( "_AM_MB_NUMBEROFDESCRIPTIONS" , "Nombre de descriptions" ) ;
define( "_AM_MB_NUMBEROFCATEGORIES" , "Nombre de catégories" ) ;
define( "_AM_MB_NUMBEROFVOTEDATA" , "Nombre de votes" ) ;
define( "_AM_MB_NUMBEROFCOMMENTS" , "Nombre de commentaires" ) ;


define( "_AM_H4_CONFIG" , "Vérificaiton de la configuration" ) ;
define( "_AM_MB_PIPEFORIMAGES" , "Tunnel pour les images" ) ;
define( "_AM_MB_DIRECTORYFORPHOTOS" , "Répertoire pour les photos" ) ;
define( "_AM_MB_DIRECTORYFORTHUMBS" , "Répertoire pour les vignettes" ) ;
define( "_AM_ERR_LASTCHAR" , "Erreur: Le dernier caractère ne doit pas être le '/'" ) ;
define( "_AM_ERR_FIRSTCHAR" , "Erreur: Le premier caractère doit être le '/'" ) ;
define( "_AM_ERR_PERMISSION" , "Erreur: chmod 777 ce répertoire à sa création en utilisant ssh ou ftp." ) ;
define( "_AM_ERR_NOTDIRECTORY" , "Erreur: Ce n'est pas un répertoire." ) ;
define( "_AM_ERR_READORWRITE" , "Erreur: Ce répertoire ne peut être écrit ou lu. Vous devrier faire un chmod 777." ) ;
define( "_AM_ERR_SAMEDIR" , "Erreur: Le chemin des photos ne doit pas être le même que celui des vignettes" ) ;
define( "_AM_LNK_CHECKGD2" , "Vérifier que 'GD2' fonctionne correctement avec votre installation de PHP avec GD imbriqué" ) ;
define( "_AM_MB_CHECKGD2" , "Si la page en lien avec ici ne fonctionne pas, vous devriez arrêter de travailler sur votre GD2 en mode couleurs vraies" ) ;
define( "_AM_MB_GD2SUCCESS" , "Succès!<br />malgré tout, Vous pouvez utiliser GD2 dans votre environnement" ) ;


define( "_AM_H4_PHOTOLINK" , "Vérification des liens photo-vignette" ) ;
define( "_AM_MB_NOWCHECKING" , "Vérification en cours ." ) ;
define( "_AM_FMT_PHOTONOTREADABLE" , "la photo principale (%s) n'est pas lisible." ) ;
define( "_AM_FMT_THUMBNOTREADABLE" , "la vignette (%s) n'est pas lisible." ) ;
define( "_AM_FMT_NUMBEROFDEADPHOTOS" , "%s photos mortes ont été trouvées." ) ;
define( "_AM_FMT_NUMBEROFDEADTHUMBS" , "%s vignettes devraient être reconstruites." ) ;
define( "_AM_FMT_NUMBEROFREMOVEDTMPS" , "%s fichier-poubelles onmt été supprimés." ) ;
define( "_AM_LINK_REDOTHUMBS" , "Reconstruction des vignettes" ) ;
define( "_AM_LINK_TABLEMAINTENANCE" , "Maintenir le tableau" ) ;



// Redo Thumbnail
define( "_AM_H3_FMT_RECORDMAINTENANCE" , "Maintenance des photos avec myAlbum-P" ) ;

define( "_AM_FMT_CHECKING" , "vérification de %s ..." ) ;

define( "_AM_FORM_RECORDMAINTENANCE" , "reconstructions de vignettes pour la maintenance" ) ;

define( "_AM_MB_FAILEDREADING" , "lectures échouée." ) ;
define( "_AM_MB_CREATEDTHUMBS" , "Une vignette a été créée" ) ;
define( "_AM_MB_BIGTHUMBS" , "La vignette n'a pas été construite." ) ;
define( "_AM_MB_SKIPPED" , "Au suivant." ) ;
define( "_AM_MB_SIZEREPAIRED" , "(Correction du champs taille de l'enregistrement.)" ) ;
define( "_AM_MB_RECREMOVED" , "Cette enregistrement a été enlevé." ) ;
define( "_AM_MB_PHOTONOTEXISTS" , "La photo principale n'existe pas." ) ;
define( "_AM_MB_PHOTORESIZED" , "la photos principale a été redimensionnée." ) ;

define( "_AM_TEXT_RECORDFORSTARTING" , "Nombre d'enregistrement débutant par " ) ;
define( "_AM_TEXT_NUMBERATATIME" , "Nombre d'enregistrement effectué à chaque fois" ) ;
define( "_AM_LABEL_DESCNUMBERATATIME" , "Un nombre trop élevé ne donnera pas un beau travail." ) ;

define( "_AM_RADIO_FORCEREDO" , "Recreer les vignette existantes" ) ;
define( "_AM_RADIO_REMOVEREC" , "Enlever les enregistrements qui ne possèdent pas de photo" ) ;
define( "_AM_RADIO_RESIZE" , "Redimensionner les photos plus grandes que l'option dans les préférences" ) ;

define( "_AM_MB_FINISHED" , "Fin" ) ;
define( "_AM_LINK_RESTART" , "Redémarrer" ) ;
define( "_AM_SUBMIT_NEXT" , "Au suivant" ) ;



// Batch Register
define( "_AM_H3_FMT_BATCHREGISTER" , "myAlbum-P en lot" ) ;



// Appended by Xoops Language Checker -GIJOE- in 2003-12-03 15:27:11
define('_ALBM_INDEX_BLOCKSADMIN','administration des blocs de myAlbum-P');

// Appended by Xoops Language Checker -GIJOE- in 2004-01-27 15:37:03
define('_AM_TH_SUBMITTER','Auteur(e)');
define('_AM_TH_TITLE','Titre');
define('_AM_TH_DESCRIPTION','Description');
define('_AM_TH_CATEGORIES','Catégorie');
define('_AM_ALBM_GROUPPERM_GLOBAL','Permissions globales');
define('_AM_ALBM_GROUPPERM_GLOBALDESC','Configurer les privilère de groupe pour tout le module');
define('_AM_ALBM_GPERMUPDATED','Les permissions ont été mises à jour avec succès');

}

?>
