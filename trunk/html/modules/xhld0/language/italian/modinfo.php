<?php
// $Id: modinfo.php,v 1.1 2004/01/29 14:45:48 buennagel Exp $
// Module Info

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( '_MI_HEADLINES_NAME' ) ) {

// DateTime format



// Appended by Xoops Language Checker -GIJOE- in 2006-05-02 13:15:22
define('_MI_HEADLINES_FETCHMETHOD','method to fetch RSS/ATOM');
define('_MI_HEADLINES_FETCHMETHOD_DSC','use Snoopy if possible. fopen() can work "allow_url_fopen on" in php.ini');
define('_MI_HEADLINES_FM_SNOOPY','snoopy');
define('_MI_HEADLINES_FM_FOPEN','fopen()');
define('_MI_HEADLINES_FM_SSC','stream_socket_client() (PHP5)');

// Appended by Xoops Language Checker -GIJOE- in 2006-02-03 16:31:40
define('_MI_HEADLINES_ADMENU_MYTPLSADMIN','Templates');

// Appended by Xoops Language Checker -GIJOE- in 2005-08-09 17:42:02
define('_MI_HEADLINES_BDESC','Shows headline news via RSS/ATOM in separate cells');
define('_MI_HEADLINES_BDESC_MIXED','Shows headline news via RSS/ATOM in an aggregated view');

define("_MI_DEFAULT_DTFMT_SHORT","j M H:i");

// The name of this module
define("_MI_HEADLINES_NAME","Fonti");

// A brief description of this module
define("_MI_HEADLINES_DESC","Visualizza fonti RSS/XML da altri siti");

// Names of blocks for this module (Not all module has blocks)
define("_MI_HEADLINES_BNAME","Fonti");
define("_MI_HEADLINES_BNAME_MIXED","Fonti Recenti");

// Names of admin menu items
define("_MI_HEADLINES_ADMENU1","Elenca fonti");
define("_MI_HEADLINES_ADMENU_MYBLOCKSADMIN","Blocchi/Gruppi");

// Configs
define("_MI_HEADLINES_INDEX_VIEWMODE","Visualizzazione di default");
define("_MI_HEADLINES_INDEX_VIEWMODED","Scegli un tipo di visualizzazione come pagina principale del modulo");
define("_MI_HEADLINES_INDEX_VIEWMODE_MIXED","Misti & i più recenti in alto");
define("_MI_HEADLINES_INDEX_VIEWMODE_CLASSIC","Classica");
define("_MI_HEADLINES_MIXED_MAXITEM","Numero massimo di titoli");
define("_MI_HEADLINES_MIXED_MAXITEMD", "Specifica la massima registrazione di RSS/ATOMs nella visualizzazione recenti (titoli)");
define("_MI_HEADLINES_MIXED_MAXLEN","Lunghezza massima");
define("_MI_HEADLINES_MIXED_MAXLEND", "Specifa la lunghezza massima dei titoli nella visualizzazione recenti (caratteri)");
define("_MI_HEADLINES_PROXY_HOST","Proxy host");
define("_MI_HEADLINES_PROXY_HOSTD","Se prendi RSS/ATOM via server proxy , imposta un nome host o IP quì.  Altrimenti, lascia in bianco.");
define("_MI_HEADLINES_PROXY_PORT","Proxy port");
define("_MI_HEADLINES_PROXY_PORTD","Se prendi RSS/ATOM via server proxy , imposta un numero di porta") ;
define("_MI_HEADLINES_PROXY_USER","Proxy user");
define("_MI_HEADLINES_PROXY_USERD","Se il tuo server proxy necessita BASIC authentication, imposta il nome utente.  Altrimenti, lascia in bianco.") ;
define("_MI_HEADLINES_PROXY_PASS","Proxy password");
define("_MI_HEADLINES_PROXY_PASSD","Se il tuo server proxy necessita BASIC authentication, imposta la password.  Altrimenti, lascia in bianco.") ;
define("_MI_HEADLINES_SHORTDTFMT","Formato breve di data & ora");
define("_MI_HEADLINES_SHORTDTFMTD","Valgono i parametri di PHP function date(). <a href='http://it2.php.net/manual/it/function.date.php'>vedi quì</a>") ;
define("_MI_HEADLINES_MIXPICKUP","Non caricare un titolo come recente se la sua fonte supera il numero massimo di titoli");
define("_MI_HEADLINES_MIXPICKUPD","Se impostato su No, l'impostazione di 'Numero massimo di titoli' di ogni fonte viene ignorata.");


}

?>