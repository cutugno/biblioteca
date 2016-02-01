<script src="<?php echo site_url('js/jquery.validate.js'); ?>"></script>
<script src="<?php echo site_url('js/jquery.maskedinput.min.js'); ?>"></script>
<script src="<?php echo site_url('js/libro_validation.js'); ?>"></script>
<script>
	
	validaLibro("#schedalibro"); // chiamata a funzione in libro_validation.js
	
	$(document).ready(function() {
	
		<?php if ($this->session->insertlibro==1) :?>
		swal({title:"", text:"Libro aggiunto alla Biblioteca", timer:2000, showConfirmButton:false, type: "success"});
		<?php endif ?>
		
		<?php if ($this->session->noinsertlibro==1) :?>
		swal({title:"", text:"Errore durante il salvataggio. Riprova", timer:2000, showConfirmButton:false, type: "error"});
		<?php endif ?>
		
		<?php if ($this->session->invesiste) :?>
		swal({title:"", text:"Il codice inventario <strong><?php echo strtoupper($this->session->invesiste); ?></strong> è già presente in biblioteca.", html:true, timer:2500, showConfirmButton:false, type: "error"});
		<?php endif ?>
		
	    // input mask
	    $("#inventario").mask("aa-9999");
	    $("#isbn").mask("999-99-9999-999-9");

		/*
		// validazione form con jquery validate
		$("#nuovolibro").validate({
			rules: {
				inventario: {
					required: true
				},
				collocazione: {
					maxlength: 100
				},
				autore: {
					required: true,
					maxlength: 100
				},
				titolo: {
					required: true,
					maxlength: 100
				},
				editore: {
					maxlength: 45
				},
				luogo: {
					maxlength: 45
				},
				anno: {
					number: true,
					rangelength: [4,4]
				},
				lingua: {
					maxlength: 45
				},
				cdd: {
					maxlength: 20
				},
				descrizione_cdd: {
					maxlength: 100
				},
				curatore: {
					maxlength: 100
				},
				traduttore: {
					maxlength: 100
				},
				
			},
			messages: {
				inventario: {
					required: "Campo obbligatorio"
				},
				collocazione: {
					maxlength: jQuery.validator.format("Massimo {0} caratteri")
				},
				autore: {
					required: "Campo obbligatorio",
					maxlength: jQuery.validator.format("Massimo {0} caratteri")
				},
				titolo: {
					required: "Campo obbligatorio",
					maxlength: jQuery.validator.format("Massimo {0} caratteri")
				},
				editore: {
					maxlength: jQuery.validator.format("Massimo {0} caratteri")
				},
				luogo: {
					maxlength: jQuery.validator.format("Massimo {0} caratteri")
				},				
				anno: {
					number: "Solo numeri",
					rangelength: jQuery.validator.format("L'anno è di {0} caratteri numerici")
				},
				lingua: {
					maxlength: jQuery.validator.format("Massimo {0} caratteri")
				},
				cdd: {
					maxlength: jQuery.validator.format("Massimo {0} caratteri")
				},
				descrizione_cdd: {
					maxlength: jQuery.validator.format("Massimo {0} caratteri")
				},
				curatore: {
					maxlength: jQuery.validator.format("Massimo {0} caratteri")
				},
				traduttore: {
					maxlength: jQuery.validator.format("Massimo {0} caratteri") 
				}
			},
			errorPlacement: function(error, element) {
			 	element.before(error);
			 	error.css("color","#a94442");
			}
		});
		*/

	});
	
</script>
	

