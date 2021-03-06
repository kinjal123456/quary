<?php 
	include 'libs/data/db.connect.php';
	session_start();
	
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
	
	//Delete Notes
	if(isset($_POST['action']) && trim($_POST['action'])=="noteDelete"){
		$type['type']="error";
		$noteid=intval($_POST['noteid']);
		if($noteid>0){
			$query="DELETE FROM customer_notes WHERE id=%i";
			$query=$sql->query($query, array($noteid));
			if($db->query($query)){
				$type['type']="success";
			}
		}
		echo json_encode($type);
		exit(0);
	}
	
	if(isset($_POST['customerid'])){
		$type['type']="error";
		
		$_SESSION['tab1']=0;
		$_SESSION['tab2']=0;
		$_SESSION['tab3']=0;
		$_SESSION['tab4']=0;
		
		$custid=intval($_POST['customerid']);
		if($custid>0){
			if(isset($_POST['generalid']) && intval($_POST['generalid'])>0){//general updation
				$type["generalid"]="success";
				$_SESSION['tab1']=1;
				
				$custquery = "SELECT count(*) as totalrecords FROM customers WHERE email='%s' AND id<>%i";
				$custquery=$sql->query($custquery, array(trim($_POST['custemail']), $custid));
				$custcount = intval($db->queryUniqueValue($custquery));
		
				if($custcount>0){//if email address repeats
					$type['type']="success";
					$type['genstatus']="custexists";
				}else {
					$query="UPDATE customers SET zoneid=%i, companyname='%s', phone='%s', email='%s', password='%s', survey_no='%s', address='%s', address2='%s', address3='%s', pincode=%i, state='%s', updated_at=NOW() WHERE id=%i";
					$query=$sql->query($query, array(intval($_POST['zoneid']), trim($_POST['companynm']), trim($_POST['phoneno']), trim($_POST['custemail']), utf8_encode(trim($_POST['custpwd'])), trim($_POST['surveyno']), trim($_POST['custadd']), trim($_POST['custadd2']), trim($_POST['custadd3']), $_POST['custpincode'], trim($_POST['custstate']), $custid));
					if($db->query($query)){
						$type['type']="success";
						$type['genstatus']="success";
					}
				}
				
				//UPDATE CUSTOMERS EMPLOYEES
				for($e=0; $e<count($_POST['empname']); $e++){
					if(strlen(trim($_POST['empname'][$e]))>0 && strlen(trim($_POST['empdesignation'][$e]))>0 && strlen(trim($_POST['empmob'][$e]))>0){
						$empinsert="INSERT INTO customer_employees SET customerid=%i, name='%s', designation='%s', mobile_no='%s', created_at=NOW(), updated_at=NOW()";
						$empinsert=$sql->query($empinsert, array($custid, trim($_POST['empname'][$e]), trim($_POST['empdesignation'][$e]), trim($_POST['empmob'][$e])));
						if($db->query($empinsert)){
							$type['custempstatus']="success";
						}
					}
				}
			}else if(isset($_POST['additionalid']) && intval($_POST['additionalid'])>0){//additional information
				$type['additionalid']="success";
				$_SESSION['tab2']=1;
				
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
						$query="INSERT INTO customer_additional_info SET customerid=%i, detailname='%s', add_licence_no='%s', emailid='%s', password='%s', created_at=NOW(), updated_at=NOW()";
						$query=$sql->query($query, array($custid, trim($_POST['detailname'][$i]), trim($_POST['add_licence_no'][$i]), trim($_POST['emailid'][$i]), utf8_encode(trim($_POST['addpassword'][$i]))));
						if($db->query($query)){
							$type['addstatus']="success";
						}
					}
				}
				
				$type['type']="success";
				
			}else if(isset($_POST['noteid']) && intval($_POST['noteid'])>0){//notes insertion
				$type['noteid']="success";
				$_SESSION['tab4']=1;
				
				for($n=0; $n<count($_POST['cust_note']); $n++){
					if(strlen($_POST['cust_note'][$n])>0){
						$query="INSERT INTO customer_notes SET customerid=%i, subject='%s', note_date='%s', notes='%s', created_at=NOW(), updated_at=NOW()";
						$query=$sql->query($query, array($custid, trim($_POST['subject'][$n]), trim($_POST['note_date'][$n]), trim($_POST['cust_note'][$n])));
						if($db->query($query)){
							$type['type']="success";
							$type['notestatus']="success";
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
		
		$custquery="SELECT id, zoneid, companyname, email, password, phone, survey_no, address, address2, address3, pincode, state FROM customers WHERE id=%i";
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
					<a class="tab <?php echo (isset($_SESSION['tab1']) && intval($_SESSION['tab1'])==1)?'active_tab':''; ?>" id="general">General Details</a>
					<a class="tab <?php echo (isset($_SESSION['tab2']) && intval($_SESSION['tab2'])==1)?'active_tab':''; ?>" id="additional">Additional Details</a>
					<a class="tab <?php echo (isset($_SESSION['tab3']) && intval($_SESSION['tab3'])==1)?'active_tab':''; ?>" id="registers">Registers</a>
					<a class="tab <?php echo (isset($_SESSION['tab4']) && intval($_SESSION['tab4'])==1)?'active_tab':''; ?>" id="notes">Notes</a>
				</div>
			</div>
			<div style="padding:20px">
				<form name="customerform" id="customerform" action="" method="post">
					<div class="tab_content_container">
						<!-- Genereal Details -->
						<div id="gencontent" style="display:<?php echo (isset($_SESSION['tab1']) && intval($_SESSION['tab1'])==1)?'block':'none'; ?>">
							<?php include_once "customer-general-details.php"; ?>
						</div>
						<!-- Additional Details -->
						<div id="addcontent" style="display:<?php echo (isset($_SESSION['tab2']) && intval($_SESSION['tab2'])==1)?'block':'none'; ?>">
							<?php include_once "customer-additional-details.php"; ?>
						</div>
						<!-- Registers -->
						<div id="regcontent" style="display:<?php echo (isset($_SESSION['tab3']) && intval($_SESSION['tab3'])==1)?'block':'none'; ?>">
							<?php include_once "customer-register-details.php"; ?>
						</div>
						<!-- Registers -->
						<div id="notescontent" style="display:<?php echo (isset($_SESSION['tab4']) && intval($_SESSION['tab4'])==1)?'block':'none'; ?>">
							<?php include_once "customer-notes-details.php"; ?>
						</div>
					</div>
					<div style="padding-top:10px">
						<input type="hidden" class="hiddencomponent" name="generalid" id="generalid" value="<?php echo (isset($_SESSION['tab1']) && intval($_SESSION['tab1'])==1)?1:''; ?>">
						<input type="hidden" class="hiddencomponent" name="additionalid" id="additionalid" value="<?php echo (isset($_SESSION['tab2']) && intval($_SESSION['tab2'])==1)?1:''; ?>">
						<input type="hidden" class="billid" name="billid" id="billid" value="<?php echo (isset($_SESSION['tab3']) && intval($_SESSION['tab3'])==1)?1:''; ?>">
						<input type="hidden" class="noteid" name="noteid" id="noteid" value="<?php echo (isset($_SESSION['tab4']) && intval($_SESSION['tab4'])==1)?1:''; ?>">
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