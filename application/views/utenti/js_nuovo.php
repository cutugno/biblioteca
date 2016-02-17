<script src="<?php echo site_url('js/jquery.validate.js'); ?>"></script>
<script src="<?php echo site_url('js/validation.js'); ?>"></script>
<script>
		
	validaUtente("#nuovoutente"); // chiamata a funzione in validation.js
	
	$(document).ready(function() {
	
		<?php if ($this->session->insertutente==1) :?>
		swal({title:"", text:"Utente aggiunto", timer:1500, showConfirmButton:false, type: "success"});
		<?php endif ?>
		
		<?php if ($this->session->noinsertutente==1) :?>
		swal({title:"", text:"Errore durante il salvataggio. Riprova", timer:1500, showConfirmButton:false, type: "error"});
		<?php endif ?>
		
		<?php if ($this->session->utenteesiste) :?>
		swal({title:"", text:"L'username <strong><?php echo $this->session->utenteesiste; ?></strong> è già in uso.", html:true, timer:2000, showConfirmButton:false, type: "error"});
		<?php endif ?>

	});
	
</script>
	

