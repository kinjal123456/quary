<?php include_once "header.php"; ?>
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
<Script>
	$(document).ready(function(){
		$( "#dob" ).datepicker();
	});
</Script>
<td valign="top" style="padding: 20px; width:100%">
	<div class="table-container">
		<div id="notify"><!-- --></div>
		<div valign="top" class="table-heading"><?php echo ($customerid>0)?'Update Customer - '.trim($custrow->customername).' details':'New Customer'; ?></div>
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
									<option>Select</option>
									<option>Male</option>
									<option>Female</option>
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
								<input type="text" name="specimensign" id="specimensign" value="" />
							</div>
						</td>
						<td align="left" valign="top" class="border_bottom border_right">
							<div class="listing_td_padding">
								<input type="text" name="remark" id="remark" value="" />
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="9"><input name="submitbtn" id="submitbtn" value="Save" class="add-button" style="margin-left:0" type="submit"></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</td>
<?php include_once "footer.php"; ?>