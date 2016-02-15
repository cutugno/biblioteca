<div class="container">
	
	<?php if ($this->session->utente->livello > 0) : ?>
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="<?php echo $activelibro; ?>"><a href="#libro" aria-controls="libro" role="tab" data-toggle="tab">Cerca libro</a></li>
		<li role="presentation" class="<?php echo $activeprestito; ?>"><a href="#prestito" aria-controls="prestito" role="tab" data-toggle="tab">Cerca prestito</a></li>		
	</ul>
	<?php endif ?>
	
	<!-- contenuto -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane <?php echo $activelibro; ?>jumbotron searchjumbo" id="libro">
			<div class="row" id="csemplice">
				<div class="col-xs-12">
					<p>Cerca libro</p>
				</div>
				<?php 
					$attr=array("class"=>"form-inline", "id"=>"searchlibro");
					echo form_open("homepage",$attr);
				?>
				  <div class="form-group col-xs-10">
					<?php
						$attr=array("class"=>"form-control input-lg", "id"=>"keyword", "name"=>"keyword", "placeholder"=>"Inserisci qui inventario, autore, titolo, traduttore, curatore...", "style"=>"width:100%");
						echo form_input($attr);
					?>
				  </div>
				  <div class="col-xs-2">
					<?php
						echo form_hidden('type', 'csemplice');
						$attr=array("type"=>"submit","class"=>"btn btn-primary btn-lg", "id"=>"btn_searchlibro", "content"=>"CERCA");
						echo form_button($attr);
					?>
				  </div>
				  <div class="col-xs-12"><?php echo form_error('keyword'); ?></div>
				<?php echo form_close(); ?>
				  <div class="col-xs-12">
					<small><a href="#" id="showavanzata">Vai a ricerca avanzata</a></small>
				  </div>
			</div>
			<div class="row" id="cavanzata" style="display:none">
				<div class="col-xs-12">
					<p>Cerca libro</p>
				</div>
				<?php 
					$attr=array("class"=>"form-horizontal", "id"=>"advancedsearchlibro");
					echo form_open("homepage",$attr);
				?>
				  <div class="form-group">
					  <label for="autore" class="col-xs-2 control-label">Autore</label>
					  <div class="col-xs-10">
					  <?php
						$attr=array("class"=>"form-control", "id"=>"autore", "name"=>"autore", "value"=>set_value('autore'));
						echo form_input($attr);
					  ?>
					  </div>
				  </div>
				  <div class="form-group">
					  <label for="titolo" class="col-xs-2 control-label">Titolo</label>
					  <div class="col-xs-10">
					  <?php
						$attr=array("class"=>"form-control", "id"=>"titolo", "name"=>"titolo", "value"=>set_value('titolo'));
						echo form_input($attr);
					  ?>
					  </div>
				  </div>
				  <div class="form-group">
					<label for="id_tipodoc" class="col-xs-2 control-label">Tipo Documento</label>
					<div class="col-xs-10 col-sm-6">
					<?php
						$options=array(""=>"Seleziona un tipo documento");
						$attr="class=form-control id=id_tipodoc";
						foreach ($select_tipidoc as $val) {
							$options[$val['id']]=$val['nome'];
						}
						echo form_dropdown('id_tipodoc', $options, set_value('id_tipodoc'), $attr);
					?>
					</div>				  
				  </div>
				  <div class="form-group">
					<label for="id_localizzazione" class="col-xs-2 control-label">Localizzazione</label>
					<div class="col-xs-10 col-sm-6">
					<?php
						$options=array(""=>"Seleziona una localizzazione");
						$attr="class=form-control id=id_localizzazione";
						foreach ($select_local as $val) {
							$options[$val['id']]=$val['nome'];
						}
						echo form_dropdown('id_localizzazione', $options, set_value('id_localizzazione'), $attr);
					?>
					</div>				  
				  </div>
				  <div class="form-group">
					<label for="id_argomento" class="col-xs-2 control-label">Argomento</label>
					<div class="col-xs-10 col-sm-6">
					<?php
						$options=array(""=>"Seleziona un argomento");
						$attr="class=form-control id=id_argomento";
						foreach ($select_argomenti as $val) {
							$options[$val['id']]=$val['nome'];
						}
						echo form_dropdown('id_argomento', $options, set_value('id_argomento'), $attr);
					?>
					</div>				  
				  </div>
				  <div class="form-group">
					<div class="col-xs-10 col-sm-6 col-xs-offset-2">
						<?php
							echo form_hidden('type', 'cavanzata');
							$attr=array("type"=>"submit","class"=>"btn btn-primary", "id"=>"btn_advancedsearchlibro", "content"=>"CERCA");
							echo form_button($attr);
						?>
					</div>
				  </div>
				<?php echo form_close(); ?>
				  <div class="col-xs-12">
					<small><a href="#" id="showsemplice">Vai a ricerca semplice</a></small>
				  </div>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane <?php echo $activeprestito; ?>jumbotron searchjumbo" id="prestito">
			<div class="row">
				<div class="col-xs-12">
					<p>Cerca prestito</p>
				</div>
				<div class="col-xs-12">
					<?php 
						$attr=array("class"=>"form-inline", "id"=>"searchprestito");
						echo form_open("homepage",$attr);
					?>
					  <div class="form-group col-xs-10">
						<?php
							$attr=array("class"=>"form-control input-lg", "id"=>"codice", "name"=>"codice", "placeholder"=>"Inserisci qui il codice prestito", "style"=>"width:100%");
							echo form_input($attr);
						?>
					  </div>
					  <div class="col-xs-2">
						<?php
							echo form_hidden('type', 'cprestito');
							$attr=array("type"=>"submit","class"=>"btn btn-primary btn-lg", "id"=>"btn_searchprestito", "content"=>"CERCA");
							echo form_button($attr);
						?>
					  </div>
					  <div class="col-xs-12"><?php echo form_error('codice'); ?></div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	
	</div>
</div>