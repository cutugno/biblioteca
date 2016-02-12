<script>
	
	<?php if ($this->session->insertprestito==1) :?>
	swal({title:"", text:"Prestito inserito", timer:1500, showConfirmButton:false, type: "success"});
	<?php endif ?>
	
	<?php if ($this->session->noinsertprestito==1) :?>
	swal({title:"", text:"Errore durante l'inserimento del prestito. Riprova", timer:1500, showConfirmButton:false, type: "error"});
	<?php endif ?>
	
	<?php if ($this->session->registratoreso==1) :?>
	swal({title:"", text:"Reso registrato", timer:1500, showConfirmButton:false, type: "success"});
	<?php endif ?>
	
	<?php if ($this->session->noregistratoreso==1) :?>
	swal({title:"", text:"Errore durante l'inserimento del reso. Riprova", timer:2000, showConfirmButton:false, type: "error"});
	<?php endif ?>		
	
</script>
	

