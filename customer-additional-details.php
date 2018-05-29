<div class="border_top border_bottom border_left border_right">
	<div class="table_additional_data_heading">Explosive licence occupier details</div>
	<div class="border_top border_bottom border_left border_right" style="margin:20px">
		<div>
			<table border="0" cellpadding="0" cellspacing="0" class="list_table addlisting" style="width:100%">
				<tr>
					<td align="left" valign="top" class="list_table_th border_bottom border_right"><div class="listing_th_padding">Document key</div></td>
					<td align="left" valign="top" class="list_table_th border_bottom border_right"><div class="listing_th_padding">Licence number</div></td>
					<td align="left" valign="top" class="list_table_th border_bottom border_right"><div class="listing_th_padding">Occupier name</div></td>
					<td align="left" valign="top" class="list_table_th border_bottom border_right"><div class="listing_th_padding">Issue date</div></td>
					<td align="left" valign="top" class="list_table_th border_bottom"><div class="listing_th_padding">Expiry date</div></td>
				</tr>
				<tr>
	                <td align="left" valign="top" class="border_bottom border_right">
	                    <div style="padding: 10px">
                        	<input type="text" name="explosive_dockey" id="explosive_dockey" class="explosive_dockey" value="">
			            </div>
	                </td>
	                <td align="left" valign="top" class="border_bottom border_right">
	                    <div style="padding: 10px">
	                    	<input type="text" name="explosive_licenceno" id="explosive_licenceno" class="explosive_licenceno" value="" />
	                	</div>
	                </td>
	                <td align="left" valign="top" class="border_bottom border_right">
	                    <div style="padding: 10px">
		                    <input type="text" name="explosive_occupiernm" id="explosive_occupiernm" class="explosive_occupiernm" value="" />
		                </div>
	                </td>
	                <td align="left" valign="top" class="border_bottom border_right">
	                    <div style="padding: 10px">
		                    <input type="text" name="explosive_issuedate" id="explosive_issuedate" class="explosive_issuedate" value="" />
		                </div>
	                </td>
	                <td align="left" valign="top" class="border_bottom">
	                    <div style="padding: 10px">
		                    <input type="text" name="explosive_expirydate" id="explosive_expirydate" class="explosive_expirydate" value="" />
		                </div>
	                </td>
	            </tr>
			</table>
		</div>
		<div>
			<div class="table_additional_data_heading">Capacity</div>
		</div>
		<div>
			<table border="0" cellpadding="0" cellspacing="0" id="appendcapacitycontent" class="list_table capacitylisting">
				<tr>
					<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right" style="width: 40px;">&nbsp;</td>
					<td align="left" valign="top" class="list_table_th border_bottom border_right"><div class="listing_th_padding">Sr no.</div></td>
					<td align="left" valign="top" class="list_table_th border_bottom border_right"><div class="listing_th_padding">Explosive name</div></td>
					<td align="left" valign="top" class="list_table_th border_bottom border_right"><div class="listing_th_padding">Class</div></td>
					<td align="left" valign="top" class="list_table_th border_bottom border_right"><div class="listing_th_padding">Division</div></td>
					<td align="left" valign="top" class="list_table_th border_bottom border_right"><div class="listing_th_padding">Quantity at time</div></td>
					<td align="left" valign="top" class="list_table_th border_bottom border_right"><div class="listing_th_padding">Unit</div></td>
					<td align="left" valign="top" class="list_table_th border_bottom"><div class="listing_th_padding">No. of times</div></td>
				</tr>
				<?php
	            	$addcapqry="SELECT cli.name, cec.class, cec.division, cec.qty_at_time, cec.unit, cec.no_of_time FROM customer_explosive_capacity cec
								LEFT JOIN customer_licence_info cli on cec.customer_licence_id=cli.id
								WHERE cli.customerid=%i";
	            	$addcapqry=$sql->query($addcapqry, array($customerid));
	            	$addcapres=$db->query($addcapqry);
	            	$addcapcnt=$db->numRows($addcapres);
	            	if($addcapcnt>0){
	            		$addcapcount=1;
	            		while($addcaprw=$db->fetchNextObject($addcapres)){
	            ?>
	            <tr>
	                <td align="center" valign="middle" class="border_bottom border_left border_right">
	                	<div style="padding-left: 10px">
	                		<div title="Edit" class="pull-left icon_edit"></div>
	                		<div title="Delete" class="icon_delete"></div>
	                		<div style="clear:all"><!--  --></div>
	                	</div>
	                </td>
	                <td align="left" valign="top" class="border_bottom border_right">
	                    <div style="padding: 10px">
	                    	<?php echo $addcapcount++; ?>
		                </div>
	                </td>
	                <td align="left" valign="top" class="border_bottom border_right whitebg">
	                    <div style="padding: 10px">
	                    	<?php echo trim($addcaprw->name); ?>
		                </div>
	                </td>
	                <td align="left" valign="top" class="border_bottom border_right">
	                    <div style="padding: 10px">
	                    	 <?php echo trim($addcaprw->class); ?>
		                </div>
	                </td>
	                <td align="left" valign="top" class="border_bottom border_right">
	                    <div style="padding: 10px">
	                    	<?php echo trim($addcaprw->division); ?>
		                </div>
	                </td>
	                <td align="left" valign="top" class="border_bottom border_right">
	                    <div style="padding: 10px">
	                    	<?php echo trim($addcaprw->qty_at_time); ?>
		                </div>
	                </td>
	                <td align="left" valign="top" class="border_bottom border_right">
	                    <div style="padding: 10px">
	                    	<?php echo trim($addcaprw->unit); ?>
		                </div>
	                </td>
	                <td align="left" valign="top" class="border_bottom border_right">
	                    <div style="padding: 10px">
	                    	<?php echo trim($addcaprw->no_of_time); ?>
		                </div>
	                </td>
	            </tr>
	            <?php } } ?>
	            <?php
		            $expqry="SELECT id, name FROM customer_licence_info WHERE customerid=%i AND detail_type=%i";
		            $expqry=$sql->query($expqry, array($customerid, 1));
		            $experes=$db->query($expqry);
		            $expcount=$db->numRows($experes);
		            
		            if($expcount>0){
	            ?>
				<tr class="capacity templatecapacity">
					<td align="center" valign="middle" class="border_bottom border_left border_right">
	                    <div>
	                        <div title="Delete" class="icon_delete"></div>
	                    </div>
	                </td>
	                <td align="left" valign="top" class="border_bottom border_right">
	                    <div style="padding: 10px">
                        	<input type="text" name="capacity_srno[]" id="capacity_srno" class="capacity_srno" value="">
			            </div>
	                </td>
	                <td align="left" valign="top" class="border_bottom border_right">
	                    <div style="padding: 10px">
	                    	<select name="capacity_explosivenm[]" id="capacity_explosivenm" class="capacity_explosivenm select_drop_down">
	                    		<option value="">Select explosive name</option>
								<?php
									if($expcount>0){
										while($exprw=$db->fetchNextObject($expres)){
											echo '<option value="'.intval($exprw->id).'">'.trim($exprw->name).'</option>';
										}
									}
								?>
	                    	</select>
	                	</div>
	                </td>
	                <td align="left" valign="top" class="border_bottom border_right">
	                    <div style="padding: 10px">
		                    <input type="text" name="capacity_class[]" id="capacity_class" class="capacity_class" value="" />
		                </div>
	                </td>
	                <td align="left" valign="top" class="border_bottom border_right">
	                    <div style="padding: 10px">
		                    <input type="text" name="capacity_division[]" id="capacity_division" class="capacity_division" value="" />
		                </div>
	                </td>
	                <td align="left" valign="top" class="border_bottom border_right">
	                    <div style="padding: 10px">
		                    <input type="text" name="capacity_qty[]" id="capacity_qty" class="capacity_qty" value="" />
		                </div>
	                </td>
	                <td align="left" valign="top" class="border_bottom border_right">
	                    <div style="padding: 10px">
		                    <input type="text" name="capacity_unit[]" id="capacity_unit" class="capacity_unit" value="" />
		                </div>
	                </td>
	                <td align="left" valign="top" class="border_bottom">
	                    <div style="padding: 10px">
		                    <input type="text" name="capacity_notimes[]" id="capacity_notimes" class="capacity_notimes" value="" />
		                </div>
	                </td>
	            </tr>
	            <tr>
					<td colspan="8" align="left" valign="top" class="border_right">
						<div style="padding:10px;">
							<div title="Add" class="icon_add icon_add_capacity"></div>
						</div>
					</td>
				</tr>
				<?php }else { ?>
				<tr>
					<td colspan="8">
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
	<div class="table_additional_data_heading">Short fire permit details</div>
	<div class="border_top border_bottom border_left border_right" style="margin:20px">
		<table border="0" cellpadding="0" cellspacing="0" id="appendshortcontent" class="list_table shortlisting">
			<tr>
				<td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right" style="width: 40px;">&nbsp;</td>
				<td align="left" valign="top" class="list_table_th border_bottom border_right"><div class="listing_th_padding">Document key</div></td>
				<td align="left" valign="top" class="list_table_th border_bottom border_right"><div class="listing_th_padding">Licence number</div></td>
				<td align="left" valign="top" class="list_table_th border_bottom border_right"><div class="listing_th_padding">Shortfire name</div></td>
				<td align="left" valign="top" class="list_table_th border_bottom border_right"><div class="listing_th_padding">Issue date</div></td>
				<td align="left" valign="top" class="list_table_th border_bottom border_right"><div class="listing_th_padding">Expirty date</div></td>
			</tr>
			<tr class="short templateshort">
				<td align="center" valign="middle" class="border_bottom border_left border_right">
                    <div>
                        <div title="Delete" class="icon_delete"></div>
                    </div>
                </td>
                <td align="left" valign="top" class="border_bottom border_right">
                    <div style="padding: 10px">
                    	<input type="text" name="short_doc_key[]" id="short_doc_key" class="short_doc_key" value="">
			        </div>
	            </td>
	            <td align="left" valign="top" class="border_bottom border_right">
	            	<div style="padding: 10px">
                    	<input type="text" name="short_licenceno[]" id="short_licenceno" class="short_licenceno" value="" />
                	</div>
                </td>
                <td align="left" valign="top" class="border_bottom border_right">
                    <div style="padding: 10px">
	                    <input type="text" name="short_name[]" id="short_name" class="short_name" value="" />
	                </div>
                </td>
                <td align="left" valign="top" class="border_bottom border_right">
                    <div style="padding: 10px">
	                    <input type="text" name="short_issuedate[]" id="short_issuedate" class="short_issuedate" value="" />
	                </div>
                </td>
                <td align="left" valign="top" class="border_bottom border_right">
                    <div style="padding: 10px">
	                    <input type="text" name="short_expirydate[]" id="short_expirydate" class="short_expirydate" value="" />
	                </div>
                </td>
            </tr>
            <tr>
				<td colspan="8" align="left" valign="top" class="border_right">
					<div style="padding:10px;">
						<div title="Add" class="icon_add icon_add_short"></div>
					</div>
				</td>
			</tr>
		</table>
	</div>
</div>
<div style="padding-bottom:10px"><!--  --></div>
	<div>
		<table border="0" cellpadding="0" cellspacing="0" id="appendaddcontent" class="list_table addlisting">
			<tr>
                <td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right" style="width: 20px;">&nbsp;</td>
                <td align="left" valign="top" class="list_table_th border_top border_bottom border_right" style="width: 100px;"><div class="listing_th_padding">Detail name</div></td>
                <td align="left" valign="top" class="list_table_th border_top border_bottom border_right" style="width: 100px;"><div class="listing_th_padding">Id</div></td>
                <td align="left" valign="top" class="list_table_th border_top border_bottom border_right" style="width: 100px;"><div class="listing_th_padding">Password</div></td>
            </tr>
            <?php
            	$addqry="SELECT customerid, detailname, emailid, password FROM customer_additional_info WHERE customerid=%i";
            	$addqry=$sql->query($addqry, array($customerid));
            	$addres=$db->query($addqry);
            	$addcnt=$db->numRows($addres);
            	if($addcnt>0){
            		while($addrw=$db->fetchNextObject($addres)){
            ?>
            <tr>
                <td align="center" valign="middle" class="border_bottom border_left border_right">
                	<div style="padding-left: 10px">
                		<div title="Edit" class="pull-left icon_edit"></div>
                		<div title="Delete" class="icon_delete"></div>
                		<div style="clear:all"><!--  --></div>
                	</div>
                </td>
                <td align="left" valign="top" class="border_bottom border_right">
                    <div style="padding: 10px">
                    	<?php echo trim($addrw->detailname); ?>
	                </div>
                </td>
                <td align="left" valign="top" class="border_bottom border_right whitebg">
                    <div style="padding: 10px">
                    	<?php echo trim($addrw->emailid); ?>
	                </div>
                </td>
                <td align="left" valign="top" class="border_bottom border_right">
                    <div style="padding: 10px">
                    	<?php echo utf8_decode(trim($addrw->password)); ?>
	                </div>
                </td>
            </tr>
            <?php } } if($addcnt==0){ ?>
			<tr>
                <td align="center" valign="middle" class="border_bottom border_left border_right"></td>
                <td align="left" valign="top" class="border_bottom border_right">
                    <div style="padding: 10px">
                    	Employee RNA detail
                        <input type="hidden" name="detailname[]" value="Employee RNA detail">
			        </div>
		        </td>
		        <td align="left" valign="top" class="border_bottom border_right">
		        	<div style="padding: 10px">
                    	<input type="text" name="emailid[]" class="emailid" style="cursor: pointer; width: 100%; border: 0; padding:0" value="" />
	                </div>
                </td>
                <td align="left" valign="top" class="border_bottom border_right">
                    <div style="padding: 10px">
                    	<input type="password" name="addpassword[]" class="addpassword" style="cursor: pointer; width: 100%; border: 0; padding:0" value="" />
	                </div>
                </td>
            </tr>
			<tr>
                <td align="center" valign="middle" class="border_bottom border_left border_right"></td>
                <td align="left" valign="top" class="border_bottom border_right">
                    <div style="padding: 10px">
                    	Shram Shuvidha LIN detail
                    	<input type="hidden" name="detailname[]" value="Shram Shuvidha LIN detail">
			        </div>
		        </td>
		        <td align="left" valign="top" class="border_bottom border_right">
		        	<div style="padding: 10px">
                    	<input type="text" name="emailid[]" class="emailid" style="cursor: pointer; width: 100%; border: 0; padding:0" value="" />
	                </div>
                </td>
                <td align="left" valign="top" class="border_bottom border_right">
                    <div style="padding: 10px">
                    	<input type="password" name="addpassword[]" class="addpassword" style="cursor: pointer; width: 100%; border: 0; padding:0" value="" />
	                </div>
                </td>
            </tr>
            <?php } ?>
            <tr class="add templateadd">
                <td align="center" valign="middle" class="border_bottom border_left border_right">
                    <div>
                        <div title="Delete" class="icon_delete"></div>
                    </div>
                </td>
                <td align="left" valign="top" class="border_bottom border_right">
                    <div style="padding: 10px">
                    	<input type="text" name="detailname[]" class="detailname" style="cursor: pointer; width: 100%; border: 0; padding:0" value="" />
	                </div>
                </td>
                <td align="left" valign="top" class="border_bottom border_right">
                    <div style="padding: 10px">
                    	<input type="text" name="emailid[]" class="emailid" style="cursor: pointer; width: 100%; border: 0; padding:0" value="" />
	                </div>
                </td>
                <td align="left" valign="top" class="border_bottom border_right">
                    <div style="padding: 10px">
                    	<input type="text" name="addpassword[]" class="addpassword" style="cursor: pointer; width: 100%; border: 0; padding:0" value="" />
	                </div>
                </td>
            </tr>
			<tr>
				<td colspan="5" align="left" valign="top" class="border_right">
					<div style="padding:10px 22px;">
						<div title="Add" class="icon_add icon_add_additional"></div>
					</div>
				</td>
			</tr>
	</table>
</div>