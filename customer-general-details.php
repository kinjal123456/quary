<div>
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td style="padding-right:10px">
											<div class="addField" style="padding-right:10px">Customer ID: </div>
										</td>
										<td>
											<div class="customer-table-data"><input disabled="disabled" style="cursor: pointer; width: 100%; border: 0; padding:0" value="<?php echo trim($custrow->id); ?>" ></div>
										</td>
										<td style="width:10px"><!--  --></td>
										<td style="padding-right:10px">
											<div class="addField" style="padding-right:10px">Zone: </div>
										</td>
										<td>
											<div class="customer-table-data">
												<select name="zoneid" id="zoneid" class="select_drop_down">
													<option value="">Select Zone</option>
													<?php
														$zoneqry="SELECT id, zonename FROM zones";
														$zoneres=$db->query($zoneqry);
														$selected='';
														while($zonerw=$db->fetchNextObject($zoneres)){
															$selected=($zonerw->id==$custrow->zoneid)?'selected="selected"':'';
															echo '<option value="'.intval($zonerw->id).'" '.$selected.'>'.trim($zonerw->zonename).'</option>';
														}
													?>
												</select>
											</div>
										</td>
									</tr>
									<tr><td style="height:10px"><!--  --></td></tr>
									<tr>
										<td style="padding-right:10px">
											<div class="addField" style="padding-right:10px">Company name: </div>
										</td>
										<td>
											<div class="customer-table-data"><input type="text" name="companynm" id="companynm" style="cursor: pointer; width: 100%; border: 0; padding:0" value="<?php echo trim($custrow->companyname); ?>" ></div>
										</td>
										<td style="width:10px"><!--  --></td>
										<td style="padding-right:10px">
											<div class="addField" style="padding-right:10px">Phone number: </div>
										</td>
										<td>
											<div class="customer-table-data"><input type="text" name="phoneno" id="phoneno" style="cursor: pointer; width: 100%; border: 0; padding:0" value="<?php echo trim($custrow->phone); ?>" ></div>
										</td>
									</tr>
									<tr><td style="height:10px"><!--  --></td></tr>
									<tr>
										<td style="padding-right:10px">
											<div class="addField" style="padding-right:10px">First name: </div>
										</td>
										<td>
											<div class="customer-table-data"><input type="text" name="firstnm" id="firstnm" style="cursor: pointer; width: 100%; border: 0; padding:0" value="<?php echo trim($custrow->firstname); ?>" ></div>
										</td>
										<td style="width:10px"><!--  --></td>
										<td style="padding-right:10px">
											<div class="addField" style="padding-right:10px">Last name: </div>
										</td>
										<td>
											<div class="customer-table-data"><input type="text" name="lastnm" id="lastnm" style="cursor: pointer; width: 100%; border: 0; padding:0" value="<?php echo trim($custrow->lastname); ?>" ></div>
										</td>
									</tr>
									<tr><td style="height:10px"><!--  --></td></tr>
									<tr>
										<td style="padding-right:10px">
											<div class="addField" style="padding-right:10px">Email: </div>
										</td>
										<td>
									 		<div class="customer-table-data"><input type="text" name="custemail" id="custemail" style="cursor: pointer; width: 100%; border: 0; padding:0" value="<?php echo trim($custrow->email); ?>" ></div>
										</td>
										<td style="width:10px"><!--  --></td>
										<td style="padding-right:10px">
											<div class="addField" style="padding-right:10px">Password: </div>
										</td>
										<td>
											<div class="customer-table-data"><input type="password" name="custpwd" id="custpwd" style="cursor: pointer; width: 100%; border: 0; padding:0" value="<?php echo trim($custrow->password); ?>" ></div>
										</td>
									</tr>
									<tr><td style="height:10px"><!--  --></td></tr>
									<tr>
										<td style="padding-right:10px">
											<div class="addField" style="padding-right:10px">Survey number: </div>
										</td>
										<td>
											<div class="customer-table-data"><input type="text" name="surveyno" id="surveyno" style="cursor: pointer; width: 100%; border: 0; padding:0" value="<?php echo trim($custrow->survey_no); ?>" ></div>
										</td>
										<td style="width:10px"><!--  --></td>
										<td style="padding-right:10px">
											<div class="addField" style="padding-right:10px">Pincode: </div>
										</td>
										<td>
											<div class="customer-table-data"><input type="text" name="custpincode" id="custpincode" style="cursor: pointer; width: 100%; border: 0; padding:0" value="<?php echo trim($custrow->pincode); ?>" ></div>
										</td>
									</tr>
									<tr><td style="height:10px"><!--  --></td></tr>
									<tr>
										<td style="padding-right:10px">
											<div class="addField" style="padding-right:10px">State: </div>
										</td>
										<td>
											<div class="customer-table-data"><input type="text" name="custstate" id="custstate" style="cursor: pointer; width: 100%; border: 0; padding:0" value="<?php echo trim($custrow->state); ?>" ></div>
										</td>
										<td style="width:10px"><!--  --></td>
										<td style="padding-right:10px">
											<div class="addField" style="padding-right:10px">Address: </div>
										</td>
										<td>
											<div class="customer-table-data"><input type="text" name="custadd" id="custadd" style="cursor: pointer; width: 100%; border: 0; padding:0" value="<?php echo trim($custrow->address); ?>" ></div>
										</td>
									</tr>
									<tr><td style="height:10px"><!--  --></td></tr>
								</table>
							</div>
							<div class="table-heading" style="padding:30px 0 10px 0;margin: 30px 0;">Employee details</div>
							<div>
								<table border="0" cellpadding="0" cellspacing="0" id="appendgenempcontent" class="list_table genemplisting">
									<tr>
						                <td align="left" valign="top" class="list_table_th border_top border_bottom border_left border_right" style="width: 20px;">&nbsp;</td>
						                <td align="left" valign="top" class="list_table_th border_top border_bottom border_right" style="width: 100px;"><div class="listing_th_padding">Name</div></td>
						                <td align="left" valign="top" class="list_table_th border_top border_bottom border_right" style="width: 100px;"><div class="listing_th_padding">Designation</div></td>
						                <td align="left" valign="top" class="list_table_th border_top border_bottom border_right" style="width: 100px;"><div class="listing_th_padding">Mobile number</div></td>
						            </tr>
						            <?php
						            	$genempqry="SELECT name, designation, mobile_no FROM customer_employees WHERE customerid=%i";
						            	$genempqry=$sql->query($genempqry, array($customerid));
						            	$genempres=$db->query($genempqry);
						            	$genempcnt=$db->numRows($genempres);
						            	if($genempcnt>0){
						            		while($genemprw=$db->fetchNextObject($genempres)){
						            ?>
						            <tr>
						                <td align="center" valign="middle" class="border_bottom border_left border_right">
						                	<div>
						                		<!--<div title="Edit" class="pull-left icon_edit"></div>-->
						                		<div title="Delete" class="icon_delete"></div>
						                		<div style="clear:all"><!--  --></div>
						                	</div>
						                </td>
						                <td align="left" valign="top" class="border_bottom border_right">
						                    <div style="padding: 10px">
			                                	<?php echo trim($genemprw->name); ?>
							                </div>
						                </td>
						                <td align="left" valign="top" class="border_bottom border_right">
						                    <div style="padding: 10px">
							                    <?php echo trim($genemprw->designation); ?>
							                </div>
						                </td>
						                <td align="left" valign="top" class="border_bottom border_right">
						                    <div style="padding: 10px">
							                    <?php echo trim($genemprw->mobile_no); ?>
							                </div>
						                </td>
						            </tr>
						            <?php } } ?>
						            <tr class="genemp templategenemp" style="display:none">
						                <td align="center" valign="middle" class="border_bottom border_left border_right">
						                    <div>
						                        <div title="Delete" class="icon_delete"></div>
						                    </div>
						                </td>
						                <td align="left" valign="top" class="border_bottom border_right">
						                    <div style="padding: 10px">
				                            	<input type="text" name="empname[]" class="empname" style="cursor: pointer; width: 100%; border: 0; padding:0" value="" />
							                </div>
						                </td>
						                <td align="left" valign="top" class="border_bottom border_right">
						                    <div style="padding: 10px">
							                    <input type="text" name="empdesignation[]" class="empdesignation" style="cursor: pointer; width: 100%; border: 0; padding:0" value="" />
							                </div>
						                </td>
						                <td align="left" valign="top" class="border_bottom border_right">
						                    <div style="padding: 10px">
							                    <input type="text" name="empmob[]" class="empmob" style="cursor: pointer; width: 100%; border: 0; padding:0" value="" />
							                </div>
						                </td>
						            </tr>
									<tr>
										<td colspan="5" align="left" valign="top" class="border_right">
											<div style="padding:10px 22px;">
												<div title="Add" class="icon_add icon_gen_emp"></div>
											</div>
										</td>
									</tr>
								</table>	
							</div>