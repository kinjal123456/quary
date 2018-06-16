<?php 
	include 'libs/data/db.connect.php';
	
	//Delete Employee
	if(isset($_POST['action']) && trim($_POST['action'])=="custEmpDelete"){
		$type['type']="error";
		$employeeid=intval($_POST['employeeid']);
		if($employeeid>0){
			$query="DELETE FROM customer_employees WHERE id=%i";
			$query=$sql->query($query, array($employeeid));
			if($db->query($query)){
				$type['type']="success";
			}
		}
		echo json_encode($type);
		exit(0);
	}
	
	//Delete Capacity
	if(isset($_POST['action']) && trim($_POST['action'])=="capacityDelete"){
		$type['type']="error";
		$capacityid=intval($_POST['capacityid']);
		if($capacityid>0){
			$query="DELETE FROM customer_explosive_capacity WHERE id=%i";
			$query=$sql->query($query, array($capacityid));
			if($db->query($query)){
				$type['type']="success";
			}
		}
		echo json_encode($type);
		exit(0);
	}
	
	//Delete Short fire
	if(isset($_POST['action']) && trim($_POST['action'])=="shortfireDelete"){
		$type['type']="error";
		$shortfireid=intval($_POST['shortfireid']);
		if($shortfireid>0){
			$query="DELETE FROM customer_licence_info WHERE id=%i AND detail_type=%i";
			$query=$sql->query($query, array($shortfireid, _SHORTFIRE_LICENCE_TYPE_));
			if($db->query($query)){
				$type['type']="success";
			}
		}
		echo json_encode($type);
		exit(0);
	}
	
	//Delete Details
	if(isset($_POST['action']) && trim($_POST['action'])=="detailsDelete"){
		$type['type']="error";
		$detailid=intval($_POST['detailid']);
		if($detailid>0){
			$query="DELETE FROM customer_additional_info WHERE id=%i";
			$query=$sql->query($query, array($detailid));
			if($db->query($query)){
				$type['type']="success";
			}
		}
		echo json_encode($type);
		exit(0);
	}
	
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
	
	if(isset($_POST['customerid'])){
		$type['type']="error";
		$custid=intval($_POST['customerid']);
		if($custid>0){
			if(isset($_POST['generalid']) && intval($_POST['generalid'])>0){//general updation
				$type["generalid"]="success";
				
				$custquery = "SELECT count(*) as totalrecords FROM customers WHERE email='%s' AND id<>%i";
				$custquery=$sql->query($custquery, array(trim($_POST['custemail']), $custid));
				$custcount = intval($db->queryUniqueValue($custquery));
		
				if($custcount>0){//if email address repeats
					$type['type']="success";
					$type['genstatus']="custexists";
				}else {
					$query="UPDATE customers SET zoneid=%i, companyname='%s', firstname='%s', lastname='%s', phone=%i, email='%s', password='%s', survey_no='%s', address='%s', pincode=%i, state='%s', updated_at=NOW() WHERE id=%i";
					$query=$sql->query($query, array(intval($_POST['zoneid']), trim($_POST['companynm']), trim($_POST['firstnm']), trim($_POST['lastnm']), trim($_POST['phoneno']), trim($_POST['custemail']), utf8_encode(trim($_POST['custpwd'])), trim($_POST['surveyno']), trim($_POST['custadd']), intval($_POST['custpincode']), trim($_POST['custstate']), $custid));
					if($db->query($query)){
						$type['type']="success";
						$type['genstatus']="success";
					}
				}
				
				//UPDATE CUSTOMERS EMPLOYEES
				for($e=0; $e<count($_POST['empname']); $e++){
					if(strlen(trim($_POST['empname'][$e]))>0 && strlen(trim($_POST['empdesignation'][$e]))>0 && strlen(trim($_POST['empmob'][$e]))>0){
						$empinsert="INSERT INTO customer_employees SET customerid=%i, name='%s', designation='%s', mobile_no=%i, created_at=NOW(), updated_at=NOW()";
						$empinsert=$sql->query($empinsert, array($custid, trim($_POST['empname'][$e]), trim($_POST['empdesignation'][$e]), trim($_POST['empmob'][$e])));
						if($db->query($empinsert)){
							$type['custempstatus']="success";
						}
					}
				}
			}else if(isset($_POST['additionalid']) && intval($_POST['additionalid'])>0){//additional information
				$type['additionalid']="success";
				
				if(isset($_POST['explosiveid'])){
					$explosiveid=intval($_POST['explosiveid']);
					if($explosiveid>0){
						//UPDATE EXPLOSIVE DETAILS
						$expinsert="UPDATE customer_licence_info SET customerid=%i, detail_type=%i, document_key='%s', licence_no='%s', name='%s', issue_date='%s', expiry_date='%s', updated_at=NOW() WHERE id=%i";
						$expinsert=$sql->query($expinsert, array($custid, _EXPLOSIVE_LICENCE_TYPE_, trim($_POST['explosive_dockey']), trim($_POST['explosive_licenceno']), trim($_POST['explosive_occupiernm']), trim($_POST['explosive_issuedate']), trim($_POST['explosive_expirydate']), $explosiveid));
						if($db->query($expinsert)){
							$type['explosivestatus']='success';
						}
					}else {
						//INSERT EXPLOSIVE DETAILS
						$expinsert="INSERT INTO customer_licence_info SET customerid=%i, detail_type=%i, document_key='%s', licence_no='%s', name='%s', issue_date='%s', expiry_date='%s', created_at=NOW(), updated_at=NOW()";
						$expinsert=$sql->query($expinsert, array($custid, _EXPLOSIVE_LICENCE_TYPE_, trim($_POST['explosive_dockey']), trim($_POST['explosive_licenceno']), trim($_POST['explosive_occupiernm']), trim($_POST['explosive_issuedate']), trim($_POST['explosive_expirydate'])));
						if($db->query($expinsert)){
							$type['explosivestatus']='success';
						}
					}
				}
				
				//UPDATE EXPLOSIVE CAPACITY DETAILS
				for($c=0; $c<count($_POST['capacity_explosivenm']); $c++){
					if(strlen(trim($_POST['capacity_explosivenm'][$c]))>0 && strlen(trim($_POST['capacity_class'][$c]))>0 && strlen(trim($_POST['capacity_division'][$c]))>0){
						$capinsert="INSERT INTO customer_explosive_capacity SET customerid=%i, srno=%i, explosive_name='%s', class='%s', division='%s', qty_at_time='%s', unit='%s', no_of_time='%s', created_at=NOW(), updated_at=NOW()";
						$capinsert=$sql->query($capinsert, array($custid, intval($_POST['capacity_srno'][$c]), trim($_POST['capacity_explosivenm'][$c]), trim($_POST['capacity_class'][$c]), trim($_POST['capacity_division'][$c]), trim($_POST['capacity_qty'][$c]), trim($_POST['capacity_unit'][$c]), trim($_POST['capacity_notimes'][$c])));
						if($db->query($capinsert)){
							$type['capacitystatus']="success";
						}
					}
				}
				
				//UPDATE SHORT FIRE DETAILS
				for($s=0; $s<count($_POST['short_name']); $s++){
					if(strlen(trim($_POST['short_name'][$s]))>0 && strlen(trim($_POST['short_doc_key'][$s]))>0 && strlen(trim($_POST['short_licenceno'][$s]))>0){
						$shortinsert="INSERT INTO customer_licence_info SET customerid=%i, detail_type=%i, document_key='%s', licence_no='%s', name='%s', issue_date='%s', expiry_date='%s', created_at=NOW(), updated_at=NOW()";
						$shortinsert=$sql->query($shortinsert, array($custid, _SHORTFIRE_LICENCE_TYPE_, trim($_POST['short_doc_key'][$s]), trim($_POST['short_licenceno'][$s]), trim($_POST['short_name'][$s]), trim($_POST['short_issuedate'][$s]), trim($_POST['short_expirydate'][$s])));
						if($db->query($shortinsert)){
							$type['shortstatus']='success';
						}
					}
				}
				
				//UPDATE ADDITIONAL LAST FIELDS DETAILS
				for($i=0; $i<count($_POST['detailname']); $i++){
					if(strlen(trim($_POST['detailname'][$i]))>0 && strlen(trim($_POST['emailid'][$i]))>0 && strlen(trim($_POST['addpassword'][$i]))>0){
						$query="INSERT INTO customer_additional_info SET customerid=%i, detailname='%s', emailid='%s', password='%s', created_at=NOW(), updated_at=NOW()";
						$query=$sql->query($query, array($custid, trim($_POST['detailname'][$i]), trim($_POST['emailid'][$i]), utf8_encode(trim($_POST['addpassword'][$i]))));
						if($db->query($query)){
							$type['addstatus']="success";
						}
					}
				}
				
				$type['type']="success";

			}else if(isset($_POST['billid']) && intval($_POST['billid'])>0){//bills insertion
				$type['billid']="success";
				
				for($b=0; $b<count($_POST['user']); $b++){
					if(intval($_POST['user'][$b])>0 && strlen(trim($_POST['billname'][$b]))>0 && strlen(trim($_POST['billamt'][$b]))>0){
						
						$billquery = "SELECT count(*) as totalrecords FROM customers_bills WHERE customerid=%i AND userid=%i";
						$billquery=$sql->query($billquery, array($custid, intval($_POST['user'][$b])));
						$billcount = intval($db->queryUniqueValue($billquery));
				
						if($billcount==0){
							$query="INSERT INTO customers_bills SET customerid=%i, userid=%i, billno='%s', billname='%s', bill_amount='%s', created_at=NOW(), updated_at=NOW()";
							$query=$sql->query($query, array($custid, intval($_POST['user'][$b]), genRandomString(5), trim($_POST['billname'][$b]), trim($_POST['billamt'][$b])));
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
			}
		}
		
		echo json_encode($type);
		exit(0);
	}
	
	$customerid=0;
	if(isset($_GET['custid']) && intval($_GET['custid'])>0){
		$customerid=intval($_GET['custid']);
		
		$custquery="SELECT id, zoneid, companyname, firstname, lastname, email, password, phone, survey_no, address, pincode, state FROM customers WHERE id=%i";
		$custquery=$sql->query($custquery, array($customerid));
		$custresult=$db->query($custquery);
		$custcount=$db->numRows($custresult);
		$custrow=$db->fetchNextObject($custresult);
	}
	
	include 'header.php';
?>
<script type="text/javascript" src="js/customer.js"></script>
<td valign="top" style="padding: 20px">
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
				<form name="customerform" id="customerform" action="" method="post">
					<div class="tab_content_container">
						<!-- Genereal Details -->
						<div id="gencontent" style="display:block">
							<?php include_once "customer-general-details.php"; ?>
						</div>
						<!-- Additional Details -->
						<div id="addcontent">
							<?php include_once "customer-additional-details.php"; ?>
						</div>
						<!-- Bills -->
						<div id="billcontent">
							<?php include_once "customer-bills-details.php"; ?>
						</div>
						<!-- Registers -->
						<div id="regcontent">
							<?php include_once "customer-register-details.php"; ?>
						</div>
					</div>
					<div style="padding-top:10px">
						<input type="hidden" class="hiddencomponent" name="generalid" id="generalid" value="">
						<input type="hidden" class="hiddencomponent" name="additionalid" id="additionalid" value="">
						<input type="hidden" class="billid" name="billid" id="billid" value="">
						<input type="hidden" name="customerid" id="customerid" value="<?php echo $customerid; ?>">
						<input type="hidden" name="print" id="print" value="0">
						<input type="submit" name="submitbtn" id="submitbtn" value="Save" class="add-button" style="margin-left:0">
					</div>
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