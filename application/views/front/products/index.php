<div class="templates" hidden>
<!--products -->
	<div id="templateProducts">
		<div class="col-sm-4 col-lg-4 col-md-4 pagination-item shownProduct">
			<div class="thumbnail"> 
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
		<div>
	</div>
</div>

<script>
	$.ajax({
		url: "<?php echo base_url("index.php/products/getProducts") ?>",
		dataType: "json",
		success:function(result,status,xhr){
			var times=0
			var lastId=0
			console.log(result)
			$.each(result, function(key,value){
				if(times===3){
					lastId=lastId+1
					$("#products").append('<div class="row" id="row'+lastId+'">')
					times=0
					
				}
				var element= $("#templateProducts")
				$(element).find("img").attr("src", "<?php echo base_url() ?>"+value.Picpath)
				$(element).find(".price").empty().html("&#8364; "+value.Sell_price)
				$(element).find(".stock").empty().html("Voorraad: "+value.stock)
				$(element).find(".name").empty().html(value.Name)
				$(element).find(".description").empty().html(value.Description)
				$(element).find(".shownProduct").clone().appendTo("#row"+lastId)
				times=times+1
			})
		}
		
	}).done(function(msg){
		console.log(msg)
	})
</script>
