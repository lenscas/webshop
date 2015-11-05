
<?php
function writeCategory($categories,$extraId,$sort){ 
	$count=0;
	foreach($categories as $key => $category){

	?>
		<li style="background-color:#ffffff;" class="treeview rootcat categoriesNavItem" >
			<table>
				<tr>
					<td>
						<p class="linky">
							<i style="color:;" class="fa fa-cross"></i>
							<span style="color:#3c8dbc;"><?php echo $category["Name"] ?></span>
							<input type="hidden" value="<?php echo $category["Id"] ?>" name="<?php echo $sort ?>" class="<?php echo $extraId."child".$count."input" ?>">
						</p>
					</td>
					<td>
						<button class="btn btn-danger btn-xs delete" id="<?php echo $extraId."child".$sort.$category['Id'] ?>">Delete</button>
					</td>
				</tr>
			</table>
	<?php 
		if(isset($category["subCatergory"])){
			?>
			<ul class="treeview-menu" style="background-color:#ffffff; " hidden>
			<?php writeCategory($category["subCatergory"],$extraId."child",'subCat'); ?>
			</ul>
		</li>
		<?php
		}
		$count++;
	}
}
?>
<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Categorie toevoegen
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url("index.php/admin/dashboard")?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?php echo base_url("index.php/admin/products")?>"> Categorien</a></li>
			<li class="active">Toevoegen</li>
		</ol>
	</section>
	<section class="content">
		<div class="col-md-3">
			<div class="box" >
				<div class="box-header">
					<h1 id="listTitle">Categoriën</h1>
					<h1 hidden id="deleteTitle" class="delete">Verwijderen</h1>
				</div>
				<div class="box-body">
					<div id="list">
						<div class="col-md-12">
							<?php writeCategory($categoriesList,"parent",'categories') ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<script>
	$(".linky").on("click",function(){
		$(this).parent().parent().parent().parent().parent().children(".treeview-menu").each(function(i,element){
			if($(element).is(":hidden")){
				$(element).show()
			} else {
				$(element).hide()
			}
		})
	})
	$(".delete").on("click",function(){
		var id		=	$(this).attr("id");
		var cleanerId =	id.replace(/child/g ,"" ).replace(/parent/g , '');
		var table="";
		var cleanId="";
		if (cleanerId.indexOf("subCat")==-1){
			table="categories";
			cleanId = cleanerId.replace(/categories/g,"")
		} else {
			table="subcat";
			cleanId = cleanerId.replace(/subCat/g,"")
		}
		$.ajax({
			url: "<?php echo base_url("index.php/admin/categories/ajax/delete") ?>/"+table+"/"+cleanId,
			dataType: "json"
		});
		
		$(this).parent().parent().parent().hide()
	})
	
			
</script> 
