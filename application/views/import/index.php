

<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1>IMPORTAZIONE LIBRI</h1>
			<p class="lead">Da questa pagina è possibile importare in blocco nuovi libri direttamente da un file con estensione <em>.csv</em> elaborato con Excel o software simile.<br>
				E' possibile <u>aggiungere</u> i libri importati al database o <u>svuotare</u> il database e <strong>sostituire i libri presenti in precedenza</strong> con quelli contenuti nel file.<br>
				ATTENZIONE! Quest'ultima opzione provocherà <strong>l'eliminazione di tutti i prestiti</strong> presenti, quindi va considerata come procedura di <em>"reset"</em> del database.
			</p>
		</div>
	</div>
	<hr>
	<div class="spacer-25"></div>
	<div class="row well">
		<?php
			$attr=array('id'=>'formimport', 'class'=>'form-horizontal');
			echo form_open_multipart('import', $attr);
		?>	
		<div class="form-group col-xs-12">
		    <label for="csvfile" class="col-sm-3 control-label">File .csv</label> 		    
		    <div class="col-sm-9">
				<button type="button" class="btn btn-info btn-xs" id="loadfile"><i class="fa fa-upload"></i> CARICA NUOVO FILE</button>
				<?php echo form_error('csvname'); ?>
				<div id="csv-preview"></div>			 
				<!-- preview container -->
				<div id="preview-template" style="display: none;">
					<div class="dz-preview dz-file-preview">
					  <div class="dz-details">						
						<div class="dz-filename"><i class="fa fa-file-text-o fa-3x"></i> <span data-dz-name></span> (<span data-dz-size></span>)</div>
						<div class="spacer-10"></div>
						<div><button type="button" class="btn btn-danger btn-xs" data-dz-remove><i class="fa fa-remove"></i> RIMUOVI FILE</button></div>
					  </div>					  
					</div>
				</div><!-- // oreview container -->
				<?php
					$attr=array(
							'type'	=> 'hidden',
							'name'  => 'csvname',
							'id'    => 'csvname'
					);
					echo form_input($attr);
				?>
			</div>
		</div>
		<div class="form-group col-xs-12">
			<label for="metodo" class="col-sm-3 control-label">Seleziona un metodo di importazione:</label>
			<div class="col-sm-6 col-md-4">
				<?php
					$attr="class=form-control";
					$options = array(
							'append'      => 'Aggiungi record al database',
							'truncate'    => 'Svuota database'
					);
					echo form_dropdown('metodo', $options, 'append', $attr);				
				?>				
			</div>
			<div class="col-sm-3"><?php echo form_error('metodo'); ?></div>
		</div>
		<div class="form-group col-xs-12">
			<div class="col-sm-offset-3 col-sm-9">
				<?php
					$attr=array(
							'name'          => 'btn_import',
							'id'            => 'btn_import',
							'type'          => 'submit',
							'class'  		=> 'btn btn-primary',
							'content'       => 'AVVIA IMPORTAZIONE'
					);
					echo form_button($attr);
				?>
			</div>
		</div>
		<?php echo form_close(); ?>		
	</div>
</div>
