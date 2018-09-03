<?php 
	include 'libs/data/db.connect.php';
	include 'libs/data/db.paging.php';
	
	$values=array();
	
	if(isset($_POST['action']) && trim($_POST['action'])=="billPaymentUpdate"){
		$type['type']="error";
		$billid=intval($_POST['billid']);
		$billpaymentid=intval($_POST['billpaymentid']);
		if($billid>0 && $billpaymentid>0){
			$query="UPDATE customers_bills SET payment_status=%i, updated_at=NOW() WHERE id=%i";
			$query=$sql->query($query, array($billpaymentid, $billid));
			if($db->query($query)){
				$type['type']="success";
			}
		}
		echo json_encode($type);
		exit(0);
	}
	
	$values[]=(isset($_POST['billyear']) && $_POST['billyear']>0)?$_POST['billyear']:date('Y');
	
	$qry = "SELECT count(*) as totalrecords FROM customers_bills WHERE YEAR(created_at)='%s' ORDER BY created_at DESC";
	$qry=$sql->query($qry, $values);
    $count = intval($db->queryUniqueValue($qry));
	
	$offset = (isset($_POST['offset']))?trim($_POST['offset']):0;
	$perpage = _PERPAGE_LISTING_;
	
	$paging = new PG($offset, $perpage, $count, "manage");
	
	$values[] = $offset;
    $values[] = $perpage;
	
	$query = "SELECT cb.id, cb.userid, cb.billname, cb.billno, cb.bill_amount, cb.paid_by, cb.paid_on, cb.remarks, cb.payment_status, companyname AS name FROM customers_bills cb 
			  LEFT JOIN customers c ON cb.customerid=c.id
			  WHERE YEAR(cb.created_at)='%s'
			  ORDER BY cb.created_at DESC LIMIT %i, %i";
	$query = $sql->query($query, $values);
	$result=$db->query($query);
	$limitcount=$db->numRows($result);
	
	include 'header.php';
?>
<td valign="top" style="padding: 20px">
	<div class="table-container">
		<div align="right" style="padding:10px">
			<form name="filterform" id="filterform" action="" method="post">
				<span>Select Year: </span>
				<select name="billyear" id="billyear" class="select_drop_down" style="width:100px;cursor:pointer" onchange="filterYears()">
					<option value="">Select</option>
					<?php 
						$yearq="SELECT YEAR(created_at) as year FROM customers_bills GROUP BY YEAR(created_at) ORDER BY created_at DESC";
						$yearr=$db->query($yearq);
						$yearc=$db->numRows($yearr);
						while($yearrw=$db->fetchNextObject($yearr)){ ?>
							<option value="<?php echo $yearrw->year; ?>" <?php echo ($_POST['billyear']==$yearrw->year)?"selected='selected'":"" ;?> ><?php echo $yearrw->year; ?></option>
						<?php }
					?>
				</select>
				<input type="hidden" name="offset" id="offset" value="<?php echo $offset; ?>"/>
			</form>
		</div>
		<div id="notify"><!-- --></div>
		<div>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td  valign="top" class="table-title" style="width:50px">&nbsp;</td>
					<td valign="top" class="table-title" style="width:50px">Sr No.</td>
					<td valign="top" class="table-title" style="width:100px">User Name</td>
					<td valign="top" class="table-title" style="width:200px">Customer Name</td>
					<td valign="top" class="table-title" style="width:100px">Bill Number</td>
					<td valign="top" class="table-title">Bill Name</td>
					<td valign="top" class="table-title" style="width:100px">Bill Amount</td>
					<td valign="top" class="table-title" style="width:100px">Paid by</td>
					<td valign="top" class="table-title" style="width:100px">Paid on</td>
					<td valign="top" class="table-title" style="width:100px">Payment status</td>
				</tr>
				<?php
					if($count>0){
						$counter=1;
						$paid_by="";
						while($row=$db->fetchNextObject($result)){
							$id=intval($row->id); 
							$uservalue=(intval($row->userid)==1)?"Jayesh bhai":"Bhavna ben";
							if($row->paid_by==1) $paid_by="Cheque"; else if($row->paid_by==2) $paid_by="Cash"; else $paid_by="";
				?>
						<tr>
							<td valign="top" class="table-data">
								<div class="action-icon" title="Print" style="cursor:pointer" onclick="printBills(<?php echo $id; ?>)">Print</div>
							</td>
							<td valign="top" class="table-data" title="<?php echo $counter+=$offset; ?>"><?php echo $counter+=$offset; ?></td>
							<td valign="top" class="table-data" title="<?php echo $uservalue; ?>"><?php echo ellipses($uservalue, 50); ?></td>
							<td valign="top" class="table-data" title="<?php echo trim($row->name); ?>"><?php echo ellipses(trim($row->name), 50); ?></td>
							<td valign="top" class="table-data" title="<?php echo trim($row->billno); ?>"><?php echo ellipses(trim($row->billno), 50); ?></td>
							<td valign="top" class="table-data" title="<?php echo trim($row->billname); ?>"><?php echo ellipses(trim($row->billname), 50); ?></td>
							<td valign="middle" class="table-data" title="<?php echo $row->bill_amount; ?>"><?php echo $row->bill_amount; ?></td>
							<td valign="middle" class="table-data" title="<?php echo $paid_by; ?>"><?php echo $paid_by; ?></td>
							<td valign="middle" class="table-data" title="<?php echo $row->paid_on; ?>"><?php echo $row->paid_on; ?></td>
							<td valign="middle" class="table-data">
								<select name="paymentstatus" id="paymentstatus<?php echo $id; ?>" style="width:80px" onchange="updateBillPayment(this, <?php echo $id; ?>)">
									<option value="0">Select</option>
									<?php foreach($BILLS_PAYMENT_STATUS_ as $payment_key => $payment_value){ ?>
										<option value="<?php echo $payment_key; ?>" <?php echo (intval($row->payment_status)==$payment_key)?'selected="selected"':""; ?>><?php echo $payment_value; ?></option>
									<?php } ?>
								</select>
							</td>
						</tr>
				<?php $counter++; } }else { ?>
						<tr>
							<td colspan="7">
								<div id="norecord"></div>
							</td>
						</tr>
						<script type="text/javascript" language="javascript">
							$("#norecord").notification({caption:"No Record found.", type: "warning", sticky:true});
						</script>
				<?php } ?>
				<form name="billformprint" id="billformprint" action="customer-bill-print.php" method="post">
					<input type="hidden" name="billprint" id="billprint" value="0">
					<input type="hidden" name="bill_id" id="bill_id" value="">
				</form>
			</table>
		</div>
	</div>
	<?php if($count>0){ ?>
		<div align="right" class="pull-right">
			<div class="showing-title">Showing <?php echo $limitcount; ?> of <?php echo $count; ?></div>
			<div>
				<table border="0" cellpadding="0" cellspacing="0">
					<tr>
					   <td valign="top" class="paging"><?php echo $paging->show(); ?></td>
					</tr>
				</table>
			</div>
		</div>
	<?php } ?>
</td>
<?php 
	include 'footer.php';
?>