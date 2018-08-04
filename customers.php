<?php 
	include 'libs/data/db.connect.php';
	include 'libs/data/db.paging.php';
	
	//Delete customer
	if(isset($_POST['action']) && trim($_POST['action'])=="customerDelete"){
		$type["type"]='error';
		$type["usernotiy"]=false;
		$confirmFlag=intval($_POST['confirmFlag']);
		
		if(isset($_POST['customerid'])){
			$customerid=$_POST['customerid'];
			$uploadid=array();
			
			$type=deletecustomerBycustomerid($customerid, $confirmFlag);
		}
		echo json_encode($type);
        exit(0);
	}
	
	//-------------------------------UPLOAD FILE TO DATA FOLDER-----------------------//
    if(isset($_POST['action']) && $_POST['action']=="uploadcustomerfile"){
        $type="error";
        $uploadid=0;
		$userid=intval($_POST['userid']);
		
        if($userid>0 && isset($_FILES['file']['tmp_name']) && $_FILES['file']['tmp_name']!=""){
            $query="INSERT INTO customerupload SET created_at=NOW(),updated_at=NOW()";
            if($db->query($query)){
                $uploadid=$db->lastInsertedId();
            }
            $uploads_dir="upload/customers/".$uploadid."/";
            createdir($uploads_dir);
            $originalfilename=$_FILES["file"]["name"];
            $path_parts = pathinfo($originalfilename);
            $displayname=$path_parts['filename'];
            $fileextension=pathinfo($originalfilename,PATHINFO_EXTENSION);
            $filename=gettempname($uploads_dir,$fileextension);
            $destinationpath=$uploads_dir.$filename;
            if(move_uploaded_file($_FILES['file']['tmp_name'],$destinationpath)){
                $query="Update customerupload SET filename='%s',updated_at=NOW() where id=%i";
                $query=$sql->query($query,array($filename, $uploadid));
                if($db->query($query)){
                    $type="success";
                }
            }
        }
        echo '{"type":"' . $type . '","uploadid":"' . $uploadid. '"}';
        exit(0); 
    }
	
	$values=array();
	
	$searchValue="";
	$searchText="";
	if(isset($_POST['searchcustomer']) && strlen($_POST['searchcustomer'])>0){
		$searchValue=trim($_POST['searchcustomer']);
		$searchText=" WHERE (LOWER(companyname) LIKE '%s%' OR LOWER(firstname) LIKE '%s%' OR LOWER(lastname) LIKE '%s%' OR email LIKE '%s')";
		$values[]=$searchValue;
		$values[]=$searchValue;
		$values[]=$searchValue;
		$values[]=$searchValue;
	}
	
	$query = "SELECT count(*) as totalrecords FROM customers ".$searchText." ORDER BY created_at DESC";
    $count = intval($db->queryUniqueValue($query));
	
	$offset = (isset($_POST['offset']))?trim($_POST['offset']):0;
	$perpage = _PERPAGE_LISTING_;
	
	$paging = new PG($offset, $perpage, $count, "manage");
	
	$values[] = $offset;
    $values[] = $perpage;
	
	$query = "SELECT id, firstname, lastname, email, phone FROM customers ".$searchText." ORDER BY created_at DESC LIMIT %i, %i";
	$query=$sql->query($query, $values);
	$result=$db->query($query);
	$limitcount=$db->numRows($result);
	
	include 'header.php';
?>
<form name="customeruploadform" id="customeruploadform" method="post" action="customerupload.php">
	<input type="hidden" name="uploadid" id="uploadid" value="">
</form>
<td valign="top" style="padding: 20px">
	<div class="table-container">
		<div id="notify"><!-- --></div>
		<div>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td align="right" colspan="7">
						<?php if($count>0){ ?>
						<div class="pull-left">
							<a href="#"><input type="button" name="deletebtn" id="deletebtn" value="Delete" class="add-button" onclick="deleteMultipleCustomers(this)"></a>
						</div>
						<form name="filterform" id="filterform" action="" method="post">
						<div class="pull-left">
							<div>
								<div class="pull-left" style="padding:10px 0">
									<input type="hidden" name="offset" id="offset" value="<?php echo $offset; ?>"/>
									<input type="text" name="searchcustomer" id="searchcustomer" value="<?php echo $searchValue; ?>">
								</div>
								<div class="pull-left">
									<input type="submit" name="submitbtn" id="submitbtn" value="Search" class="add-button">
								</div>
								<div class="clearall"><!-- --></div>
							</div>
						</div>
						</form>
						<?php } ?>
						<?php 
							$zonequery = "SELECT count(*) as totalrecords FROM zones";
    						$zonecount = intval($db->queryUniqueValue($zonequery));
							if($zonecount>0){
						?>
						<div class="pull-right"><a href="customeradd.php"><input type="button" name="addcustomer" id="addcustomer" value="Add Customer" class="add-button" style="margin-left:0"></a></div>
						<div>
							<script type="text/javascript" src="js/customers.js"></script>
							<form action="" method="post" name="uploadcustomerform" id="uploadcustomerform">
								<div class="pull-right">
									<input type="submit" name="submitbtn" id="submitbtn" value="Upload" class="add-button">
								</div>
								<div align="right" style="width: 35%; padding-top:8px" class="pull-right">
									<input type="hidden" name="action" id="action" value="uploadcustomerfile"/>
									<input type="hidden" name="userid" id="userid" value="<?php echo $userid; ?>">
									<input type="file" name="file" id="file"/>
								</div>
								<div class="clearall"><!-- --></div>
							</form>
						</div>
						<?php } ?>
						<div class="clearall"><!-- --></div>
					</td>
				</tr>
				<tr>
					<td valign="top" class="table-title" style="width:30px;padding-top:10px"><input type="checkbox" name="selectall" id="selectall"></td>
					<td valign="top" class="table-title" style="width:50px">Sr no.</td>
					<td valign="top" class="table-title">First Name</td>
					<td valign="top" class="table-title">Last Name</td>
					<td valign="top" class="table-title">Email</td>
					<td valign="top" class="table-title">Phone Number</td>
					<td valign="top" class="table-title" style="width:100px">Actions</td>
				</tr>
				<?php
					if($count>0){
						$counter=1;
						while($row=$db->fetchNextObject($result)){
						$id=intval($row->id); ?>
						<tr>
							<td valign="top" class="table-data"><input type="checkbox" name="selectcustomer" id="selectcustomer" class="selectcheckbox" value="<?php echo $id; ?>"></td>
							<td valign="top" class="table-data" title="<?php echo $counter; ?>"><?php echo $counter; ?></td>
							<td valign="top" class="table-data" title="<?php echo trim($row->firstname); ?>"><?php echo ellipses(trim($row->firstname), 50); ?></td>
							<td valign="top" class="table-data" title="<?php echo trim($row->lastname); ?>"><?php echo ellipses(trim($row->lastname), 20); ?></td>
							<td valign="top" class="table-data" title="<?php echo trim($row->email); ?>"><?php echo ellipses(trim($row->email), 50); ?></td>
							<td valign="top" class="table-data" title="<?php echo trim($row->phone);?>"><?php echo trim($row->phone); ?></td>
							<td valign="middle" class="table-data"> 
								<div>
									<div class="pull-left action-icon"><a href="customer.php?custid=<?php echo $id; ?>" title="View"><img src="images/view-icon.png"></a></div>
									<div class="pull-left action-icon"><img src="images/delete-icon.png" onclick="deleteCustomer(this, <?php echo $id; ?>)" title="Delete"></div>
								</div>
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