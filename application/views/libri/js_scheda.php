<script src="<?php echo site_url('js/jquery.validate.js'); ?>"></script>
<script src="<?php echo site_url('js/jquery.maskedinput.min.js'); ?>"></script>
<script src="<?php echo site_url('js/validation.js'); ?>"></script>
<script>
	
	function resetForm(form) {
		$(form).find(':input').each(function(i, elem) {
			 var input = $(elem);
			 input.val(input.data('initialState'));
		});
	}
	
	function setFormValues(form) {
		$(form).find(':input').each(function(i, elem) {
			 var input = $(elem);
			 input.data('initialState', input.val());
		});
	}
	
	validaLibro("#schedalibro"); // chiamata a funzione in validation.js
	
	$(document).ready(function() {	
		<?php if ($this->session->updatelibro==1) :?>
		swal({title:"", text:"Aggiornamento effettuato", timer:2000, showConfirmButton:false, type: "success"});
		<?php endif ?>
		
		<?php if ($this->session->noupdatelibro==1) :?>
		swal({title:"", text:"Errore durante l'aggiornamento. Riprova", timer:2000, showConfirmButton:false, type: "error"});
		<?php endif ?>
		
		<?php if ($this->session->registratoreso==1) :?>
		swal({title:"", text:"Reso registrato", timer:1500, showConfirmButton:false, type: "success"});
		<?php endif ?>
		
		<?php if ($this->session->noregistratoreso==1) :?>
		swal({title:"", text:"Errore durante l'inserimento del reso. Riprova", timer:2000, showConfirmButton:false, type: "error"});
		<?php endif ?>
		
		// input mask
	    $("#isbn").mask("999-99-9999-999-9");
	    	
	    setFormValues("#schedalibro"); // accoppiata a reset form
	});
	
	$("#btn_undolibro").click(function(){
		resetForm("#schedalibro");		
	});
	
	$("#btn_deletelibro").click(function(){
		var idlibro=$("input[name='id']").val();
		swal({ 
			title: "", 
			text: "Vuoi davvero eliminare questo libro?", 
			html: true,
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			cancelButtonText: "Annulla", 
			confirmButtonText: "Elimina"
		},function(isConfirm){ 
			if (isConfirm){ 
				window.location.href = "<?php echo site_url('libri/delete'); ?>/"+idlibro;
			}
		});
	});
		
</script>
	

