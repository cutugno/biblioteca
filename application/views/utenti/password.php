<div class="container">
	<h1>Modifica Password</h1>
	<?php
		$attr=array("id"=>"nuovolibro");
		echo form_open("modifica-password",$attr);
	?>
	<div class="row">
		<div class="form-group col-xs-12 col-sm-6">
			<label for="old_password">Vecchia password</label> <?php echo form_error('old_password'); ?>
			<input type="password" class="form-control" id="old_password" name="old_password" placeholder="************">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-xs-12 col-sm-6">
			<label for="new_password">Nuova password</label> <?php echo form_error('new_password'); ?>
			<input type="password" class="form-control" id="new_password" name="new_password" placeholder="************">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-xs-12 col-sm-6">
			<label for="conf_password">Conferma password</label> <?php echo form_error('conf_password'); ?>
			<input type="password" class="form-control" id="conf_password" name="conf_password" placeholder="************">
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-6">
			<?php					
				$attr=array("type"=>"submit","class"=>"btn btn-success", "id"=>"btn_cambiapassword", "content"=>"<i class=\"fa fa-floppy-o\"></i> SALVA MODIFICHE");
				echo form_button($attr);				
			?>		
		</div>
	</div>
	<?php echo form_close(); ?>
</div>
