<?php
	include_once "libs/data/db.connect.php";
	
	//Delete register form a
	if(isset($_POST['action']) && trim($_POST['action'])=="registerFormDelete"){
		$type['type']="error";
		$formid=intval($_POST['formid']);
		$customerid=intval($_POST['customerid']);
		
		if($formid>0){
			$query="DELETE FROM customer_register_form_b WHERE id=%i AND customerid=%i";
			$query=$sql->query($query, array($formid, $customerid));
			if($db->query($query)){
				$type['type']="success";
			}
		}
		echo json_encode($type);
		exit(0);
	}

	if(isset($_POST['form_id'])){
		$customer_form_id=intval($_POST['form_id']);
		$type["registerstaus"]="error";
		$custid=intval($_POST['custid']);
		$dateofpayment=strlen(trim($_POST['date_of_payment'])>0)?date("Y-m-d", strtotime(trim($_POST['date_of_payment']))):"";
		
		if($customer_form_id>0){
			$query="UPDATE customer_register_form_b SET
													    `customerid`=%i,
														`name`='%s',
														`rate_of_wage`=%i,
														`no_of_work_days`=%i,
														`overtime_hours`=%i,
														`basic`=%i,
														`special_basic`=%i,
														`da`=%i,
														`overtime_payments`=%i,
														`hra`=%i,
														`others`=%i,
														`total`=%i,
														`pf`=%i,
														`esic`='%s',
														`society`='%s',
														`income_tax`=%i,
														`insurance`=%i,
														`others_deduction`=%i,
														`recoveries`=%i,
														`total_deduction`=%i,
														`net_payment`=%i,
														`emp_share_pf_welfare`=%i,
														`receipt_by_emp_bank_trans_id`=%i,
														`date_of_payment`='%s',
														`remark`='%s',
														`min_highly_skilled`=%i,
														`min_skilled`=%i,
														`min_semi_skilled`=%i,
														`min_un_skilled`=%i,
														`da_highly_skilled`=%i,
														`da_skilled`=%i,
														`da_semi_skilled`=%i,
														`da_un_skilled`=%i,
														`over_highly_skilled`=%i,
														`over_skilled`=%i,
														`over_semi_skilled`=%i,
														`over_un_skilled`=%i,
														`updated_by`=NOW() WHERE id=%i";
			$query=$sql->query($query, array($custid, trim($_POST['name']), trim($_POST['rate_of_wage']), trim($_POST['no_of_work_days']), 
					trim($_POST['overtime_hours']), intval($_POST['basic']), trim($_POST['special_basic']), trim($_POST['da']), 
					trim($_POST['overtime_payments']), trim($_POST['hra']), trim($_POST['others']), 
					intval($_POST['total']), trim($_POST['pf']), trim($_POST['esic']), trim($_POST['society']), trim($_POST['income_tax']),
					trim($_POST['insurance']), trim($_POST['others_deduction']), trim($_POST['recoveries']), intval($_POST['total_deduction']), trim($_POST['net_payment']),
					intval($_POST['emp_share_pf_welfare']), trim($_POST['receipt_by_emp_bank_trans_id']), $dateofpayment, trim($_POST['remark']),
					intval($_POST['min_highly_skilled']), intval($_POST['min_skilled']), intval($_POST['min_semi_skilled']), intval($_POST['min_un_skilled']), 
					intval($_POST['da_highly_skilled']), intval($_POST['da_skilled']), intval($_POST['da_semi_skilled']), intval($_POST['da_un_skilled']), 
					intval($_POST['over_highly_skilled']), intval($_POST['over_skilled']), intval($_POST['over_semi_skilled']), intval($_POST['over_un_skilled']), $customer_form_id
			));
			if($db->query($query)){
				$type['customerid']=$custid;
				$type["registerstaus"]="success";
			}
		}else {
			$query="INSERT INTO customer_register_form_b SET
													    `customerid`=%i,
														`name`='%s',
														`rate_of_wage`=%i,
														`no_of_work_days`=%i,
														`overtime_hours`=%i,
														`basic`=%i,
														`special_basic`=%i,
														`da`=%i,
														`overtime_payments`=%i,
														`hra`=%i,
														`others`=%i,
														`total`=%i,
														`pf`=%i,
														`esic`='%s',
														`society`='%s',
														`income_tax`=%i,
														`insurance`=%i,
														`others_deduction`=%i,
														`recoveries`=%i,
														`total_deduction`=%i,
														`net_payment`=%i,
														`emp_share_pf_welfare`=%i,
														`receipt_by_emp_bank_trans_id`=%i,
														`date_of_payment`='%s',
														`remark`='%s',
														`min_highly_skilled`=%i,
														`min_skilled`=%i,
														`min_semi_skilled`=%i,
														`min_un_skilled`=%i,
														`da_highly_skilled`=%i,
														`da_skilled`=%i,
														`da_semi_skilled`=%i,
														`da_un_skilled`=%i,
														`over_highly_skilled`=%i,
														`over_skilled`=%i,
														`over_semi_skilled`=%i,
														`over_un_skilled`=%i,
														`created_by`=NOW(),
														`updated_by`=NOW()";
			$query=$sql->query($query, array($custid, trim($_POST['name']), trim($_POST['rate_of_wage']), trim($_POST['no_of_work_days']), 
					trim($_POST['overtime_hours']), intval($_POST['basic']), trim($_POST['special_basic']), trim($_POST['da']), 
					trim($_POST['overtime_payments']), trim($_POST['hra']), trim($_POST['others']), 
					intval($_POST['total']), trim($_POST['pf']), trim($_POST['esic']), trim($_POST['society']), trim($_POST['income_tax']),
					trim($_POST['insurance']), trim($_POST['others_deduction']), trim($_POST['recoveries']), intval($_POST['total_deduction']), trim($_POST['net_payment']),
					intval($_POST['emp_share_pf_welfare']), trim($_POST['receipt_by_emp_bank_trans_id']), $dateofpayment, trim($_POST['remark']),
					intval($_POST['min_highly_skilled']), intval($_POST['min_skilled']), intval($_POST['min_semi_skilled']), intval($_POST['min_un_skilled']), 
					intval($_POST['da_highly_skilled']), intval($_POST['da_skilled']), intval($_POST['da_semi_skilled']), intval($_POST['da_un_skilled']), 
					intval($_POST['over_highly_skilled']), intval($_POST['over_skilled']), intval($_POST['over_semi_skilled']), intval($_POST['over_un_skilled'])
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

	$form_id=0;
	if(isset($_GET['custid']) && intval($_GET['custid'])){
		$customerid=intval($_GET['custid']);
		
		if(isset($_GET['id']) && intval($_GET['id'])){
			$form_id=intval($_GET['id']);
			
			$formDetailQuery="SELECT * FROM customer_register_form_b WHERE id=%i";
			$formDetailQuery=$sql->query($formDetailQuery, array($form_id));
			$formDetailResult=$db->query($formDetailQuery);
			$formDetailRow=$db->fetchNextObject($formDetailResult);
		}
		
		$formlinq="SELECT emailid FROM customer_additional_info WHERE id=%i AND detailname='Shram Shuvidha LIN detail'";
		$formlinq=$sql->query($formlinq, array($customerid));
		$formlin=$db->queryUniqueValue($formlinq);
	}
?>
<link href="css/register-styles.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/customer-register-form-b.js"></script>
<td valign="top" style="padding: 20px; width:100%">
	<div class="table-container">
		<div id="notify"><!-- --></div>
		<div valign="top" class="table-heading">
			<div class="pull-left"><a href="customer.php?custid=<?php echo $customerid; ?>"><img src="images/back.png"></a></div>
			<div><?php echo ($customerid>0)?'Register Form B':''; ?></div>
			<div class="clearall"><!-- --></div>
		</div>
		<div style="padding: 20px 0;">
			<div style="padding:20px">
				<div>
					<form name="registerform" id="registerform" action="" method="post">
					<div align="center">
						<div class="register_form_upper_hadding_lg">FORMAT FOR WAGE REGISTER</div>
					</div>
					<div>
						<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
							<tr>
								<td class="list_table_th border_top border_left register_table_td"></td>
								<td align="center" colspan="4" class="list_table_th border_top border_right register_table_td">
									<div class="listing_th_padding">Rate of Minimum Wages and since the date</div>
								</td>
							</tr>
							<tr>
								<td class="list_table_th border_top border_left register_table_td">
									<div class="listing_th_padding"></div>
								</td>
								<td align="center" class="list_table_th border_top border_right register_table_td">
									<div class="listing_th_padding">Highly Skilled</div>
								</td>
								<td align="center" class="list_table_th border_top border_right register_table_td">
									<div class="listing_th_padding">Skilled</div>
								</td>
								<td align="center" class="list_table_th border_top border_right register_table_td">
									<div class="listing_th_padding">Semi Skilled</div>
								</td>
								<td align="center" class="list_table_th border_top border_right register_table_td">
									<div class="listing_th_padding">Un Skilled</div>
								</td>
							</tr>
							<tr>
								<td class="list_table_th border_top border_left register_table_td">
									<div class="listing_th_padding">Minimum Basic</div>
								</td>
								<td align="center" class="border_top border_left register_table_td">
									<div class="listing_th_padding">
										<select name="min_highly_skilled" id="min_highly_skilled" class="select_drop_down" style="width:100px;cursor:pointer">
											<?php
												$selectedvalue='';
												$rate_values='';
												$rate_key='';
												foreach($REGISTER_FORM_B_RATES_ as $rate_key => $rate_values){
													$selectedvalue=($form_id>0 && $formDetailRow->min_highly_skilled==$rate_values)?'selected="selected"':"";
													echo '<option value="'.$rate_key.'" '.$selectedvalue.'>'.$rate_values.'</option>';
											} ?>
										</select>
									</div>
								</td>
								<td align="center" class="border_top border_left register_table_td">
									<div class="listing_th_padding">
										<select name="min_skilled" id="min_skilled" class="select_drop_down" style="width:100px;cursor:pointer">
											<?php
												$selectedvalue='';
												$rate_values='';
												$rate_key='';
												foreach($REGISTER_FORM_B_RATES_ as $rate_key => $rate_values){
													$selectedvalue=($form_id>0 && $formDetailRow->min_skilled==$rate_values)?'selected="selected"':"";
													echo '<option value="'.$rate_key.'" '.$selectedvalue.'>'.$rate_values.'</option>';
											} ?>
										</select>
									</div>
								</td>
								<td align="center" class="border_top border_left register_table_td">
									<div class="listing_th_padding">
										<select name="min_semi_skilled" id="min_semi_skilled" class="select_drop_down" style="width:100px;cursor:pointer">
											<?php
												$selectedvalue='';
												$rate_values='';
												$rate_key='';
												foreach($REGISTER_FORM_B_RATES_ as $rate_key => $rate_values){
													$selectedvalue=($form_id>0 && $formDetailRow->min_semi_skilled==$rate_values)?'selected="selected"':"";
													echo '<option value="'.$rate_key.'" '.$selectedvalue.'>'.$rate_values.'</option>';
											} ?>
										</select>
									</div>
								</td>
								<td align="center" class="border_top border_left border_right register_table_td">
									<div class="listing_th_padding">
										<select name="min_un_skilled" id="min_un_skilled" class="select_drop_down" style="width:100px;cursor:pointer">
											<?php
												$selectedvalue='';
												$rate_values='';
												$rate_key='';
												foreach($REGISTER_FORM_B_RATES_ as $rate_key => $rate_values){
													$selectedvalue=($form_id>0 && $formDetailRow->min_un_skilled==$rate_values)?'selected="selected"':"";
													echo '<option value="'.$rate_key.'" '.$selectedvalue.'>'.$rate_values.'</option>';
											} ?>
										</select>
									</div>
								</td>
							</tr>
							<tr>
								<td class="list_table_th border_top border_left register_table_td">
									<div class="listing_th_padding">DA</div>
								</td>
								<td align="center" class="border_top border_left register_table_td">
									<div class="listing_th_padding">
										<select name="da_highly_skilled" id="da_highly_skilled" class="select_drop_down" style="width:100px;cursor:pointer">
											<?php
												$selectedvalue='';
												$rate_values='';
												foreach($REGISTER_FORM_B_RATES_ as $rate_key => $rate_values){
													$selectedvalue=($form_id>0 && $formDetailRow->da_highly_skilled==$rate_values)?'selected="selected"':"";
													echo '<option value="'.$rate_key.'" '.$selectedvalue.'>'.$rate_values.'</option>';
											} ?>
										</select>
									</div>
								</td>
								<td align="center" class="border_top border_left register_table_td">
									<div class="listing_th_padding">
										<select name="da_skilled" id="da_skilled" class="select_drop_down" style="width:100px;cursor:pointer">
											<?php
												$selectedvalue='';
												$rate_values='';
												foreach($REGISTER_FORM_B_RATES_ as $rate_key => $rate_values){
													$selectedvalue=($form_id>0 && $formDetailRow->da_skilled==$rate_values)?'selected="selected"':"";
													echo '<option value="'.$rate_key.'" '.$selectedvalue.'>'.$rate_values.'</option>';
											} ?>
										</select>
									</div>
								</td>
								<td align="center" class="border_top border_left register_table_td">
									<div class="listing_th_padding">
										<select name="da_semi_skilled" id="da_semi_skilled" class="select_drop_down" style="width:100px;cursor:pointer">
											<?php
												$selectedvalue='';
												$rate_values='';
												foreach($REGISTER_FORM_B_RATES_ as $rate_key => $rate_values){
													$selectedvalue=($form_id>0 && $formDetailRow->da_semi_skilled==$rate_values)?'selected="selected"':"";
													echo '<option value="'.$rate_key.'" '.$selectedvalue.'>'.$rate_values.'</option>';
											} ?>
										</select>
									</div>
								</td>
								<td align="center" class="border_top border_left border_right register_table_td">
									<div class="listing_th_padding">
										<select name="da_un_skilled" id="da_un_skilled" class="select_drop_down" style="width:100px;cursor:pointer">
											<?php
												$selectedvalue='';
												$rate_values='';
												foreach($REGISTER_FORM_B_RATES_ as $rate_key => $rate_values){
													$selectedvalue=($form_id>0 && $formDetailRow->da_un_skilled==$rate_values)?'selected="selected"':"";
													echo '<option value="'.$rate_key.'" '.$selectedvalue.'>'.$rate_values.'</option>';
											} ?>
										</select>
									</div>
								</td>
							</tr>
							<tr>
								<td class="list_table_th border_top border_bottom border_left register_table_td">
									<div class="listing_th_padding">Overtime</div>
								</td>
								<td align="center" class="border_top border_bottom border_left register_table_td">
									<div class="listing_th_padding">
										<select name="over_highly_skilled" id="over_highly_skilled" class="select_drop_down" style="width:100px;cursor:pointer">
											<?php
												$selectedvalue='';
												$rate_values='';
												foreach($REGISTER_FORM_B_RATES_ as $rate_key => $rate_values){
													$selectedvalue=($form_id>0 && $formDetailRow->over_highly_skilled==$rate_values)?'selected="selected"':"";
													echo '<option value="'.$rate_key.'" '.$selectedvalue.'>'.$rate_values.'</option>';
											} ?>
										</select>
									</div>
								</td>
								<td align="center" class="border_top border_bottom border_left register_table_td">
									<div class="listing_th_padding">
										<select name="over_skilled" id="over_skilled" class="select_drop_down" style="width:100px;cursor:pointer">
											<?php
												$selectedvalue='';
												$rate_values='';
												foreach($REGISTER_FORM_B_RATES_ as $rate_key => $rate_values){
													$selectedvalue=($form_id>0 && $formDetailRow->over_skilled==$rate_values)?'selected="selected"':"";
													echo '<option value="'.$rate_key.'" '.$selectedvalue.'>'.$rate_values.'</option>';
											} ?>
										</select>
									</div>
								</td>
								<td align="center" class="border_top border_bottom border_left register_table_td">
									<div class="listing_th_padding">
										<select name="over_semi_skilled" id="over_semi_skilled" class="select_drop_down" style="width:100px;cursor:pointer">
											<?php
												$selectedvalue='';
												$rate_values='';
												foreach($REGISTER_FORM_B_RATES_ as $rate_key => $rate_values){
													$selectedvalue=($form_id>0 && $formDetailRow->over_semi_skilled==$rate_values)?'selected="selected"':"";
													echo '<option value="'.$rate_key.'" '.$selectedvalue.'>'.$rate_values.'</option>';
											} ?>
										</select>
									</div>
								</td>
								<td align="center" class="border_top border_bottom border_left border_right register_table_td">
									<div class="listing_th_padding">
										<select name="over_un_skilled" id="over_un_skilled" class="select_drop_down" style="width:100px;cursor:pointer">
											<?php
												$selectedvalue='';
												$rate_values='';
												foreach($REGISTER_FORM_B_RATES_ as $rate_key => $rate_values){
													$selectedvalue=($form_id>0 && $formDetailRow->over_un_skilled==$rate_values)?'selected="selected"':"";
													echo '<option value="'.$rate_key.'" '.$selectedvalue.'>'.$rate_values.'</option>';
											} ?>
										</select>
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="5" style="height:30px"><!-- --></td>
							</tr>
						</table>
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
							<tr><td colspan="5" style="height:10px"><!-- --></td></tr>
							<tr>
								<td style="font-weight:bold">Wage period From</td>
								<td>2018</td>
								<td style="font-weight:bold">To</td>
								<td>2019</td>
								<td style="font-weight:bold">(Monthly/Fortnightly/Weekly/Daily/Piece Rated)</td>
								<td></td>
							</tr>
							<tr><td colspan="5" style="height:20px"><!-- --></td></tr>
						</table>
					</div>
						<table border="0" cellpadding="0" cellspacing="0" class="list_table addlisting" style="width:100%">
							<tr>
								<td align="center" valign="middle" class="list_table_th border_top border_bottom border_left border_right register_table_td"><div class="listing_th_padding">1. Name</div></td>
								<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">2. Rate of <br /> Wage</div></td>
								<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">3. Number of work days</div></td>
								<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">4. Overtime hours</div></td>
								<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">5. Basic</div></td>
								<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">6. Special Basic</div></td>
								<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">7. DA</div></td>
								<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">8. Overtime payments</div></td>
								<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">9. HRA</div></td>
								<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">10. Others</div></td>
								<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">11. Total</div></td>
							</tr>
							<tr>
								<td align="left" valign="top" class="border_bottom border_left border_right">
									<div class="listing_td_padding">
										<input type="text" name="name" id="name" value="<?php echo ($form_id>0)?trim($formDetailRow->name):""; ?>">
									</div>
								</td>
								<td align="left" valign="top" class="border_bottom border_right">
									<div class="listing_td_padding">
										<input type="text" name="rate_of_wage" id="rate_of_wage" value="<?php echo ($form_id>0)?$formDetailRow->rate_of_wage:""; ?>" />
									</div>
								</td>
								<td align="left" valign="top" class="border_bottom border_right">
									<div class="listing_td_padding">
										<input type="text" name="no_of_work_days" id="no_of_work_days" value="<?php echo ($form_id>0)?$formDetailRow->no_of_work_days:""; ?>" />
									</div>
								</td>
								<td align="left" valign="top" class="border_bottom border_right">
									<div class="listing_td_padding">
										<input type="text" name="overtime_hours" id="overtime_hours" value="<?php echo ($form_id>0)?$formDetailRow->overtime_hours:""; ?>" />
									</div>
								</td>
								<td align="left" valign="top" class="border_bottom border_right">
									<div class="listing_td_padding">
										<input type="text" name="basic" id="basic" value="<?php echo ($form_id>0)?$formDetailRow->basic:""; ?>" />
									</div>
								</td>
								<td align="left" valign="top" class="border_bottom border_right">
									<div class="listing_td_padding">
										<input type="text" name="special_basic" id="special_basic" value="<?php echo ($form_id>0)?$formDetailRow->special_basic:""; ?>" />
									</div>
								</td>
								<td align="left" valign="top" class="border_bottom border_right">
									<div class="listing_td_padding">
										<input type="text" name="da" id="da" value="<?php echo ($form_id>0)?$formDetailRow->da:""; ?>" style="width:100%" />
									</div>
								</td>
								<td align="left" valign="top" class="border_bottom border_right">
									<div class="listing_td_padding">
										<input type="text" name="overtime_payments" id="overtime_payments" value="<?php echo ($form_id>0)?$formDetailRow->overtime_payments:""; ?>" />
									</div>
								</td>
								<td align="left" valign="top" class="border_bottom border_right">
									<div class="listing_td_padding">
										<input type="text" name="hra" id="hra" value="<?php echo ($form_id>0)?$formDetailRow->hra:""; ?>" />
									</div>
								</td>
								<td align="left" valign="top" class="border_bottom border_right">
									<div class="listing_td_padding">
										<input type="text" name="others" id="others" value="<?php echo ($form_id>0)?$formDetailRow->others:""; ?>" style="width:100%" />
									</div>
								</td>
								<td align="left" valign="top" class="border_bottom border_right">
									<div class="listing_td_padding">
										<input type="text" name="total" id="total" value="<?php echo ($form_id>0)?$formDetailRow->total:""; ?>" />
									</div>
								</td>
							</tr>
							<tr><td style="height:10px"><!-- --></td></tr>
						</table>
						<table border="0" cellpadding="0" cellspacing="0" class="list_table addlisting" style="width:100%">
							<tr>
								<td align="center" valign="middle" class="list_table_th border_top border_bottom border_left border_right register_table_td"><div class="listing_th_padding">12. PF</div></td>
								<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">13. ESIC</div></td>
								<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">14. Society</div></td>
								<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">15. Income Tax</div></td>
								<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">16. Insurance</div></td>
								<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">17. Others Deduction</div></td>
								<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">18. Recoveries</div></td>
								<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">19. Total Deduction</div></td>
								<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">20. Net Payment</div></td>
								<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">21. Employee Share <br />PF Welfare</div></td>
								<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">22. Receipt by Employee <br /> Bank Transaction Id</div></td>
							</tr>
							<tr>
								<td align="left" valign="top" class="border_bottom border_left border_right">
									<div class="listing_td_padding">
										<input type="text" name="pf" id="pf" value="<?php echo ($form_id>0)?$formDetailRow->pf:""; ?>" />
									</div>
								</td>
								<td align="left" valign="top" class="border_bottom border_right">
									<div class="listing_td_padding">
										<input type="text" name="esic" id="esic" value="<?php echo ($form_id>0)?trim($formDetailRow->esic):""; ?>" />
									</div>
								</td>
								<td align="left" valign="top" class="border_bottom border_right">
									<div class="listing_td_padding">
										<input type="text" name="society" id="society" value="<?php echo ($form_id>0)?trim($formDetailRow->society):""; ?>" />
									</div>
								</td>
								<td align="left" valign="top" class="border_bottom border_right">
									<div class="listing_td_padding">
										<input type="text" name="income_tax" id="income_tax" value="<?php echo ($form_id>0)?intval($formDetailRow->income_tax):""; ?>" />
									</div>
								</td>
								<td align="left" valign="top" class="border_bottom border_right">
									<div class="listing_td_padding">
										<input type="text" name="insurance" id="insurance" value="<?php echo ($form_id>0)?$formDetailRow->insurance:""; ?>" />
									</div>
								</td>
								<td align="left" valign="top" class="border_bottom border_right">
									<div class="listing_td_padding">
										<input type="text" name="others_deduction" id="others_deduction" value="<?php echo ($form_id>0)?$formDetailRow->total_deduction:""; ?>" />
									</div>
								</td>
								<td align="left" valign="top" class="border_bottom border_right">
									<div class="listing_td_padding">
										<input type="text" name="recoveries" id="recoveries" value="<?php echo ($form_id>0)?$formDetailRow->recoveries:""; ?>" />
									</div>
								</td>
								<td align="left" valign="top" class="border_bottom border_right">
									<div class="listing_td_padding">
										<input type="text" name="total_deduction" id="total_deduction" value="<?php echo ($form_id>0)?$formDetailRow->total_deduction:""; ?>" />
									</div>
								</td>
								<td align="left" valign="top" class="border_bottom border_right">
									<div class="listing_td_padding">
										<input type="text" name="net_payment" id="net_payment" value="<?php echo ($form_id>0)?$formDetailRow->net_payment:""; ?>" />
									</div>
								</td>
								<td align="left" valign="top" class="border_bottom border_right">
									<div class="listing_td_padding">
										<input type="text" name="emp_share_pf_welfare" id="emp_share_pf_welfare" value="<?php echo ($form_id>0)?$formDetailRow->emp_share_pf_welfare:""; ?>" />
									</div>
								</td>
								<td align="left" valign="top" class="border_bottom border_right">
									<div class="listing_td_padding">
										<input type="text" name="receipt_by_emp_bank_trans_id" id="receipt_by_emp_bank_trans_id" value="<?php echo ($form_id>0)?$formDetailRow->receipt_by_emp_bank_trans_id:""; ?>" />
									</div>
								</td>
							</tr>
							<tr><td style="height:10px"><!-- --></td></tr>
						</table>
						<table border="0" cellpadding="0" cellspacing="0" class="list_table addlisting" style="width:100%">
							<tr>
								<td align="center" valign="middle" class="list_table_th border_top border_bottom border_left border_right" style="width:200px"><div class="listing_th_padding">23. Date of Payment</div></td>
								<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right"><div class="listing_th_padding">24. Remarks</div></td>
							</tr>
							<tr>
								<td align="left" valign="top" class="border_bottom border_left border_right">
									<div class="listing_td_padding">
										<input type="text" name="date_of_payment" id="date_of_payment" value="<?php echo ($form_id>0 && strlen($formDetailRow->date_of_payment)>0)?date("m/d/Y", strtotime($formDetailRow->date_of_payment)):""; ?>">
									</div>
								</td>
								<td align="left" valign="top" class="border_bottom border_right">
									<div class="listing_td_padding">
										<input type="text" name="remark" id="remark" value="<?php echo ($form_id>0)?trim($formDetailRow->remark):""; ?>" />
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="9">
									<input type="hidden" name="custid" id="custid" value="<?php echo $customerid; ?>">
									<input type="hidden" name="form_id" id="form_id" value="<?php echo $form_id; ?>">
									<input name="submitbtn" id="submitbtn" value="Save" class="add-button" style="margin-left:0" type="submit">
								</td>
							</tr>
						</table>
					</form>
				</div>
				<?php 
					$yearPart=''; $monthPart=''; $subPart=array(); $values=array();
					$values[]=$customerid;
					
					if(isset($_POST['regyear']) && strlen($_POST['regyear'])>0){
						$subPart[]="YEAR(created_by)='%s'";
						$values[]=$_POST['regyear'];
					}
					
					if(isset($_POST['regmonth']) && strlen($_POST['regmonth'])>0){
						$subPart[]="MONTH(created_by)='%s'";
						$values[]=$_POST['regmonth'];
					}
					
					if(count($subPart)>0){
						$qryPart=' AND '.implode(" AND ", $subPart);
					}
							
					$qry="SELECT * FROM customer_register_form_b WHERE customerid=%i".$qryPart;
					$qry=$sql->query($qry, $values);
					$res=$db->query($qry);
					$cnt=$db->numRows($res);
					
					$monthq="SELECT MONTH(created_by) as month FROM customer_register_form_b WHERE customerid=%i GROUP BY MONTH(created_by) ORDER BY MONTH(created_by)";
					$monthq=$sql->query($monthq, array($customerid));
					$monthr=$db->query($monthq);
					$monthc=$db->numRows($monthr);
					
					$yearq="SELECT YEAR(created_by) as year FROM customer_register_form_b WHERE customerid=%i GROUP BY YEAR(created_by) ORDER BY created_by DESC";
					$yearq=$sql->query($yearq, array($customerid));
					$yearr=$db->query($yearq);
					$yearc=$db->numRows($yearr);
					
					if($monthc>0 && $yearc>0){
				?>
					<div align="right" style="padding:10px">
						<form name="filterregform" id="filterregform" action="" method="post">
							<div class="pull-right" style="padding-left:10px">
								<div class="filtertitle">Select Month: </div>
								<select name="regmonth" id="regmonth" class="select_drop_down" style="width:100px;cursor:pointer" onchange="filterRegMonths()">
									<option value="">Select</option>
									<?php 
										while($monthrw=$db->fetchNextObject($monthr)){ ?>
											<option value="<?php echo $monthrw->month; ?>" <?php echo ($_POST['regmonth']==$monthrw->month)?"selected='selected'":"" ;?> ><?php echo date("F", mktime(0,0,0,$monthrw->month,1,2011)); ?></option>
										<?php }
									?>
								</select>
							</div>
							<div class="pull-right">
								<div class="filtertitle">Select Year: </div>
								<select name="regyear" id="regyear" class="select_drop_down" style="width:100px;cursor:pointer" onchange="filterRegYears()">
									<option value="">Select</option>
									<?php 
										while($yearrw=$db->fetchNextObject($yearr)){ ?>
											<option value="<?php echo $yearrw->year; ?>" <?php echo ($_POST['regyear']==$yearrw->year)?"selected='selected'":"" ;?> ><?php echo $yearrw->year; ?></option>
										<?php }
									?>
								</select>
							</div>
							<div class="clearall"><!-- --></div>
							<input type="hidden" name="offset" id="offset" value="<?php echo $offset; ?>"/>
						</form>
					</div>
				<?php } ?>
				<div style="padding:20px 0;width: 100%;max-height: 500px;overflow: auto;">
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th valign="top" class="table-title border_left border_right">Actions</th>
								<th valign="top" class="table-title border_right">Name</th>
								<th valign="top" class="table-title border_right">Rate of Wage</th>
								<th valign="top" class="table-title border_right">Number of Work days</th>
								<th valign="top" class="table-title border_right">Overtime hours</th>
								<th valign="top" class="table-title border_right">Basic</th>
								<th valign="top" class="table-title border_right">Special Basic</th>
								<th valign="top" class="table-title border_right">DA</th>
								<th valign="top" class="table-title border_right">Overtime Payments</th>
								<th valign="top" class="table-title border_right">HRA</th>
								<th valign="top" class="table-title border_right">Others</th>
								<th valign="top" class="table-title border_right">Total</th>
								<th valign="top" class="table-title border_right">PF</th>
								<th valign="top" class="table-title border_right">ESIC</th>
								<th valign="top" class="table-title border_right">Society</th>
								<th valign="top" class="table-title border_right">Income Tax</th>
								<th valign="top" class="table-title border_right">Insurance</th>
								<th valign="top" class="table-title border_right">Other Deduction</th>
								<th valign="top" class="table-title border_right">Recoveries</th>
								<th valign="top" class="table-title border_right">Total Deduction</th>
								<th valign="top" class="table-title border_right">Net Payment</th>
								<th valign="top" class="table-title border_right">Employee Share PF Welfare</th>
								<th valign="top" class="table-title border_right">Receipt by employee Bank Transaction ID</th>
								<th valign="top" class="table-title border_right">Date of Payment</th>
								<th valign="top" class="table-title border_right">Remark</th>
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
								<td valign="middle" class="table-data borderall" style="padding:5px 25px">
									<form name="registerformprint" id="registerformprint<?php echo $id; ?>" action="register-form-b-print.php" method="post">
										<input type="hidden" name="fromprint" id="fromprint" value="0">
										<input type="hidden" name="formid" id="formid" value="<?php echo $id; ?>">
									</form>
									<div>
										<div class="pull-left action-icon"><a href="customer-register-form-b.php?custid=<?php echo $customerid; ?>&id=<?php echo $id; ?>"><img src="images/edit.png" /></a></div>
										<div class="pull-left action-icon" style="padding-top:3px"><img src="images/delete.png" onclick="deleteRegisterForm('b', <?php echo $id; ?>, <?php echo intval($rw->customerid); ?>)" title="Delete"></div>
										<div class="pull-left action-icon"><label title="Print" style="cursor:pointer" onclick="printRegisterfrom(<?php echo $id; ?>)">Print</lable></div>
										<div class="clearall">
									</div>
								</td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->name); ?>"><?php echo trim($rw->name); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->rate_of_wage); ?>"><?php echo trim($rw->rate_of_wage); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo $rw->no_of_work_days; ?>"><?php echo $rw->no_of_work_days; ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo $rw->overtime_hours; ?>"><?php echo $rw->overtime_hours; ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo $rw->basic; ?>"><?php echo $rw->basic; ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo $rw->special_basic; ?>"><?php echo $rw->special_basic; ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo $rw->da; ?>"><?php echo $rw->da; ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo $rw->overtime_payments; ?>"><?php echo $rw->overtime_payments; ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo $rw->hra; ?>"><?php echo $rw->hra; ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo $rw->others; ?>"><?php echo $rw->others; ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo $rw->total; ?>"><?php echo $rw->total; ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo $rw->pf; ?>"><?php echo $rw->pf; ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo $rw->esic; ?>"><?php echo $rw->esic; ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo $rw->society; ?>"><?php echo $rw->society; ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo $rw->income_tax; ?>"><?php echo $rw->income_tax; ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->insurance); ?>"><?php echo trim($rw->insurance); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo $rw->others_deduction; ?>"><?php echo $rw->others_deduction; ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo $rw->recoveries; ?>"><?php echo $rw->recoveries; ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo $rw->total_deduction; ?>"><?php echo $rw->total_deduction; ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo $rw->net_payment; ?>"><?php echo $rw->net_payment; ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->emp_share_pf_welfare); ?>"><?php echo trim($rw->emp_share_pf_welfare); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo $rw->receipt_by_emp_bank_trans_id; ?>"><?php echo $rw->receipt_by_emp_bank_trans_id; ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo (strlen($rw->date_of_payment)>0)?date("m/d/Y", strtotime(trim($rw->date_of_payment))):""; ?>"><?php echo (strlen($rw->date_of_payment)>0)?date("m/d/Y", strtotime(trim($rw->date_of_payment))):""; ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->remark); ?>"><?php echo ellipses(trim($rw->remark), 50); ?></td>
							</tr>
						<?php $counter++; } }else { ?>
						<tr>
							<td colspan="25">
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