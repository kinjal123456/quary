<table border="0" cellpadding="0" cellspacing="0">
	<?php 
		$billsqry="SELECT userid, billno, billname, bill_amount FROM customers_bills WHERE customerid=%i";
		$billsqry=$sql->query($billsqry, array($customerid));
		$billsres=$db->query($billsqry);
		$billscnt=$db->numRows($billsres);
		$counter=1;
		if($billscnt>0){
	?>
	<tr>
		<td valign="top" class="table-title" style="width:50px">Sr no.</td>
		<td valign="top" class="table-title">User</td>
		<td valign="top" class="table-title">Bill number</td>
		<td valign="top" colspan="2" class="table-title">Bill name</td>
		<td valign="top" class="table-title" style="padding-right:28px">Bill amount</td>
	</tr>
	<?php while($billsrw=$db->fetchNextObject($billsres)){
			$uservalue=(intval($billsrw->userid)==1)?"Jayesh bhai":"Bhavna ben";
			$customestyle=($billscnt==$counter)?'style="border-bottom: solid 1px #e6e6e6;"':'';
	?>
	<tr>
		<td valign="top" class="table-data" title="<?php echo $counter; ?>" <?php echo $customestyle; ?>><?php echo $counter; ?></td>
		<td valign="top" class="table-data" title="<?php echo $uservalue; ?>" <?php echo $customestyle; ?>><?php echo $uservalue; ?></td>
		<td valign="top" class="table-data" title="<?php echo trim($billsrw->billno); ?>" <?php echo $customestyle; ?>><?php echo ellipses(trim($billsrw->billno), 20); ?></td>
		<td valign="top" colspan="2" class="table-data" title="<?php echo trim($billsrw->billname); ?>" <?php echo $customestyle; ?>><?php echo ellipses(trim($billsrw->billname), 50); ?></td>
		<td valign="top" class="table-data" title="<?php echo trim($billsrw->bill_amount);?>" <?php echo $customestyle; ?>><?php echo trim($billsrw->bill_amount); ?></td>
	</tr>
	<?php if($billscnt==$counter){ ?>
	<tr><td style="height:20px"><!-- --></td></tr>
	<?php } ?>
	<?php $counter++; } } ?>
</table>
<table border="0" cellpadding="0" cellspacing="0" id="appendbillcontent" class="billslisting">
	<tr class="bills template" style="height:40px;display:none">
		<td>
			<div title="Delete" class="icon_delete"></div>
		</td>
		<td style="padding:0 10px">
			<div class="addField">User: </div>
		</td>
		<td>
			<div class="customer-table-data">
				<select name="user[]" id="user" class="user select_drop_down">
					<option value="">Select user</option>
					<option value="1">Jayesh bhai</option>
					<option value="2">Bhavna ben</option>
				</select>
			</div>
		</td>
		<td style="padding:0 10px 0 20px">
			<div class="addField">Bill name: </div>
		</td>
		<td>
			<div class="customer-table-data"><input type="text" name="billname[]" id="billname" class="billname" value=""></div>
		</td>
		<td style="padding:0 10px 0 20px">
			<div class="addField">Amount: </div>
		</td>
		<td>
			<div class="customer-table-data"><input type="text" name="billamt[]" id="billamt" class="billamt" value=""></div>
		</td> 
	</tr>
	<tr><td style="height:10px"><!--  --></td></tr>
	<tr>
		<td colspan="7">
			<div title="Add" class="icon_add icon_add_bill"></div>
		</td>
	</tr>
</table>