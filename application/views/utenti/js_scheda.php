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
	
	$(document).ready(function() {	
		setFormValues("#schedautente");	
		
		<?php if ($this->session->updateutente==1) :?>
		swal({title:"", text:"Aggiornamento effettuato", timer:2000, showConfirmButton:false, type: "success"});
		<?php endif ?>
		
		<?php if ($this->session->noupdateutente==1) :?>
		swal({title:"", text:"Errore durante l'aggiornamento. Riprova", timer:2000, showConfirmButton:false, type: "error"});
		<?php endif ?>
	});
	
	$("#btn_undoutente").click(function(){
		resetForm("#schedautente");		
	});
	
	$("#btn_deleteutente").click(function(){
		var idutente=$("input[name='id']").val();
		swal({ 
			title: "", 
			text: "Vuoi davvero eliminare questo utente?", 
			html: true,
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			cancelButtonText: "Annulla", 
			confirmButtonText: "Elimina"
		},function(isConfirm){ 
			if (isConfirm){ 
				window.location.href = "<?php echo site_url('utenti/delete'); ?>/"+idutente;
			}
		});
	});
		
</script>
	

