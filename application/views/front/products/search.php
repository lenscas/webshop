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
	<div id="products">
		<div class="row" id="row0">
		<?php 
		$times= 0;
		foreach ($search as $key => $value) {
			if ($times == 3) {
				echo "</div><div class='row'>";
				$times=0;
			}?>
			<div class="col-sm-4 col-lg-4 col-md-4 pagination-item shownProduct">
				<a href="<?php echo base_url("index.php/product/".$value['Id'])?>">
					<div class="thumbnail" style="height:247px; overflow:hidden"> 
						<img style="max-width:260px!important;height:150px;width:auto;float:center" src="<?php echo base_url($value['Picpath'])?>"></img>
						<div class="caption">
							<span class="pull-right">
								<h4 class="price"><?php echo $value['Sell_price']?></h4>
								<h5 class="stock"><?php echo $value['stock']?></h5>
							</span>
							<h4 class="name"><?php echo $value['Name']?></h4>
							<div class="description"><?php echo $value['Description']?></div>
						</div>
					</div>
				</a>
			</div>
		<?php 
			$times++;
	} ?>
		</div>
	</div>
</div>

