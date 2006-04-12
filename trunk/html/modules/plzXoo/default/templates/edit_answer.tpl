<?php if($template['editform']->isError()) { ?>
    <?php echo  $template['editform']->getHtmlErrors() ?>
<?php } ?>

<h2><?php echo  $template['question']->getVar('subject') ?></h2>
<?php echo  $template['question']->getVar('body') ?>

<h1 align='center'>ANSWER</h1>

<?php echo  $template['xoopsform']->render() ?>