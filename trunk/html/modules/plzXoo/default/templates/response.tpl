<?php if($template['editform']->isError()) { ?>
    <?php echo  $template['editform']->getHtmlErrors() ?>
<?php } ?>

<table class='outer'>
	<tr class='head'>
		<td colspan='2'><?php echo _MD_PLZXOO_LANG_ANSWER ?></td>
	</tr>
	<tr class='even'>
		<td width='20%'><?php echo  _MD_PLZXOO_LANG_QUESTION_POSTER ?>:<a href="<?php echo  XOOPS_URL ?>/userinfo.php?uid=<?php echo  $template['answer']['uid'] ?>"><?php echo  $template['answer']['user']['uname'] ?></a></td>
		<td rowspan='2'><?php echo  $template['answer']['body'] ?></td>
	</tr>
	<tr class='odd'>
		<td width='20%'><?php echo  strftime("%Y/%m/%d %H:%M",$template['answer']['input_date']) ?></td>
	</tr>
</table>

<h2 align='center'><?php echo _MD_PLZXOO_LANG_RESPONSE ?></h2>

<?php echo  $template['xoopsform']->render() ?>