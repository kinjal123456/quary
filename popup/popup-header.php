<script>
    $('#popup select, #popup input[type!="submit"][type!="button"], #popup textarea').not('.no-csform').csform();
</script  >
<div>
	<table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td class="popup-middle-middle" style="padding:10px 0 10px 10px">
				<div style="max-height: 450px; width: 470px">
					<table border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td align="right">
								<div class="close-icon">
									<img src="images/popup/popup-close.png" style="cursor: pointer" onclick="hidePopup();">
								</div>
							</td>
						</tr>
						<tr>
							<td align="left" class="popup-title popup_dragger"><?php echo (strlen($popup_title)>0)?$popup_title:'Popup'; ?></td>
						</tr>
						<tr><td style="height: 5px"><!-- --></td></tr>
						<tr>
							<td>
								<div class="popup-border-top"></div>
							</td>
						</tr>