<?php
    $page_title = "Customer Bill";
    session_start();
    require_once 'libs/data/db.connect.php';
    require_once 'style-print.php';
?>
<?php
if(isset($_POST['bill_id']) && intval($_POST['bill_id'])>0){?>
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
	if(isset($_POST['bill_id']) && intval($_POST['bill_id'])>0){
		$billid=intval($_POST['bill_id']);
		
		$query="SELECT CONCAT(c.firstname, ' ', c.lastname) AS name, c.pincode, c.state, c.address, cb.billname, cb.bill_amount, cb.billno, cb.created_at FROM customers_bills cb 
				LEFT JOIN customers c ON cb.customerid=c.id 
				WHERE cb.id=%i";
		$query=$sql->query($query, array($billid));
		$result=$db->query($query);
		$count=$db->numRows($result);
		$row=$db->fetchNextObject($result);
	}
?>
<title>Quarry<?php if(isset($page_title)) echo " : ".$page_title; ?></title>
<div style="padding:10px 0;">
	<div>
		<div align="center" style="padding-bottom:10px;font-size:16px;color:#000">
			<div style="font-size:28px;padding-bottom:5px">JAYESH PRAMODRAI DESAI.</div>
			<div>"Shri Sai Rang Nivas" Tagore Nagar, Near Ravindra Nagar,</div>
			<div style="padding:2px 0 10px 0">Tithal Road, Valsad. Phone No: 02632-242901.</div>
			<div style="border-top:3px solid #000"></div>
		</div>
		<div>
			<div style="color:#000;font-weight:bold;text-transform:capitalize;text-decoration:underline;padding-bottom:5px">Bill No: <?php echo trim($row->billno); ?></div>
			<div style="color:#000;font-weight:bold;text-transform:capitalize;text-decoration:underline;padding-bottom:15px">Dated: <?php echo date("dS F, Y", strtotime(trim($row->created_at))); ?>.</div>
			<div style="color:#000;font-weight:bold;text-transform:capitalize;text-decoration:underline"><?php echo trim($row->name); ?></div>
			<?php if(strlen($row->address)>0){ ?>
				<div style="color:#000;font-weight:bold;text-transform:capitalize;text-decoration:underline"><?php echo trim($row->address); ?></div>
			<?php } ?>
			<div style="color:#000;font-weight:bold;text-transform:capitalize;text-decoration:underline"><?php echo $row->pincode.", ".trim($row->state); ?></div>
		</div>
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
				$totalbill+=number_format($row->bill_amount, 2); ?>
			<tr>
				<td align="center" valign="top" style="<?php echo $border_bottom.$border_left.$border_right; ?>">
					<div style="<?php echo $listing_td_padding; ?>">
						<?php echo $counter,"."; ?>
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
			<tr>
				<td colspan="2" align="center" valign="top" style="<?php echo $border_bottom.$border_left.$border_right; ?>;padding:10px 0"><!--Rupees Three Thousand Only.--></td>
				<td align="right" valign="top" style="<?php echo $border_bottom.$border_left.$border_right; ?>;padding:10px 20px">
					<div style="<?php echo $listing_td_padding; ?>"><?php echo "Rs. ".number_format($totalbill, 2); ?></div>
				</td>
			</tr>
		</table>
	</div>
</div>