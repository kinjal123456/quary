<?php
	include '../libs/data/db.connect.php';
	
	$popup_title='Edit note details';
	
	if(isset($_POST['note_id'])){
		$_SESSION['tab1']=0;
		$_SESSION['tab2']=0;
		$_SESSION['tab3']=0;
		$_SESSION['tab4']=1;
		
		$type['type']="error";
		$noteid=intval($_POST['note_id']);
		if($noteid>0){
			$query="UPDATE customer_notes SET subject='%s', note_date='%s', notes='%s', updated_at=NOW() WHERE id=%i";
			$query=$sql->query($query, array(trim($_POST['subject']), trim($_POST['note_date']), trim($_POST['notes']), $noteid));
			if($db->query($query)){
				$type['type']="success";
			}
		}
		echo json_encode($type);
		exit(0);
	}
	
	include 'popup-header.php';
	
	$note_id=0;
	if(isset($_GET['id']) && intval($_GET['id'])>0){
		$note_id=intval($_GET['id']);
		
		$query="SELECT id, customerid, subject, note_date, notes FROM customer_notes
				WHERE id=%i";
		$query=$sql->query($query, array($note_id));
		$result=$db->query($query);
		$count=$db->numRows($query);
		$row=$db->fetchNextObject($result);
	}
?>
<script type="text/javascript" src="popup/js/edit-note.js"></script>
<tr>
	<td>
		<form name="noteform" id="noteform" action="popup/edit-note.php" method="post">
			<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr><td colspan="2"><div id="notifypopup"><!-- --></div></td></tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right">
						<div class="listing_th_padding">Subject</div>
					</td>
					<td><input name="subject" id="subject" value="<?php echo $row->subject; ?>" /></td>
				</tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right">
						<div class="listing_th_padding">Date</div>
					</td>
					<td>
						<input name="note_date" id="note_date" value="<?php echo $row->note_date; ?>" />
					</td>
				</tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right">
						<div class="listing_th_padding">Notes</div>
					</td>
					<td>
						<textarea class="notes" name="notes" id="notes" style="width:100%" class="no-csform"><?php echo $row->notes; ?></textarea>
					</td>
				</tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="right" valign="top" colspan="2">
						<input type="hidden" name="note_id" id="note_id" value="<?php echo $note_id; ?>">
						<input type="hidden" name="customerid" id="customerid" value="<?php echo intval($row->customerid); ?>">
						<input type="submit" name="submitbtn" id="submitbtn" value="Save" class="add-button" style="margin:0">
					</td>
				</tr>
			</table>
		</form>
	</td>
</tr>
<?php 
	include 'popup-footer.php';
?>