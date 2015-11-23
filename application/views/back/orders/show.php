<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Orders
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url("index.php/admin/dashboard")?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Orders</li>
		</ol>
	</section>
	<section class="content">
		<div class="box">
			<div class="box-body">
				<table id="AllOrders">	
			  		<thead>
		                <tr>
		                    <th>ID</th>
		                    <th>Naam</th>
		                    <th>Datum</th>          
		                    <th>Status</th>
		                    <th>Actie</th>
		                </tr>
		            </thead>
				</table>
			</div>
	<script>
		$('#AllOrders').DataTable({
			ajax:'<?php echo base_url('index.php/admin/orders/ajax/getorders')?>'

		});
	</script>
