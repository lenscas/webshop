<script type="text/javascript">
    tinymce.init({
        selector: "#Reason"
    });
</script>

<div class="content-wrapper">
<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			RMA weizigen
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url("index.php/admin/dashboard")?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?php echo base_url("index.php/admin/rma/view")?>"> RMA</a></li>
			<li class="active">Weizigen</li>
		</ol>
	</section>
	<section class="content">
		<form method="post" enctype="multipart/form-data">
			<div class="box">
				<div class="box-header">
					<input type="submit" class="btn btn-success pull-right" value="Opslaan">
					<?php if ($error){ ?>
						<div class="alert alert-error">
							<?php echo $error ?>
						</div>>
					<?php } 
						if (isset($success)){ ?>
						<div class="alert alert-success">
							<?php echo $success ?>
						</div>
					<?php } ?>
				</div>
				<div class="box-body">
					<div class="col-md-4">
						<div class="form-group">
							<label>Status</label>
							<select class="form-control" name="Status">
								<?php
									foreach($status as $key=>$value){
								?>
								<option value= "<?php echo $value['Id'] ?>" <?php if($value['Id']==$RMAData['Status']){echo "selected";}; ?>>
									<?php echo $value['Name'] ?> 
								</option>
								<?php
									}
								?>
							</select>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label>Beschrijving</label>
							<textarea class="form-control" name="Reason" id="Reason"><?php echo $RMAData['Reason']; ?></textarea>
						</div>
					</div>
				</div>
			</div>
		</form>
	</section>
</div>
