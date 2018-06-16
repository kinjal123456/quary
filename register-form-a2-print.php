<?php
    $page_title = "Register Form A";
    session_start();
    require_once 'libs/data/db.connect.php';
    require_once 'style-print.php';
?>
<?php
if(isset($_POST['fromprint']) && $_POST['fromprint'] == 1){?>
    <script type="text/javascript" src="jquery/jquery-1.8.3.js"></script>
    <script>
        $(document).ready(function(){
            window.print();
        });
    </script>
<?php }?>
<style>
    body{
        background-color:#ffffff;
        font-size: 13px;
        margin:0;
        padding:0;
        font-family: Arial; 
        line-height: 18px;
        color:#676767;
        height: 100%;
    }
    tbody,thead{
        font-size: 12px;
    }
</style>
    <!--first table-->
<?php 
if(isset($_POST['fromprint']) && $_POST['fromprint'] == 1){ 
	if(isset($_POST['formid']) && intval($_POST['formid'])>0){
		$formid=intval($_POST['formid']);
		
		$query="SELECT * FROM customer_register_form_a_type_a WHERE id=%i";
		$query=$sql->query($query, array($formid));
		$result=$db->query($query);
		$count=$db->numRows($result);
		$row=$db->fetchNextObject($result);
		
		$custnameq="SELECT CONCAT(firstname, ' ', lastname) AS name FROM customers WHERE id=%i";
		$custnameq=$sql->query($custnameq, array(intval($row->customerid)));
		$cust_name=$db->queryUniqueValue($custnameq);
		
		$formlinq="SELECT emailid FROM customer_additional_info WHERE id=%i AND detailname='Shram Shuvidha LIN detail'";
		$formlinq=$sql->query($formlinq, array(intval($row->customerid)));
		$formlin=$db->queryUniqueValue($formlinq);
	}
?>
<title>Quarry<?php if(isset($page_title)) echo " : ".$page_title; ?></title>
<div style="padding:10px 0;">
		<div align="center">
			<div style="<?php echo $register_form_upper_hadding_lg; ?>">SCHEDULE</div>
			<div style="<?php echo $register_form_upper_hadding_sm; ?>">[See rule 2(1)]</div>
			<div style="<?php echo $register_form_upper_hadding_lg; ?>">FORM A</div>
			<div style="<?php echo $register_form_upper_hadding_lg; ?>">FORMAT OF EMPLOYEE REGISTER</div>
			<div style="<?php echo $register_form_upper_hadding_sm; ?>"[Part-A: For all Establishments]</div>
		</div>
		<div>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td style="font-weight:bold">Name of the Establishment</td>
					<td><?php echo $cust_name; ?></td>
					<td style="font-weight:bold">Name of Owner</td>
					<td>Jayeshbhai Desai</td>
					<td style="font-weight:bold">LIN</td>
					<td><?php echo (strlen($formlin)>0)?$formlin:"-"; ?></td>
				</tr>
				<tr><td colspan="6" style="height:10px"><!-- --></td></tr>
			</table>
		</div>
		<div>
			<table border="0" cellpadding="0" cellspacing="0" style="<?php echo $list_table.addlisting; ?>">
				<tr>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">Sr No.</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">Employee<br /> Code</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">Name</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">Surname</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">Gender</div></td>
				</tr>
				<tr>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_left.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<input type="text" name="srno" id="srno" value="<?php echo intval($row->srno); ?>" readonly="readonly" style="border:0" />
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<input type="text" name="empcode" id="empcode" value="<?php echo trim($row->empcode); ?>" readonly="readonly" style="border:0" />
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<input type="text" name="name" id="name" value="<?php echo trim($row->name); ?>" readonly="readonly" style="border:0" />
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<input type="text" name="surname" id="surname" value="<?php echo trim($row->surname); ?>" readonly="readonly" style="border:0" />
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<input type="text" name="gender" id="gender" value="<?php echo (intval($row->gender)>0)?"Male":"Female"; ?>" readonly="readonly" style="border:0" />
						</div>
					</td>
				</tr>
				<tr><td style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">Father's/Spouse<br /> Name</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">Date of Birth</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">Nationality</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">Education<br /> Level</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">Date of<br /> Joining</div></td>
				</tr>
				<tr>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_left.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<input type="text" name="secondname" id="secondname" value="<?php echo trim($row->secondname); ?>" readonly="readonly" style="border:0" />
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<input type="text" name="dob" id="dob" value="<?php echo (strlen($row->dob)>0)?date("m/d/Y", strtotime($row->dob)):""; ?>" readonly="readonly" style="border:0" />
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<input type="text" name="nationality" id="nationality" value="Indian" readonly="readonly" style="border:0" />
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<input type="text" name="education" id="education" value="<?php echo trim($row->education); ?>" readonly="readonly" style="border:0" />
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<input type="text" name="doj" id="doj" value="<?php echo date("m/d/Y", strtotime($row->doj)); ?>" readonly="readonly" readonly="readonly" style="border:0" />
						</div>
					</td>
				</tr>
				<tr><td style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">Designation</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">Category<br /> Address<br /> *(HS|S|SS|US)</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">Type of<br />Employment</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">Mobile</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">UAN</div></td>
				</tr>
				<tr>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_left.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<input type="text" name="designation" id="designation" value="<?php echo trim($row->designation); ?>" readonly="readonly" style="border:0" />
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_left.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<input type="text" name="cat_add" id="cat_add" value="<?php echo intval($row->cat_add); ?>" readonly="readonly" style="border:0" />
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<input type="text" name="emptype" id="emptype" value="<?php echo trim($row->emptype); ?>" readonly="readonly" style="border:0" />
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<input type="text" name="mobile" id="mobile" value="<?php echo intval($row->mobile); ?>" readonly="readonly" style="border:0" />
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<input type="text" name="uan" id="uan" value="<?php echo trim($row->uan); ?>" readonly="readonly" style="border:0" />
						</div>
					</td>
				</tr>
				<tr><td style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">PAN</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">ESIC IP</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">LWF</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">AADHAAR</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">Bank A/C<br /> Number</div></td>
				</tr>
				<tr>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_left.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<input type="text" name="pan" id="pan" value="<?php echo trim($row->pan); ?>" readonly="readonly" style="border:0" />
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<input type="text" name="esicip" id="esicip" value="<?php echo trim($row->esicip); ?>" readonly="readonly" style="border:0" />
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<input type="text" name="lwf" id="lwf" value="<?php echo trim($row->lwf); ?>" readonly="readonly" style="border:0" />
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<input type="text" name="aadharno" id="aadharno" value="<?php echo trim($row->aadharno); ?>" readonly="readonly" style="border:0" />
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<input type="text" name="bankacno" id="bankacno" value="<?php echo intval($row->bankacno); ?>" readonly="readonly" style="border:0" />
						</div>
					</td>
				</tr>
				<tr><td style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">Bank</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">Branch<br /> (IFSC)</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left.$border_right; ?>"><div style="<?php echo $listing_th_padding; ?>">Present<br /> Address</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_right; ?>"><div style="<?php echo $listing_th_padding; ?>">Permanent</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_right; ?>"><div style="<?php echo $listing_th_padding; ?>">Service Book No.</div></td>
				<tr>
				<tr>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_left.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<input type="text" name="bankname" id="bankname" value="<?php echo trim($row->bankname); ?>" readonly="readonly" style="border:0" />
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<input type="text" name="ifsccode" id="ifsccode" value="<?php echo intval($row->ifsccode); ?>" readonly="readonly" style="border:0" />
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<input type="text" name="presentadd" id="presentadd" value="<?php echo trim($row->presentadd); ?>" readonly="readonly" style="border:0" />
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<input type="text" name="permanantadd" id="permanantadd" value="<?php echo trim($row->permanantadd); ?>" readonly="readonly" style="border:0" />
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<input type="text" name="servicebookno" id="servicebookno" value="<?php echo trim($row->servicebookno); ?>" readonly="readonly" style="border:0" />
						</div>
					</td>
				</tr>
				<tr><td style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left.$border_right; ?>"><div style="<?php echo $listing_th_padding; ?>">Date of Exit</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left.$border_right; ?>"><div style="<?php echo $listing_th_padding; ?>">Reason for Exit</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_right; ?>"><div style="<?php echo $listing_th_padding; ?>">Mark of Identification</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_right; ?>"><div style="<?php echo $listing_th_padding; ?>">Photo</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_right; ?>"><div style="<?php echo $listing_th_padding; ?>">Specimen Signature/Thumb<br /> Impression</div></td>
				</tr>
				<tr>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_left.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<input type="text" name="dateofexit" id="dateofexit" value="<?php echo strlen(trim($row->dateofexit)>0)?date("m/d/Y", strtotime(trim($row->dateofexit))):""; ?>" readonly="readonly" style="border:0" />
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<input type="text" name="reasonforexit" id="reasonforexit" value="<?php echo trim($row->reasonforexit); ?>" readonly="readonly" style="border:0" />
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<input type="text" name="idmark" id="idmark" value="<?php echo trim($row->idmark); ?>" readonly="readonly" style="border:0" />
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<input type="text" name="photo" id="photo" value="<?php echo trim($row->photo); ?>" readonly="readonly" style="border:0" />
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<input type="text" name="specimensign" id="specimensign" value="<?php echo trim($row->specimensign); ?>" readonly="readonly" style="border:0" />
						</div>
					</td>
				</tr>
				<tr><td style="height:10px"><!-- --></td></tr>
				<tr>
					<td colspan="5" align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left.$border_right; ?>"><div style="<?php echo $listing_th_padding; ?>">Remarks</div></td>
				</tr>
				<tr>
					<td colspan="5" align="center" valign="top" style="<?php echo $border_bottom.$border_left.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<input type="text" name="remark" id="remark" value="<?php echo trim($row->remark); ?>" readonly="readonly" style="border:0" />
						</div>
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>
<?php } ?>