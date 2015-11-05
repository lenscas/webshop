<script type="text/javascript">
    tinymce.init({
        selector: "#description"
    });
</script>

<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Product toevoegen
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url("index.php/admin/dashboard")?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?php echo base_url("index.php/admin/products")?>"> Products</a></li>
			<li class="active">Toevoegen</li>
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
							<label>Product naam</label>
							<input class="form-control" type="text" name="Name" value="<?php echo (isset($productData["Name"]) ? $productData["Name"] :""); ?>">
						</div>
						<div class="form-group">	
							<label>path to picture</label>
							<input class="form-control" type="file" name="Picture">
						</div>
						<div class="form-group">
							<label>Gewicht in (?)</label>	
							<input class="form-control" type="text" name="Weight" value="<?php echo (isset($productData["Weight"]) ? $productData["Weight"] :""); ?>">
						</div>
							
						<div class="form-group">
							<label>Verkoop prijs</label>
							<input class="form-control" type="text" name="Sell_Price"  value="<?php echo (isset($productData["Sell_price"]) ? $productData["Sell_price"] :""); ?>">
						</div>
						<div class="form-group">
							<label>BTW (needs to become a dropdown)</label>
							<select class="form-control" type="text" name="Tax_Id">
								<?php foreach($taxOptions as $key=>$value){ ?>
									<option value="<?php echo $value["Tax_Id"] ?>"><?php echo $value['Tax_Amount']?></option>
									
								
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label>Garantie in maanden</label>						
							<input class="form-control" type="text" name="Warranty" value="<?php echo (isset($productData["Warranty"]) ? $productData["Warranty"] :""); ?>">
						</div>
						<label class="check-box">Breekbaar: <input class="pull-right" type="checkbox" name="Fragile" <?php if(isset($productData["Fragile"])){
									if ($productData["Fragile"]==1) {
										echo "checked";
									}
								}?>>
						 </label>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label>Beschrijving</label>
							<textarea class="form-control" name="Description" id="description"><p>"<?php echo (isset($productData["Description"]) ? $productData["Description"] :""); ?>"</p></textarea>
						</div>
					</div>
				</div>
			</div>
		</form>
	</section>
</div>
