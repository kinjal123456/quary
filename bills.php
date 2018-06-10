<?php 
	include 'libs/data/db.connect.php';
	include 'libs/data/db.paging.php';
	
	$query = "SELECT count(*) as totalrecords FROM customers_bills ORDER BY created_at DESC";
    $count = intval($db->queryUniqueValue($query));
	
	$offset = (isset($_POST['offset']))?trim($_POST['offset']):0;
	$perpage = _PERPAGE_LISTING_;
	
	$paging = new PG($offset, $perpage, $count, "manage");
	
	$values[] = $offset;
    $values[] = $perpage;
	
	$query = "SELECT cb.id, cb.userid, cb.billname, cb.billno, cb.bill_amount, CONCAT(c.firstname, ' ', c.lastname) AS name FROM customers_bills cb 
			  LEFT JOIN customers c ON cb.customerid=c.id 
			  ORDER BY cb.created_at DESC LIMIT %i, %i";
	$query = $sql->query($query, $values);
	$result=$db->query($query);
	$limitcount=$db->numRows($result);
	
	include 'header.php';
?>
<td valign="top" style="padding: 20px">
	<div class="table-container">
		<div id="notify"><!-- --></div>
		<div>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td valign="top" class="table-title" style="width:50px">Sr No.</td>
					<td valign="top" class="table-title" style="width:100px">User Name</td>
					<td valign="top" class="table-title" style="width:200px">Customer Name</td>
					<td valign="top" class="table-title" style="width:100px">Bill Number</td>
					<td valign="top" class="table-title">Bill Name</td>
					<td valign="top" class="table-title" style="width:100px">Bill Amount</td>
				</tr>
				<?php
					if($count>0){
						$counter=1;
						while($row=$db->fetchNextObject($result)){
							$id=intval($row->id); 
							$uservalue=(intval($row->userid)==1)?"Jayesh bhai":"Bhavna ben";
				?>
						<tr>
							<td valign="top" class="table-data" title="<?php echo $counter+=$offset; ?>"><?php echo $counter+=$offset; ?></td>
							<td valign="top" class="table-data" title="<?php echo $uservalue; ?>"><?php echo ellipses($uservalue, 50); ?></td>
							<td valign="top" class="table-data" title="<?php echo trim($row->name); ?>"><?php echo ellipses(trim($row->name), 50); ?></td>
							<td valign="top" class="table-data" title="<?php echo trim($row->billno); ?>"><?php echo ellipses(trim($row->billno), 50); ?></td>
							<td valign="top" class="table-data" title="<?php echo trim($row->billname); ?>"><?php echo ellipses(trim($row->billname), 50); ?></td>
							<td valign="middle" class="table-data" title="<?php echo $row->bill_amount; ?>"><?php echo $row->bill_amount; ?></td>
						</tr>
				<?php $counter++; } }else { ?>
						<tr>
							<td colspan="6">
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