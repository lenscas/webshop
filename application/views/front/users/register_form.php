<div class="col-md-9">
	<?php
		if ($error != null) {
	?> 
			<div class="alert alert-danger" role="alert"> <?php echo $error ?> </div>
	<?php
		}
	?>

		<form method = "post">
			<div class="col-lg-6">
				<div class="form-group">
					<label>Gebruikersnaam</label>
				 	<input type="text" name = "Username" class="form-control">
				</div>
				<div class="form-group">
					<label>Wachtwoord</label>
				 	<input type="password" name = "Password" class="form-control">
				</div>
				<div class="form-group">
					<label>Herhaal Wachtwoord</label>
				 	<input type="password" name = "PasswordCheck" class="form-control">
				</div>
			</div>
			<div class="col-lg-6">

				<div class="form-group">
					<label>Geboortedatum</label>
				 	<input type="date" name = "Birthdate" class="form-control">
				</div>
				<div class="form-group">
					<label>Email</label>
				 	<input type="email" name = "Email" class="form-control">
				</div>
				
				<div class="form-group">
			        <label>Gender</label>	      
		            <select class="form-control" name="Gender">
		                <option value="1">Man</option>
		                <option value="0">Vrouw</option>
		            </select>
		        </div>

				<button class="btn btn-success pull-right" type="submit"> Registreren! </button>
			</div>
		</form>
</div>