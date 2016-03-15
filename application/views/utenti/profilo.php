<div class="container">
	<h1><?php echo $utente->nome; ?></h1>
	<div class="row">
		<div class="col-md-9">
			<?php
				$attr=array("id"=>"schedautente");
				echo form_open("utenti/profilo",$attr);
			?>
			<div class="row">
		       <div class="form-group col-xs-12 col-sm-6 col-md-4">
				<label for="username">Username</label>
				<?php 
					$valore=isset($utente->username) ? $utente->username : set_value('username');
					$attr=array("class"=>"form-control","id"=>"username","name"=>"username","value"=>$valore, "readonly"=>"true");
					echo form_input($attr);
				?>
			  </div>		
			  <div class="form-group col-xs-12 col-sm-6 col-md-4">
				<label for="nome">Nome</label> <?php echo form_error('nome'); ?>
				<?php 
					$valore=isset($utente->nome) ? $utente->nome : set_value('nome');
					$attr=array("class"=>"form-control","id"=>"nome","name"=>"nome","value"=>$valore);
					echo form_input($attr);
				?>
			  </div>
			  <div class="form-group col-xs-12 col-sm-6 col-md-4">
				<label for="nome">Livello</label>
				<?php
					$attr=array("class"=>"form-control","id"=>"livello","name"=>"livello","value"=>$utente->descrizione,"readonly"=>"true");
					echo form_input($attr);
				?>
			  </div>
			</div>	
			<div class="row">
			  <div class="form-group col-xs-12 col-sm-6 col-md-4">
				<label for="nome">Classe</label> 
				<?php 
					$attr=array("class"=>"form-control","id"=>"classe","name"=>"classe","value"=>$utente->classe);
					echo form_input($attr);
				?>
			  </div>
			  <div class="form-group col-xs-12 col-sm-6 col-md-4">
				<label for="email">Email</label> <?php echo form_error('email'); ?>
				<?php 
					$valore=!empty($utente->email) ? $utente->email : set_value('email');
					$attr=array("class"=>"form-control","id"=>"email","name"=>"email","value"=>$valore);
					echo form_input($attr);
				?>
			  </div>
			  <div class="form-group col-xs-12 col-sm-6 col-md-4">
				<label for="telefono">Telefono</label> <?php echo form_error('telefono'); ?>
				<?php 
					$valore=!empty($utente->telefono) ? $utente->telefono : set_value('telefono');
					$attr=array("class"=>"form-control","id"=>"telefono","name"=>"telefono","value"=>$valore);
					echo form_input($attr);
				?>
			  </div>
			 </div>
			 <div class="spacer-25"></div>
			 <div class="row">
				<div class="form-group col-xs-12 text-center">
					<div class="row">
						<div class="col-xs-12 center-xs">
							<?php					
								$attr=array("type"=>"submit","class"=>"btn btn-success", "id"=>"btn_updateutente", "content"=>"<i class=\"fa fa-floppy-o\"></i> SALVA MODIFICHE");
								echo form_button($attr);	
								echo form_hidden('id', $utente->id);			
							?>		
						</div>
					</div>
				</div>
			 </div>
			<?php echo form_close(); ?>
		</div>	
	</div>		
</div>
