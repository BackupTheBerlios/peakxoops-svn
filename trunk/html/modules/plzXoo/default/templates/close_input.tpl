<?php
	$points = explode( '|' , @$GLOBALS['xoopsModuleConfig']['points'] ) ;
	$point_options = '' ;
	foreach( $points as $key => $point_tmp ) {
		@list( $point , $max ) = explode( ':' , $point_tmp ) ;
		if( empty( $max ) ) $max = 0 ;
		$point = intval( $point_tmp ) ;
		$point_options .= "<option value='$point'>".sprintf($max?_MD_PLZXOO_FORMAT_POINT_OF_ANSWER:_MD_PLZXOO_FORMAT_POINT_OF_ANSWER_NOLIMIT,$point,$max)."</option>\n" ;
	}
?>


<?php if($template['editform']->isError()) { ?>
    <?php echo  $template['editform']->getHtmlErrors() ?>
<?php } ?>

<h2 align='center'><?php echo _MD_PLZXOO_MESSAGE_CLOSE_QUESTION_CONFIRM ?></h2>

<form method='post'>
	<table class='outer'>
		<tr class='head'>
			<td colspan='2'><?php echo _MD_PLZXOO_LANG_QUESTION ?></td>
		</tr>
		<tr class='odd'>
			<td width='20%'>No.<?php echo  $template['question']['qid'] ?></td>
			<td><b><?php echo _MD_PLZXOO_LANG_QUESTION ?>:<?php echo  $template['question']['subject'] ?></b></td>
		</tr>
		<tr class='even'>
			<td width='20%'><?php echo _MD_PLZXOO_LANG_QUESTION_POSTER ?>:<a href="<?php echo  XOOPS_URL ?>/userinfo.php?uid=<?php echo  $template['question']['uid'] ?>"><?php echo  $template['question']['user']['uname'] ?></a></td>
			<td rowspan='2'><?php echo $template['question']['body'] ?></td>
		</tr>
		<tr class='odd'>
			<td width='20%'><?php echo  strftime("%Y/%m/%d %H:%M",$template['question']['input_date']) ?></td>
		</tr>
	</table>
	
	<?php foreach( $template['answers'] as $answer ) { ?>
	<p>
	<table class='outer'>
		<tr class='head'>
			<td colspan='2'>
				<?php echo _MD_PLZXOO_LANG_ANSWER ; ?>
			</td>
		</tr>
		<tr>
			<td class='even' width='20%'><?php echo _MD_PLZXOO_LANG_ANSWER_POSTER ; ?>:<a href="<?php echo XOOPS_URL ?>/userinfo.php?uid=<?php echo $answer['uid'] ; ?>"><?php echo $answer['user']['uname'] ; ?></a></td>
			<td class='odd' rowspan='3'>
				<?php echo $answer['body'] ; ?>
			</td>
		</tr>
		<tr class='even'>
			<td width='20%'><?php echo formatTimestamp( $answer['input_date'] ) ; ?></td>
		</tr>
		<tr class='even'>
			<td width='20%'>
				<?php echo _MD_PLZXOO_LANG_POINT_TO_THIS ; ?>
				<select name='points[<?php echo $answer['aid'] ; ?>]'>
					<?php echo $point_options ; ?>
				</select>
			</td>
		</tr>
	</table>
	</p>
	<?php } ?>
	
	<div align='center'>
			<input type='hidden' name='<?php echo  $template['editform']->ticket_->name_ ?>' value='<?php echo  $template['editform']->ticket_->value_ ?>'>
			<input type='submit' value='<?php echo _MD_PLZXOO_LANG_EXECUTE ?>' onclick='return confirm("<?php echo _MD_PLZXOO_MESSAGE_IS_POINT_OK ; ?>");' />
	</div>
</form>
