

<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1>LOGIN</h1>
		</div>
	</div>
	<div class="row">
	<?php
		$attr=array("id"=>"formlogin","class"=>"form-horizontal");
		echo form_open('login',$attr);
	?>
	  <div class="form-group">
		<label for="username" class="col-sm-1 control-label">Username</label>
		<div class="col-sm-5">
		  <?php
			$attr=array("class"=>"form-control", "name"=>"username", "id"=>"username", "placeholder"=>"Username", "value"=>set_value('username'));
			echo form_input($attr);
			echo form_error('username');
		  ?> 
		  
		</div>
	  </div>
	  <div class="form-group">
		<label for="password" class="col-sm-1 control-label">Password</label>
		<div class="col-sm-5">
		   <?php
			$attr=array("class"=>"form-control", "name"=>"password", "id"=>"password", "placeholder"=>"Password", "value"=>set_value('password'));
			echo form_password($attr);
			echo form_error('password');
		  ?> 
		</div>
	  </div>
	  <div class="form-group">
		<div class="col-sm-offset-1 col-sm-5">
		  <div class="checkbox">
			<label>
			  <?php echo form_checkbox('ricordami', 1, TRUE); ?> Ricordami
			</label>
		  </div>
		</div>
	  </div>
	  <div class="form-group">
		<div class="col-sm-offset-1 col-sm-5">
		  <?php
				$attr=array("type"=>"submit", "class"=>"btn btn-primary", "content"=>"ENTRA");
				echo form_button($attr);
		  ?>
		</div>
	  </div>
	</form>
	</div>
</div>
