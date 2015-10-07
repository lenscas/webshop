<div class="col-md-9" style="text-allign:center">

	<table id="UserOrders">	
	  <thead>
                <tr>
                    <th>Order Nummer</th>
                    <th>Bestel datum</th>
                    <th>Status</th>          
                    <th>Totale Prijs</th>
                </tr>
            </thead>
	</table>

</div>

<script>
	$('#UserOrders').DataTable({
		ajax:'<?php echo base_url('index.php/order')?>'

	});
</script>