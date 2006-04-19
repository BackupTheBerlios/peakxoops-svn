<?php if($template['editform']->isError()) { ?>
    <?php echo  $template['editform']->getHtmlErrors() ?>
<?php } ?>

<h2><?php echo  $template['question']->getVar('subject') ?></h2>
<?php echo  $template['question']->getVar('body') ?>

<h1 align='center'><?php echo $template['editform']->aid_ ? _MD_PLZXOO_LANG_TITLE_EDIT_ANSWER : _MD_PLZXOO_LANG_TITLE_NEW_ANSWER ; ?></h1>

<?php echo  $template['xoopsform']->render() ?>