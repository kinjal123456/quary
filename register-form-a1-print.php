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
		
		$custnameq="SELECT companyname AS name FROM customers WHERE id=%i";
		$custnameq=$sql->query($custnameq, array(intval($row->customerid)));
		$cust_name=$db->queryUniqueValue($custnameq);
		
		$formlinq="SELECT emailid FROM customer_additional_info WHERE id=%i AND detailname='Shram Shuvidha LIN detail'";
		$formlinq=$sql->query($formlinq, array(intval($row->customerid)));
		$formlin=$db->queryUniqueValue($formlinq);
	}
?>
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
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">1. Sr No.</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">2. Employee<br /> Code</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">3. Name</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">4. Surname</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">5. Gender</div></td>
				</tr>
				<tr>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_left.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo intval($row->srno); ?>
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo trim($row->emp_code); ?>
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo trim($row->firstname); ?>
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo trim($row->lastname); ?>
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php if(intval($row->gender)==1) echo "Men"; else if(intval($row->gender)==2) echo "Woman"; else echo ""; ?>
						</div>
					</td>
				</tr>
				<tr><td style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">6. Father's/Spouse<br /> Name</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">7. Date of Birth</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">8. Nationality</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">9. Education<br /> Level</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">10. Date of<br /> Joining</div></td>
				</tr>
				<tr>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_left.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo trim($row->secondname); ?>
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo (strlen($row->dob)>0)?date("m/d/Y", strtotime($row->dob)):""; ?>
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo trim($row->nationality); ?>
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo trim($row->education); ?>
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo date("m/d/Y", strtotime($row->doj)); ?>
						</div>
					</td>
				</tr>
				<tr><td style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">11. Designation</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">12. Category<br /> Address<br /> *(HS|S|SS|US)</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">13. Type of<br />Employment</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">14. Mobile</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">15. UAN</div></td>
				</tr>
				<tr>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_left.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo trim($row->designation); ?>
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_left.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo trim($row->category_address); ?>
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo trim($row->emp_type); ?>
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo intval($row->mobile); ?>
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo trim($row->uan); ?>
						</div>
					</td>
				</tr>
				<tr><td style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">16. PAN</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">17. ESIC IP</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">18. LWF</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">19. AADHAAR</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">20. Bank A/C<br /> Number</div></td>
				</tr>
				<tr>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_left.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo trim($row->pan); ?>
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo trim($row->esic_ip); ?>
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo trim($row->lwf); ?>
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo trim($row->aadhaar_no); ?>
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo intval($row->bank_ac_no); ?>
						</div>
					</td>
				</tr>
				<tr><td style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">21. Bank</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">22. Branch<br /> (IFSC)</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left.$border_right; ?>"><div style="<?php echo $listing_th_padding; ?>">23. Present<br /> Address</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_right; ?>"><div style="<?php echo $listing_th_padding; ?>">24. Permanent</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_right; ?>"><div style="<?php echo $listing_th_padding; ?>">25. Service Book No.</div></td>
				<tr>
				<tr>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_left.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo trim($row->bank); ?>
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo intval($row->branch_ifsc_code); ?>
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo trim($row->present_address); ?>
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo trim($row->permenent_address); ?>
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo intval($row->service_book_no); ?>
						</div>
					</td>
				</tr>
				<tr><td style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left.$border_right; ?>"><div style="<?php echo $listing_th_padding; ?>">26. Date of Exit</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left.$border_right; ?>"><div style="<?php echo $listing_th_padding; ?>">27. Reason for Exit</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_right; ?>"><div style="<?php echo $listing_th_padding; ?>">28. Mark of Identification</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_right; ?>"><div style="<?php echo $listing_th_padding; ?>">29. Photo</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_right; ?>"><div style="<?php echo $listing_th_padding; ?>">30. Specimen Signature/Thumb<br /> Impression</div></td>
				</tr>
				<tr>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_left.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo strlen(trim($row->date_of_exit)>0)?date("m/d/Y", strtotime(trim($row->date_of_exit))):""; ?>
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo trim($row->reason_for_exit); ?>
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo trim($row->id_mark); ?>
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php if(strlen(trim($row->photo))>0){ ?>
								<img src="upload/<?php echo intval($row->customerid).'/'.$formid.'/image/'.trim($row->photo); ?>" style="width:50px;height:50px" >
							<?php } ?>
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php if(strlen(trim($row->signature_thumb_image))>0){ ?>
								<img src="upload/<?php echo intval($row->customerid).'/'.$formid.'/sign/'.trim($row->signature_thumb_image); ?>" style="width:50px;height:50px" >
							<?php } ?>
						</div>
					</td>
				</tr>
				<tr><td style="height:10px"><!-- --></td></tr>
				<tr>
					<td colspan="5" align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left.$border_right; ?>"><div style="<?php echo $listing_th_padding; ?>">31. Remarks</div></td>
				</tr>
				<tr>
					<td colspan="5" align="center" valign="top" style="<?php echo $border_bottom.$border_left.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo trim($row->remark); ?>
						</div>
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>
<?php } ?>