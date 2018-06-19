<?php
	include_once "libs/data/db.connect.php";
	
	//Delete register form a
	if(isset($_POST['action']) && trim($_POST['action'])=="registerFormDelete"){
		$type['type']="error";
		$formid=intval($_POST['formid']);
		$customerid=intval($_POST['customerid']);
		
		if($formid>0){
			$query="DELETE FROM customer_register_form_a_type_b WHERE id=%i AND customerid=%i";
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
			$query="INSERT INTO customer_register_form_a_type_b SET
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
		
		$formlinq="SELECT emailid FROM customer_additional_info WHERE id=%i AND detailname='Shram Shuvidha LIN detail'";
		$formlinq=$sql->query($formlinq, array($customerid));
		$formlin=$db->queryUniqueValue($formlinq);
	}
?>
<link href="css/register-styles.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/customer-register-form-a-2.js"></script>
<td valign="top" style="padding: 20px; width:100%">
	<div class="table-container">
		<div id="notify"><!-- --></div>
		<div valign="top" class="table-heading">
			<div class="pull-left"><a href="customer.php?custid=<?php echo $customerid; ?>"><img src="images/back.png"></a></div>
			<div><?php echo ($customerid>0)?'[PART B: FOR THE MINES ACT, 1952 (35 of 1952) ONLY]':''; ?></div>
			<div class="clearall"><!-- --></div>
		</div>
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
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_left border_right" style="width:130px"><div class="listing_th_padding">SI Number in<br>Employee Register</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right"><div class="listing_th_padding">Name</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right"><div class="listing_th_padding">Token Number<br>Issued</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right"><div class="listing_th_padding">Date of First<br> Appointment with<br> present Owner</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right"><div class="listing_th_padding">Certificate of<br> age/fitness taken<br>(for 14 to 18 Years)</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right"><div class="listing_th_padding">Place of<br> Employment<br> (Underground/Open<br> cast/Surface)</div></td>
							<td align="center" valign="top" class="list_table_th border_top border_bottom border_right">
								<div class="listing_th_padding" style="padding:0">
									<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
										<tr>
											<td align="center" valign="middle" colspan="2" class="border_bottom" style="line-height:42px">Certificate of Vocational Training</td>
										</tr>
										<tr style="line-height:40px">
											<td align="center" valign="middle" class="border_right" style="width:100px">Number</td>
											<td align="center" valign="middle" style="width:100px">Date</td>
										</tr>
									</table>
								</div>
							</td>
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
									<input type="text" name="token_number" id="token_number" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="date_of_first_appnt" id="date_of_first_appnt" value="" readonly="readonly" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="cert_of_age" id="cert_of_age" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="place_of_emp" id="place_of_emp" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div>
									<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
										<tr style="line-height:40px">
											<td align="center" valign="middle" class="border_right" style="width:100px;padding:5px">
												<input type="text" name="vocational_number" id="vocational_number" value="" style="width:100%" />
											</td>
											<td align="center" valign="middle" style="width:100px;padding:5px">
												<input type="text" name="vocational_date" id="vocational_date" value="" style="width:100%" />
											</td>
										</tr>
									</table>
								</div>
							</td>
						</tr>
						<tr><td style="height:10px"><!-- --></td></tr>
					</table>
					<table border="0" cellpadding="0" cellspacing="0" class="list_table addlisting" style="width:100%">
						<tr>
							<td align="center" valign="top" class="list_table_th border_top border_bottom border_right">
								<div class="listing_th_padding" style="padding:0">
									<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
										<tr>
											<td align="center" valign="middle" colspan="2" class="border_bottom" style="line-height:42px">Nominee</td>
										</tr>
										<tr style="line-height:40px">
											<td align="center" valign="middle" class="border_right" style="width:100px">Name</td>
											<td align="center" valign="middle" style="width:100px">Address</td>
										</tr>
									</table>
								</div>
							</td>
							<td align="center" valign="top" class="list_table_th border_top border_bottom border_right">
								<div class="listing_th_padding" style="padding:0">
									<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
										<tr>
											<td align="center" valign="middle" colspan="3" class="border_bottom" style="line-height:42px">Adult Person to be contracted in case of Emergency</td>
										</tr>
										<tr style="line-height:40px">
											<td align="center" valign="middle" class="border_right" style="width:100px">Name and Relationship</td>
											<td align="center" valign="middle" class="border_right" style="width:100px">Address</td>
											<td align="center" valign="middle" style="width:100px">Mobile</td>
										</tr>
									</table>
								</div>
							</td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td" style="width:200px"><div class="listing_th_padding">Remarks</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td" style="width:200px"><div class="listing_th_padding">*Signature of Mines<br> Manager</div></td>
						</tr>
						<tr>
							<td align="left" valign="top" class="border_bottom border_right">
								<div>
									<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
										<tr style="line-height:40px">
											<td align="center" valign="middle" class="border_right" style="width:100px;padding:5px">
												<input type="text" name="nomi_name" id="nomi_name" value="" style="width:100%" />
											</td>
											<td align="center" valign="middle" style="width:100px;padding:5px">
												<input type="text" name="nomi_add" id="nomi_add" value="" style="width:100%" />
											</td>
										</tr>
									</table>
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div>
									<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
										<tr style="line-height:40px">
											<td align="center" valign="middle" class="border_right" style="width:100px;padding:5px">
												<input type="text" name="emergency_name" id="emergency_name" value="" style="width:100%" />
											</td>
											<td align="center" valign="middle" class="border_right" style="width:100px;padding:5px">
												<input type="text" name="emergency_add" id="emergency_add" value="" style="width:100%" />
											</td>
											<td align="center" valign="middle" style="width:100px;padding:5px">
												<input type="text" name="emergency_mobile" id="emergency_mobile" value="" style="width:100%" />
											</td>
										</tr>
									</table>
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="remark" id="remark" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="sign_of_mines" id="sign_of_mines" value="" />
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
				<?php 
					$regYear=(isset($_POST['regyear']) && $_POST['regyear']>0)?$_POST['regyear']:date('Y');
						
					$qry="SELECT * FROM customer_register_form_a_type_b WHERE customerid=%i AND YEAR(created_by)='%s'";
					$qry=$sql->query($qry, array($customerid, $regYear));
					$res=$db->query($qry);
					$cnt=$db->numRows($res);
					
					if($cnt>0){
				?>
					<div align="right" style="padding:10px">
						<form name="filterregform" id="filterregform" action="" method="post">
							<span>Select Year: </span>
							<select name="regyear" id="regyear" class="select_drop_down" style="width:100px;cursor:pointer" onchange="filterRegYears()">
								<option value="">Select</option>
								<?php 
									$yearq="SELECT YEAR(created_by) as year FROM customer_register_form_a_type_b GROUP BY YEAR(created_by) ORDER BY created_by DESC";
									$yearr=$db->query($yearq);
									$yearc=$db->numRows($yearr);
									while($yearrw=$db->fetchNextObject($yearr)){ ?>
										<option value="<?php echo $yearrw->year; ?>" <?php echo ($_POST['regyear']==$yearrw->year)?"selected='selected'":"" ;?> ><?php echo $yearrw->year; ?></option>
									<?php }
								?>
							</select>
							<input type="hidden" name="offset" id="offset" value="<?php echo $offset; ?>"/>
						</form>
					</div>
				<?php } ?>
				<div style="padding:20px 0;width: 100%;max-height: 500px;overflow: auto;">
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th valign="top" class="table-title border_left border_right">Actions</th>
								<th valign="top" class="table-title border_right">SI Number</th>
								<th valign="top" class="table-title border_right">Name</th>
								<th valign="top" class="table-title border_right">Token Number</th>
								<th valign="top" class="table-title border_right">Date of First<br> Appointment with<br> present Owner</th>
								<th valign="top" class="table-title border_right">Certificate of<br> age/fitness taken<br>(for 14 to 18 Years)</th>
								<th valign="top" class="table-title border_right">Place of<br> Employment<br> (Underground/Open<br> cast/Surface)</th>
								<th valign="top" class="table-title border_right">vocational_number</th>
								<th valign="top" class="table-title border_right">vocational_date</th>
								<th valign="top" class="table-title border_right">nomi_name</th>
								<th valign="top" class="table-title border_right">nomi_add</th>
								<th valign="top" class="table-title border_right">emergency_name</th>
								<th valign="top" class="table-title border_right">emergency_add</th>
								<th valign="top" class="table-title border_right">emergency_mobile</th>
								<th valign="top" class="table-title border_right">remark</th>
								<th valign="top" class="table-title border_right">sign_of_mines</th>
							</tr>
						</thead>
						<tbody>
						<?php
							if($cnt>0){
								$counter=1;
								while($rw=$db->fetchNextObject($res)){
									$id=intval($rw->id); 
						?>
							<tr>
								<td valign="middle" class="table-data borderall" style="padding:5px 25px 0 25px">
									<form name="registerformprint" id="registerformprint<?php echo $id; ?>" action="register-form-c-print.php" method="post">
										<input type="hidden" name="fromprint" id="fromprint" value="0">
										<input type="hidden" name="formid" id="formid" value="<?php echo $id; ?>">
									</form>
									<div>
										<div class="pull-left action-icon"><img src="images/delete-icon.png" onclick="deleteRegisterForm('c', <?php echo $id; ?>, <?php echo intval($rw->customerid); ?>)" title="Delete"></div>
										<div class="pull-left action-icon"><label title="Print" style="cursor:pointer" onclick="printRegisterfrom(<?php echo $id; ?>)">Print</lable></div>
										<div class="clearall">
									</div>
								</td>
								<td valign="top" class="table-data borderall" title="<?php echo intval($rw->si_no); ?>"><?php echo intval($rw->si_no); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->name); ?>"><?php echo trim($rw->name); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->token_number); ?>"><?php echo trim($rw->token_number); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo date("m/d/Y", strtotime($rw->date_of_first_appnt)); ?>"><?php echo date("m/d/Y", strtotime($rw->date_of_first_appnt)); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->cert_of_age); ?>"><?php echo trim($rw->cert_of_age); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->place_of_emp); ?>"><?php echo trim($rw->place_of_emp); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->vocational_number); ?>"><?php echo trim($rw->vocational_number); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo date("m/d/Y", strtotime($rw->vocational_date)); ?>"><?php echo date("m/d/Y", strtotime($rw->vocational_date)); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->nomi_name); ?>"><?php echo trim($rw->nomi_name); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->nomi_add); ?>"><?php echo ellipses(trim($rw->nomi_add), 50); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->emergency_name); ?>"><?php echo trim($rw->emergency_name); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->emergency_add); ?>"><?php echo trim($rw->emergency_add); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo intval($rw->emergency_mobile); ?>"><?php echo intval($rw->emergency_mobile); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->remark); ?>"><?php echo ellipses(trim($rw->remark), 50); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->sign_of_mines); ?>"><?php echo trim($rw->sign_of_mines); ?></td>
							</tr>
						<?php $counter++; } }else { ?>
							<tr>
								<td colspan="14">
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