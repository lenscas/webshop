<div class="col-md-9 test">
	<table id="RMATable">
		<thead>
			<tr>
				<th>OrderNummer</th>
				<th>Datum</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				foreach($RMA as $key=>$value){
			?>
				<tr>
					<td><?php echo $value['Order_Id'] ?></td>
					<td><?php echo $value['Date'] ?></td>
					<td><label class="label label-<?php echo $value['Class'] ?>"><?php echo $value['Name'] ?></label></td>
				</tr>
			<?php
				}
			?>
			
		</tbody>
	</table>
</div>
<script>
	$("#RMATable").DataTable();
</script>
