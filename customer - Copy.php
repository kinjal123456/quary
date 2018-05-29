<?php 
	include 'libs/data/db.connect.php';
	
	if(isset($_POST['customerid'])){
		$type['type']="error";
		$custid=intval($_POST['customerid']);
		if($custid>0){
			$query="UPDATE customers SET zoneid=%i, firstname='%s', lastname='%s', email='%s', phone='%s', updated_at=now() WHERE id=%i";
			$query=$sql->query($query, array(intval($_POST['zoneid']), trim($_POST['fname']), trim($_POST['lname']), trim($_POST['custemail']), trim($_POST['phone']), $custid));
			if($db->query($query)){
				$type['type']="success";
			}
		}else {
			$query="INSERT INTO customers SET zoneid=%i firstname='%s', lastname='%s', email='%s', phone='%s', created_at=now(), updated_at=now()";
			$query=$sql->query($query, array(intval($_POST['zoneid']), trim($_POST['fname']), trim($_POST['lname']), trim($_POST['custemail']), trim($_POST['phone'])));
			if($db->query($query)){
				$type['type']="success";
			}
		}
		
		echo json_encode($type);
		exit(0);
	}
	
	$customerid=0;
	if(isset($_GET['custid']) && intval($_GET['custid'])>0){
		$customerid=intval($_GET['custid']);
		
		$custquery="SELECT id, zoneid, firstname, lastname, email, phone FROM customers WHERE id=%i";
		$custquery=$sql->query($custquery, array($customerid));
		$custresult=$db->query($custquery);
		$custcount=$db->numRows($custresult);
		$custrow=$db->fetchNextObject($custresult);
	}
	
	include 'header.php';
?>
<script type="text/javascript" src="js/customer.js"></script>
<td valign="top" style="padding: 20px">
	<div class="table-container">
		<div id="notify"><!-- --></div>
		<div valign="top" class="table-heading"><?php echo ($customerid>0)?'Edit Customer':'New Customer'; ?></div>
		<div style="padding: 10px 30px 10px 28px;">
			<form name="customerform" id="customerform" action="" method="post">
				<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
					<tr>
						<td valign="top" class="addField">
							<div>Zone</div>
							<div style="padding-top:5px">
								<select type="text" name="zoneid" id="zoneid">
									<option value="">Select Zone</option>
									<?php
										$zoneqry="SELECT id, zonename FROM zones";
										$zoneres=$db->query($zoneqry);
										$selected='';
										while($zonerw=$db->fetchNextObject($zoneres)){
											$selected=($zonerw->id==$custrow->zoneid)?'selected="selected"':'';
											echo '<option value="'.intval($zonerw->id).'" '.$selected.'>'.trim($zonerw->zonename).'</option>';
										}
									?>
								</select>
							</div>
						</td>
					</tr>
					<tr><td style="padding-top:10px"><!-- --></td></tr>
					<tr>
						<td valign="top" class="addField">
							<div>First Name</div>
							<div style="padding-top:5px"><input type="text" name="fname" id="fname" value="<?php echo ($customerid>0 && $custcount>0)?trim($custrow->firstname):""; ?>"></div>
						</td>
					</tr>
					<tr><td style="padding-top:10px"><!-- --></td></tr>
					<tr>
						<td valign="top" class="addField">
							<div>Last Name</div>
							<div style="padding-top:5px"><input type="text" name="lname" id="lname" value="<?php echo ($customerid>0 && $custcount>0)?trim($custrow->lastname):""; ?>"></div>
						</td>
					</tr>
					<tr><td style="padding-top:10px"><!-- --></td></tr>
					<tr>
						<td valign="top" class="addField">
							<div>Email</div>
							<div style="padding-top:5px"><input type="text" name="custemail" id="custemail" value="<?php echo ($customerid>0 && $custcount>0)?trim($custrow->email):""; ?>"></div>
						</td>
					</tr>
					<tr><td style="padding-top:10px"><!-- --></td></tr>
					<tr>
						<td valign="top" class="addField">
							<div>Phone Number</div>
							<div style="padding-top:5px"><input type="text" name="phone" id="phone" value="<?php echo ($customerid>0 && $custcount>0)?trim($custrow->phone):""; ?>"></div>
						</td>
					</tr>
					<tr><td style="padding-top:10px"><!-- --></td></tr>
					<tr>
						<td valign="top" class="addField">
							<div></div>
							<div style="padding-top:5px;width:100px">
								<input type="hidden" name="customerid" id="customerid" value="<?php echo $customerid; ?>">
								<input type="submit" name="submitbtn" id="submitbtn" value="Save" class="add-button" style="margin:0">
							</div>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</td>
<?php 
	include 'footer.php';
?>