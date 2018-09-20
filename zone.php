<?php 
	include 'libs/data/db.connect.php';
	
	if(isset($_POST['zoneid'])){
		$type['type']="error";
		$zoneid=intval($_POST['zoneid']);
		$values=array();
		$subquery="";
		
		$values[]=strtolower($_POST['zonename']);
		if($zoneid>0){
			$subquery=" AND id<>%i";
			$values[]=$zoneid;
		}
		$zonequery = "SELECT count(*) as totalrecords FROM zones WHERE lower(zonename)='%s'".$subquery;
		$zonequery=$sql->query($zonequery, $values);
    	$zonecount = intval($db->queryUniqueValue($zonequery));
	
		if($zonecount==0){
			if($zoneid>0){
				$query="UPDATE zones SET zonename='%s', updated_at=now() WHERE id=%i";
				$query=$sql->query($query, array(trim($_POST['zonename']), $zoneid));
				if($db->query($query)){
					$type['type']="success";
				}
			}else {
				$query="INSERT INTO zones SET zonename='%s', created_at=now(), updated_at=now()";
				$query=$sql->query($query, array(trim($_POST['zonename'])));
				if($db->query($query)){
					$type['type']="success";
				}
			}
		}else {
			$type['type']="recordexists";
		}
		
		echo json_encode($type);
		exit(0);
	}
	
	$zoneid=0;
	if(isset($_GET['zoneid']) && intval($_GET['zoneid'])>0){
		$zoneid=intval($_GET['zoneid']);
		
		$zonequery="SELECT id, zonename FROM zones WHERE id=%i";
		$zonequery=$sql->query($zonequery, array($zoneid));
		$zoneresult=$db->query($zonequery);
		$zonecount=$db->numRows($zoneresult);
		$zonerow=$db->fetchNextObject($zoneresult);
	}
	
	include 'header.php';
?>
<script type="text/javascript" src="js/zone.js"></script>
<td valign="top" style="padding: 20px">
	<div class="table-container">
		<div id="notify"><!-- --></div>
		<div valign="top" class="table-heading"><?php echo ($zoneid>0)?'Edit Zone':'New Zone'; ?></div>
		<div style="padding: 10px 30px 10px 28px;">
			<form name="zoneform" id="zoneform" action="" method="post">
				<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
					<tr>
						<td colspan="2" valign="top" class="addField">
							<div>Zone name</div>
							<div style="padding-top:5px"><input type="text" name="zonename" id="zonename" value="<?php echo ($zoneid>0 && $zonecount>0)?trim($zonerow->zonename):""; ?>"></div>
						</td>
					</tr>
					<tr><td style="padding-top:10px"><!-- --></td></tr>
					<tr>
						<td valign="top" class="addField">
							<div></div>
							<div style="padding-top:5px">
								<input type="hidden" name="zoneid" id="zoneid" value="<?php echo $zoneid; ?>">
								<input type="submit" name="savebtn" id="savebtn" value="Save" class="add-button" style="margin:0">
							</div>
						</td>
					</tr>
					<tr><td style="padding-top:10px"><!-- --></td></tr>
					<?php if($zoneid>0){ ?>
					<tr>
						<td class="zone-customers">Customers list for <?php echo trim($zonerow->zonename); ?> zone.</td>
					</tr>
					<tr><td style="padding-top:10px"><!-- --></td></tr>
					<tr>
						<td valign="top">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td valign="top" class="table-title" style="width:50px">Sr no.</td>
									<td valign="top" class="table-title">Customers</td>
								</tr>
								<?php 
									$qry="SELECT companyname AS customername FROM customers WHERE zoneid=%i";
									$qry=$sql->query($qry, array($zoneid));
									$res=$db->query($qry);
									$cnt=$db->numRows($res);
									if($cnt>0){
										$counter=1;
										while($rw=$db->fetchNextObject($res)){
								?>
									<tr>
										<td valign="top" class="table-data" title="<?php echo $counter; ?>"><?php echo $counter; ?></td>
										<td valign="top" class="table-data" title="<?php echo trim($rw->customername); ?>"><?php echo ellipses(trim($rw->customername), 50); ?></td>
									</tr>
								<?php $counter++; } }else { ?>
									<tr>
										<td colspan="2">
											<div id="norecord"></div>
										</td>
									</tr>
									<script type="text/javascript" language="javascript">
										$("#norecord").notification({caption:"No customer found in this zone.", type: "warning", sticky:true});
									</script>
							<?php } ?>
							</table>
						</td>
					</tr>
					<?php } ?>
				</table>
			</form>
		</div>
	</div>
</td>
<?php 
	include 'footer.php';
?>