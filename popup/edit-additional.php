<?php
	include '../libs/data/db.connect.php';
	
	$popup_title='Edit additional details';
	
	if(isset($_POST['add_id'])){
		$_SESSION['tab1']=0;
		$_SESSION['tab2']=1;
		$_SESSION['tab3']=0;
		$_SESSION['tab4']=0;
		
		$type['type']="error";
		$addid=intval($_POST['add_id']);
		if($addid>0){
			$query="UPDATE customer_additional_info SET detailname='%s', add_licence_no='%s', emailid='%s', password='%s', updated_at=NOW() WHERE id=%i";
			$query=$sql->query($query, array(trim($_POST['detailname']), trim($_POST['add_licence_no']), trim($_POST['emailid']), utf8_encode(trim($_POST['addpassword'])), $addid));
			if($db->query($query)){
				$type['type']="success";
			}
		}
		echo json_encode($type);
		exit(0);
	}
	
	include 'popup-header.php';
	
	$add_id=0;
	if(isset($_GET['id']) && intval($_GET['id'])>0){
		$add_id=intval($_GET['id']);
		
		$query="SELECT id, customerid, detailname, add_licence_no, emailid, password FROM customer_additional_info
				WHERE id=%i";
		$query=$sql->query($query, array($add_id));
		$result=$db->query($query);
		$count=$db->numRows($query);
		$row=$db->fetchNextObject($result);
	}
?>
<script type="text/javascript" src="popup/js/edit-additional.js"></script>
<tr>
	<td>
		<form name="additionalform" id="additionalform" action="popup/edit-additional.php" method="post">
			<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr><td colspan="2"><div id="notifypopup"><!-- --></div></td></tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right">
						<div class="listing_th_padding">Detail name</div>
					</td>
					<td><input type="text" name="detailname" id="detailname" value="<?php echo $row->detailname; ?>"></td>
				</tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right">
						<div class="listing_th_padding">Licence number</div>
					</td>
					<td>
						<input type="text" name="add_licence_no" id="add_licence_no" style="cursor: pointer; width: 100%; border: 0; padding:0" value="<?php echo $row->add_licence_no; ?>" />
					</td>
				</tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right">
						<div class="listing_th_padding">Id</div>
					</td>
					<td><input type="text" name="emailid" id="emailid" style="cursor: pointer; width: 100%; border: 0; padding:0" value="<?php echo $row->emailid; ?>" /></td>
				</tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right">
						<div class="listing_th_padding">Password</div>
					</td>
					<td><input type="text" name="addpassword" style="cursor: pointer; width: 100%; border: 0; padding:0" value="<?php echo utf8_decode($row->password); ?>" /></td>
				</tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="right" valign="top" colspan="2">
						<input type="hidden" name="add_id" id="add_id" value="<?php echo $add_id; ?>">
						<input type="hidden" name="customerid" id="customerid" value="<?php echo intval($row->customerid); ?>">
						<input type="submit" name="submitbtn" id="submitbtn" value="Save" class="add-button" style="margin:0">
					</td>
				</tr>
			</table>
		</form>
	</td>
</tr>
<?php 
	include 'popup-footer.php';
?>