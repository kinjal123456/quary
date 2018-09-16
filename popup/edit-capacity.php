<?php
	include '../libs/data/db.connect.php';
	
	$popup_title='Edit Capacity';
	
	if(isset($_POST['capacityid'])){
		$_SESSION['tab1']=0;
		$_SESSION['tab2']=1;
		$_SESSION['tab3']=0;
		$_SESSION['tab4']=0;
		
		$type['type']="error";
		$capid=intval($_POST['capacityid']);
		if($capid>0){
			$capudpate="UPDATE customer_explosive_capacity SET srno=%i, explosive_name='%s', class='%s', division='%s', qty_at_time='%s', unit='%s', no_of_time='%s', updated_at=NOW() WHERE id=%i";
			$capudpate=$sql->query($capudpate, array(intval($_POST['capacity_srno']), trim($_POST['capacity_explosivenm']), trim($_POST['capacity_class']), trim($_POST['capacity_division']), trim($_POST['capacity_qty']), trim($_POST['capacity_unit']), trim($_POST['capacity_notimes']), $capid));
			if($db->query($capudpate)){
				$type['type']="success";
			}
		}
		echo json_encode($type);
		exit(0);
	}
	
	include 'popup-header.php';
	
	$capacityid=0;
	if(isset($_GET['id']) && intval($_GET['id'])>0){
		$capacityid=intval($_GET['id']);
		
		$query="SELECT id, customerid, srno, explosive_name, class, division, qty_at_time, unit, no_of_time FROM customer_explosive_capacity
				WHERE id=%i";
		$query=$sql->query($query, array($capacityid));
		$result=$db->query($query);
		$count=$db->numRows($query);
		$row=$db->fetchNextObject($result);
	}
?>
<script type="text/javascript" src="popup/js/edit-capacity.js"></script>
<tr>
	<td>
		<form name="capacityform" id="capacityform" action="popup/edit-capacity.php" method="post">
			<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr><td colspan="2"><div id="notifypopup"><!-- --></div></td></tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right">
						<div class="listing_th_padding">Sr no.</div>
					</td>
					<td><input type="text" name="capacity_srno" id="capacity_srno" value="<?php echo intval($row->srno); ?>"></td>
				</tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right">
						<div class="listing_th_padding">Explosive name</div>
					</td>
					<td>
						<select name="capacity_explosivenm" id="capacity_explosivenm" class="select_drop_down">
							<option value="">Select</option>
							<?php foreach($CAPACITY_EXPLOSIVE_NAMES_ as $exp_name){ ?>
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
					<td><input type="text" name="capacity_class" id="capacity_class" value="<?php echo $row->class; ?>" /></td>
				</tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right">
						<div class="listing_th_padding">Division</div>
					</td>
					<td><input type="text" name="capacity_division" id="capacity_division" value="<?php echo $row->division; ?>"></td>
				</tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right">
						<div class="listing_th_padding">Quantity at time</div>
					</td>
					<td><input type="text" name="capacity_qty" id="capacity_qty" value="<?php echo $row->qty_at_time; ?>"></td>
				</tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right">
						<div class="listing_th_padding">Unit</div>
					</td>
					<td>
						<select name="capacity_unit" id="capacity_unit" class="select_drop_down">
							<option value="">Select</option>
							<?php foreach($CAPACITY_UNIT_ as $unit_name){ ?>
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
					<td><input type="text" name="capacity_notimes" id="capacity_notimes" value="<?php echo $row->no_of_time; ?>"></td>
				</tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="right" valign="top" colspan="2">
						<input type="hidden" name="capacityid" id="capacityid" value="<?php echo $capacityid; ?>">
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