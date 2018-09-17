<?php 
	$notesqry="SELECT id, customerid, subject, note_date, notes FROM customer_notes WHERE customerid=%i";
	$notesqry=$sql->query($notesqry, array($customerid));
	$notesres=$db->query($notesqry);
	$notescnt=$db->numRows($notesres);
?>

<table border="0" cellpadding="0" cellspacing="0" id="appendnotecontent" class="noteslisting" style="width:100%">
	<tr>
		<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right" style="width: 80px;">&nbsp;</td>
		<td align="left" valign="top" class="list_table_th border_top border_bottom border_right" style="width:100px"><div class="listing_th_padding">Sr no.</div></td>
		<td align="left" valign="top" class="list_table_th border_top border_bottom border_right" style="width:200px"><div class="listing_th_padding">Subject</div></td>
		<td align="left" valign="top" class="list_table_th border_top border_bottom border_right" style="width:200px"><div class="listing_th_padding">Date</div></td>
		<td align="left" valign="top" class="list_table_th border_top border_bottom border_right"><div class="listing_th_padding">Notes</div></td>
	</tr>
	<?php
		$counter=1;
		if($notescnt>0){
			$addcapcount=1;
			while($notesrw=$db->fetchNextObject($notesres)){
	?>
	<tr class="noofnotes">
		<td align="center" valign="middle" class="border_bottom border_left border_right">
			<div style="padding-left:15px">
				<div title="Edit" class="pull-left icon_edit" onclick="ajaxPopup('popup/edit-note.php?id=<?php echo intval($notesrw->id); ?>');"></div>
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
				<?php echo trim($notesrw->subject); ?>
			</div>
		</td>
		<td align="left" valign="top" class="border_bottom border_right">
			<div style="padding: 10px">
				<?php echo trim($notesrw->note_date); ?>
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
		<td id="notesrno" align="center" valign="middle" class="border_bottom border_left border_right">
			<div style="padding: 10px">
				<input name="subject[]" id="subject" value="" />
			</div>
		</td>
		<td id="notesrno" align="center" valign="middle" class="border_bottom border_left border_right">
			<div style="padding: 10px">
				<input name="note_date[]" class="note_date" value="" />
			</div>
		</td>
		<td align="left" valign="top" class="border_bottom border_right">
			<div style="padding: 10px">
				<textarea class="cust_note" name="cust_note[]" id="cust_note" style="width:100%" class="no-csform"></textarea>
			</div>
			<!--<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
			<script type="text/javascript" src="ckfinder/ckfinder.js"></script>-->
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