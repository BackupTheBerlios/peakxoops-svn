<h1 align='center'>NEW QUESTION</h1>

<?php if($template['editform']->isError()) { ?>
    <?php echo  $template['editform']->getHtmlErrors() ?>
<?php } ?>

<?php echo  $template['xoopsform']->render() ?>