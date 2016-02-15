<div class="container">
	<a href="<?php echo site_url('libri/elenco'); ?>" class="btn btn-link pull-right">Torna all'elenco</a>
	<h1><?php echo $infoutente->nome; ?></h1>
	<div class="row">
		<div class="col-md-9">
			<?php
				$attr=array("id"=>"schedautente");
				echo form_open("utenti/scheda/".$infoutente->id,$attr);
			?>
			<div class="row">
			  <div class="form-group col-xs-12">
				<label for="nome">Nome</label> <?php echo form_error('nome'); ?>
				<?php 
					$attr=array("class"=>"form-control","id"=>"nome","name"=>"nome","value"=>$infoutente->nome);
					if ($readonly) $attr["readonly"]="true";
					echo form_input($attr);
				?>
			  </div>
			</div>	
			<div class="row">
			  <div class="form-group col-xs-12 col-sm-6 col-md-4">
				<label for="nome">Classe</label> <?php echo form_error('classe'); ?>
				<?php 
					$attr=array("class"=>"form-control","id"=>"classe","name"=>"classe","value"=>$infoutente->classe);
					if ($readonly) $attr["readonly"]="true";
					echo form_input($attr);
				?>
			  </div>
			  <div class="form-group col-xs-12 col-sm-6 col-md-4">
				<label for="nome">Email</label> <?php echo form_error('email'); ?>
				<?php 
					$attr=array("class"=>"form-control","id"=>"email","name"=>"email","value"=>$infoutente->email);
					if ($readonly) $attr["readonly"]="true";
					echo form_input($attr);
				?>
			  </div>
			  <div class="form-group col-xs-12 col-sm-6 col-md-4">
				<label for="nome">Telefono</label> <?php echo form_error('telefono'); ?>
				<?php 
					$attr=array("class"=>"form-control","id"=>"telefono","name"=>"telefono","value"=>$infoutente->telefono);
					if ($readonly) $attr["readonly"]="true";
					echo form_input($attr);
				?>
			  </div>
			</div>
			
			<div class="row">
				<div class="form-group col-xs-12 col-sm-6 col-md-4">
				<label for="nome">Livello</label>
				<?php
					$options=array();
					$attr="class=form-control";
					if ($readonly) $attr.=" disabled=true";
					foreach ($select_livelli as $val) {
						$options[$val['livello']]=$val['nome'];
					}
					echo form_dropdown('livello', $options, $infoutente->livello, $attr);
				?>
			  </div>
			  <div class="form-group col-xs-12 col-sm-6 col-md-4">
				<label for="nome">Ultimo login</label>
				<?php 
					$attr=array("class"=>"form-control","id"=>"last_login","name"=>"last_login","value"=>$infoutente->last_login, "readonly"=>"true");
					echo form_input($attr);
				?>
			  </div>
			</div>			
			
			 <div class="row">
			  <div class="form-group col-xs-12 text-center">
				<?php
					if ($this->session->utente->livello >=3) {
						echo "<div class=\"row\">";
							$attr=array("type"=>"button","class"=>"btn btn-warning", "id"=>"btn_undoutente", "content"=>"<i class=\"fa fa-undo\"></i> ANNULLA MODIFICHE");
							echo "<div class=\"col-xs-12 col-sm-".$btn_col." text-right center-xs\">".form_button($attr)."</div>
								  <div class=\"col-xs-12 spacer-10 visible-xs-block\"></div>
							";
							$attr=array("type"=>"submit","class"=>"btn btn-success", "id"=>"btn_updateutente", "content"=>"<i class=\"fa fa-floppy-o\"></i> SALVA MODIFICHE");
							echo "<div class=\"col-xs-12 col-sm-".$btn_col." center-xs\">".form_button($attr)."</div>
							      <div class=\"col-xs-12 spacer-10 visible-xs-block\"></div>
							";
							if ($this->session->utente->livello > $infoutente->livello) {
								$attr=array("type"=>"button","class"=>"btn btn-danger", "id"=>"btn_deleteutente", "content"=>"<i class=\"fa fa-eraser\"></i> ELIMINA UTENTE");
								echo "<div class=\"col-xs-12 col-sm-".$btn_col." text-left center-xs\">".form_button($attr)."</div>
									  <div class=\"col-xs-12 spacer-10 visible-xs-block\"></div>
								";
							}
							echo "</div>";
					}
				?>		
			  </div>
			 </div>
			<?php echo form_close(); ?>
		</div>
		<div class="col-md-3">
			<!-- pulsante contatta utente -->
		</div>
		
	</div>
		
</div>