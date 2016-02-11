<div class="container">
	<a href="<?php echo site_url('libri/elenco'); ?>" class="btn btn-link pull-right">Torna all'elenco</a>
	<h1><?php echo $libro->titolo; ?></h1>
	<div class="row">
		<div class="col-md-8">
			<?php
				$attr=array("id"=>"schedalibro");
				echo form_open("libri/scheda/".$libro->id,$attr);
			?>
			<div class="row">
			  <div class="form-group col-xs-12 col-sm-6 col-md-4">
				<label for="inventario">Cod. inventario</label> <?php echo form_error('inventario'); ?>
				<?php 
					$attr=array("class"=>"form-control text-uppercase","id"=>"inventario","name"=>"inventario","placeholder"=>"PT0001","value"=>$libro->inventario, "readonly"=>"true");
					echo form_input($attr);
				?>
			  </div>
			  <div class="form-group col-xs-12 col-sm-6 col-md-4">
				<label for="id_localizzazione">Localizzazione</label> 
				<?php
					$options=array();
					$attr="class=form-control";
					foreach ($select_local as $val) {
						$options[$val['id']]=$val['nome'];
					}
					echo form_dropdown('id_localizzazione', $options, $libro->id_localizzazione, $attr);
				?>
			  </div>
			  <div class="form-group col-xs-12 col-sm-6 col-md-4">
				<label for="collocazione">Collocazione</label> <?php echo form_error('collocazione'); ?>
				<?php 
					$attr=array("class"=>"form-control","id"=>"collocazione","name"=>"collocazione","placeholder"=>"Armadio 3","value"=>$libro->collocazione);
					echo form_input($attr);
				?>
			  </div>
			</div>
			
			<div class="row">
			  <div class="form-group col-xs-12 col-sm-6">
				  <label for="autore">Autore</label> <?php echo form_error('autore'); ?>
				  <?php 
					 $attr=array("class"=>"form-control","id"=>"autore","name"=>"autore","placeholder"=>"Robert Jordan, Brandon Sanderson","value"=>$libro->autore);
					 echo form_input($attr);
				  ?>
			  </div>
			  <div class="form-group col-xs-12 col-sm-6">
				  <label for="autore">Titolo</label> <?php echo form_error('titolo'); ?>
				  <?php 
					 $attr=array("class"=>"form-control","id"=>"titolo","name"=>"titolo","placeholder"=>"La ruota del tempo","value"=>$libro->titolo);
					 echo form_input($attr);
				  ?>
			  </div>
			</div>
			
			<div class="row">
			  <div class="form-group col-xs-12 col-sm-6 col-md-4">
				<label for="editore">Editore</label> <?php echo form_error('editore'); ?>
				<?php 
					$attr=array("class"=>"form-control","id"=>"editore","name"=>"editore","placeholder"=>"Arnoldo Mondadori Editore","value"=>$libro->editore);
					echo form_input($attr);
				?>
			  </div>
			  <div class="form-group col-xs-12 col-sm-6 col-md-4">
				<label for="luogo">Luogo</label> <?php echo form_error('luogo'); ?>
				<?php 
					$attr=array("class"=>"form-control","id"=>"luogo","name"=>"luogo","placeholder"=>"Milano","value"=>$libro->luogo);
					echo form_input($attr);
				?>
			  </div>
			  <div class="form-group col-xs-12 col-sm-6 col-md-4">
				<label for="anno">Anno</label> <?php echo form_error('anno'); ?>
				<?php 
					$attr=array("class"=>"form-control","id"=>"anno","name"=>"anno","placeholder"=>"1991","value"=>$libro->anno);
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
					foreach ($select_tipidoc as $val) {
						$options[$val['id']]=$val['nome'];
					}
					echo form_dropdown('id_tipodoc', $options, $libro->id_tipodoc, $attr);
				?>
			  </div>
			  <div class="form-group col-xs-12 col-sm-6 col-md-4">
				<label for="id_genere">Genere</label>
				<?php
					$options=array();
					$attr="class=form-control";
					foreach ($select_generi as $val) {
						$options[$val['id']]=$val['nome'];
					}
					echo form_dropdown('id_genere', $options, $libro->id_genere, $attr);
				?>
			  </div>
			  <div class="form-group col-xs-12 col-sm-6 col-md-4">
				<label for="lingua">Lingua</label> <?php echo form_error('lingua'); ?>
				<?php 
					$attr=array("class"=>"form-control","id"=>"lingua","name"=>"lingua","placeholder"=>"Italiano","value"=>$libro->lingua);
					echo form_input($attr);
				?>
			  </div>
			</div>
			
			<div class="row">
			  <div class="form-group col-xs-12 col-sm-6 col-md-4">
				<label for="isbn">ISBN</label>
				<?php 
					$attr=array("class"=>"form-control","id"=>"isbn","name"=>"isbn","placeholder"=>"978-88-7075-703-3","value"=>$libro->isbn);
					echo form_input($attr);
				?>
			  </div>
			  <div class="form-group col-xs-12 col-sm-6 col-md-4">
				<label for="cdd">CDD</label> <?php echo form_error('cdd'); ?>
				<?php 
					$attr=array("class"=>"form-control","id"=>"cdd","name"=>"cdd","placeholder"=>"554","value"=>$libro->cdd);
					echo form_input($attr);
				?>
			  </div>
			  <div class="form-group col-xs-12 col-sm-6 col-md-4">
				<label for="descrizione_cdd">Descrizione CDD</label> <?php echo form_error('descrizione_cdd'); ?>
				<?php 
					$attr=array("class"=>"form-control","id"=>"descrizione_cdd","name"=>"descrizione_cdd","placeholder"=>"Geologia. Europa","value"=>$libro->descrizione_cdd);
					echo form_input($attr);
				?>
			  </div>
			</div>
			
			<div class="row">
			  <div class="form-group col-xs-12 col-sm-6">
				<label for="curatore">Curatore</label> <?php echo form_error('curatore'); ?>
				<?php 
					$attr=array("class"=>"form-control","id"=>"curatore","name"=>"curatore","placeholder"=>"Lorenzo Insigne, Gonzalo Higuain","value"=>$libro->curatore);
					echo form_input($attr);
				?>
			  </div>
			  <div class="form-group col-xs-12 col-sm-6">
				<label for="traduttore">Traduttore</label> <?php echo form_error('traduttore'); ?>
				<?php 
					$attr=array("class"=>"form-control","id"=>"traduttore","name"=>"traduttore","placeholder"=>"Maurizio Sarri","value"=>$libro->traduttore);
					echo form_input($attr);
				?>
			  </div>
			</div>
			
			<div class="row">
			  <div class="form-group col-xs-12">
				<label for="note">Note</label>
				<?php 
					$attr=array("class"=>"form-control","id"=>"note","name"=>"note","placeholder"=>"Informazioni varie","value"=>$libro->note);
					echo form_textarea($attr);
				?>
			  </div>
			 </div>
			 
			 <div class="row">
			  <div class="form-group col-xs-12 text-center">
				<?php
					echo form_hidden('id', $libro->id);
					$attr=array("type"=>"button","class"=>"btn btn-warning", "id"=>"btn_undolibro", "content"=>"<i class=\"fa fa-undo\"></i> ANNULLA MODIFICHE");
					echo form_button($attr);
					$attr=array("type"=>"submit","class"=>"btn btn-success", "id"=>"btn_updatelibro", "content"=>"<i class=\"fa fa-floppy-o\"></i> SALVA MODIFICHE");
					echo form_button($attr);
					$attr=array("type"=>"button","class"=>"btn btn-danger", "id"=>"btn_deletelibro", "content"=>"<i class=\"fa fa-eraser\"></i> ELIMINA LIBRO");
					echo form_button($attr);
				?>		
			  </div>
			 </div>
			<?php echo form_close(); ?>
		</div>
		<div class="md-4">
			<p class="lead">Info prestiti</p>
			<p>Questo libro è 
			<?php if ($disp==0) : ?>
			<span class="text-success">disponibile</span> per il prestito</p>
			<a href="<?php echo site_url('prestiti/nuovo/'.$libro->id); ?>" class="btn btn-success">REGISTRA PRESTITO</a>
			<?php else : ?>
			<span class="text-danger">in prestito</span></p>pulsante "registra reso"
			<?php endif ?>
		</div>
	</div>
		
</div>