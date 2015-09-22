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
		<form method="post">
			<div class="box">
				<div class="box-header">
					<input type="submit" class="btn btn-success pull-right" value="Opslaan">
					<?php if (isset($error)){ ?>
						<div class="
				</div>
				<div class="box-body">
					<div class="col-md-4">
						<div class="form-group">
							<label>Product naam</label>
							<input class="form-control" type="text" name="Name">
						</div>
						<div class="form-group">	
							<label>path to picture (needs to become upload/something else)</label>
							<input class="form-control" type="text" name="Picpath">
						</div>
						<div class="form-group">
							<label>Gewicht in (?)</label>	
							<input class="form-control" type="text" name="Weight">
						</div>
							
						<div class="form-group">
							<label>Verkoop prijs</label>
							<input class="form-control" type="text" name="Sell_Price">
						</div>
						<div class="form-group">
							<label>BTW (needs to become a dropdown)</label>
							<input class="form-control" type="text" name="Tax_Id">
						</div>
						<div class="form-group">
							<label>Garantie in maanden</label>						
							<input class="form-control" type="text" name="Warranty">
						</div>
						<label class="check-box">Breekbaar: <input class="pull-right" type="checkbox" name="Fragile"> </label>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label>Beschrijving (needs to become tiny mce)</label>
							<input class="form-control" type="text-area" name="Description">
						</div>
					</div>
				</div>
			</div>
		</form>
	</section>
</div>