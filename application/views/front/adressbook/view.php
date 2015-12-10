<div class="col-md-9" style="text-allign:center">
	<table id="Addressbook">	
		<thead>
			<tr>
				<th>Volledige naam</th>
				<th>Adres</th>
				<th>Plaats en postcode</th>
				<th>Email</th>
				<th>Acties</th>
			</tr>
			</thead>
	</table>
</div>

<div class="modal fade" id="youSure" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Weet u het zeker?</h4>
				<input type="hidden" value="" id="toDelete">
			</div>
			<div class="modal-body">
				<div class="clearfix">
					<button class="btn btn-danger pull-right" id="goAhead">Ja</button>
					<button class="btn btn-success pull-right" data-dismiss="modal">Nee</button>
				</div>
			</div>
		</div>
	</div>
</div>
<!--the delete function -->
<script>
	$("body").on("click",".delete",function(){
		var id	=	$(this).attr("id")
		var cleanId	=	id.replace("delete","")
		$("#toDelete").val(cleanId)
		$("#youSure").modal("show")
	})
	$("#goAhead").on("click",function(){
		var toDelete=$("#toDelete").val()
		$.ajax({
			url		:	"<?php echo base_url("index.php/adress/ajax/delete") ?>"+"/"+toDelete,
			success	:	function(){
				var table	=	$('#Addressbook').DataTable();
				table.row($("#delete"+toDelete).parent().parent()).remove().draw()
				$("#youSure").modal("hide")
			}
		})
	})
</script>
<!-- the datatable creation -->
<script>
	$('#Addressbook').DataTable({
		ajax:'<?php echo base_url('index.php/adress/ajax/getAllAdresses')?>'

	});
</script>
