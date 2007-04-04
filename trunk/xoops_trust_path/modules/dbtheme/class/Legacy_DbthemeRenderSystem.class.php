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
			//$result=$this->mXoopsTpl->fetch($target->getTemplateName()."/theme.html");
			$result=$this->mXoopsTpl->fetch('dbtheme:'.DBTHEME_THEME_NAME);
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