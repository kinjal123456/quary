<?php 
	$notesqry="SELECT id, customerid, notes FROM customer_notes WHERE customerid=%i";
	$notesqry=$sql->query($notesqry, array($customerid));
	$notesres=$db->query($notesqry);
	$notescnt=$db->numRows($notesres);
?>
<table border="0" cellpadding="0" cellspacing="0" id="appendnotecontent" class="noteslisting" style="width:100%">
	<tr>
		<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right" style="width: 80px;">&nbsp;</td>
		<td align="left" valign="top" class="list_table_th border_top border_bottom border_right" style="width:100px"><div class="listing_th_padding">Sr no.</div></td>
		<td align="left" valign="top" class="list_table_th border_top border_bottom border_right"><div class="listing_th_padding">Notes</div></td>
	</tr>
	<?php
		$counter=1;
		if($notescnt>0){
			$addcapcount=1;
			while($notesrw=$db->fetchNextObject($notesres)){
				$uservalue=(intval($notesrw->userid)==1)?"Jayesh bhai":"Bhavna ben";
				$customestyle=($notescnt==$counter)?'style="border-bottom: solid 1px #e6e6e6;"':'';
	?>
	<tr class="noofnotes">
		<td align="center" valign="middle" class="border_bottom border_left border_right">
			<div>
				<div title="Delete" class="icon_delete pull-left" onclick="deletenotes(this, <?php echo intval($notesrw->id); ?>, <?php echo intval($notesrw->customerid); ?>)" style="margin-left:10px"></div>
				<div class="clearall">
			</div>
		</td>
		<td align="left" valign="top" class="border_bottom border_right">
			<div style="padding: 10px">
				<?php echo $counter++; ?>
			</div>
		</td>
		<td align="left" valign="top" class="border_bottom border_right">
			<div style="padding: 10px">
				<?php echo trim($notesrw->notes); ?>
			</div>
		</td>
	</tr>
	<?php } } ?>
	<tr class="notes templatenotes noofnotes" style="height:40px;display:none">
		<td align="center" valign="middle" class="border_bottom border_left">
			<div>
				<div title="Delete" class="icon_delete pull-left" style="margin-left:10px"></div>
				<div class="action-icon">&nbsp;</div>
				<div class="clearall">
			</div>
		</td>
		<td id="notesrno" align="center" valign="middle" class="border_bottom border_left border_right">&nbsp;</td>
		<td align="left" valign="top" class="border_bottom border_right">
			<div style="padding: 10px">
				<textarea class="notes" name="notes[]" id="notes" style="width:100%"></textarea>
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="8" align="left" valign="top" class="border_right">
			<div style="padding:10px;">
				<div title="Add" class="icon_add icon_add_note"></div>
			</div>
		</td>
	</tr>
</table>