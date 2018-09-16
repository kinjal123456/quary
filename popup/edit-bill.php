<?php
	include '../libs/data/db.connect.php';
	
	$popup_title='Edit bill';
	
	if(isset($_POST['billid'])){
		$type['type']="error";
		$bill_id=intval($_POST['billid']);
		if($bill_id>0){
			$query="UPDATE customers_bills SET customerid=%i, userid=%i, billname='%s', bill_amount='%s', paid_by=%i, paid_on='%s', remarks='%s', updated_at=NOW() WHERE id=%i";
			$query=$sql->query($query, array(intval($_POST['cust']), intval($_POST['user']), trim($_POST['billname']), trim($_POST['billamt']), trim($_POST['paid_by']),trim($_POST['paid_on']),trim($_POST['remarks']), $bill_id));
			if($db->query($query)){
				$type['type']="success";
			}
		}
		echo json_encode($type);
		exit(0);
	}
	
	include 'popup-header.php';
	
	$billid=0;
	if(isset($_GET['id']) && intval($_GET['id'])>0){
		$billid=intval($_GET['id']);
		
		$query="SELECT id, customerid, userid, billname, billno, bill_amount, paid_by, paid_on, remarks FROM customers_bills
				WHERE id=%i";
		$query=$sql->query($query, array($billid));
		$result=$db->query($query);
		$count=$db->numRows($query);
		$row=$db->fetchNextObject($result);
	}
?>
<script type="text/javascript" src="popup/js/edit-bill.js"></script>
<tr>
	<td>
		<form name="billform" id="billform" action="popup/edit-bill.php" method="post">
			<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr><td colspan="2"><div id="notifypopup"><!-- --></div></td></tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right">
						<div class="listing_th_padding">Customer</div>
					</td>
					<td>
						<select name="cust" id="cust" class="select_drop_down">
							<option value="">Select customer</option>
							<?php 
								$cust_query="SELECT id, companyname FROM customers";
								$cust_result=$db->query($cust_query);
								while($cust_row=$db->fetchNextObject($cust_result)){
							?>
								<option value="<?php echo intval($cust_row->id); ?>" <?php echo (intval($cust_row->id)==$row->customerid)?'selected="selected"':''; ?>><?php echo trim($cust_row->companyname); ?></option>
							<?php } ?>
						</select>
					</td>
				</tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right">
						<div class="listing_th_padding">User</div>
					</td>
					<td>
						<select name="user" id="user" class="select_drop_down">
							<option value="">Select user</option>
							<option value="1" <?php echo ($row->userid==1)?'selected="selected"':''; ?>>Jayesh bhai</option>
							<option value="2" <?php echo ($row->userid==2)?'selected="selected"':''; ?>>Bhavna ben</option>
						</select>
					</td>
				</tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right">
						<div class="listing_th_padding">Bill number</div>
					</td>
					<td>
						<input type="text" name="bill_number" id="bill_number" value="<?php echo $row->billno; ?>" readonly="readonly">
					</td>
				</tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right">
						<div class="listing_th_padding">Bill name</div>
					</td>
					<td>
						<input type="text" name="billname" id="billname" value="<?php echo $row->billname; ?>">
					</td>
				</tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right">
						<div class="listing_th_padding">Bill amount</div>
					</td>
					<td>
						<input type="text" name="billamt" id="billamt" class="billamt" value="<?php echo $row->bill_amount; ?>">
					</td>
				</tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right">
						<div class="listing_th_padding">Paid By</div>
					</td>
					<td>
						<select name="paid_by" id="paid_by" class="select_drop_down" style="width:100%">
							<option value="0">Select</option>
							<option value="1" <?php echo ($row->paid_by==1)?'selected="selected"':''; ?>>Cheque</option>
							<option value="2" <?php echo ($row->paid_by==2)?'selected="selected"':''; ?>>Cash</option>
						</select>
					</td>
				</tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right">
						<div class="listing_th_padding">Paid on</div>
					</td>
					<td>
						<input type="text" name="paid_on" id="paid_on" value="<?php echo $row->paid_on; ?>">
					</td>
				</tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right">
						<div class="listing_th_padding">Remarks</div>
					</td>
					<td>
						<input type="text" name="remarks" id="remarks" value="<?php echo $row->remarks; ?>" >
					</td>
				</tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="right" valign="top" colspan="2">
						<input type="hidden" name="billid" id="billid" value="<?php echo $billid; ?>">
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