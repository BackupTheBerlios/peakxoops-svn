<?php

require_once XOOPS_ROOT_PATH.'/modules/legacyRender/kernel/Legacy_RenderSystem.class.php' ;

class Legacy_DbthemeRenderSystem extends Legacy_RenderSystem {

function renderTheme(&$target)
{
	if( ! defined( 'DBTHEME_THEME_NAME' ) ) {
		parent::renderTheme( $target ) ;
	} else {


		$this->_commonPrepareRender();
		
		//
		// Assign from attributes of the render-target.
		//
		foreach($target->getAttributes() as $key => $value) {
			$this->mXoopsTpl->assign($key, $value);
		}
		
		//
		// [TODO]
		// We must implement with a render-target.
		//
		// $this->_processLegacyTemplate();

		// assing
		/// @todo I must move these to somewhere.
		$assignNameMap = array(
				XOOPS_SIDEBLOCK_LEFT=>array('showflag'=>'xoops_showlblock','block'=>'xoops_lblocks'),
				XOOPS_CENTERBLOCK_LEFT=>array('showflag'=>'xoops_showcblock','block'=>'xoops_clblocks'),
				XOOPS_CENTERBLOCK_RIGHT=>array('showflag'=>'xoops_showcblock','block'=>'xoops_crblocks'),
				XOOPS_CENTERBLOCK_CENTER=>array('showflag'=>'xoops_showcblock','block'=>'xoops_ccblocks'),
				XOOPS_SIDEBLOCK_RIGHT=>array('showflag'=>'xoops_showrblock','block'=>'xoops_rblocks')
			);

		foreach($assignNameMap as $key=>$val) {
			$this->mXoopsTpl->assign($val['showflag'],$this->_getBlockShowFlag($val['showflag']));
			if(isset($this->mController->mRoot->mContext->mAttributes['legacy_BlockContents'][$key])) {
				foreach($this->mController->mRoot->mContext->mAttributes['legacy_BlockContents'][$key] as $result) {
					$this->mXoopsTpl->append($val['block'], $result);
				}
			}
		}
		
		//
		// Render result, and set it to the RenderBuffer of the $target.
		//
		$result=null;
		if($target->getAttribute("isFileTheme")) {

			/**** DB THEME ******/
			$mydirname = DBTHEME_MYDIRNAME ;
			$module_handler =& xoops_gethandler( 'module' ) ;
			$module =& $module_handler->getByDirname( $mydirname ) ;
			$config_handler =& xoops_gethandler( 'config' ) ;
			$mod_config =& $config_handler->getConfigsByCat( 0 , $module->getVar( 'mid' ) ) ;

			if( ! empty( $mod_config['base_theme'] ) ) {
				$this->mXoopsTpl->assign( array(
					'xoops_theme' => $mod_config['base_theme'] ,
					'xoops_imageurl' => XOOPS_THEME_URL.'/'.$mod_config['base_theme'].'/' ,
					'xoops_themecss' => XOOPS_URL.'/modules/'.$mydirname.'/?template=style.css' , // TODO (?)
					'xoops_dbthemecssurl' => XOOPS_URL.'/modules/'.$mydirname.'/?template=' ,
				) ) ;
			}

			$result = $this->mXoopsTpl->fetch('db:'.DBTHEME_THEME_NAME);
			/**** DB THEME ******/

			//$result=$this->mXoopsTpl->fetch($target->getTemplateName()."/theme.html");

		}
		else {
			$result=$this->mXoopsTpl->fetch("db:".$target->getTemplateName());
		}
		
		$result .= $this->mXoopsTpl->fetchDebugConsole();

		$target->setResult($result);

	}

}



}

?>