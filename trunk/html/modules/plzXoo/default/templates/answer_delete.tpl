<h2 align="center"><?php echo _MD_PLZXOO_LANG_DELETE_CONFIRM ?></h2>

<form method='post'>
<?php echo  $template['editform']->ticket_->makeHTMLhidden() ?>
<table class='outer'>
	<tr>
		<td class='head'><?php echo  _MD_PLZXOO_LANG_AID ?></td>
		<td class='odd'><?php echo  $template['answer']['aid'] ?></td>
	</tr>
	<tr>
		<td class='head'><?php echo  _MD_PLZXOO_LANG_BODY ?></td>
		<td class='odd'><?php echo  $template['answer']['body'] ?></td>
	</tr>
	<tr>
		<td class='head'><?php echo  _MD_PLZXOO_LANG_ANSWER_POSTER ?></td>
		<td class='odd'><?php echo  $template['answer']['user']['uname'] ?></td>
	</tr>
	<tr>
		<td class='head'><?php echo  _MD_PLZXOO_LANG_CONTROL ?></td>
		<td class='odd'>
			<input type="submit" value="<?php echo  _MD_PLZXOO_LANG_EXECUTE ?>">
		</td>
	</tr>
</table>
</form>	