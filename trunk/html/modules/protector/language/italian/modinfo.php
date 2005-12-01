<?php
// Module Info

// The name of this module







// Appended by Xoops Language Checker -GIJOE- in 2005-08-24 13:15:37
define('_MI_PROTECTOR_HIJACK_TOPBIT','Bit protetti dell\'IP per la sessione');
define('_MI_PROTECTOR_HIJACK_TOPBITDSC','Anti Hi-Jacking della sessione:<br />Valore di default 32(bit). (Tutti i bit sono protetti)<br />Se il tuo IP non è statico, imposta il range di IP mediante il numero di bit.<br />Ad esempio, se il tuo IP si muove nel range 192.168.0.0-192.168.0.255, imposta 24(bit)');

// Appended by Xoops Language Checker -GIJOE- in 2005-07-31 12:33:20
define('_MI_PROTECTOR_DISABLES','Disabilita le funzionalità pericolose di XOOPS');

// Appended by Xoops Language Checker -GIJOE- in 2005-07-22 15:35:34
define('_MI_PROTECTOR_RELIABLE_IPS','IP affidabili');
define('_MI_PROTECTOR_RELIABLE_IPSDSC','imposta gli IP affidabili separandoli con | . Wildcard: ^ abbina la testa della stringa, $ abbina la coda della stringa.');
define('_MI_PROTECTOR_BF_COUNT','Anti Forza bruta');
define('_MI_PROTECTOR_BF_COUNTDSC','Impostare il numero di tentativi di login effettuabili dagli utenti anonimi nell\'arco di 10 minuti. Se qualcuno supera la soglia impostata, il suo IP viene bannato.');
define('_MI_PROTECTOR_DOS_SKIPMODS','Moduli esclusi dai controlli DoS/Crawler');
define('_MI_PROTECTOR_DOS_SKIPMODSDSC','Impostare i nomi delle directory dei moduli separandoli con |. Questa opzione è molto utile con i moduli di tipo chat, ecc.');

// Appended by Xoops Language Checker -GIJOE- in 2005-03-31 12:07:31
define('_MI_PROTECTOR_PREFIXMANAGER','Gestore dei prefissi');

// Appended by Xoops Language Checker -GIJOE- in 2005-03-05 07:09:09
define('_MI_PROTECTOR_GLOBAL_DISBL','Temporaneamente disabilitato');
define('_MI_PROTECTOR_GLOBAL_DISBLDSC','Tutte le protezioni sono temporaneamente disabilitate.<br />Non dimenticare di riattivare dopo aver individuato il problema.');
define('_MI_PROTECTOR_LOG_LEVEL','Livello di autenticazione');
define('_MI_PROTECTOR_LOG_LEVELDSC','');
define('_MI_PROTECTOR_LOGLEVEL0','nessuno');
define('_MI_PROTECTOR_LOGLEVEL15','Quiete');
define('_MI_PROTECTOR_LOGLEVEL63','quiete');
define('_MI_PROTECTOR_LOGLEVEL255','totale');

// Appended by Xoops Language Checker -GIJOE- in 2005-02-18 18:41:12
define('_MI_PROTECTOR_DOSOPT_HTA','NEGA da .htaccess(Sperimentale)');

// Appended by Xoops Language Checker -GIJOE- in 2005-01-21 11:35:16
define('_MI_PROTECTOR_HIJACK_DENYGP','Gruppi non abilitati a spostare l\'IP in una sessione');
define('_MI_PROTECTOR_HIJACK_DENYGPDSC','Anti Session Hi-Jacking:<br />Selezionare quali gruppi non sono abilitati a spostare il proprio IP in una sessione.<br />(raccomando di attivare il gruppo Administrator.)');
define('_MI_PROTECTOR_SAN_NULLBYTE','Sterilizzazione carattere nullo (null-bytes)');
define('_MI_PROTECTOR_SAN_NULLBYTEDSC','Il carattere di terminazione "\0" è spesso usato negli attacchi maliziosi.<br />Il carattere nullo verrà cambiato in spazio.<br />(caldamente raccomandato: ON)');
define('_MI_PROTECTOR_DIE_NULLBYTE','Uscire se viene trovato un carattere nullo (null-bytes).');
define('_MI_PROTECTOR_DIE_NULLBYTEDSC','Il carattere di terminazione "\0" è spesso usato negli attacchi maliziosi.<br />(caldamente raccomandato: ON)');
define('_MI_PROTECTOR_CONTAMI_ACTION','Azione da eseguire se viene rilevata una contaminazione');
define('_MI_PROTECTOR_CONTAMI_ACTIONDS','Selezionare l\'azione da eseguire quando qualcuno tenta di contaminare le variabili globali di sistema del vostro XOOPS.<br />(opzione raccomandata: Schermo bianco)');
define('_MI_PROTECTOR_ISOCOM_ACTION','Azione da eseguire se viene rilevato un commento isolato');
define('_MI_PROTECTOR_ISOCOM_ACTIONDSC','Anti SQL Injection:<br />Selezionare l\'azione da eseguire quando viene trovato un "/*" isolato.<br />"Sterilizzazione" siginifica aggiungere un "*/" in coda.<br />(opzione raccomandata: Sterilizzazione)');
define('_MI_PROTECTOR_UNION_ACTION','Azione da eseguire se viene trovato UNION');
define('_MI_PROTECTOR_UNION_ACTIONDSC','Anti SQL Injection:<br />Selezionare l\'azione da eseguire quando qualcuno tenta di utilizzare sintassi UNION di SQL.<br />"Sterilizzazione" significa modificare "union" in "uni-on".<br />(opzione raccomandata: Sterilizzazione)');
define('_MI_PROTECTOR_FILE_DOTDOT','Patch per dubbiose specificazioni di file');
define('_MI_PROTECTOR_FILE_DOTDOTDSC','Elimina ".." da tutte le richieste che sembrano specificare file precisi');
define('_MI_PROTECTOR_OPT_NONE','Nulla (solo login)');
define('_MI_PROTECTOR_OPT_SAN','Sterilizzazione');
define('_MI_PROTECTOR_OPT_EXIT','Schermo bianco');
define('_MI_PROTECTOR_OPT_BIP','Espulsione IP (ban)');
define('_MI_PROTECTOR_PATCH2092','Patch specifiche per Xoops <= 2.0.9.2');

define("_MI_PROTECTOR_NAME","Xoops Protector");

// A brief description of this module
define("_MI_PROTECTOR_DESC","Questo modulo protegge il vostro sito XOOPS da diversi tipi di attacchi, come il DoS, SQL Injection, e la contaminazione delle Variabili.<br />\nE' opportuno mettere questo blocco in testa ai blocchi di sinistra e impostare l'accesso al blocco a tutti i gruppi.");

// Names of blocks for this module (Not all module has blocks)
define("_MI_PROTECTOR_BNAME1","Protector");
define("_MI_PROTECTOR_BDESC1","E' opportuno mettere questo blocco in testa ai blocchi di sinistra e dovrebbe essere visibile in 'tutte le pagine'.");

// Menu
define("_MI_PROTECTOR_ADMININDEX","Centro di protezione");
define("_MI_PROTECTOR_ADVISORY","Avviso di Sicurezza");
define("_MI_PROTECTOR_MYBLOCKSADMIN","Amministrazione Blocchi&Gruppi");

// Configs
define('_MI_PROTECTOR_DIE_BADEXT','Uscire se file corrotti vengono messi in upload');
define('_MI_PROTECTOR_DIE_BADEXTDSC','Se qualcuno tenta di caricare file con estensione maliziosa come .php , il modulo chiude lo XOOPS.<br />Se avete spesso necessità di allegare file php in moduli tipo B-Wiki o PukiWikiMod, disattivate questa impostazione.');
define('_MI_PROTECTOR_DIE_CONTAMI','Uscire se viene rilevata una contaminazione');
define('_MI_PROTECTOR_DIE_CONTAMIDSC','Se qualcuno tenta di contaminare le variabili globali di sistema del vostro XOOPS, questo modulo chiude il sistema.<br />(raccomandato: ON)');
define('_MI_PROTECTOR_BIP_CONTAMI','Registrare come Bad IP da contaminazione');
define('_MI_PROTECTOR_BIP_CONTAMIDSC','Quando qualcuno tenta di attaccare mediante contaminazione, questo modulo registra automaticamente il suo IP tra quelli da sottoporre a ban nelle preferenze di sistema.');
define('_MI_PROTECTOR_SAN_ISOCOM','Forzare sterilizzazione dei commenti isolati');
define('_MI_PROTECTOR_SAN_ISOCOMDSC','Quando un "/*" isolato viene trovato, questo modulo appende in coda un "*/" nei post data.<br />Questa opzione è caldamente raccomandata se il prefisso del database è "xoops" come di default.');
define('_MI_PROTECTOR_DIE_ISOCOM','Uscire se vengono rilevati commenti isolati');
define('_MI_PROTECTOR_DIE_ISOCOMDSC','Quando un "/*" isolato viene trovato, questo modulo chiude il sistema XOOPS.<br />Questa opzione protegge da parecchi attacchi portati con iniezione di SQL (SQL Injection).');
define('_MI_PROTECTOR_BIP_ISOCOM','Registrare come Bad IP da commenti isolati');
define('_MI_PROTECTOR_BIP_ISOCOMDSC','Quando un "/*" isolato viene trovato, questo modulo registra registra automaticamente il suo IP tra quelli da sottoporre a ban nelle preferenze di sistema. (raccomandato: OFF)');
define('_MI_PROTECTOR_SAN_UNION','Forzare sterilizzazione UNION');
define('_MI_PROTECTOR_SAN_UNIONDSC','Quando viene rilevata della sintassi UNION di SQL, questo modulo modifica "union" con "uni-on".<br />Questa opzione è caldamente raccomandata se il prefisso del vostro database è "xoops" come di default.');
define('_MI_PROTECTOR_DIE_UNION','Uscire se viene rilevato UNION');
define('_MI_PROTECTOR_DIE_UNIONDSC','Quando viene rilevata della sintassi UNION di SQL, questo modulo chiude il sistema XOOPS.<br />Questa opzione protegge da alcuni tipi di attacchi SQL Injection.');
define('_MI_PROTECTOR_BIP_UNION','Registrare come Bad IP da UNION ');
define('_MI_PROTECTOR_BIP_UNIONDSC','Quando viene rilevata della sintassi UNION di SQL, questo modulo registra automaticamente il suo IP tra quelli da sottoporre a ban nelle preferenze di sistema. (raccomandato: OFF)');
define('_MI_PROTECTOR_ID_INTVAL','Forzare un valore intero (intval) alle variabili come id');
define('_MI_PROTECTOR_ID_INTVALDSC','Tutte le richieste chiamate "*id" verranno trattate come integer.<br />Questa opzione protegge da alcuni tipi di attacchi XSS e SQL Injections.<br />Nonostante io raccomandi di attivare questa opzione, può di fatto causare problemi con alcuni moduli.');

define('_MI_PROTECTOR_DOS_EXPIRE','Tempo di reazione per frequenti caricamenti (sec)');
define('_MI_PROTECTOR_DOS_EXPIREDSC','Questo valore specifica il tempo oltre il quale considerare i reload delle pagine come molto frequenti (attacchi mediante F5) e oltre il quale considerare una motore di indicizzazione (crawler) come eccessivamente pesante.');
                                        ///////////
define('_MI_PROTECTOR_DOS_F5COUNT','Conteggio eccessivo per attacco F5');
define('_MI_PROTECTOR_DOS_F5COUNTDSC','Prevenzione da attacchi DoS.<br />Questo valore specifica il numero di reload di pagina oltre il quale considerare la possibilità di un attacco malizioso.');
define('_MI_PROTECTOR_DOS_F5ACTION','Azione contro attacco F5');

define('_MI_PROTECTOR_DOS_CRCOUNT','Conteggio eccessivo per Crawler');
define('_MI_PROTECTOR_DOS_CRCOUNTDSC','Prevenzione dai crawler molto pesante.<br />Questo valore specifica il numero di accessi oltre il quale considerare un crawler come maleducato.');
define('_MI_PROTECTOR_DOS_CRACTION','Action against high loading Crawlers');

define('_MI_PROTECTOR_DOS_CRSAFE','User-Agent benvenuti');
define('_MI_PROTECTOR_DOS_CRSAFEDSC','Un pattern regex in perl per gli User-Agent ben accetti.<br />Se corrispe, il crawler non verrà mai considerato come troppo pesante.<br />eg) /(msnbot|Googlebot|Yahoo! Slurp)/i');

define('_MI_PROTECTOR_DOSOPT_NONE','Nulla (solo login)');
define('_MI_PROTECTOR_DOSOPT_SLEEP','Riposo (sleep)');
define('_MI_PROTECTOR_DOSOPT_EXIT','Schermo bianco');
define('_MI_PROTECTOR_DOSOPT_BIP','Ban dell\'IP');

define('_MI_PROTECTOR_BIP_EXCEPT','Gruppi mai registrabili come Bad IP');
define('_MI_PROTECTOR_BIP_EXCEPTDSC','Un\'utente che fa parte del gruppo qui specificato non verrà mai espulso.<br />(raccomando di attivare il gruppo Administrator.)');
define('_MI_PROTECTOR_PASSWD_BIP','Recupero password (disabilitare ban dell\'IP)');
define('_MI_PROTECTOR_PASSWD_BIPDSC','Se vieni espulso(ban) dal tuo stesso sito, accedere a XOOPS_URL/modules/protector/admin/rescue.php e inserire questa password.<br />Non dimenticare di impostare la password prima di venir espulso per errore.<br />Se questa opzione viene lasciata in bianco, lo script che disabilita il ban dell\'IP non funzionerà mai.');

?>
