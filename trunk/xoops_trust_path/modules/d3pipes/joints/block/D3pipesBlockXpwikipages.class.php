<?php

if( file_exists( XOOPS_TRUST_PATH.'/modules/xpwiki/include/d3pipes.inc.php' ) ) {
	require_once XOOPS_TRUST_PATH.'/modules/xpwiki/include/d3pipes.inc.php' ;
	class D3pipesBlockXpwikipages extends D3pipesBlockXpwikipagesSubstance {}
} else {
	class D3pipesBlockXpwikipages extends D3pipesBlockAbstract {}
}

?>