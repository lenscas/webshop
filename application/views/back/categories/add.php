
<?php
function writeCategory($categories,$extraId,$sort){ 
	$count=0;
	foreach($categories as $key => $category){

	?>
		<li style="background-color:#ffffff;" class="treeview rootcat categoriesNavItem" >
			<p style="-webkit-user-drag: element; -webkit-user-select:none;" class="" id="<?php echo $extraId."child".$count ?>">
				<i style="color:;" class="fa fa-cross"></i>
				<span style="color:#3c8dbc;"><?php echo $category["Name"] ?></span>
				<input type="hidden" value="<?php echo $category["Id"] ?>" name="<?php echo $sort ?>" class="<?php echo $extraId."child".$count."input" ?>"><span class="linky fa fa-angle-left" style="cursor:pointer"></span>
			</p>
	<?php 
		if(isset($category["subCatergory"])){
			?>
			<ul class="treeview-menu" style="background-color:#ffffff; " hidden>
			<?php writeCategory($category["subCatergory"],$extraId."child".$count,'subCat'); ?>
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
					<div  style="text-align:center;" id="delete" hidden>
						<span id="delete" class="fa fa-trash fa-5x delete"></span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-9">
			<div class="col-md-12">
				<form method="post">
					<div class="row">
						<div class="box">
							<div class="box-body">
								<div class="col-md-10">
									<p>De categorie naam</p>
									<input type="text" name="Name" class="form-control">
								</div>
								<div class="col-md-2">
									<button type="post" class="btn btn-success pull-right">Aanmaken</button>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="panel box box-primary drop" style="padding:20px" id="drop">
							<p>Sleep hier een categorie heen als u een sub categorie wilt aanmaken</p>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>
</div>
<!-- code for menu -->

<!-- code for drag and drop 
<script>
function switchVisible(whatVis,whatInvis){
	$("#"+whatVis).show()
	$("#"+whatVis+"Title").show()
	
	$("#"+whatInvis).hide()
	$("#"+whatInvis+"Title").hide()
}

function allowDrop(ev) {
	ev.preventDefault();
	console.log("ondragover");
	return false;
}

function drag(ev) {
	//ev.preventDefault();
	ev.dataTransfer.setData("text", ev.target.id);
	console.log("drag")
	//console.log(ev.target.id)
}

function drop(ev) {
	ev.preventDefault();
	console.log('drop!!!!!');
	var data = ev.dataTransfer.getData("text");
	var dropElement=$(ev.target).closest(".drop");
	if($('#'+data).html()){
		$(dropElement).empty().html('<p id="dropped" draggable="true" ondragstart="drag(event)">'+$('#'+data).html()+"</p>")
	}
	//console.log($("#"+data))
	//console.log($(ev.target))
	//ev.target.appendChild(document.getElementById(data));
	
}
$(document).on("dragstart","p",function(){
	switchVisible("delete","list")
})
	
$(document).on("dragend","p",function(){
	console.log("test")
	switchVisible("list","delete")
})
</script>
-->
<!-- now in jquery ui -->
<script>
	function switchVisible(whatVis,whatInvis){
		$("#"+whatVis).show()
		$("#"+whatVis+"Title").show()
	
		$("#"+whatInvis).hide()
		$("#"+whatInvis+"Title").hide()
	}

	$( "#list p" ).draggable({
		appendTo: "body",
		helper: "clone"
	});
	$( "#drop" ).droppable({
		activeClass: "ui-state-default",
		hoverClass: "ui-state-hover",
		accept: ":not(.ui-sortable-helper)",
		drop: function( event, ui ) {
			$(this).empty().html('<p id="dropped" >'+$(ui.draggable).html()+"</p>")
			$("#dropped").draggable({
				appendTo: "body",
				helper: "clone"
			});
			switchVisible("list","delete")
		}
	})
	$(".delete").droppable({
		activeClass: "ui-state-default",
		hoverClass: "ui-state-hover",
		accept: ":not(.ui-sortable-helper)",
		drop: function( event, ui ) {
			if( $(ui.draggable).attr("id")=="dropped"){
				console.log("test")
				$("#drop").empty().html("<p>Sleep hier een categorie heen als u een sub categorie wilt aanmaken</p>")
			}
			switchVisible("list","delete")
		}
	})
	
	$(document).on("dragstart","p",function(){
		switchVisible("delete","list")
	})
	$(document).on("dragstop","p",function(){
		switchVisible("list","delete")
	})
</script>

<script>
	$(".linky").on("click",function(){
		var angle=this
		$(this).parent().parent().children(".treeview-menu").each(function(i,element){
			if($(element).is(":hidden")){
				$(angle).removeClass("fa-angle-left").addClass("fa-angle-down")
				$(element).show()
			} else {
				$(angle).removeClass("fa-angle-down").addClass("fa-angle-left")
				$(element).hide()
			}
		})
	})
</script> 
