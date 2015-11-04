<form method="post" action="<?php echo $payURL ?>" name="checkout">
	<input type="hidden" value="<?php echo $data ?>" name="Data">
	<input type="hidden" value="<?php echo $interfaceVersion ?>" name="InterfaceVersion">
	<input type="hidden" value="<?php echo $seal ?>" name="Seal">
	<input type="submit" value="verder">
</form>
<script type="text/javascript"> 
	function doAutoSubmit() {
	 	document.forms.checkout.submit(); 
	} 
	setTimeout('doAutoSubmit()', 100); 
</script>
