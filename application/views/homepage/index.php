<div class="container">
	
	<?php if ($this->session->utente->livello > 0) : ?>
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#libro" aria-controls="libro" role="tab" data-toggle="tab">Cerca libro</a></li>
		<li role="presentation"><a href="#prestito" aria-controls="prestito" role="tab" data-toggle="tab">Cerca prestito</a></li>		
	</ul>
	<?php endif ?>
	
	<!-- contenuto -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active jumbotron searchjumbo" id="libro">
			<div class="row">
				<div class="col-xs-12">
					<p>Cerca libro</p>
				</div>
				<div class="col-xs-12">
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
							echo form_hidden('type', 'semplice');
							$attr=array("type"=>"submit","class"=>"btn btn-primary btn-lg", "id"=>"btn_searchlibro", "content"=>"CERCA");
							echo form_button($attr);
						?>
					  </div>
					  <div class="col-xs-12"><?php echo form_error('keyword'); ?></div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane jumbotron searchjumbo" id="prestito">
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
							echo form_hidden('type', 'semplice');
							$attr=array("type"=>"submit","class"=>"btn btn-primary btn-lg", "id"=>"btn_searchlibro", "content"=>"CERCA");
							echo form_button($attr);
						?>
					  </div>
					  <div class="col-xs-12"><?php echo form_error('keyword'); ?></div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	
	</div>
</div>