<div class="col-md-9">
	<?php 
		if(isset($products)){
			foreach($products as $key=>$value){
	?>
				<div class="row" style="max-height:400px; margin-bottom:10px">
					<div class="col-md-2">
						<p>buttons to add more or less of the same products here also show how many you want</p>
					</div>
					<div class="col-md-6">
						<h1><?php echo $value['Name'] ?></h1>
						<div><?php echo $value['Description'] ?> </div>
					</div>
					<div class="col-md-4">
						<img style="max-width:100%;max-height:100%;" src="<?php echo base_url($value['Picpath']) ?>">
					</div>
				</div>
	<?php 
			}
		} else {
	?><h1>Geen producten in het winkel mandje </h1>
	<?php 
		}
	?>
</div>