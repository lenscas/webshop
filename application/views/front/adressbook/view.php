<div class="col-md-9" style="text-allign:center">

	<table id="Addressbook">	
	  <thead>
                <tr>
                    <th>Volledige naam</th>
                    <th>Adres</th>
                    <th>Plaats en postcode</th>          
                    <th>Email</th>
                </tr>
            </thead>
	</table>

</div>

<script>
	$('#Addressbook').DataTable({
		ajax:'<?php echo base_url('index.php/adress/ajax/getAllAdresses')?>'

	});
</script>