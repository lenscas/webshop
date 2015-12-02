<div class="col-md-9">
	<form method="post">
		<div class="row">
			<button class="pull-right btn btn-success">Opslaan</button>
		</div>
		<div class="row">
			<table style="max-width:100%; table-layout:fixed">
				<tr>
					<td>Voornaam</td>
					<td>Tussen voegsels</td>
					<td>Achternaam</td>
				</tr>
				<tr>
					<td><input type="text"	name="Firstname"	></td>
					<td><input type="text"	name="SecondName"	></td>
					<td><input type="text"	name="LastName"		></td>
				</tr>
			</table>
			<table style="max-width:100%">
				<tr>
					<td>Woonplaats</td>
					<td>Zipcode</td>
				</tr>
				<tr>
					<td><input type="text"	name="City"		></td>
					<td><input type="text"	name="Zipcode"	></td>
				</tr>
				<tr>
					<td>Straat</td>
					<td>Huisnummer</td>
				</tr>
				<tr>
					<td><input type="text"	name="Adress"		></td>
					<td><input type="text"	name="HomeNumber"	></td>
				</tr>
			</table>
			<table style="max-width:100%">
				<tr>
					<td>Land</td>
				</tr>
				<tr>
					<td><select id="country" name="Land_Id">
					<?php 
						foreach($countries as $key=>$value){
							echo '<option value="'.$value['Id'].'">'.$value['Name'].'</option>';
						}
					?>
				</tr>
				<tr>
					<td>Email address</td>
				</tr>
				<tr>
					<td><input type="text" name="MailAdress"></td>
				</tr>
			</table>
		</div>
	</form>
</div>
