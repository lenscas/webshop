<script type="text/javascript">
    tinymce.init({
        selector: "#reason"
    });
</script>
<div class="col-md-9">
	<?php 
		if($error){
	?>
			<div class="alert alert-danger">
				<?php echo $error ?>
			</div>
	<?php
		}
	?>
	<form method="post">
		<div class="row" style="margin-bottom:10px">
			<div class="col-md-12">
				<h1>RMA aanvragen <button type="submit" class="btn btn-success pull-right">Aanvragen</button></h1>
				
			</div>
		</div>
		<p>Wat is de rede voor de RMA?</p>
		<div class="row">
			<textarea name="reason" id="reason"></textarea>
		</div>
	</form>
</div>


