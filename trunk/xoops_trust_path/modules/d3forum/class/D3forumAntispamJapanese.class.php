<?php

require_once dirname(__FILE__).'/D3forumAntispamAbstract.class.php' ;

class D3forumAntispamJapanese extends D3forumAntispamAbstract {

var $dictionary_cache = array() ;

function getKanaKanji( $time = null )
{
	if( empty( $time ) ) $time = time() ;
	
	if( empty( $this->dictionary_cache ) ) {
		// SKK EUC dictionary
		$lines = file( dirname( __FILE__ ) . '/AntispamJapaneseDictionary.txt' ) ;
		foreach( $lines as $line ) {
			$line = mb_convert_encoding( $line , mb_internal_encoding() , 'EUC-JP' ) ;
			if( preg_match( '#(.+) /(.+)/#' , $line , $regs ) ) {
				$this->dictionary_cache[] = array(
					'yomigana' => $regs[1] ,
					'kanji' => $regs[2] ,
				) ;
			}
		}
	}
	
	$size = sizeof( $this->dictionary_cache ) ;
	$key = abs( crc32( md5( gmdate( 'YmdH' , $time ) . XOOPS_DB_PREFIX . XOOPS_DB_NAME ) ) ) ;

	return $this->dictionary_cache[ $key % $size ] ;
}

function getHtml4Assign()
{
	$yomi_kan = $this->getKanaKanji() ;
	$kanji = $yomi_kan['kanji'] ;

	$html = '<label for="antispam_yomigana">'._MD_D3FORUM_LABEL_JAPANESEINPUTYOMI.': <strong class="antispam_kanji">'.htmlspecialchars($kanji).'</strong></label><input type="text" name="antispam_yomigana" id="antispam_yomigana" value="" />' ;

	return array(
		'html_in_form' => $html ,
		'js_global' => '' ,
		'js_in_validate_function' => '' ,
	) ;
}

function checkValidate()
{
	$yomigana = mb_convert_kana( trim( @$_POST['antispam_yomigana'] ) , 'HVc' ) ;

	$yomi_kan0 = $this->getKanaKanji() ;
	$yomi_kan1 = $this->getKanaKanji( time() - 3600 ) ;

	if( $yomigana != $yomi_kan0['yomigana'] && $yomigana != $yomi_kan1['yomigana'] ) {
		$this->errors[] = _MD_D3FORUM_ERR_TURNJAVASCRIPTON ;
		return false ;
	}
	return true ;
}

}

?>