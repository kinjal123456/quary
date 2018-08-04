<?php
    $page_title = "[PART B: FOR THE MINES ACT, 1952 (35 of 1952) ONLY]";
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
		
		$query="SELECT * FROM customer_register_form_a_type_b WHERE id=%i";
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
			<div style="<?php echo $register_form_upper_hadding_lg; ?>">[PART B: FOR THE MINES ACT, 1952 (35 of 1952) ONLY]</div>
		</div>
		<div>
			<table border="0" cellpadding="0" cellspacing="0" style="<?php echo $list_table; ?>">
				<tr>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left; ?>">
						<div style="<?php echo $listing_th_padding; ?>">SI Number in<br>Employee Register</div>
					</td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left; ?>">
						<div style="<?php echo $listing_th_padding; ?>">Name</div>
					</td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left; ?>">
						<div style="<?php echo $listing_th_padding; ?>">Token Number<br>Issued</div>
					</td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left; ?>">
						<div style="<?php echo $listing_th_padding; ?>">Date of First<br> Appointment with<br> present Owner</div>
					</td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left.$border_right; ?>">
						<div style="<?php echo $listing_th_padding; ?>">Certificate of<br> age/fitness taken<br>(for 14 to 18 Years)</div>
					</td>
				</tr>
				<tr>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_left; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo intval($row->si_no); ?>
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_left; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo trim($row->name); ?>
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_left; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo trim($row->token_number); ?>
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_left; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo (strlen(trim($row->date_of_first_appnt))>0)?date("m/d/Y", strtotime($row->date_of_first_appnt)):""; ?>
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_left.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo trim($row->cert_of_age); ?>
						</div>
					</td>
				</tr>
				<tr><td style="height:10px"><!-- --></td></tr>
			</table>
			<table border="0" cellpadding="0" cellspacing="0" style="<?php echo $list_table; ?>">
				<tr>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left.$border_right; ?>">
						<div style="<?php echo $listing_th_padding; ?>">Place of<br> Employment<br> (Underground/Open<br> cast/Surface)</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_top.$border_bottom.$border_left.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>; padding:0">
							<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
								<tr>
									<td align="center" valign="middle" colspan="2" style="<?php echo $list_table_th.$border_bottom?>;line-height:42px">
										<div style="<?php echo $listing_th_padding; ?>">Certificate of Vocational Training</div>
									</td>
								</tr>
								<tr style="line-height:40px">
									<td align="center" valign="middle" style="<?php echo $border_right; ?>;width:100px">Number</td>
									<td align="center" valign="middle" style="width:100px">Date</td>
								</tr>
							</table>
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_top.$border_bottom.$border_left.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>; padding:0">
							<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
								<tr>
									<td align="center" valign="middle" colspan="2" style="<?php echo $list_table_th.$border_bottom?>;line-height:42px">
										<div style="<?php echo $listing_th_padding; ?>">Nominee</div>
									</td>
								</tr>
								<tr style="line-height:40px">
									<td align="center" valign="middle" style="<?php echo $border_right; ?>width:100px">Name</td>
									<td align="center" valign="middle" style="<?php echo $border_right; ?>width:100px">Address</td>
								</tr>
							</table>
						</div>
					</td>
				</tr>
				<tr>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_left.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo trim($row->place_of_emp); ?>
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div>
							<table border="0" cellpadding="0" cellspacing="0" style="width:100%; height:51px">
								<tr>
									<td valign="top" style="<?php echo $table_data.$border_right; ?>width:100px;" title="<?php echo trim($row->vocational_number); ?>" style="width:101px;border-top:none"><?php echo trim($row->vocational_number); ?></td>
									<td valign="top" style="<?php echo $table_data; ?>width:100px;" title="<?php echo (strlen($row->vocational_date)>0)?date("m/d/Y", strtotime($row->vocational_date)):""; ?>" style="width:100px;border-top:none"><?php echo (strlen($row->vocational_date)>0)?date("m/d/Y", strtotime($row->vocational_date)):""; ?></td>
								</tr>
							</table>
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_left.$border_right; ?>">
						<div>
							<table border="0" cellpadding="0" cellspacing="0" style="width:100%;height:51px">
								<tr>
									<td valign="top" style="<?php echo $table_data.$border_right; ?>width:100px;" title="<?php echo trim($row->nomi_name); ?>" style="width:100px;border-top:none"><?php echo trim($row->nomi_name); ?></td>
									<td valign="top" style="<?php echo $table_data; ?>width:100px;" title="<?php echo trim($row->nomi_add); ?>" style="width:100px;border-top:none;"><?php echo ellipses(trim($row->nomi_add), 50); ?></td>
								</tr>
							</table>
						</div>
					</td>
				</tr>
				<tr><td style="height:10px"><!-- --></td></tr>
			</table>
			<table border="0" cellpadding="0" cellspacing="0" style="<?php echo $list_table; ?>">
				<tr>
					<td align="center" valign="top" style="<?php echo $border_top.$border_bottom.$border_left; ?>">
						<div style="<?php echo $listing_td_padding; ?>; padding:0">
							<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
								<tr>
									<td align="center" valign="middle" colspan="3" style="<?php echo $list_table_th.$border_bottom?>;line-height:42px">
										<div style="<?php echo $listing_th_padding; ?>">Adult Person to be contracted in case of Emergency</div>
									</td>
								</tr>
								<tr style="line-height:40px">
									<td align="center" valign="middle" style="<?php echo $border_right; ?>;width:100px">Name and Relationship</td>
									<td align="center" valign="middle" style="<?php echo $border_right; ?>;width:100px">Address</td>
									<td align="center" valign="middle" style="width:100px">Mobile</td>
								</tr>
							</table>
						</div>
					</td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left.$border_right; ?>"><div style="<?php echo $listing_th_padding; ?>">remark</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left.$border_right; ?>"><div style="<?php echo $listing_th_padding; ?>">*Signature of Mines<br> Manager</div></td>
				</tr>
				<tr>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div>
							<table border="0" cellpadding="0" cellspacing="0" style="width:100%;height:51px">
								<tr>
									<td align="center" valign="top" style="<?php echo $table_data.$border_right; ?>width:100px;" title="<?php echo trim($row->emergency_name); ?>" style="width:100px;border-top:none"><?php echo trim($row->emergency_name); ?></td>
									<td align="center" valign="top" style="<?php echo $table_data.$border_right; ?>width:100px;" title="<?php echo trim($row->emergency_add); ?>" style="width:100px;border-top:none"><?php echo trim($row->emergency_add); ?></td>
									<td align="center" valign="top" style="<?php echo $table_data; ?>width:100px;" title="<?php echo intval($row->emergency_mobile); ?>" style="width:100px;border-top:none"><?php echo intval($row->emergency_mobile); ?></td>
								</tr>
							</table>
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_left.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo trim($row->remark); ?>
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_left.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo trim($row->sign_of_mines); ?>
						</div>
					</td> 
				</tr>
			</table>
		</div>
	</div>
</div>
<?php } ?>