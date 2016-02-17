<div class="container">
	<h1>Nuovo utente</h1>
	<?php
		$attr=array("id"=>"nuovoutente");
		echo form_open("utenti/nuovo",$attr);
	?>
	<div class="row">
		<div class="col-md-9">
			<div class="row">
				<div class="form-group col-xs-12 col-sm-6 col-md-4">
					<label for="username">Username</label> <?php echo form_error('username'); ?>
					<?php 
						$attr=array("class"=>"form-control","id"=>"username","name"=>"username","value"=>set_value('username'));
						echo form_input($attr);
					?>
				</div>	
				<div class="form-group col-xs-12 col-sm-6 col-md-4">
					<label for="nome">Nome</label> <?php echo form_error('nome'); ?>
					<?php 
						$attr=array("class"=>"form-control","id"=>"nome","name"=>"nome","value"=>set_value('nome'));
						echo form_input($attr);
					?>
				</div>
				<div class="form-group col-xs-12 col-sm-6 col-md-4">
					<label for="nome">Livello</label>
					<?php
						$options=array();
						$attr="class=form-control";
						foreach ($select_livelli as $val) {
							$options[$val['livello']]=$val['nome'];
						}
						echo form_dropdown('livello', $options, set_value('livello'), $attr);
					?>
				</div>
			</div>	
			<div class="row">
				<div class="form-group col-xs-12 col-sm-6 col-md-4">
					<label for="nome">Classe</label> 
					<?php 
						$attr=array("class"=>"form-control","id"=>"classe","name"=>"classe","value"=>set_value('classe'));
						echo form_input($attr);
					?>
				</div>
				<div class="form-group col-xs-12 col-sm-6 col-md-4">
					<label for="email">Email</label> <?php echo form_error('email'); ?>
					<?php 
						$attr=array("class"=>"form-control","id"=>"email","name"=>"email","value"=>set_value('email'));
						echo form_input($attr);
					?>
				</div>
				<div class="form-group col-xs-12 col-sm-6 col-md-4">
					<label for="telefono">Telefono</label> <?php echo form_error('telefono'); ?>
					<?php 
						$attr=array("class"=>"form-control","id"=>"telefono","name"=>"telefono","value"=>set_value('telefono'));
						echo form_input($attr);
					?>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-xs-12 text-center">
					<?php
						$attr=array("type"=>"submit","class"=>"btn btn-primary", "id"=>"btn_insertutente", "content"=>"SALVA");
						echo form_button($attr);
					?>
				</div>
			</div>
			<?php echo form_close(); ?>
		</div>
		<div class="col-md-3">
		</div>
	</div>
</div>