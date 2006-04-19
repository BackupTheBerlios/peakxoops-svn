<h1 align='center'><?php echo $template['editform']->qid_ ? _MD_PLZXOO_LANG_TITLE_EDIT_QUESTION : _MD_PLZXOO_LANG_TITLE_NEW_QUESTION ; ?></h1>

<?php if($template['editform']->isError()) { ?>
    <?php echo  $template['editform']->getHtmlErrors() ?>
<?php } ?>

<?php echo  $template['xoopsform']->render() ?>