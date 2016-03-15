<script>
		
	$(document).ready(function() {	
		
		<?php if ($this->session->updateprofilo==1) :?>
		swal({title:"", text:"Aggiornamento effettuato", timer:2000, showConfirmButton:false, type: "success"});
		<?php endif ?>
		
		<?php if ($this->session->noupdateprofilo==1) :?>
		swal({title:"", text:"Errore durante l'aggiornamento. Riprova", timer:2000, showConfirmButton:false, type: "error"});
		<?php endif ?>
	});
		
</script>
	

