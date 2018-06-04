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
		$type["registerstaus"]="error";
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
<link href="css/register-styles.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/customer-register-form-a-1.js"></script>
<td valign="top" style="padding: 20px; width:100%">
	<div class="table-container">
		<div id="notify"><!-- --></div>
		<div valign="top" class="table-heading"><?php echo ($customerid>0)?'Register Form A - Type B':''; ?></div>
		<div style="padding: 20px 0;">
			<div style="border-bottom: 1px solid #cccccc;">
				<div class="tab_container">
					<a class="tab active_tab" id="general">General Details</a>
					<a class="tab" id="additional">Additional Details</a>
					<a class="tab" id="bills">Bills</a>
					<a class="tab" id="registers">Registers</a>
				</div>
			</div>
			<div style="padding:20px">
				<form name="register_a_1" id="register_a_1" action="" method="post">
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
									<input type="text" name="dob" id="dob" value="" style="width:100%" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="nationality" id="nationality" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="education" id="education" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="doj" id="doj" value="" style="width:100%" />
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
				<div style="padding:20px 0">
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td valign="top" class="table-title" style="width:50px">Sr No.</td>
							<td valign="top" class="table-title" style="width:100px">Employee Code</td>
							<td valign="top" class="table-title" style="width:300px">Name</td>
							<td valign="top" class="table-title" style="width:300px">Surname</td>
							<td valign="top" class="table-title" style="width:200px">Father's/Spouse name</td>
							<td valign="top" class="table-title" style="width:100px">Actions</td>
						</tr>
						<?php
							$qry="SELECT id, customerid, srno, emp_code, firstname, lastname, secondname FROM customer_register_form_a_type_a WHERE customerid=%i";
							$qry=$sql->query($qry, array($customerid));
							$res=$db->query($qry);
							$cnt=$db->numRows($res);
							if($cnt>0){
								while($rw=$db->fetchNextObject($res)){
									$id=intval($rw->id); 
						?>
						<tr>
							<td valign="top" class="table-data" title="<?php echo intval($rw->srno); ?>"><?php echo intval($rw->srno); ?></td>
							<td valign="top" class="table-data" title="<?php echo trim($rw->emp_code); ?>"><?php echo trim($rw->emp_code); ?></td>
							<td valign="top" class="table-data" title="<?php echo trim($rw->firstname); ?>"><?php echo ellipses(trim($rw->firstname), 50); ?></td>
							<td valign="top" class="table-data" title="<?php echo trim ($rw->lastname); ?>"><?php echo ellipses(trim($rw->lastname), 50); ?></td>
							<td valign="top" class="table-data" title="<?php echo trim($rw->secondname); ?>"><?php echo ellipses(trim($rw->secondname), 50); ?></td>
							<td valign="middle" class="table-data">
								<div>
									<div class="pull-left action-icon"><img src="images/delete-icon.png" onclick="deleteRegisterForm(this, <?php echo $id; ?>, <?php echo intval($rw->customerid); ?>)" title="Delete"></div>
								</div>
							</td>
						</tr>
						<?php } }else { ?>
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