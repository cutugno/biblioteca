<div class="container">
	<h1>Nuovo libro</h1>
	<?php
		$attr=array("id"=>"nuovolibro");
		echo form_open("libri/nuovo",$attr);
	?>
	<div class="row">
	  <div class="form-group col-xs-12 col-sm-6 col-md-4">
		<label for="id_localizzazione">Localizzazione</label> <i id="preload_loc" class="fa fa-spin fa-spinner" style="display:none"></i><?php echo form_error('id_localizzazione'); ?>
		<?php
			$options=array(""=>"Seleziona:");
			$attr="class=form-control id=id_localizzazione";
			foreach ($select_local as $val) {
				$options[$val['id']]=$val['nome'];
			}
			echo form_dropdown('id_localizzazione', $options, '', $attr);
		?>
	  </div>	
	  <div class="form-group col-xs-12 col-sm-6 col-md-4">
		<label for="inventario">Cod. inventario</label> <?php echo form_error('inventario'); ?>
		<?php 
			$attr=array("class"=>"form-control text-uppercase","id"=>"inventario","name"=>"inventario","placeholder"=>"PT0001","value"=>set_value('inventario'));
			echo form_input($attr);
		?>
	  </div>	  
	  <div class="form-group col-xs-12 col-sm-6 col-md-4">
		<label for="collocazione">Collocazione</label> <?php echo form_error('collocazione'); ?>
		<?php 
			$attr=array("class"=>"form-control","id"=>"collocazione","name"=>"collocazione","placeholder"=>"Armadio 3","value"=>set_value('collocazione'));
			echo form_input($attr);
		?>
	  </div>
	</div>
	
	<div class="row">
	  <div class="form-group col-xs-12 col-sm-6">
		  <label for="autore">Autore</label> <?php echo form_error('autore'); ?>
		  <?php 
			 $attr=array("class"=>"form-control","id"=>"autore","name"=>"autore","placeholder"=>"Robert Jordan, Brandon Sanderson","value"=>set_value('autore'));
			 echo form_input($attr);
		  ?>
	  </div>
	  <div class="form-group col-xs-12 col-sm-6">
		  <label for="autore">Titolo</label> <?php echo form_error('titolo'); ?>
		  <?php 
			 $attr=array("class"=>"form-control","id"=>"titolo","name"=>"titolo","placeholder"=>"La ruota del tempo","value"=>set_value('titolo'));
			 echo form_input($attr);
		  ?>
	  </div>
	</div>
	
	<div class="row">
	  <div class="form-group col-xs-12 col-sm-6 col-md-4">
		<label for="editore">Editore</label> <?php echo form_error('editore'); ?>
		<?php 
			$attr=array("class"=>"form-control","id"=>"editore","name"=>"editore","placeholder"=>"Arnoldo Mondadori Editore","value"=>set_value('editore'));
			echo form_input($attr);
		?>
	  </div>
	  <div class="form-group col-xs-12 col-sm-6 col-md-4">
		<label for="luogo">Luogo</label> <?php echo form_error('luogo'); ?>
		<?php 
			$attr=array("class"=>"form-control","id"=>"luogo","name"=>"luogo","placeholder"=>"Milano","value"=>set_value('luogo'));
			echo form_input($attr);
		?>
	  </div>
	  <div class="form-group col-xs-12 col-sm-6 col-md-4">
		<label for="anno">Anno</label> <?php echo form_error('anno'); ?>
		<?php 
			$attr=array("class"=>"form-control","id"=>"anno","name"=>"anno","placeholder"=>"1991","value"=>set_value('anno'));
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
			echo form_dropdown('id_tipodoc', $options, '', $attr);
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
			echo form_dropdown('id_genere', $options, '', $attr);
		?>
	  </div>
	  <div class="form-group col-xs-12 col-sm-6 col-md-4">
		<label for="lingua">Lingua</label> <?php echo form_error('lingua'); ?>
		<?php 
			$attr=array("class"=>"form-control","id"=>"lingua","name"=>"lingua","placeholder"=>"Italiano","value"=>set_value('lingua'));
			echo form_input($attr);
		?>
	  </div>
	</div>
	
	<div class="row">
	  <div class="form-group col-xs-12 col-sm-6 col-md-4">
		<label for="isbn">ISBN</label>
		<?php 
			$attr=array("class"=>"form-control","id"=>"isbn","name"=>"isbn","placeholder"=>"978-88-7075-703-3","value"=>set_value('isbn'));
			echo form_input($attr);
		?>
	  </div>
	  <div class="form-group col-xs-12 col-sm-6 col-md-4">
		<label for="cdd">CDD</label> <?php echo form_error('cdd'); ?>
		<?php 
			$attr=array("class"=>"form-control","id"=>"cdd","name"=>"cdd","placeholder"=>"554","value"=>set_value('cdd'));
			echo form_input($attr);
		?>
	  </div>
	  <div class="form-group col-xs-12 col-sm-6 col-md-4">
		<label for="descrizione_cdd">Descrizione CDD</label> <?php echo form_error('descrizione_cdd'); ?>
		<?php 
			$attr=array("class"=>"form-control","id"=>"descrizione_cdd","name"=>"descrizione_cdd","placeholder"=>"Geologia. Europa","value"=>set_value('descrizione_cdd'));
			echo form_input($attr);
		?>
	  </div>
	</div>
	
	<div class="row">
	  <div class="form-group col-xs-12 col-sm-6">
		<label for="curatore">Curatore</label> <?php echo form_error('curatore'); ?>
		<?php 
			$attr=array("class"=>"form-control","id"=>"curatore","name"=>"curatore","placeholder"=>"Lorenzo Insigne, Gonzalo Higuain","value"=>set_value('curatore'));
			echo form_input($attr);
		?>
	  </div>
	  <div class="form-group col-xs-12 col-sm-6">
		<label for="traduttore">Traduttore</label> <?php echo form_error('traduttore'); ?>
		<?php 
			$attr=array("class"=>"form-control","id"=>"traduttore","name"=>"traduttore","placeholder"=>"Maurizio Sarri","value"=>set_value('traduttore'));
			echo form_input($attr);
		?>
	  </div>
	</div>
	
	<div class="row">
	  <div class="form-group col-xs-12">
		<label for="note">Note</label>
		<?php 
			$attr=array("class"=>"form-control","id"=>"note","name"=>"note","placeholder"=>"Informazioni varie","value"=>set_value('note'));
			echo form_textarea($attr);
		?>
	  </div>
	 </div>
	 
	 <div class="row">
	  <div class="form-group col-xs-12 text-center">
		<?php
			$attr=array("type"=>"submit","class"=>"btn btn-primary", "id"=>"btn_insertlibro", "content"=>"SALVA");
			echo form_button($attr);
		?>
	  </div>
	 </div>
	<?php echo form_close(); ?>
</div>