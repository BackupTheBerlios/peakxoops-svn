<?php
// $Id: admin.php,v 1.1 2004/01/29 14:45:48 buennagel Exp $
//%%%%%%        Admin Module Name  Headlines         %%%%%

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( '_AM_DBUPDATED' ) ) {

// list of encodings allowed   (name):(title)|(name):(title)|...
define('_AM_ENCODINGS','utf-8:UTF-8|iso-8859-1:ISO-8859-1|us-ascii:US-ASCII') ;
define('_AM_ENCODING_AUTO','auto detection') ;

define('_AM_DBUPDATED','Database aggiornato con successo!');
define('_AM_HEADLINES','Configurazione Fonti (No.%s)');
define('_AM_HLMAIN','Headline Main');
define('_AM_SITENAME','Nome del sito');
define('_AM_URL','URL');
define('_AM_TITLEPATTERN','Estrai con stringa titolo<br /><span style="font-weight:normal;">scrivi quì un espressione regolare di perl eg) /doller/<br />Normalmente, lascia in bianco</span>');
define('_AM_TITLEEXCLUDE','Escludi con stringa titolo<br /><span style="font-weight:normal;">(perl regex) Normalmente, lascia in bianco</span>');
define('_AM_LINKPATTERN','Estrai con stringa link<br /><span style="font-weight:normal;">scrivi quì un espressione regolare di perl eg) /business/<br />Normalmente, lascia in bianco</span>');
define('_AM_LINKEXCLUDE','Escludi con stringa link<br /><span style="font-weight:normal;">(perl regex) Normalmente, lascia in bianco</span>');
define('_AM_ORDER', 'Ordine');
define('_AM_ENCODING', 'Decodifica');
define('_AM_CACHETIME', 'Prelevare Cache');
define('_AM_TIMEOUT', 'Time-out prelevamento');
define('_AM_ALLOWHTML', 'Permetti la visualizzazione di HTML dentro XML<br /><span style="font-weight:normal;">Non dovresti consentire HTML dentro RSS/ATOM per le fonti generate dai posts dei visitatori.</span>');
define('_AM_MAINSETT', 'Impostazioni pagina principale');
define('_AM_BLOCKSETT', 'Impostazioni Blocco');
define('_AM_DISPIMG', 'Visualizza immagine');
define('_AM_DISPFULL', 'Visualizza descrizioni e date di pubblicazione');
define('_AM_DISPMAX', 'Numero massimo di titoli da visualizzare');
define('_AM_DISPLAY', 'Principale');
define('_AM_ASBLOCK', 'Blocco');
define('_AM_ADDHEADL','Aggiungi fonte');
define('_AM_URLEDFXML','URI o RSS o ATOM');
define('_AM_SYNDICATIONTYPE','Tipo di feed');
define('_AM_SYNDICATIONTYPE_AUTO','Auto');
define('_AM_SAVEAS','Salva come');
define('_AM_UPDATE','Aggiorna & Ri-preleva');
define('_AM_EDITHEADL','Edita fonte');
define('_AM_WANTDEL','Sei sicuro di voler cancellare fonti per %s?');
define('_AM_INVALIDID', 'Invalid ID');
define('_AM_OBJECTNG', 'Oggetto non esistente');
define('_AM_FAILUPDATE', 'Salvataggio dei dati nel database fallito per fonte %s');
define('_AM_FAILDELETE', 'Cancellazione dei dati dal database fallita per fonte %s');

}

?>
