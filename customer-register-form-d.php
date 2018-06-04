<?php
	include_once "libs/data/db.connect.php";
	
	//Delete register form a
	if(isset($_POST['action']) && trim($_POST['action'])=="registerFormDelete"){
		$type['type']="error";
		$formid=intval($_POST['formid']);
		$customerid=intval($_POST['customerid']);
		
		if($formid>0){
			$query="DELETE FROM customer_register_form_d WHERE id=%i AND customerid=%i";
			$query=$sql->query($query, array($formid, $customerid));
			if($db->query($query)){
				$type['type']="success";
			}
		}
		echo json_encode($type);
		exit(0);
	}

	if(isset($_POST['submitbtn'])){
		$type["registerstaus"]="error";
		$custid=intval($_POST['custid']);
		
		if($custid>0){//INSERT MAIN DATA
			$query="INSERT INTO customer_register_form_d SET `customerid`=%i,`name`='%s',`relay_or_set_work`='%s',`summary_no_of_days`=%i,`signature_of_reg_keeper`='%s',
														`remark_no_of_hours`='%s',`created_by`=NOW(),`updated_by`=NOW()";
			$query=$sql->query($query, array($custid, trim($_POST['name']), trim($_POST['relay_or_set_work']), intval($_POST['summary_no_of_days']), 
					trim($_POST['signature_of_reg_keeper']), trim($_POST['remark_no_of_hours'])));
			if($db->query($query)){
				$lastinsId=$db->lastInsertedId();
				if($lastinsId>0){//UPDATE ATTENDENCE DATA
					if(isset($_POST['days']) && count($_POST['days'])>0){
						$dayno=1;
						for($j=0; $j<=count($_POST['days']); $j++){
							if(strlen($_POST['days'][$j])>0){
								$upquery="UPDATE customer_register_form_d SET day_".$dayno."='%s',`updated_by`=NOW() WHERE id=%i";
								$upquery=$sql->query($upquery, array($_POST['days'][$j], $lastinsId));
								$db->query($upquery);
							}
						$dayno++; }
					}
					$type['customerid']=$custid;
					$type["registerstaus"]="success";
				}
			}
		}
		
		echo json_encode($type);
		exit(0);
	}
	include_once "header.php";

	if(isset($_GET['custid']) && intval($_GET['custid'])){
		$customerid=intval($_GET['custid']);
	}
?>
<link href="css/register-styles.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/customer-register-form-d.js"></script>
<td valign="top" style="padding: 20px; width:100%">
	<div class="table-container">
		<div id="notify"><!-- --></div>
		<div valign="top" class="table-heading"><?php echo ($customerid>0)?'Register Form D':''; ?></div>
		<div style="padding: 20px 0;">
			<!--<div style="border-bottom: 1px solid #cccccc;">
				<div class="tab_container">
					<a class="tab active_tab" id="general">General Details</a>
					<a class="tab" id="additional">Additional Details</a>
					<a class="tab" id="bills">Bills</a>
					<a class="tab" id="registers">Registers</a>
				</div>
			</div>-->
			<div style="padding:20px">
				<div align="center">
					<div class="register_form_upper_hadding_lg">FORM D</div>
					<div class="register_form_upper_hadding_lg">FORMAT OF ATTENDANCE REGISTER</div>
				</div>
				<div>
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td style="font-weight:bold">Name of the Establishment</td>
							<td>fg</td>
							<td style="font-weight:bold">Name of Owner</td>
							<td>Jayeshbhai Desai</td>
							<td style="font-weight:bold">LIN</td>
							<td></td>
						</tr>
						<tr>
							<td>
								<div class="pull-left" style="font-weight:bold;padding-right:10px">For the Period From</div>
								<div class="pull-left">fg</div>
								<div class="pull-left" style="font-weight:bold;padding:0 10px">To</div>
								<div class="pull-left">gfd</div>
								<br clear="all">
							</td>
						</tr>
						<tr><td colspan="6" style="height:10px"><!-- --></td></tr>
					</table>
				</div>
				<form name="registerform" id="registerform" action="" method="post">
					<table border="0" cellpadding="0" cellspacing="0" class="list_table addlisting" style="width:100%">
						<tr>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Name</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Relay or set work</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Summary number of days</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Signature of reg keeper</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Remark number of hours</div></td>
						</tr>
						<tr>
							<td align="left" valign="top" class="border_bottom border_left border_right">
								<div class="listing_td_padding">
									<input type="text" name="name" id="name" value="">
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="relay_or_set_work" id="relay_or_set_work" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="summary_no_of_days" id="summary_no_of_days" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="signature_of_reg_keeper" id="signature_of_reg_keeper" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="remark_no_of_hours" id="remark_no_of_hours" value="" />
								</div>
							</td>
						</tr>
						<tr><td style="height:10px"><!-- --></td></tr>
					</table>
					<table border="0" cellpadding="0" cellspacing="0" class="list_table addlisting" style="width:100%">
						<tr>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_left border_right"><div class="listing_th_padding">Attendence</div></td>
						</tr>
						<tr>
							<td align="left" valign="top" class="border_bottom border_left border_right">
								<?php for($i=0; $i<31; $i++){ ?>
									<div class="listing_td_padding pull-left">
										<input type="text" name="days[]" id="day_<?php echo $i; ?>" value="" style="width:12px" />
									</div>
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td colspan="9">
								<input type="hidden" name="custid" id="custid" value="<?php echo $customerid; ?>">
								<input name="submitbtn" id="submitbtn" value="Save" class="add-button" style="margin-left:0" type="submit">
							</td>
						</tr>
					</table>
				</form>
				<div style="padding:20px 0;width: 100%;max-height: 500px;overflow: auto;">
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th valign="top" class="table-title border_left border_right">Actions</th>
								<th valign="top" class="table-title border_right">Name</th>
								<th valign="top" class="table-title border_right">Relay or set work</th>
								<th valign="top" class="table-title border_right">Summary number of days</th>
								<th valign="top" class="table-title border_right">Signature of registration keeper</th>
								<th valign="top" class="table-title border_right">Remark number of hours</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$qry="SELECT id, customerid, name FROM customer_register_form_d WHERE customerid=%i";
							$qry=$sql->query($qry, array($customerid));
							$res=$db->query($qry);
							$cnt=$db->numRows($res);
							if($cnt>0){
								$counter=1;
								while($rw=$db->fetchNextObject($res)){
									$id=intval($rw->id); 
						?>
							<tr>
								<td valign="middle" class="table-data borderall" style="padding-top:5px">
									<div>
										<div class="pull-left action-icon"><img src="images/delete-icon.png" onclick="deleteRegisterForm('d', <?php echo $id; ?>, <?php echo intval($rw->customerid); ?>)" title="Delete"></div>
									</div>
								</td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->name); ?>"><?php echo trim($rw->name); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->relay_or_set_work); ?>"><?php echo ellipses(trim($rw->relay_or_set_work), 50); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo intval($rw->summary_no_of_days); ?>"><?php echo intval($rw->summary_no_of_days); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->signature_of_reg_keeper); ?>"><?php echo ellipses(trim($rw->signature_of_reg_keeper), 50); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->remark_no_of_hours); ?>"><?php echo ellipses(trim($rw->remark_no_of_hours), 50); ?></td>
							</tr>
						<?php $counter++; } }else { ?>
						<tr>
							<td colspan="6">
								<div id="norecord"></div>
							</td>
						</tr>
						<script type="text/javascript" language="javascript">
							$("#norecord").notification({caption:"No Record found.", type: "warning", sticky:true});
						</script>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</td>
<?php include_once "footer.php"; ?>