<div class="col-md-9">
	<?php 
		if(isset($Name)){
	?>
			<div class="col-md-8">
				<div style="text-align:center">
					<h1> <?php echo $Name ?></h1>
				</div>
				<div>
					<?php echo $Description ?>
				</div>
			</div>
			<div class="col-md-4">
				<div class="row" style="margin-bottom:10px">
					<a class="btn btn-success" id="add" href="<?php echo base_url("index.php/cart/add/".$Id) ?>">Bestellen</a><p>Voorraad: <?php echo $stock ?></p>
				
				</div>
				<div class="row">
					<img src="<?php echo base_url($Picpath)?>"style="max-width:100%; max-height:247px">
				</div>
			</div>
	<?php 
		} else {
	?>
		<h1>Het product kon niet gevonden worden</h1>
	<?php	
		}
	?>
</div>

