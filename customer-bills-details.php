<?php
	include 'libs/data/db.connect.php';
	
	//Delete Bills
	if(isset($_POST['action']) && trim($_POST['action'])=="billDelete"){
		$type['type']="error";
		$billid=intval($_POST['billid']);
		if($billid>0){
			$query="DELETE FROM customers_bills WHERE id=%i";
			$query=$sql->query($query, array($billid));
			if($db->query($query)){
				$type['type']="success";
			}
		}
		echo json_encode($type);
		exit(0);
	}
	
	if(isset($_POST['cust']) && count($_POST['cust'])>0){ //bills insertion
		$type['billid']="success";
		
		for($b=0; $b<count($_POST['cust']); $b++){
			$paid_on='';
			if(intval($_POST['cust'][$b])>0 && intval($_POST['user'][$b])>0 && strlen(trim($_POST['billname'][$b]))>0 && strlen(trim($_POST['billamt'][$b]))>0){
				
				$billquery = "SELECT count(*) as totalrecords FROM customers_bills WHERE customerid=%i AND userid=%i";
				$billquery=$sql->query($billquery, array(intval($_POST['cust'][$b]), intval($_POST['user'][$b])));
				$billcount = intval($db->queryUniqueValue($billquery));
				$autobillno=$billcount;
				if($billcount<=2){
					if(intval($_POST['user'][$b])==1){//Jayeshbhai
						$auto_bill_no='JPD/LAB/00'.($autobillno+1).'/'.date("y").'-'.date("y", strtotime("+1 year"));
					}else if(intval($_POST['user'][$b])==2){//bhavnaben
						$auto_bill_no='BJB/EXP/00'.($autobillno+1).'/'.date("y").'-'.date("y", strtotime("+1 year"));
					}else {//Default value
						$auto_bill_no="";
					}
					
					$query="INSERT INTO customers_bills SET customerid=%i, userid=%i, billno='%s', billname='%s', bill_amount='%s', paid_by=%i, paid_on='%s', remarks='%s', created_at=NOW(), updated_at=NOW()";
					$query=$sql->query($query, array(intval($_POST['cust'][$b]), intval($_POST['user'][$b]), $auto_bill_no, trim($_POST['billname'][$b]), trim($_POST['billamt'][$b]), trim($_POST['paid_by'][$b]), trim($_POST['paid_on'][$b]), trim($_POST['remarks'][$b])));
					if($db->query($query)){
						$type['type']="success";
						$type['billstatus']="success";
					}
				}else {
					$type['type']="success";
					$type['billstatus']="billexists";
				}
			}
		}
		
		echo json_encode($type);
		exit(0);
	}
	
	$billsqry="SELECT cb.id, cb.customerid, c.companyname, cb.userid, cb.billno, cb.billname, cb.bill_amount, cb.paid_by, cb.paid_on, cb.remarks FROM customers_bills cb
			   LEFT JOIN customers c ON cb.customerid=c.id
			   WHERE YEAR(cb.created_at)=%i";
	$billsqry=$sql->query($billsqry, array(date('Y')));
	$billsres=$db->query($billsqry);
	$billscnt=$db->numRows($billsres);
	
	include 'header.php';
?>
<script type="text/javascript" src="js/add-bill.js"></script>
<td valign="top" style="padding: 20px">
	<div class="table-container">
		<div id="notify"><!-- --></div>
		<div style="padding: 20px 0;">
			<div style="padding:20px">
				<form name="billform" id="billform" action="customer-bills-details.php" method="post">
					<table border="0" cellpadding="0" cellspacing="0" id="appendbillcontent" class="billslisting" style="width:100%">
						<tr>
							<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right" style="width: 150px;">&nbsp;</td>
							<td align="left" valign="top" class="list_table_th border_top border_bottom border_right"><div class="listing_th_padding">Sr no.</div></td>
							<td align="left" valign="top" class="list_table_th border_top border_bottom border_right"><div class="listing_th_padding">Customer</div></td>
							<td align="left" valign="top" class="list_table_th border_top border_bottom border_right"><div class="listing_th_padding">User</div></td>
							<td align="left" valign="top" class="list_table_th border_top border_bottom border_right"><div class="listing_th_padding">Bill number</div></td>
							<td align="left" valign="top" class="list_table_th border_top border_bottom border_right"><div class="listing_th_padding">Bill name</div></td>
							<td align="left" valign="top" class="list_table_th border_top border_bottom border_right"><div class="listing_th_padding">Bill amount</div></td>
						</tr>
						<?php
							$counter=1;
							if($billscnt>0){
								$addcapcount=1;
								while($billsrw=$db->fetchNextObject($billsres)){
									$uservalue=(intval($billsrw->userid)==1)?"Jayesh bhai":"Bhavna ben";
									$customestyle=($billscnt==$counter)?'style="border-bottom: solid 1px #e6e6e6;"':'';
						?>
						<tr class="noofbills">
							<td align="center" valign="middle" class="border_bottom border_left border_right">
								<div style="padding-left:15px">
									<div title="Edit" class="pull-left icon_edit" onclick="ajaxPopup('popup/edit-bill.php?id=<?php echo intval($billsrw->id); ?>');"></div>
									<div title="Delete" class="icon_delete pull-left" onclick="deleteBills(this, <?php echo intval($billsrw->id); ?>)" style="margin-left:10px"></div>
									<div class="action-icon"><label title="Print" style="cursor:pointer" onclick="printBills(<?php echo intval($billsrw->id); ?>)">Print</lable></div>
									<div class="clearall">
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div style="padding: 10px">
									<?php echo $counter++; ?>
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div style="padding: 10px">
									<?php echo $billsrw->companyname; ?>
								</div>
							
							<td align="left" valign="top" class="border_bottom border_right">
								<div style="padding: 10px">
									<?php echo $uservalue; ?>
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div style="padding: 10px">
									 <?php echo trim($billsrw->billno); ?>
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div style="padding: 10px">
									<?php echo trim($billsrw->billname); ?>
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div style="padding: 10px">
									<?php echo number_format($billsrw->bill_amount, 2); ?>
								</div>
							</td>
						</tr>
						<?php } } ?>
						<tr class="bills template noofbills" style="height:40px;display:none">
							<td align="center" valign="middle" class="border_bottom border_left">
								<div>
									<div title="Delete" class="icon_delete pull-left" style="margin-left:10px"></div>
									<div class="action-icon">&nbsp;</div>
									<div class="clearall">
								</div>
							</td>
							<td align="center" valign="middle" class="border_bottom border_left border_right">&nbsp;</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div style="padding: 10px">
									<select name="cust[]" id="cust" class="cust select_drop_down">
										<option value="">Select Customer</option>
										<?php 
											$cust_query="SELECT id, companyname FROM customers";
											$cust_result=$db->query($cust_query);
											while($cust_row=$db->fetchNextObject($cust_result)){
										?>
											<option value="<?php echo intval($cust_row->id); ?>"><?php echo trim($cust_row->companyname); ?></option>
										<?php } ?>
									</select>
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div style="padding: 10px">
									<select name="user[]" id="user" class="user select_drop_down">
										<option value="">Select user</option>
										<option value="1">Jayesh bhai</option>
										<option value="2">Bhavna ben</option>
									</select>
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div style="padding: 10px">
									-
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div style="padding: 10px">
									<input type="text" name="billname[]" id="billname" class="billname" value="">
								</div>
							</td>
							<td align="left" valign="top" class="border_bottom border_right">
								<div style="padding: 10px">
									<input type="text" name="billamt[]" id="billamt" class="billamt" value="">
								</div>
							</td>
						</tr>
						<tr>
							<td colspan="8" align="left" valign="top">
								<div style="padding:10px;">
									<div title="Add" class="icon_add icon_add_bill"></div>
								</div>
							</td>
						</tr>
					</table>
					<input type="hidden" name="print" id="print" value="0">
					<input type="submit" name="submitbtn" id="submitbtn" value="Save" class="add-button" style="margin-left:0">
				</form>
				<form name="billformprint" id="billformprint" action="" method="post">
					<input type="hidden" name="billprint" id="billprint" value="0">
					<input type="hidden" name="bill_id" id="bill_id" value="">
				</form>
			</div>
		</div>
	</div>
</td>
<?php 
	include 'footer.php';
?>