<?php
    $page_title = "Register Form C";
    session_start();
    require_once 'libs/data/db.connect.php';
    require_once 'style-print.php';
?>
<?php
if(isset($_POST['fromprint']) && $_POST['fromprint'] == 1){?>
    <script type="text/javascript" src="jquery/jquery-1.8.3.js"></script>
    <script>
        $(document).ready(function(){
            window.print();
        });
    </script>
<?php }?>
<style>
    body{
        background-color:#ffffff;
        font-size: 13px;
        margin:0;
        padding:0;
        font-family: Arial; 
        line-height: 18px;
        color:#676767;
        height: 100%;
    }
    tbody,thead{
        font-size: 12px;
    }
</style>
    <!--first table-->
<?php 
if(isset($_POST['fromprint']) && $_POST['fromprint'] == 1){ 
	if(isset($_POST['formid']) && intval($_POST['formid'])>0){
		$formid=intval($_POST['formid']);
		
		$query="SELECT * FROM customer_register_form_d WHERE id=%i";
		$query=$sql->query($query, array($formid));
		$result=$db->query($query);
		$count=$db->numRows($result);
		$row=$db->fetchNextObject($result);
	}
?>
<title>Quarry<?php if(isset($page_title)) echo " : ".$page_title; ?></title>
<div style="padding:10px 0;">
		<div align="center">
			<div style="<?php echo $register_form_upper_hadding_lg; ?>">FORMAT FOR WAGE REGISTER</div>
		</div>
		<div>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td style="font-weight:bold">Name of the Establishment</td>
					<td>fg</td>
					<td style="font-weight:bold">Name of Owner</td>
					<td>Jayeshbhai Desai</td>
					<td style="font-weight:bold">LIN</td>
				</tr>
				<tr><td colspan="5" style="height:10px"><!-- --></td></tr>
				<tr>
					<td style="font-weight:bold">Wage period From</td>
					<td>fg</td>
					<td style="font-weight:bold">To</td>
					<td>df</td>
					<td style="font-weight:bold">(Monthly/Fortnightly/Weekly/Daily/Piece Rated)</td>
					<td></td>
				</tr>
				<tr><td colspan="5" style="height:10px"><!-- --></td></tr>
			</table>
		</div>
		<div>
			<table border="0" cellpadding="0" cellspacing="0" style="<?php echo $list_table.addlisting; ?>">
				<tr>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">Name</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">Relay or set work</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">Summary number of days</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">Signature of reg keeper</div></td>
					<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">Remark number of hourss</div></td>
				</tr>
				<tr>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_left.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo trim($row->name); ?>
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo trim($row->relay_or_set_work); ?>
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo intval($row->summary_no_of_days); ?>
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo trim($row->signature_of_reg_keeper); ?>
						</div>
					</td>
					<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
						<div style="<?php echo $listing_td_padding; ?>">
							<?php echo trim($row->remark_no_of_hours); ?>
						</div>
					</td>
				</tr>
				<tr><td style="height:10px"><!-- --></td></tr>
				<tr>
					<td colspan="5" align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left.$border_right.$register_table_td; ?>"><div style="<?php echo $listing_th_padding; ?>">Attendence</div></td>
				</tr>
				<tr>
					<td colspan="5" align="center" valign="top" style="<?php echo $border_bottom.$border_left.$border_right; ?>">
						<?php for($i=1; $i<=31; $i++){ ?>
						<div style="<?php echo $listing_td_padding.$border_bottom.$border_left.$border_right; ?>;float:left;width:20px;height:20px">
							<?php $day="day_".$i; if(intval($row->$day)==1) echo "A"; else if(intval($row->$day)==2) echo "P"; else if(intval($row->$day)==3) echo "X"; else echo ""; ?>
						</div>
						<?php } ?>
					</td>
				</tr>
				<tr><td style="height:10px"><!-- --></td></tr>
			</table>
		</div>
	</div>
</div>
<?php } ?>