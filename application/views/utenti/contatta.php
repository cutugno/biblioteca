<div class="container">
	<a href="<?php echo site_url($torna_url); ?>" class="btn btn-link pull-right"><?php echo $torna_txt; ?></a>
	<h1>Contatta <?php echo $infoutente->nome; ?></h1>
	<div class="row">
		<div class="col-md-9">
			<?php
				$attr=array("id"=>"contattautente");
				echo form_open("utenti/contatta/".$infoutente->id);
				echo form_hidden('id', $infoutente->id);
			?>
			<div class="row">
				<div class="form-group col-xs-12 col-sm-6 col-md-4">
					<label for="email">Email</label> <?php echo form_error('email'); ?>
					<?php 
						$attr=array("class"=>"form-control", "id"=>"email", "name"=>"email", "value"=>$infoutente->email, "readonly"=>"true");
						echo form_input($attr);
					?>
			    </div>	
			    <div class="form-group col-xs-12">
					<label for="messaggio">Messaggio</label> <?php echo form_error('messaggio'); ?>
					<?php
						$attr=array("id"=>"messaggio", "name"=>"messaggio", "class"=>"form-control summernote", "rows"=>15);											
						echo form_textarea($attr);						
					?>
			    </div>	
			    <div class="form-group col-xs-12">
					<button type="submit" id="inviamessaggio" class="btn btn-primary"><i class="fa fa-paper-plane"></i> INVIA MESSAGGIO</a>										
			    </div>
			</div>
			
		</div>
	</div>		
</div>