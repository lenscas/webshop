
<?php
function writeCategory($categories,$sort){ 
	$count=0;
	foreach($categories as $key => $category){

	?>
		<li style="background-color:#ffffff;" class="treeview rootcat categoriesNavItem" >
			<table>
				<tr class="bg-<?php if($category['hasLink']){echo "success";} else {echo "danger";}?>">
					<td>
						<p style="margin-right:10px">
							<i style="color:;" class="fa fa-cross"></i>
							<span style="color:#3c8dbc;"><?php echo $category["Name"] ?></span>
							<span class="fa  fa-angle-left linky" style="cursor:pointer;">
						</p>
					</td>
					<td>
						<button class="btn btn-<?php if($category['hasLink']){echo "danger";}else { echo "success";} ?> btn-xs update" id="<?php echo $sort.$category['Id'] ?>"><?php if($category['hasLink']){echo "<span class='fa fa-minus'></span>";} else {echo "<span class='fa fa-plus'></span>";} ?></button>
					</td>
				</tr>
			</table>
	<?php 
		if(isset($category["subCatergory"])){
			?>
			<ul class="treeview-menu" style="background-color:#ffffff; " hidden>
			<?php writeCategory($category["subCatergory"],'subCat'); ?>
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
							<?php writeCategory($categoriesList,'categories') ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<script>
	//is used to make the menu work
	$(".linky").on("click",function(){
		console.log($(this))
		var span = this
		$(this).parent().parent().parent().parent().parent().parent().children(".treeview-menu").each(function(i,element){
			if($(element).is(":hidden")){
				$(element).show()
				$(span).removeClass("fa-angle-left").addClass("fa-angle-down")
				console.log($(this))
			} else {
				$(span).removeClass("fa-angle-down").addClass("fa-angle-left")
				$(element).hide()
			}
		})
	})
	//is used to make the db change
	$(".update").on("click",function(){
		var id			=	$(this).attr("id");
		var cleanId 	=	id.replace("subCat" ,"" ).replace("categories" , '');
		var table="";
		if (id.indexOf("subCat")==-1){
			table="categories";
		} else {
			table="subcat";
		}
		$.ajax({
			url: "<?php echo base_url("index.php/admin/categories/ajax/link/update") ?>/"+table+"/"+cleanId+"/"+<?php echo $productId ?>,
			dataType: "json"
		});
		var addClass1	=	"bg-success"
		var addClass2	=	"btn-danger"
		var text		=	"<span class='fa fa-minus'></span>"
		if($(this).parent().parent().hasClass("bg-success")){
			addClass1	="bg-danger"
			addClass2	="btn-success"
			text		="<span class='fa fa-plus'></span>"
		}
		$(this).removeClass("btn-success").removeClass("btn-danger").addClass(addClass2)
		$(this).empty().html(text)
		$(this).parent().parent().removeClass("bg-success").removeClass("bg-danger").addClass(addClass1)
		
	})
	
			
</script> 
