<div class="container">
	<h1>Modifica Password</h1>
	<form>
	<div class="row">
		<div class="form-group col-xs-12 col-sm-6">
			<label for="old_password">Vecchia password</label>
			<input type="password" class="form-control" id="old_password" name="old_password">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-xs-12 col-sm-6">
			<label for="new_password">Nuova password</label>
			<input type="password" class="form-control" id="new_password" name="new_password">
		</div>
	</div>
	<div class="row">
		<div class="form-group col-xs-12 col-sm-6">
			<label for="conf_password">Conferma password</label>
			<input type="password" class="form-control" id="conf_password" name="conf_password">
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
	</form>
</div>
