<script>
	
	<?php if ($this->session->nologin==1) :?>
		swal({title:"", text:"Login errato", timer:1500, showConfirmButton:false, type: "error"});
	<?php endif ?>
	
</script>
	

