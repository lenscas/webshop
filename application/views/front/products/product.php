<div class="templates" hidden>
<!--products -->
	<div id="templateProducts">
		<div class="col-sm-4 col-lg-4 col-md-4 pagination-item shownProduct">
			<div class="thumbnail" style="height:247px; overflow:hidden"> 
				<img style="max-width:260px!important;height:150px;width:auto;float:center" src="<?php echo base_url("application/assets/products/1test.gif")?>"></img>
				<div class="caption">
					<span class="pull-right">
						<h4 class="price"></h4>
						<h5 class="stock"></h5>
					</span>
					<h4 class="name"></h4>
					<div class="description">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="col-md-9">
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
</div>

