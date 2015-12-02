<script type="text/javascript">
    tinymce.init({
        selector: "#description"
    });
</script>

<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Voorraad aanpassen
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url("index.php/admin/dashboard")?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?php echo base_url("index.php/admin/products")?>"> Products</a></li>
			<li class="active">Aanpassen</li>
		</ol>
	</section>
	<section class="content">
		<form method="post" enctype="multipart/form-data">
			<div class="box">
				<div class="box-header">
					<input type="submit" class="btn btn-success pull-right" value="Opslaan">
					<?php if (isset($error)){ ?>
						<div class="alert alert-error">
							<?php echo $error ?>
						</div>>
					<?php } 
						if (isset($success)){ ?>
						<div class="alert alert-success">
							<?php echo $success ?>
						</div>
					<?php } ?>
				</div>
				<div class="box-body">
					<div class="col-md-4">
						<div class="form-group">
							<label>Verkoop prijs</label>
							<input class="form-control" type="text" name="Sell_Price"  value="<?php echo (isset($productData["Sell_price"]) ? $productData["Sell_price"] :""); ?>">
						</div>
						<div class="form-group">
							<label>Voorraad</label>
							<input type="text" name="amount" id="amount">
						</div>
						<div id="eanContainer">
						</div>
					</div>
				</div>
			</div>
		</form>
	</section>
</div>
<script type="text/javascript">
	$("#amount").on("change",function(){
		var amount = Number($(this).val())
		console.log(amount)
		$("#eanContainer").empty()
		if(amount){
			console.log("if")
			for(var times=0;times<amount;times++){
				console.log("test")
				$("#eanContainer").append('<input name="ean['+times+']" type="text">');
			}
		}
	})

</script>