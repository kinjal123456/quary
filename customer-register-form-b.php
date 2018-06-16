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

	if(isset($_POST['submitbtn'])){
		$type["registerstaus"]="error";
		$custid=intval($_POST['custid']);
		$dateofpayment=strlen(trim($_POST['date_of_payment'])>0)?date("Y-m-d", strtotime(trim($_POST['date_of_payment']))):"";
		
		if($custid>0){
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
														`created_by`=NOW(),
														`updated_by`=NOW()";
			$query=$sql->query($query, array($custid, trim($_POST['name']), trim($_POST['rate_of_wage']), trim($_POST['no_of_work_days']), 
					trim($_POST['overtime_hours']), intval($_POST['basic']), trim($_POST['special_basic']), trim($_POST['da']), 
					trim($_POST['overtime_payments']), trim($_POST['hra']), trim($_POST['others']), 
					intval($_POST['total']), trim($_POST['pf']), trim($_POST['esic']), trim($_POST['society']), trim($_POST['income_tax']),
					trim($_POST['insurance']), trim($_POST['others_deduction']), trim($_POST['recoveries']), intval($_POST['total_deduction']), trim($_POST['net_payment']),
					intval($_POST['emp_share_pf_welfare']), trim($_POST['receipt_by_emp_bank_trans_id']), $dateofpayment, trim($_POST['remark'])
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
					<div class="register_form_upper_hadding_lg">FORMAT FOR WAGE REGISTER</div>
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
				<form name="registerform" id="registerform" action="" method="post">
					<table border="0" cellpadding="0" cellspacing="0" class="list_table addlisting" style="width:100%">
						<tr>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_left border_right register_table_td"><div class="listing_th_padding">Name</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Rate of <br /> Wage</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Number of work days</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Overtime hours</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Basic</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Special Basic</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">DA</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Overtime payments</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">HRA</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Others</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Total</div></td>
						</tr>
						<tr>
							<td align="left" valign="top" class="border_bottom border_left border_right">
								<div class="listing_td_padding">
									<input type="text" name="name" id="name" value="">
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="rate_of_wage" id="rate_of_wage" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="no_of_work_days" id="no_of_work_days" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="overtime_hours" id="overtime_hours" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="basic" id="basic" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="special_basic" id="special_basic" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="da" id="da" value="" style="width:100%" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="overtime_payments" id="overtime_payments" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="hra" id="hra" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="others" id="others" value="" style="width:100%" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="total" id="total" value="" />
								</div>
							</td>
						</tr>
						<tr><td style="height:10px"><!-- --></td></tr>
					</table>
					<table border="0" cellpadding="0" cellspacing="0" class="list_table addlisting" style="width:100%">
						<tr>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_left border_right register_table_td"><div class="listing_th_padding">PF</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">ESIC</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Society</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Income Tax</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Insurance</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Others Deduction</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Recoveries</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Total Deduction</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Net Payment</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Employee Share <br />PF Welfare</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right register_table_td"><div class="listing_th_padding">Receipt by Employee <br /> Bank Transaction Id</div></td>
						</tr>
						<tr>
							<td align="left" valign="top" class="border_bottom border_left border_right">
								<div class="listing_td_padding">
									<input type="text" name="pf" id="pf" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="esic" id="esic" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="society" id="society" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="income_tax" id="income_tax" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="insurance" id="insurance" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="others_deduction" id="others_deduction" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="recoveries" id="recoveries" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="total_deduction" id="total_deduction" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="net_payment" id="net_payment" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="emp_share_pf_welfare" id="emp_share_pf_welfare" value="" />
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div class="listing_td_padding">
									<input type="text" name="receipt_by_emp_bank_trans_id" id="receipt_by_emp_bank_trans_id" value="" />
								</div>
							</td>
						</tr>
						<tr><td style="height:10px"><!-- --></td></tr>
					</table>
					<table border="0" cellpadding="0" cellspacing="0" class="list_table addlisting" style="width:100%">
						<tr>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_left border_right" style="width:200px"><div class="listing_th_padding">Date of Payment</div></td>
							<td align="center" valign="middle" class="list_table_th border_top border_bottom border_right"><div class="listing_th_padding">Remarks</div></td>
						</tr>
						<tr>
							<td align="left" valign="top" class="border_bottom border_left border_right">
								<div class="listing_td_padding">
									<input type="text" name="date_of_payment" id="date_of_payment" value="">
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
							$qry="SELECT * FROM customer_register_form_b WHERE customerid=%i";
							$qry=$sql->query($qry, array($customerid));
							$res=$db->query($qry);
							$cnt=$db->numRows($res);
							if($cnt>0){
								$counter=1;
								while($rw=$db->fetchNextObject($res)){
									$id=intval($rw->id); 
						?>
							<tr>
								<td valign="middle" class="table-data borderall" style="padding:5px 25px 0 25px">
									<form name="registerformprint" id="registerformprint<?php echo $id; ?>" action="register-form-b-print.php" method="post">
										<input type="hidden" name="fromprint" id="fromprint" value="0">
										<input type="hidden" name="formid" id="formid" value="<?php echo $id; ?>">
									</form>
									<div>
										<div class="pull-left action-icon"><img src="images/delete-icon.png" onclick="deleteRegisterForm('b', <?php echo $id; ?>, <?php echo intval($rw->customerid); ?>)" title="Delete"></div>
										<div class="pull-left action-icon"><label title="Print" style="cursor:pointer" onclick="printRegisterfrom(<?php echo $id; ?>)">Print</lable></div>
										<div class="clearall">
									</div>
								</td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->name); ?>"><?php echo trim($rw->name); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->rate_of_wage); ?>"><?php echo trim($rw->rate_of_wage); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo intval($rw->no_of_work_days); ?>"><?php echo ellipses(intval($rw->no_of_work_days), 50); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo intval($rw->overtime_hours); ?>"><?php echo intval($rw->overtime_hours); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo intval($rw->basic); ?>"><?php echo intval($rw->basic); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo intval($rw->special_basic); ?>"><?php echo intval($rw->special_basic); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo intval($rw->da); ?>"><?php echo intval($rw->da); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo intval($rw->overtime_payments); ?>"><?php echo intval($rw->overtime_payments); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo intval($rw->hra); ?>"><?php echo intval($rw->hra); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo intval($rw->others); ?>"><?php echo intval($rw->others); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo intval($rw->total); ?>"><?php echo intval($rw->total); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo intval($rw->pf); ?>"><?php echo intval($rw->pf); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->esic); ?>"><?php echo trim($rw->esic); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->society); ?>"><?php echo trim($rw->society); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo intval($rw->income_tax); ?>"><?php echo intval($rw->income_tax); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->insurance); ?>"><?php echo trim($rw->insurance); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo intval($rw->others_deduction); ?>"><?php echo intval($rw->others_deduction); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo intval($rw->recoveries); ?>"><?php echo intval($rw->recoveries); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo intval($rw->total_deduction); ?>"><?php echo intval($rw->total_deduction); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo intval($rw->net_payment); ?>"><?php echo intval($rw->net_payment); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo trim($rw->emp_share_pf_welfare); ?>"><?php echo trim($rw->emp_share_pf_welfare); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo intval($rw->receipt_by_emp_bank_trans_id); ?>"><?php echo intval($rw->receipt_by_emp_bank_trans_id); ?></td>
								<td valign="top" class="table-data borderall" title="<?php echo date("m/d/Y", strtotime(trim($rw->date_of_payment))); ?>"><?php echo date("m/d/Y", strtotime(trim($rw->date_of_payment))); ?></td>
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