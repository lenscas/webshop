<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			RMA's
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url("index.php/admin/dashboard")?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Rma's</li>
		</ol>
	</section>
	<section class="content">
		<div class="box">
			<div class="box-body">
				<table id="AllRMAs">	
					<thead>
						<tr>
							<th>Product</th>
							<th>Naam</th>
							<th>Verkoop prijs</th>
							<th>Voorraad</th>
							<th>Actie</th>
						</tr>
					</thead>
				</table>
			</div>
	<script>
		$('#AllRMAs').DataTable({
			ajax:'<?php echo base_url('index.php/products/getProducts/dataTable')?>'

		});
	</script>
