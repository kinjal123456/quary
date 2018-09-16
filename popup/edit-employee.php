<?php
	include '../libs/data/db.connect.php';
	
	$popup_title='Edit Employee details';
	
	if(isset($_POST['empid'])){
		$_SESSION['tab1']=1
		$_SESSION['tab2']=0;
		$_SESSION['tab3']=0;
		$_SESSION['tab4']=0;
		
		$type['type']="error";
		$empid=intval($_POST['empid']);
		if($empid>0){
			$empupdate="UPDATE customer_employees SET name='%s', designation='%s', mobile_no='%s', updated_at=NOW() WHERE id=%i";
			$empupdate=$sql->query($empupdate, array(trim($_POST['empname']), trim($_POST['empdesignation']), trim($_POST['empmob']), $empid));
			if($db->query($empupdate)){
				$type['type']="success";
			}
		}
		echo json_encode($type);
		exit(0);
	}
	
	include 'popup-header.php';
	
	$empid=0;
	if(isset($_GET['id']) && intval($_GET['id'])>0){
		$employeeid=intval($_GET['id']);
		
		$query="SELECT id, customerid, name, designation, mobile_no FROM customer_employees
				WHERE id=%i";
		$query=$sql->query($query, array($employeeid));
		$result=$db->query($query);
		$count=$db->numRows($query);
		$row=$db->fetchNextObject($result);
	}
?>
<script type="text/javascript" src="popup/js/edit-employee.js"></script>
<tr>
	<td>
		<form name="employeeform" id="employeeform" action="popup/edit-employee.php" method="post">
			<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr><td colspan="2"><div id="notifypopup"><!-- --></div></td></tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right">
						<div class="listing_th_padding">Name</div>
					</td>
					<td><input type="text" name="empname" class="empname" style="width: 100%; border: 0; padding:0" value="<?php echo $row->name; ?>" /></td>
				</tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right">
						<div class="listing_th_padding">Designation</div>
					</td>
					<td>
						<input type="text" name="empdesignation" class="empdesignation" style="width: 100%; border: 0; padding:0" value="<?php echo $row->designation; ?>" />
					</td>
				</tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right">
						<div class="listing_th_padding">Mobile number</div>
					</td>
					<td><input type="text" name="empmob" class="empmob" style="width: 100%; border: 0; padding:0" value="<?php echo $row->mobile_no; ?>" /></td>
				</tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="right" valign="top" colspan="2">
						<input type="hidden" name="empid" id="empid" value="<?php echo $employeeid; ?>">
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