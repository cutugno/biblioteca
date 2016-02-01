<div class="container">
	<div class="jumbotron">
		<div class="row">
			<div class="col-xs-12">
				<p>Cerca libro</p>
			</div>
			<div class="col-xs-12">
				<?php 
					$attr=array("class"=>"form-inline", "id"=>"searchlibro");
					echo form_open("search",$attr);
				?>
				  <div class="form-group col-xs-10">
					<?php
						$attr=array("class"=>"form-control input-lg", "id"=>"keyword", "name"=>"keyword", "placeholder"=>"Inserisci qui autore, titolo, traduttore, curatore...", "style"=>"width:100%");
						echo form_input($attr);
					?>
				  </div>
				  <div class="col-xs-2">
					<?php
						$attr=array("type"=>"submit","class"=>"btn btn-primary btn-lg", "id"=>"btn_searchlibro", "content"=>"CERCA");
						echo form_button($attr);
					?>
				  </div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>