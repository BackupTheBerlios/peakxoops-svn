<?php

define('_MD_D3PIPES_H2_INDEX','Index');
define('_MD_D3PIPES_H2_LATESTHEADLINES','The latest entries');
define('_MD_D3PIPES_H2_EACHPIPE','List entries of the pipe');
define('_MD_D3PIPES_H2_CLIPPING','Detail of the clipping');


define('_MD_D3PIPES_JOINT_FETCH','Fetching from outside');
define('_MD_D3PIPES_JOINT_BLOCK','Fetching/Parsing from blocks');
define('_MD_D3PIPES_JOINT_PARSE','Parsing XML');
define('_MD_D3PIPES_JOINT_UTF8TO','Transfer encoding from UTF-8');
define('_MD_D3PIPES_JOINT_UTF8FROM','Transfer encoding to UTF-8');
define('_MD_D3PIPES_JOINT_CLIP','Clipping into local');
define('_MD_D3PIPES_JOINT_FILTER','Filter entries by keywords');
define('_MD_D3PIPES_JOINT_REASSIGN','Reassign');
define('_MD_D3PIPES_JOINT_UNION','Union pipes');

define('_MD_D3PIPES_N4J_FETCH','Input URI of RSS/ATOM');
define('_MD_D3PIPES_N4J_BLOCK','Input dirname of the module');
define('_MD_D3PIPES_N4J_PARSE','Input type of XML (eg. RDF/RSS/ATOM)');
define('_MD_D3PIPES_N4J_UTF8TO','Normally, input internal encoding');
define('_MD_D3PIPES_N4J_UTF8FROM','Normally, input the encoding of the XML');
define('_MD_D3PIPES_N4J_CLIP','Input cache time (sec)');
define('_MD_D3PIPES_N4J_FILTER','Input patterns/keywords to filter');
define('_MD_D3PIPES_N4J_REASSIGN','Input rules for re-assignment');
define('_MD_D3PIPES_N4J_UNION','Input numbers of pipes separated by comma(,)');


define('_MD_D3PIPES_TH_PUBTIME','published time');
define('_MD_D3PIPES_TH_PIPENAME','name');
define('_MD_D3PIPES_TH_HEADLINE','headline');
define('_MD_D3PIPES_TH_LINKURL','Link URI');
define('_MD_D3PIPES_TH_DESCRIPTION','Description');
define('_MD_D3PIPES_TH_ACTIONTOCLIPPING','Action to this clipping');

define('_MD_D3PIPES_LABEL_HIGHLIGHTCLIPPING','Highlight it');

define('_MD_D3PIPES_BTN_UPDATE','Update');

define('_MD_D3PIPES_FMT_EXTERNALLINK','External link to %s');

define('_MD_D3PIPES_MSG_CLIPPINGUPDATED','The clipping updated successfully');

define('_MD_D3PIPES_ERR_INVALIDCLIPPINGID','Invalid clipping ID');
define('_MD_D3PIPES_ERR_INVALIDPIPEID','Invalid pipe ID');
define('_MD_D3PIPES_ERR_PERMISSION','Permission error');
define('_MD_D3PIPES_ERR_INVALIDPIPEIDINBLOCK','Invalid pipe_id. Go to blocks admin and edit the pipe_id');
define('_MD_D3PIPES_ERR_PARSETYPEMISMATCH','XML type is not matched');
define('_MD_D3PIPES_ERR_CACHEFOLDERNOTWRITABLE','Cache folder does not exist or is not writable');
define('_MD_D3PIPES_ERR_INVALIDURIINFETCH','Invalid URI specified as fetch joint\'s option');
define('_MD_D3PIPES_ERR_CANTCONNECTINFETCH','Cannot access to outer contents');
define('_MD_D3PIPES_ERR_URLFOPENINFETCH','You cannot use "fopen" under allow_url_fopen=off');
define('_MD_D3PIPES_ERR_INVALIDDIRNAMEINBLOCK','Invalid dirname on the block joint');
define('_MD_D3PIPES_ERR_INVALIDFILEINBLOCK','Invalid blockfile on the block joint');
define('_MD_D3PIPES_ERR_INVALIDFUNCINBLOCK','Invalid blockfunc on the block joint');


?>