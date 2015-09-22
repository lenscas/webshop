<script>
	$.ajax({
		url: "<?php echo base_url("index.php/products/getProducts") ?>",
		dataType: "json",
		success:function(result,status,xhr){
			console.log(result)
			console.log(status)
			console.log(xhr)
		}
	}).done(function(msg){
		console.log(msg)
	})
</script>
