<?php 
	$billsqry="SELECT id, customerid, userid, billno, billname, bill_amount FROM customers_bills WHERE customerid=%i AND YEAR(created_at)=%i";
	$billsqry=$sql->query($billsqry, array($customerid, date('Y')));
	$billsres=$db->query($billsqry);
	$billscnt=$db->numRows($billsres);
?>
<table border="0" cellpadding="0" cellspacing="0" id="appendbillcontent" class="billslisting" style="width:100%">
	<tr>
		<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right" style="width: 80px;">&nbsp;</td>
		<td align="left" valign="top" class="list_table_th border_top border_bottom border_right"><div class="listing_th_padding">Sr no.</div></td>
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
			<div>
				<div title="Delete" class="icon_delete pull-left" onclick="deleteBills(this, <?php echo intval($billsrw->id); ?>, <?php echo intval($billsrw->customerid); ?>)" style="margin-left:10px"></div>
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
				<select name="user[]" id="user" class="user select_drop_down">
					<option value="">Select user</option>
					<option value="1">Jayesh bhai</option>
					<option value="2">Bhavna ben</option>
				</select>
			</div>
		</td>
		<td align="left" valign="top" class="border_bottom border_right">
			<div style="padding: 10px">
				<input type="text" name="billno[]" id="billno" class="billno" value="">
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
	<?php if($billscnt<2){ ?>
		<tr>
			<td colspan="8" align="left" valign="top" class="border_right">
				<div style="padding:10px;">
					<div title="Add" class="icon_add icon_add_bill"></div>
				</div>
			</td>
		</tr>
	<?php } ?>
</table>