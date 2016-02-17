<div class="container">
	<?php if ($prestito) : ?>
	<a href="<?php echo site_url('libri/elenco'); ?>" class="btn btn-link pull-right">Torna all'elenco libri</a>
	<?php endif ?>
	<h1>Registra prestito</h1>
	<?php
		$attr=array("id"=>"schedaprestito");
		echo form_open("prestiti/nuovo",$attr);
	?>
	<!-- scheda prestito: setto tutti i campi readonly di default tranne inventario 
		 quando c'è il focusout al campo inventario invoco ajax che mi carica dati libro (aggiornando i campi se dati già presenti)
	-->
	<div class="row">
		<div class="form-group col-xs-12 col-sm-4 col-md-2">
			<label for="prestito">Cod. prestito</label>
			<?php 
				$attr=array("class"=>"form-control text-uppercase","id"=>"codice","name"=>"codice","value"=>$cod_prestito,"readonly"=>"true");
				echo form_input($attr);
			?>
		</div>
	</div>
	
	<div class="row">
		<div class="form-group col-xs-12 col-sm-4 col-md-2">
			<label for="inventario">Cod. inventario</label> 
			<label class="text-danger" id="error_inv" style="display:none">Inventario obbligatorio</label>
			<i id="preload_inv" class="fa fa-spin fa-spinner" style="display:none"></i>
			<?php echo form_error('id_libro'); ?>
			<?php 
				$valore=isset($prestito->inventario) ? $prestito->inventario : set_value('inventario');
				$attr=array("class"=>"form-control text-uppercase","id"=>"inventario","name"=>"inventario","value"=>$valore);
				echo form_input($attr);
			?>
		</div>
	</div>
	
	<div class="row">
		<div class="form-group col-xs-12 col-sm-6">
			<label for="autore">Autore</label>
			<?php 
			    $valore=isset($prestito->autore) ? $prestito->autore : set_value('autore');
				$attr=array("class"=>"form-control","id"=>"autore","name"=>"autore","value"=>$valore,"readonly"=>"true");
				echo form_input($attr);
			?>
		</div>
		<div class="form-group col-xs-12 col-sm-6">
			<label for="titolo">Titolo</label>
			<?php 
			    $valore=isset($prestito->titolo) ? $prestito->titolo : set_value('titolo');
				$attr=array("class"=>"form-control","id"=>"titolo","name"=>"titolo","value"=>$valore,"readonly"=>"true");
				echo form_input($attr);
			?>
		</div>
	</div>
	
	<div class="row">
		<div class="form-group col-xs-12 col-sm-6 col-md-4">
			<label for="isbn">ISBN</label>
			<?php 
				$attr=array("class"=>"form-control","id"=>"isbn","name"=>"isbn","value"=>set_value('isbn'),"readonly"=>"true");
				echo form_input($attr);
			?>
		</div>
		<div class="form-group col-xs-12 col-sm-6 col-md-4">
			<label for="cdd">CDD</label>
			<?php 
				$attr=array("class"=>"form-control","id"=>"cdd","value"=>set_value('cdd'),"readonly"=>"true");
				echo form_input($attr);
			?>
		</div>
	</div>
	
	<div class="row">
		<div class="form-group col-xs-12 col-sm-6 col-md-3">
			<label for="nome">Utente</label> <?php echo form_error('nome'); ?> <i id="preload_ute" class="fa fa-spin fa-spinner" style="display:none"></i>
			<?php 
				$attr=array(
						'type'  => 'hidden',
						'name'  => 'id_utente',
						'id'    => 'id_utente',
						'value' => set_value('id_utente')
				);
				echo form_input($attr);
				$attr=array(
						'type'  => 'hidden',
						'name'  => 'livello',
						'id'    => 'livello',
						'value' => set_value('livello')
				);
				echo form_input($attr);
				$attr=array("class"=>"form-control","id"=>"nome","name"=>"nome","value"=>set_value('nome'));
				echo form_input($attr);
			?>
		</div>
		<div class="form-group col-xs-12 col-sm-6 col-md-3">
			<label for="classe">Classe</label>
			<?php 
				$attr=array("class"=>"form-control","id"=>"classe","name"=>"classe","value"=>set_value('classe'));
				echo form_input($attr);
			?>
		</div>
		<div class="form-group col-xs-12 col-sm-6 col-md-3">
			<label for="email">Email</label> <?php echo form_error('email'); ?>
			<?php 
				$attr=array("class"=>"form-control","id"=>"email","name"=>"email","value"=>set_value('email'));
				echo form_input($attr);
			?>
		</div>
		<div class="form-group col-xs-12 col-sm-6 col-md-3">
			<label for="telefono">Telefono</label> <?php echo form_error('telefono'); ?>
			<?php 
				$attr=array("class"=>"form-control","id"=>"telefono","name"=>"telefono","value"=>set_value('telefono'));
				echo form_input($attr);
			?>
		</div>
	</div>
	
	<div class="row">
		<div class="form-group col-xs-12">
			<?php echo form_checkbox('comodato', 1, set_value('comodato')); ?> 
			<label for="comodato">Comodato</label>
		</div>
	</div>
	
	<div class="row">
		<div class="form-group col-xs-12">
			<label for="note">Note</label>
			<?php 
				$attr=array("class"=>"form-control","id"=>"note_prestito","name"=>"note_prestito","placeholder"=>"Informazioni prestito","value"=>set_value('note_prestito'));
				echo form_textarea($attr);
			?>
		</div>
	</div>
	
	<div class="row">
		<div class="form-group col-xs-12 text-center">
			<?php
				$valore=isset($prestito->id) ? $prestito->id : set_value('id_libro');
				$attr=array(
						'type'  => 'hidden',
						'name'  => 'id_libro',
						'id'    => 'id_libro',
						'value' => $valore
				);
				echo form_input($attr);
				$attr=array("type"=>"submit","class"=>"btn btn-success", "id"=>"btn_registraprestito", "content"=>"<i class=\"fa fa-pencil\"></i> REGISTRA PRESTITO");
				echo form_button($attr);
			?>
		</div>
	</div>
	
	<?php echo form_close(); ?>
</div>