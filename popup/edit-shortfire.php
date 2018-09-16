<?php
	include '../libs/data/db.connect.php';
	
	$popup_title='Edit Short fire permit details';
	
	if(isset($_POST['shortfireid'])){
		$_SESSION['tab1']=0;
		$_SESSION['tab2']=2;
		$_SESSION['tab3']=0;
		$_SESSION['tab4']=0;
		
		$type['type']="error";
		$shortid=intval($_POST['shortfireid']);
		if($shortid>0){
			$shortinsert="UPDATE customer_licence_info SET detail_type=%i, document_key='%s', licence_no='%s', name='%s', issue_date='%s', expiry_date='%s', updated_at=NOW() WHERE id=%i";
			$shortinsert=$sql->query($shortinsert, array(_SHORTFIRE_LICENCE_TYPE_, trim($_POST['short_doc_key']), trim($_POST['short_licenceno']), trim($_POST['short_name']), trim($_POST['short_issuedate']), trim($_POST['short_expirydate']), $shortid));
			if($db->query($shortinsert)){
				$type['type']='success';
			}
		}
		echo json_encode($type);
		exit(0);
	}
	
	include 'popup-header.php';
	
	$shortfireid=0;
	if(isset($_GET['id']) && intval($_GET['id'])>0){
		$shortfireid=intval($_GET['id']);
		
		$query="SELECT * FROM customer_licence_info WHERE id=%i AND detail_type=%i";
		$query=$sql->query($query, array($shortfireid, _SHORTFIRE_LICENCE_TYPE_));
		$result=$db->query($query);
		$count=$db->numRows($query);
		$row=$db->fetchNextObject($result);
	}
?>
<script type="text/javascript" src="popup/js/edit-shortfire.js"></script>
<tr>
	<td>
		<form name="shortfireform" id="shortfireform" action="popup/edit-shortfire.php" method="post">
			<table border="0" cellpadding="0" cellspacing="0" style="width:100%">
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr><td colspan="2"><div id="notifypopup"><!-- --></div></td></tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right">
						<div class="listing_th_padding">Document key</div>
					</td>
					<td><input type="text" name="short_doc_key" id="short_doc_key" class="short_doc_key" value="<?php echo $row->document_key; ?>"></td>
				</tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right">
						<div class="listing_th_padding">Licence number</div>
					</td>
					<td><input type="text" name="short_licenceno" id="short_licenceno" class="short_licenceno" value="<?php echo $row->licence_no; ?>" /></td>
				</tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right">
						<div class="listing_th_padding">Shortfire name</div>
					</td>
					<td><input type="text" name="short_name" id="short_name" class="short_name" value="<?php echo $row->name; ?>" /></td>
				</tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right">
						<div class="listing_th_padding">Issue date</div>
					</td>
					<td><input type="text" name="short_issuedate" class="short_issuedate" value="<?php echo (strlen($row->issue_date)>0)?trim($row->issue_date):''; ?>" /></td>
				</tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right">
						<div class="listing_th_padding">Expirty date</div>
					</td>
					<td><input type="text" name="short_expirydate" class="short_expirydate" value="<?php echo (strlen($row->expiry_date)>0)?trim($row->expiry_date):''; ?>" /></td>
				</tr>
				<tr><td colspan="2" style="height:10px"><!-- --></td></tr>
				<tr>
					<td align="right" valign="top" colspan="2">
						<input type="hidden" name="shortfireid" id="shortfireid" value="<?php echo $shortfireid; ?>">
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