<?php
	include_once "libs/data/db.connect.php";
	
	//Delete register form a
	if(isset($_POST['action']) && trim($_POST['action'])=="registerFormDelete"){
		$type['type']="error";
		$formid=intval($_POST['formid']);
		$customerid=intval($_POST['customerid']);
		
		if($formid>0){
			$query="DELETE FROM customer_register_form_c WHERE id=%i AND customerid=%i";
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
		$dateofcompleterecovery=strlen(trim($_POST['date_of_complete_recovery'])>0)?date("Y-m-d", strtotime(trim($_POST['date_of_complete_recovery']))):"";
		
		if($custid>0){
			$query="INSERT INTO customer_register_form_c SET
													    `customerid`=%i,
														`si_no`=%i,
														`name`='%s',
														`recovery_type`=%i,
														`particulars`='%s',
														`date_of_loss`='%s',
														`amount`=%i,
														`whether_show_cause_issued`='%s',
														`explanation_heard_in_presence_of`='%s',
														`no_of_emis`=%i,
														`first_month_year`='%s',
														`last_month_year`='%s',
														`date_of_complete_recovery`='%s',
														`remark`='%s',
														`created_by`=NOW(),
														`updated_by`=NOW()";
			$query=$sql->query($query, array($custid, intval($_POST['si_no']), trim($_POST['name']), intval($_POST['recovery_type']), 
					trim($_POST['particulars']), trim($_POST['date_of_loss']), intval($_POST['amount']), trim($_POST['whether_show_cause_issued']), 
					trim($_POST['explanation_heard_in_presence_of']), intval($_POST['no_of_emis']), trim($_POST['first_month_year']), 
					trim($_POST['last_month_year']), $dateofcompleterecovery, trim($_POST['remark'])
			));
			if($db->query($query)){
				$type['customerid']=$custid;
				$type["registerstaus"]="success";
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
<style>
	.register_table_td{
		width:100px
	}
	.listing_th_padding {
		padding: 5px 5px 5px 8px;
		color: #000;
		font-size: 13px;
	}
	.listing_td_padding{
		padding:5px
	}
</style>
<script type="text/javascript" src="js/customer-register-form-c.js"></script>
<td valign="top" style="padding: 20px; width:100%">
	<div class="table-container">
		<div id="notify"><!-- --></div>
		<div valign="top" class="table-heading"><?php echo ($customerid>0)?'Update Customer - '.trim($custrow->customername).' details':'New Customer'; ?></div>
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
				<form name="registerform" id="registerform" action="" method="post">
					<table border="0" cellpadding="0" cellspacing="0" class="list_table addlisting" style="width:100%">
						<tr>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_left border_right register_table_td"><div class="listing_th_padding">SI Number</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Name</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Recovery Type</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Particulars</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Date of Loss</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Amount</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Whether show <br />Cause Issued</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Explanation Heard <br /> in Presence of</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Number of EMIS</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">First Month Year</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Last Month Year</div></td>
						</tr>
						<tr>
							<td align="left" valign="top" class="border_bottom border_left border_right">
								<div class="listing_td_padding">
									<input type="text" name="si_no" id="si_no" value="">
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="name" id="name" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="recovery_type" id="recovery_type" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="particulars" id="particulars" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="date_of_loss" id="date_of_loss" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="amount" id="amount" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="whether_show_cause_issued" id="whether_show_cause_issued" value="" style="width:100%" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="explanation_heard_in_presence_of" id="explanation_heard_in_presence_of" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="no_of_emis" id="no_of_emis" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="first_month_year" id="first_month_year" value="" style="width:100%" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="last_month_year" id="last_month_year" value="" />
								</div>
							</td>
						</tr>
						<tr><td style="height:10px"><!-- --></td></tr>
					</table>
					<table border="0" cellpadding="0" cellspacing="0" class="list_table addlisting" style="width:100%">
						<tr>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_left border_right" style="width:200px"><div class="listing_th_padding">Date of Complete Recovery</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right"><div class="listing_th_padding">Remarks</div></td>
						</tr>
						<tr>
							<td align="left" valign="top" class="border_bottom border_left border_right">
								<div class="listing_td_padding">
									<input type="text" name="date_of_complete_recovery" id="date_of_complete_recovery" value="">
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="remark" id="remark" value="" />
								</div>
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
				<div style="padding:20px 0">
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td valign="top" class="table-title" style="width:50px">Sr No.</td>
							<td valign="top" class="table-title"Name</td>
							<td valign="top" class="table-title" style="width:100px">Actions</td>
						</tr>
						<?php
							$qry="SELECT id, customerid, name FROM customer_register_form_c WHERE customerid=%i";
							$qry=$sql->query($qry, array($customerid));
							$res=$db->query($qry);
							$cnt=$db->numRows($res);
							if($cnt>0){
								$counter=1;
								while($rw=$db->fetchNextObject($res)){
									$id=intval($rw->id); 
						?>
						<tr>
							<td valign="top" class="table-data" title="<?php echo $counter; ?>"><?php echo $counter; ?></td>
							<td valign="top" class="table-data" title="<?php echo trim($rw->name); ?>"><?php echo trim($rw->name); ?></td>
							<td valign="middle" class="table-data">
								<div>
									<div class="pull-left action-icon"><img src="images/delete-icon.png" onclick="deleteRegisterForm('c', <?php echo $id; ?>, <?php echo intval($rw->customerid); ?>)" title="Delete"></div>
								</div>
							</td>
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
					</table>
				</div>
			</div>
		</div>
	</div>
</td>
<?php include_once "footer.php"; ?>