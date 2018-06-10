<table border="0" cellpadding="0" cellspacing="0" id="appendbillcontent" class="billslisting">
	<?php 
		$billsqry="SELECT id, customerid, userid, billno, billname, bill_amount FROM customers_bills WHERE customerid=%i";
		$billsqry=$sql->query($billsqry, array($customerid));
		$billsres=$db->query($billsqry);
		$billscnt=$db->numRows($billsres);
		$counter=1;
		if($billscnt>0){
	?>
	<tr>
		<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right" style="width: 50px;">&nbsp;</td>
		<td valign="top" class="list_table_th border_top border_bottom border_right" style="width:100px"><div class="listing_th_padding">Sr no.</div></td>
		<td valign="top" class="list_table_th border_top border_bottom border_right" style="width:100px"><div class="listing_th_padding">User</div></td>
		<td valign="top" class="list_table_th border_top border_bottom border_right" style="width:200px"><div class="listing_th_padding">Bill number</div></td>
		<td valign="top" class="list_table_th border_top border_bottom border_right" style="width:200px"><div class="listing_th_padding">Bill name</div></td>
		<td valign="top" class="list_table_th border_top border_bottom border_right" style="padding-right:28px"><div class="listing_th_padding">Bill amount</div></td>
	</tr>
	<?php while($billsrw=$db->fetchNextObject($billsres)){
			$uservalue=(intval($billsrw->userid)==1)?"Jayesh bhai":"Bhavna ben";
			$customestyle=($billscnt==$counter)?'style="border-bottom: solid 1px #e6e6e6;"':'';
	?>
	<tr>
		<td align="center" valign="middle" class="border_bottom border_left border_right">
			<div>
				<div title="Delete" class="icon_delete" onclick="deleteBills(this, <?php echo intval($billsrw->id); ?>, <?php echo intval($billsrw->customerid); ?>)"></div>
			</div>
		</td>
		<td valign="top" class="border_bottom border_right" title="<?php echo $counter; ?>" <?php echo $customestyle; ?>><div style="padding: 10px"><?php echo $counter; ?></div></td>
		<td valign="top" class="border_bottom border_right" title="<?php echo $uservalue; ?>" <?php echo $customestyle; ?>><div style="padding: 10px"><?php echo $uservalue; ?></div></td>
		<td valign="top" class="border_bottom border_right" title="<?php echo trim($billsrw->billno); ?>" <?php echo $customestyle; ?>><div style="padding: 10px"><?php echo ellipses(trim($billsrw->billno), 20); ?></div></td>
		<td valign="top" class="border_bottom border_right" title="<?php echo trim($billsrw->billname); ?>" <?php echo $customestyle; ?>><div style="padding: 10px"><?php echo ellipses(trim($billsrw->billname), 50); ?></div></td>
		<td valign="top" class="border_bottom border_right" title="<?php echo trim($billsrw->bill_amount);?>" <?php echo $customestyle; ?>><div style="padding: 10px"><?php echo trim($billsrw->bill_amount); ?></div></td>
	</tr>
	<?php if($billscnt==$counter){ ?>
	<tr><td style="height:20px"><!-- --></td></tr>
	<?php } ?>
	<?php $counter++; } } ?>
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
	<tr>
		<td colspan="6" style="padding-left:16px">
			<div title="Add" class="icon_add icon_add_bill"></div>
		</td>
	</tr>
</table>