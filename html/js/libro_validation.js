// validazione form con jquery validate

function validaLibro (form){
	$(form).validate({
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
}
