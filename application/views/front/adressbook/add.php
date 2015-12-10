<div class="col-md-9">
	<?php 
		if(isset($error)){
	?>
		<div class="alert alert-danger">
			<p><?php echo $error ?></p>
		</div>
	<?php
		}
	?>
	<?php 
		if(isset($success)){
	?>
		<div class="alert alert-success">
			<p>Uw address is met success toegevoegd</p>
		</div>
	<?php
	}
	?>
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
					<td><input type="text"	name="Firstname" value="<?php if(isset($Firstname)){echo $Firstname;} ?>"	></td>
					<td><input type="text"	name="SecondName" value="<?php if(isset($SecondName)){echo $SecondName;} ?>"	></td>
					<td><input type="text"	name="LastName"	value="<?php if(isset($LastName)){echo $LastName;} ?>"	></td>
				</tr>
			</table>
			<table style="max-width:100%">
				<tr>
					<td>Woonplaats</td>
					<td>Zipcode</td>
				</tr>
				<tr>
					<td><input type="text"	name="City"	value="<?php if(isset($City)){echo $City;} ?>"	></td>
					<td><input type="text"	name="Zipcode" value="<?php if(isset($Zipcode)){echo $Zipcode;} ?>"	></td>
				</tr>
				<tr>
					<td>Straat</td>
					<td>Huisnummer</td>
				</tr>
				<tr>
					<td><input type="text"	name="Adress" value="<?php if(isset($Adress)){echo $Adress;} ?>"		></td>
					<td><input type="text"	name="HomeNumber" value="<?php if(isset($HomeNumber)){echo $HomeNumber;} ?>"	></td>
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
					<td><input type="text" name="MailAdress" value="<?php if(isset($MailAdress)){echo $MailAdress;} ?>"></td>
				</tr>
			</table>
		</div>
	</form>
</div>
