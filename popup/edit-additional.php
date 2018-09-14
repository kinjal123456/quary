<?php
	include '../libs/data/db.connect.php';
	
	$popup_title='Edit additional';
	
	if(isset($_POST['additionalid'])){
		$type['type']="error";
		$addid=intval($_POST['additionalid']);
		if($addid>0){
			$query="INSERT INTO customer_additional_info SET detailname='%s', emailid='%s', password='%s', updated_at=NOW() WHERE id=%i";
			$query=$sql->query($query, array(trim($_POST['detailname']), trim($_POST['emailid']), utf8_encode(trim($_POST['addpassword'])), $addid));
			if($db->query($query)){
				$type['addstatus']="success";
			}
		}
		echo json_encode($type);
		exit(0);
	}
	
	include 'popup-header.php';
	
	$additionalid=0;
	if(isset($_GET['id']) && intval($_GET['id'])>0){
		$additionalid=intval($_GET['id']);
		
		$query="SELECT id, customerid, srno, explosive_name, class, division, qty_at_time, unit, no_of_time FROM customer_additional_info
				WHERE id=%i";
		$query=$sql->query($query, array($additionalid));
		$result=$db->query($query);
		$count=$db->numRows($query);
		$row=$db->fetchNextObject($result);
	}
?>
<script type="text/javascript" src="popup/js/edit-additional.js"></script>
<tr>
	<td>
		<form name="additionalform" id="additionalform" action="popup/edit-additional.php" method="post">
			<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr><td colspan="2"><div id="notifypopup"><!-- --></div></td></tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right">
						<div class="listing_th_padding">Sr no.</div>
					</td>
					<td><input type="text" name="additional_srno" id="additional_srno" value="<?php echo intval($row->srno); ?>"></td>
				</tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right">
						<div class="listing_th_padding">Explosive name</div>
					</td>
					<td>
						<select name="additional_explosivenm" id="additional_explosivenm" class="select_drop_down">
							<option value="">Select</option>
							<?php foreach($additional_EXPLOSIVE_NAMES_ as $exp_name){ ?>
								<option value="<?php echo $exp_name; ?>"  <?php echo (trim($row->explosive_name==$exp_name))?'selected="selected"':''; ?>><?php echo $exp_name; ?></option>
							<?php } ?>
						</select>
					</td>
				</tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right">
						<div class="listing_th_padding">Class</div>
					</td>
					<td><input type="text" name="additional_class" id="additional_class" value="<?php echo $row->class; ?>" /></td>
				</tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right">
						<div class="listing_th_padding">Division</div>
					</td>
					<td><input type="text" name="additional_division" id="additional_division" value="<?php echo $row->division; ?>"></td>
				</tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right">
						<div class="listing_th_padding">Quantity at time</div>
					</td>
					<td><input type="text" name="additional_qty" id="additional_qty" value="<?php echo $row->qty_at_time; ?>"></td>
				</tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right">
						<div class="listing_th_padding">Unit</div>
					</td>
					<td>
						<select name="additional_unit" id="additional_unit" class="select_drop_down">
							<option value="">Select</option>
							<?php foreach($additional_UNIT_ as $unit_name){ ?>
								<option value="<?php echo $unit_name; ?>" <?php echo (trim($row->unit==$unit_name))?'selected="selected"':''; ?>><?php echo $unit_name; ?></option>
							<?php } ?>
						</select>
					</td>
				</tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right">
						<div class="listing_th_padding">No. of times</div>
					</td>
					<td><input type="text" name="additional_notimes" id="additional_notimes" value="<?php echo $row->no_of_time; ?>"></td>
				</tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="right" valign="top" colspan="2">
						<input type="hidden" name="additionalid" id="additionalid" value="<?php echo $additionalid; ?>">
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