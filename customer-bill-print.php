<?php
    $page_title = "Customer Bill";
    session_start();
    require_once 'libs/data/db.connect.php';
    require_once 'style-print.php';
?>
<?php
if(isset($_GET['custid']) && intval($_GET['custid'])>0){?>
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
	if(isset($_GET['custid']) && intval($_GET['custid'])>0){
		$custid=intval($_GET['custid']);
		
		$custquery="SELECT CONCAT(firstname, ' ', lastname) AS name, pincode, state, address FROM customers WHERE id=%i";
		$custquery=$sql->query($custquery, array($custid));
		$custresult=$db->query($custquery);
		$custcount=$db->numRows($custresult);
		$custrow=$db->fetchNextObject($custresult);
		
		$query="SELECT * FROM customers_bills WHERE customerid=%i";
		$query=$sql->query($query, array($custid));
		$result=$db->query($query);
		$count=$db->numRows($result);
	}
?>
<title>Quarry<?php if(isset($page_title)) echo " : ".$page_title; ?></title>
<div style="padding:10px 0;">
	<div>
		<div style="color:#000;font-weight:bold;text-transform:capitalize;text-decoration:underline"><?php echo trim($custrow->name); ?></div>
		<?php if(strlen($custrow->address)>0){ ?>
			<div style="color:#000;font-weight:bold;text-transform:capitalize;text-decoration:underline"><?php echo trim($custrow->address); ?></div>
		<?php } ?>
		<div style="color:#000;font-weight:bold;text-transform:capitalize;text-decoration:underline"><?php echo $custrow->pincode.", ".trim($custrow->state); ?></div>
		<div style="height:20px"><!-- --></div>
	</div>
	<div>
		<table border="0" cellpadding="0" cellspacing="0" style="<?php echo $list_table.addlisting; ?>">
			<tr>
				<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left.$border_right; ?>;width:80px"><div style="<?php echo $listing_th_padding; ?>">Sr No.</div></td>
				<td align="center" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_left.$border_right; ?>"><div style="<?php echo $listing_th_padding; ?>">Particulars</div></td>
				<td align="right" valign="middle" style="<?php echo $list_table_th.$border_top.$border_bottom.$border_right; ?>;width:150px"><div style="<?php echo $listing_th_padding; ?>">Amount Rs.</div></td>
			</tr>
			<?php 
				$counter=1; 
				while($row=$db->fetchNextObject($result)){ 
					$totalbill+=number_format($row->bill_amount, 2); ?>
			<tr>
				<td align="center" valign="top" style="<?php echo $border_bottom.$border_left.$border_right; ?>">
					<div style="<?php echo $listing_td_padding; ?>">
						<?php echo $counter++,"."; ?>
					</div>
				</td>
				<td align="center" valign="top" style="<?php echo $border_bottom.$border_right; ?>">
					<div style="<?php echo $listing_td_padding; ?>">
						<?php echo trim($row->billname); ?>
					</div>
				</td>
				<td align="right" valign="top" style="<?php echo $border_bottom.$border_right; ?>;padding-right:20px">
					<div style="<?php echo $listing_td_padding; ?>">
						<?php echo "Rs. ".number_format($row->bill_amount, 2); ?>
					</div>
				</td>
			</tr>
			<?php } ?>
			<tr>
				<td colspan="2" align="center" valign="top" style="<?php echo $border_bottom.$border_left.$border_right; ?>;padding:10px 0">Rupees Three Thousand Only.</td>
				<td align="right" valign="top" style="<?php echo $border_bottom.$border_left.$border_right; ?>;padding:10px 20px">
					<div style="<?php echo $listing_td_padding; ?>"><?php echo "Rs. ".number_format($totalbill, 2); ?></div>
				</td>
			</tr>
		</table>
	</div>
</div>