<?php 
	include 'libs/data/db.connect.php';
	include 'libs/data/db.paging.php';
	
	//Delete Zone
	if(isset($_POST['action']) && trim($_POST['action'])=="zoneDelete"){
		$type['type']="error";
		$zoneid=intval($_POST['zoneid']);
		if($zoneid>0){
			$query="DELETE FROM zones WHERE id=%i";
			$query=$sql->query($query, array($zoneid));
			if($db->query($query)){
				$type['type']="success";
			}
		}
		echo json_encode($type);
		exit(0);
	}
	
	$search='Search';
	$searchPart='';
	$values=array();
	
	$query = "SELECT count(*) as totalrecords FROM zones ORDER BY created_at DESC";
    $count = intval($db->queryUniqueValue($query));
	
	$offset = (isset($_POST['offset']))?trim($_POST['offset']):0;
	$perpage = _PERPAGE_LISTING_;
	
	$paging = new PG($offset, $perpage, $count, "manage");
	
	$values[] = $offset;
    $values[] = $perpage;
	
	$query = "SELECT id, zonename FROM zones ORDER BY created_at DESC LIMIT %i, %i";
	$query = $sql->query($query, $values);
	$result=$db->query($query);
	$limitcount=$db->numRows($result);
	
	include 'header.php';
?>
<form name="filterform" id="filterform" action="" method="post">
    <input type="hidden" name="offset" id="offset" value="<?php echo $offset; ?>"/>
</form>
<td valign="top" style="padding: 20px">
	<div class="table-container">
		<div id="notify"><!-- --></div>
		<div>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td align="right" colspan="3">
						<a href="zone.php"><input type="button" name="addbtn" id="addbtn" value="Add Zone" class="add-button"></a>
					</td>
				</tr>
				<tr>
					<td valign="top" class="table-title" style="width:50px">Sr No.</td>
					<td valign="top" class="table-title">Zone name</td>
					<td valign="top" class="table-title" style="width:100px">Actions</td>
				</tr>
				<?php
					if($count>0){
						$counter=1;
						while($row=$db->fetchNextObject($result)){
						$id=intval($row->id); ?>
						<tr>
							<td valign="top" class="table-data" title="<?php echo $counter; ?>"><?php echo $counter; ?></td>
							<td valign="top" class="table-data" title="<?php echo trim($row->zonename); ?>"><?php echo ellipses(trim($row->zonename), 50); ?></td>
							<td valign="middle" class="table-data">
								<div>
									<div class="pull-left action-icon"><a href="zone.php?zoneid=<?php echo $id; ?>" title="View"><img src="images/view-icon.png"></a></div>
									<div class="pull-left action-icon"><img src="images/delete-icon.png" onclick="deleteZone(this, <?php echo $id; ?>)" title="Delete"></div>
								</div>
							</td>
						</tr>
				<?php $counter++; } }else { ?>
						<tr>
							<td colspan="3">
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