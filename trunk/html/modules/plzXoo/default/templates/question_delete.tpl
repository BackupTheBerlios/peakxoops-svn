<h2 align="center"><?php echo _MD_PLZXOO_LANG_DELETE_CONFIRM ?></h2>

<form method='post'>
<?php echo  $template['editform']->ticket_->makeHTMLhidden() ?>
<table class='outer'>
	<tr>
		<td class='head'><?php echo  _MD_PLZXOO_LANG_QID ?></td>
		<td class='odd'><?php echo  $template['question']['qid'] ?></td>
	</tr>
	<tr>
		<td class='head'><?php echo  _MD_PLZXOO_LANG_SUBJECT ?></td>
		<td class='odd'><?php echo  $template['question']['subject'] ?></td>
	</tr>
	<tr>
		<td class='head'><?php echo  _MD_PLZXOO_LANG_BODY ?></td>
		<td class='odd'><?php echo  $template['question']['body'] ?></td>
	</tr>
	<tr>
		<td class='head'><?php echo  _MD_PLZXOO_LANG_QUESTION_POSTER ?></td>
		<td class='odd'><?php echo  $template['question']['user']['uname'] ?></td>
	</tr>
	<tr>
		<td class='head'><?php echo  _MD_PLZXOO_LANG_CATEGORY ?></td>
		<td class='odd'><?php echo  $template['question']['category']['name'] ?></td>
	</tr>
	<tr>
		<td class='head'><?php echo  _MD_PLZXOO_LANG_SIZE ?></td>
		<td class='odd'><?php echo  $template['question']['size'] ?></td>
	</tr>
	<tr>
		<td class='head'><?php echo  _MD_PLZXOO_LANG_CONTROL ?></td>
		<td class='odd'>
			<input type="submit" value="<?php echo  _MD_PLZXOO_LANG_EXECUTE ?>">
		</td>
	</tr>
</table>
</form>	