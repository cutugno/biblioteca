<script src="<?php echo site_url('js/jquery.validate.js'); ?>"></script>
<script src="<?php echo site_url('js/jquery.maskedinput.min.js'); ?>"></script>
<script src="<?php echo site_url('js/validation.js'); ?>"></script>
<script>
		
	validaLibro("#nuovolibro"); // chiamata a funzione in validation.js
	
	$(document).ready(function() {
	
		<?php if ($this->session->insertlibro==1) :?>
		swal({title:"", text:"Libro aggiunto alla Biblioteca", timer:1500, showConfirmButton:false, type: "success"});
		<?php endif ?>
		
		<?php if ($this->session->noinsertlibro==1) :?>
		swal({title:"", text:"Errore durante il salvataggio. Riprova", timer:1500, showConfirmButton:false, type: "error"});
		<?php endif ?>
		
		<?php if ($this->session->invesiste) :?>
		swal({title:"", text:"Il codice inventario <strong><?php echo strtoupper($this->session->invesiste); ?></strong> è già presente in biblioteca.", html:true, timer:2000, showConfirmButton:false, type: "error"});
		<?php endif ?>
		
	    // input mask
	    $("#inventario").mask("aa9999");
	    $("#isbn").mask("999-99-9999-999-9");

	});
	
</script>
	

