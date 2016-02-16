<div class="container">
	<?php if ($this->session->fromsearch) : ?>
	<a href="<?php echo site_url('search'); ?>" class="btn btn-link pull-right">Torna ai risultati</a>
	<?php else : ?>
	<a href="<?php echo site_url('libri/elenco'); ?>" class="btn btn-link pull-right">Torna all'elenco</a>
	<?php endif ?>
	<h1><?php echo $libro->titolo; ?></h1>
	<div class="row">
		<div class="col-md-9">
			<?php
				$attr=array("id"=>"schedalibro");
				echo form_open("libri/scheda/".$libro->id,$attr);
			?>
			<div class="row">
			  <div class="form-group col-xs-12 col-sm-6 col-md-4">
				<label for="inventario">Cod. inventario</label> <?php echo form_error('inventario'); ?>
				<?php 
					$attr=array("class"=>"form-control text-uppercase","id"=>"inventario","name"=>"inventario","value"=>$libro->inventario, "readonly"=>"true");
					if (!$readonly) $attr["readonly"]="true";
					echo form_input($attr);
				?>
			  </div>
			  <div class="form-group col-xs-12 col-sm-6 col-md-4">
				<label for="id_localizzazione">Localizzazione</label> 
				<?php
					$options=array();
					$attr="class=form-control";
					if (!$readonly) $attr.=" disabled=true";
					foreach ($select_local as $val) {
						$options[$val['id']]=$val['nome'];
					}
					echo form_dropdown('id_localizzazione', $options, $libro->id_localizzazione, $attr);
				?>
			  </div>
			  <div class="form-group col-xs-12 col-sm-6 col-md-4">
				<label for="collocazione">Collocazione</label> <?php echo form_error('collocazione'); ?>
				<?php 
					$attr=array("class"=>"form-control","id"=>"collocazione","name"=>"collocazione","value"=>$libro->collocazione);
					if (!$readonly) $attr["readonly"]="true";
					echo form_input($attr);
				?>
			  </div>
			</div>
			
			<div class="row">
			  <div class="form-group col-xs-12 col-sm-6">
				  <label for="autore">Autore</label> <?php echo form_error('autore'); ?>
				  <?php 
					 $attr=array("class"=>"form-control","id"=>"autore","name"=>"autore","value"=>$libro->autore);
					 if (!$readonly) $attr["readonly"]="true";
					 echo form_input($attr);
				  ?>
			  </div>
			  <div class="form-group col-xs-12 col-sm-6">
				  <label for="autore">Titolo</label> <?php echo form_error('titolo'); ?>
				  <?php 
					 $attr=array("class"=>"form-control","id"=>"titolo","name"=>"titolo","value"=>$libro->titolo);
					 if (!$readonly) $attr["readonly"]="true";
					 echo form_input($attr);
				  ?>
			  </div>
			</div>
			
			<div class="row">
			  <div class="form-group col-xs-12 col-sm-6 col-md-4">
				<label for="editore">Editore</label> <?php echo form_error('editore'); ?>
				<?php 
					$attr=array("class"=>"form-control","id"=>"editore","name"=>"editore","value"=>$libro->editore);
					if (!$readonly) $attr["readonly"]="true";
					echo form_input($attr);
				?>
			  </div>
			  <div class="form-group col-xs-12 col-sm-6 col-md-4">
				<label for="luogo">Luogo</label> <?php echo form_error('luogo'); ?>
				<?php 
					$attr=array("class"=>"form-control","id"=>"luogo","name"=>"luogo","value"=>$libro->luogo);
					if (!$readonly) $attr["readonly"]="true";
					echo form_input($attr);
				?>
			  </div>
			  <div class="form-group col-xs-12 col-sm-6 col-md-4">
				<label for="anno">Anno</label> <?php echo form_error('anno'); ?>
				<?php 
					$attr=array("class"=>"form-control","id"=>"anno","name"=>"anno","value"=>$libro->anno);
					if (!$readonly) $attr["readonly"]="true";
					echo form_input($attr);
				?>
			  </div>
			</div>
			
			<div class="row">
			  <div class="form-group col-xs-12 col-sm-6 col-md-4">
				<label for="id_tipodoc">Tipo documento</label>
				<?php
					$options=array();
					$attr="class=form-control";
					if (!$readonly) $attr.=" disabled=true";
					foreach ($select_tipidoc as $val) {
						$options[$val['id']]=$val['nome'];
					}
					echo form_dropdown('id_tipodoc', $options, $libro->id_tipodoc, $attr);
				?>
			  </div>
			  <div class="form-group col-xs-12 col-sm-6 col-md-4">
				<label for="id_argomento">Argomento</label>
				<?php
					$options=array();
					$attr="class=form-control";
					if (!$readonly) $attr.=" disabled=true";
					foreach ($select_argomenti as $val) {
						$options[$val['id']]=$val['nome'];
					}
					echo form_dropdown('id_argomento', $options, $libro->id_argomento, $attr);
				?>
			  </div>
			  <div class="form-group col-xs-12 col-sm-6 col-md-4">
				<label for="lingua">Lingua</label> <?php echo form_error('lingua'); ?>
				<?php 
					$attr=array("class"=>"form-control","id"=>"lingua","name"=>"lingua","value"=>$libro->lingua);
					if (!$readonly) $attr["readonly"]="true";
					echo form_input($attr);
				?>
			  </div>
			</div>
			
			<div class="row">
			  <div class="form-group col-xs-12 col-sm-6 col-md-4">
				<label for="isbn">ISBN</label>
				<?php 
					$attr=array("class"=>"form-control","id"=>"isbn","name"=>"isbn","value"=>$libro->isbn);
					if (!$readonly) $attr["readonly"]="true";
					echo form_input($attr);
				?>
			  </div>
			  <div class="form-group col-xs-12 col-sm-6 col-md-4">
				<label for="cdd">CDD</label> <?php echo form_error('cdd'); ?>
				<?php 
					$attr=array("class"=>"form-control","id"=>"cdd","name"=>"cdd","value"=>$libro->cdd);
					if (!$readonly) $attr["readonly"]="true";
					echo form_input($attr);
				?>
			  </div>
			  <div class="form-group col-xs-12 col-sm-6 col-md-4">
				<label for="descrizione_cdd">Descrizione CDD</label> <?php echo form_error('descrizione_cdd'); ?>
				<?php 
					$attr=array("class"=>"form-control","id"=>"descrizione_cdd","name"=>"descrizione_cdd","value"=>$libro->descrizione_cdd);
					if (!$readonly) $attr["readonly"]="true";
					echo form_input($attr);
				?>
			  </div>
			</div>
			
			<div class="row">
			  <div class="form-group col-xs-12 col-sm-6">
				<label for="curatore">Curatore</label> <?php echo form_error('curatore'); ?>
				<?php 
					$attr=array("class"=>"form-control","id"=>"curatore","name"=>"curatore","value"=>$libro->curatore);
					if (!$readonly) $attr["readonly"]="true";
					echo form_input($attr);
				?>
			  </div>
			  <div class="form-group col-xs-12 col-sm-6">
				<label for="traduttore">Traduttore</label> <?php echo form_error('traduttore'); ?>
				<?php 
					$attr=array("class"=>"form-control","id"=>"traduttore","name"=>"traduttore","value"=>$libro->traduttore);
					if (!$readonly) $attr["readonly"]="true";
					echo form_input($attr);
				?>
			  </div>
			</div>
			
			<div class="row">
			  <div class="form-group col-xs-12">
				<label for="note">Note</label>
				<?php 
					$attr=array("class"=>"form-control","id"=>"note","name"=>"note","value"=>$libro->note);
					if (!$readonly) $attr["readonly"]="true";
					echo form_textarea($attr);
					echo form_hidden('id', $libro->id);		
				?>
			  </div>
			 </div>
			 <div class="row">
			  <div class="form-group col-xs-12 text-center">
				<?php
					if ($this->session->utente->livello > 0) {
						echo "<div class=\"row\">";
							$attr=array("type"=>"button","class"=>"btn btn-warning", "id"=>"btn_undolibro", "content"=>"<i class=\"fa fa-undo\"></i> ANNULLA MODIFICHE");
							echo "<div class=\"col-xs-12 col-sm-4 text-right center-xs\">".form_button($attr)."</div>
								  <div class=\"col-xs-12 spacer-10 visible-xs-block\"></div>
							";
							$attr=array("type"=>"submit","class"=>"btn btn-success", "id"=>"btn_updatelibro", "content"=>"<i class=\"fa fa-floppy-o\"></i> SALVA MODIFICHE");
							echo "<div class=\"col-xs-12 col-sm-4 center-xs\">".form_button($attr)."</div>
							      <div class=\"col-xs-12 spacer-10 visible-xs-block\"></div>
							";
							$attr=array("type"=>"button","class"=>"btn btn-danger", "id"=>"btn_deletelibro", "content"=>"<i class=\"fa fa-eraser\"></i> ELIMINA LIBRO");
							echo "<div class=\"col-xs-12 col-sm-4 text-left center-xs\">".form_button($attr)."</div>
								  <div class=\"col-xs-12 spacer-10 visible-xs-block\"></div>
						";
						echo "</div>";
					}
				?>		
			  </div>
			 </div>
			<?php echo form_close(); ?>
		</div>
		<div class="col-md-3 center-xs">
			<p class="lead">Info prestiti</p>
			<p>Questo libro è 
			<?php if ($libro->disp==1) : ?>
			<span class="text-success">disponibile</span> per il prestito</p>
				<?php if ($this->session->utente->livello > 0) : ?>
				<a href="<?php echo site_url('prestiti/nuovo'); ?>" class="btn btn-success"><i class="fa fa-share"></i> REGISTRA PRESTITO</a>
				<?php endif ?>
			<?php else : ?>
			<span class="text-danger">in prestito</span></p>			
				<?php if ($this->session->utente->livello > 0) : ?>
				<div class="spacer-10"></div>
				<div class="row">
					<div class="col-xs-12">
						<label>Cod. prestito</label> <span><?php echo $prestito->codice; ?></span>
					</div>
					<div class="col-xs-12">
						<label>Utente</label> <span><?php echo $prestito->utente; ?></span>
					</div>
					<div class="col-xs-12">
						<label>Classe</label> <span><?php echo $prestito->classe; ?></span>
					</div>
					<div class="col-xs-12">
						<label>Email</label> <span><?php echo $prestito->email; ?></span>
					</div>
					<div class="col-xs-12">
						<label>Data prestito</label> <span><?php echo $prestito->data_prestito; ?></span>
					</div>
				</div>
				<div class="spacer-10"></div>
				<div class="row">					
					<div class="col-xs-12">
						<a href="<?php echo site_url('prestiti/reso/'.$prestito->id); ?>" class="btn btn-success"><i class="fa fa-reply"></i> REGISTRA RESO</a>
					</div>
					<div class="col-xs-12 spacer-10"></div>
					<div class="col-xs-12">
						<!-- <a href="#" class="btn btn-primary"><i class="fa fa-envelope-o"></i> CONTATTA UTENTE</a> -->
					</div>
				</div>				
				<?php endif ?>
			<?php endif ?>
		</div>
	</div>
		
</div>