<?php
	include_once "libs/data/db.connect.php";
	
	//Delete register form a
	if(isset($_POST['action']) && trim($_POST['action'])=="registerFormDelete"){
		$type['type']="error";
		$formid=intval($_POST['formid']);
		$customerid=intval($_POST['customerid']);
		
		if($formid>0){
			$query="DELETE FROM customer_register_form_a_type_a WHERE id=%i AND customerid=%i";
			$query=$sql->query($query, array($formid, $customerid));
			if($db->query($query)){
				$type['type']="success";
			}
		}
		echo json_encode($type);
		exit(0);
	}

	if(isset($_POST['submitbtn'])){
		$status="error";
		$custid=intval($_POST['custid']);
		$dateofjoining=strlen(trim($_POST['dob'])>0)?date("Y-m-d", strtotime(trim($_POST['dob']))):"";
		$dateofjoin=strlen(trim($_POST['doj'])>0)?date("Y-m-d", strtotime(trim($_POST['doj']))):"";
		$dateofexit=strlen(trim($_POST['dateofexit'])>0)?date("Y-m-d", strtotime(trim($_POST['dateofexit']))):"";
		
		if($custid>0){
			$query="INSERT INTO customer_register_form_a_type_a SET
													  `customerid`=%i,
													  `srno`=%i,
													  `emp_code`='%s',
													  `firstname`='%s',
													  `lastname`='%s',
													  `gender`=%i,
													  `secondname`='%s',
													  `dob`='%s',
													  `nationality`='%s',
													  `education`='%s',
													  `doj`='%s',
													  `designation`='%s',
													  `category_address`=%i,
													  `emp_type`='%s',
													  `mobile`=%i,
													  `uan`='%s',
													  `pan`='%s',
													  `esic_ip`='%s',
													  `lwf`='%s',
													  `aadhaar_no`='%s',
													  `bank_ac_no`=%i,
													  `bank`='%s',
													  `branch_ifsc_code`=%i,
													  `present_address`='%s',
													  `permenent_address`='%s',
													  `service_book_no`=%i,
													  `date_of_exit`='%s',
													  `reason_for_exit`='%s',
													  `id_mark`='%s',
									 				  `photo`='%s',
													  `signature_thumb_image`='%s',
													  `remark`='%s',
													  `created_by`=NOW(),
													  `updated_by`=NOW()";
			$query=$sql->query($query, array($custid, intval($_POST['srno']), trim($_POST['empcode']), trim($_POST['name']), 
					trim($_POST['surname']), intval($_POST['gender']), trim($_POST['secondname']), $dateofbirth, 
					trim($_POST['nationality']), trim($_POST['education']), $dateofjoin, trim($_POST['designation']), 
					intval($_POST['cat_add']), trim($_POST['emptype']), intval($_POST['mobile']), trim($_POST['uan']), trim($_POST['pan']),
					trim($_POST['esicip']), trim($_POST['lwf']), trim($_POST['aadharno']), intval($_POST['bankacno']), trim($_POST['bankname']),
					intval($_POST['ifsccode']), trim($_POST['presentadd']), trim($_POST['permanantadd']), intval($_POST['servicebookno']), $dateofexit,
					trim($_POST['reasonforexit']), trim($_POST['idmark']), trim($_POST['photo']), trim($_POST['specimensign']), trim($_POST['remark'])
			));
			if($db->query($query)){
				$status="success";
				
				$lastinsId=$db->lastInsertedId();
				
				$target_dir = "uploads/photos/".$lastinsId."/"
				$target_file = $target_dir . basename($_FILES["photo"]["name"]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				// Check if image file is a actual image or fake image
				if(isset($_POST["photo"])) {
					$check = getimagesize($_FILES["photo"]["tmp_name"]);
					if($check !== false) {
						$upquery="UPDATE customer_register_form_a_type_a SET photo='%s' WHERE id=%i";
						$upquery=$sql->query($upquery, array(trim($_POST['photo']), $lastinsId));
						if($db->query($upquery)){
							$status="success";
						}
					} else {
						$status="imageerror";
					}
				}
				
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
<script type="text/javascript" src="js/customer-register-form-a-1.js"></script>
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
		padding:5px;
	}
	.table-title {
	    padding: 0 10px;
	    vertical-align: middle;
	    min-width: 100px;
	    line-height:inherit;
	}
	.table-data {
	    padding: 0 28px;
	    line-height: 25px;
	}
</style>
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
				<div align="center">
					<div class="register_form_upper_hadding_lg">SCHEDULE</div>
					<div class="register_form_upper_hadding_sm">[See rule 2(1)]</div>
					<div class="register_form_upper_hadding_lg">FORM A</div>
					<div class="register_form_upper_hadding_lg">FORMAT OF EMPLOYEE REGISTER</div>
					<div class="register_form_upper_hadding_sm">[Part-A: For all Establishments]</div>
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
						<tr><td colspan="6" style="height:10px"><!-- --></td></tr>
					</table>
				</div>
				<form name="registerform" id="registerform" action="" method="post">
					<table border="0" cellpadding="0" cellspacing="0" class="list_table addlisting" style="width:100%">
						<tr>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_left border_right register_table_td"><div class="listing_th_padding">Sr No.</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Employee<br /> Code</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Name</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Surname</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Gender</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Father's/Spouse<br /> Name</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Date of Birth</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Nationality</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Education<br /> Level</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Date of<br /> Joining</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Designation</div></td>
						</tr>
						<tr>
							<td align="left" valign="top" class="border_bottom border_left border_right">
								<div class="listing_td_padding">
									<input type="text" name="srno" id="srno" value="">
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="empcode" id="empcode" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="name" id="name" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="surname" id="surname" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<select type="text" name="gender" id="gender" class="select_drop_down" style="width:100%">
										<option value="0">Select</option>
										<option value="1">Male</option>
										<option value="2">Female</option>
									</select>
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="secondname" id="secondname" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="dob" id="dob" value="" style="width:100%" readonly="readonly" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="nationality" id="nationality" value="Indian" readonly="readonly" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="education" id="education" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="doj" id="doj" value="" style="width:100%" readonly="readonly" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="designation" id="designation" value="" />
								</div>
							</td>
						</tr>
						<tr><td style="height:10px"><!-- --></td></tr>
					</table>
					<table border="0" cellpadding="0" cellspacing="0" class="list_table addlisting" style="width:100%">
						<tr>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_left border_right register_table_td"><div class="listing_th_padding">Category<br /> Address<br /> *(HS|S|SS|US)</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Type of<br />Employment</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Mobile</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">UAN</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">PAN</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">ESIC IP</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">LWF</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">AADHAAR</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Bank A/C<br /> Number</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Bank</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Branch<br /> (IFSC)</div></td>
						</tr>
						<tr>
							<td align="left" valign="top" class="border_bottom border_left border_right">
								<div class="listing_td_padding">
									<select name="cat_add" id="cat_add" class="select_drop_down" style="width:100%">
										<option value="">Select</option>
										<?php
											foreach($REGISTER_FORM_A_1_CATEGORY_ADDRESS as $catkey => $catvalue){
												echo '<option value="'.$catkey.'">'.$catvalue.'</option>';
											}
										?>
									</select>
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="emptype" id="emptype" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="mobile" id="mobile" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="uan" id="uan" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="pan" id="pan" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="esicip" id="esicip" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="lwf" id="lwf" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="aadharno" id="aadharno" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="bankacno" id="bankacno" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="bankname" id="bankname" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="ifsccode" id="ifsccode" value="" />
								</div>
							</td>
						</tr>
						<tr><td style="height:10px"><!-- --></td></tr>
					</table>
					<table border="0" cellpadding="0" cellspacing="0" class="list_table addlisting" style="width:100%">
						<tr>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_left border_right"><div class="listing_th_padding">Present<br /> Address</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right"><div class="listing_th_padding">Permanent</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right"><div class="listing_th_padding" style="width:110px">Service Book No.</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right"><div class="listing_th_padding">Date of Exit</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right"><div class="listing_th_padding">Reason for Exit</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right"><div class="listing_th_padding">Mark of Identification</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right"><div class="listing_th_padding">Photo</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right"><div class="listing_th_padding">Specimen Signature/Thumb<br /> Impression</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right"><div class="listing_th_padding">Remarks</div></td>
						</tr>
						<tr>
							<td align="left" valign="top" class="border_bottom border_left border_right">
								<div class="listing_td_padding">
									<input type="text" name="presentadd" id="presentadd" value="">
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="permanantadd" id="permanantadd" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="servicebookno" id="servicebookno" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="dateofexit" id="dateofexit" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="reasonforexit" id="reasonforexit" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="idmark" id="idmark" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="file" name="photo" id="photo" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="file" name="specimensign" id="specimensign" value="" />
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
				<div style="padding:20px 0;width: 100%;max-height: 500px;overflow: auto;">
					<table id="example" class="table table-bordered table-condensed" style="width:100%">
						<thead>
							<tr>
								<th valign="top" class="table-title">Actions</th>
								<th valign="top" class="table-title">Sr No.</th>
								<th valign="top" class="table-title">Employee Code</th>
								<th valign="top" class="table-title">Name</th>
								<th valign="top" class="table-title">Surname</th>
								<th valign="top" class="table-title">Gender</th>
								<th valign="top" class="table-title">Father's/Spouse name</th>
								<th valign="top" class="table-title">Dob</th>
								<th valign="top" class="table-title">Nationality</th>
								<th valign="top" class="table-title">Education</th>
								<th valign="top" class="table-title">Doj</th>
								<th valign="top" class="table-title">Designation</th>
								<th valign="top" class="table-title">Category Address</th>
								<th valign="top" class="table-title">Employee Type</th>
								<th valign="top" class="table-title">Mobile</th>
								<th valign="top" class="table-title">UAN</th>
								<th valign="top" class="table-title">PAN</th>
								<th valign="top" class="table-title">ESIC IP</th>
								<th valign="top" class="table-title">LWF</th>
								<th valign="top" class="table-title">Aadhaar Number</th>
								<th valign="top" class="table-title">Bank A/C Number</th>
								<th valign="top" class="table-title">Bank</th>
								<th valign="top" class="table-title">Branch IFSC Code</th>
								<th valign="top" class="table-title">Present Address</th>
								<th valign="top" class="table-title">Permenent Address</th>
								<th valign="top" class="table-title">Service Book Number</th>
								<th valign="top" class="table-title">Date of Exit</th>
								<th valign="top" class="table-title">Reason for Exit</th>
								<th valign="top" class="table-title">Mark of Identif ication</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$qry="SELECT * FROM customer_register_form_a_type_a WHERE customerid=%i";
								$qry=$sql->query($qry, array($customerid));
								$res=$db->query($qry);
								$cnt=$db->numRows($res);
								if($cnt>0){
									while($rw=$db->fetchNextObject($res)){
										$id=intval($rw->id); 
							?>
							<tr>
								<td valign="middle" class="table-data borderall" style="padding-top:5px">
									<div>
										<div class="pull-left action-icon"><img src="images/delete-icon.png" onclick="deleteRegisterForm('a-1', <?php echo $id; ?>, <?php echo intval($rw->customerid); ?>)" title="Delete"></div>
									</div>
								</td>
								<td valign="top" class="table-data borderall" title="<?php echo intval($rw->srno); ?>"><?php echo intval($rw->srno); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->emp_code); ?>"><?php echo trim($rw->emp_code); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->firstname); ?>"><?php echo ellipses(trim($rw->firstname), 50); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim ($rw->lastname); ?>"><?php echo ellipses(trim($rw->lastname), 50); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo (intval($rw->gender)==1)?"Men":"Woman"; ?>"><?php echo (intval($rw->gender)==1)?"Men":"Woman"; ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->secondname); ?>"><?php echo ellipses(trim($rw->secondname), 50); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->dob); ?>"><?php echo date("m/d/Y", strtotime(trim($rw->dob))); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->nationality); ?>"><?php echo ellipses(trim($rw->nationality), 50); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->education); ?>"><?php echo ellipses(trim($rw->education), 50); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->doj); ?>"><?php echo date("m/d/Y", strtotime(trim($rw->doj))); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->designation); ?>"><?php echo ellipses(trim($rw->designation), 50); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->category_address); ?>"><?php echo ellipses(trim($rw->category_address), 50); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->emp_type); ?>"><?php echo ellipses(trim($rw->emp_type), 50); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->mobile); ?>"><?php echo ellipses(trim($rw->mobile), 50); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->uan); ?>"><?php echo ellipses(trim($rw->uan), 50); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->pan); ?>"><?php echo ellipses(trim($rw->pan), 50); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->esic_ip); ?>"><?php echo ellipses(trim($rw->esic_ip), 50); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->lwf); ?>"><?php echo ellipses(trim($rw->lwf), 50); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->aadhaar_no); ?>"><?php echo ellipses(trim($rw->aadhaar_no), 50); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->bank_ac_no); ?>"><?php echo ellipses(trim($rw->bank_ac_no), 50); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->bank); ?>"><?php echo ellipses(trim($rw->bank), 50); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->branch_ifsc_code); ?>"><?php echo ellipses(trim($rw->branch_ifsc_code), 50); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->present_address); ?>"><?php echo ellipses(trim($rw->present_address), 50); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->permenent_address); ?>"><?php echo ellipses(trim($rw->permenent_address), 50); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->service_book_no); ?>"><?php echo ellipses(trim($rw->service_book_no), 50); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->date_of_exit); ?>"><?php echo ellipses(trim($rw->date_of_exit), 50); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->reason_for_exit); ?>"><?php echo ellipses(trim($rw->reason_for_exit), 50); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->id_mark); ?>"><?php echo ellipses(trim($rw->id_mark), 50); ?></td>
							</tr>
							<?php } } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</td>
<?php include_once "footer.php"; ?>