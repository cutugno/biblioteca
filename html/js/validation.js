// validazione form con jquery validate

function validaLibro (form){
	$(form).validate({
		rules: {
			id_localizzazione: {
				required: true
			},
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
			id_localizzazione: {
				required: "Localizzazione obbligatoria"
			},
			inventario: {
				required: "Inventario obbligatorio"
			},
			collocazione: {
				maxlength: jQuery.validator.format("Massimo {0} caratteri")
			},
			autore: {
				required: "Autore obbligatorio",
				maxlength: jQuery.validator.format("Massimo {0} caratteri")
			},
			titolo: {
				required: "Titolo obbligatorio",
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

jQuery.validator.addMethod("alphanumeric", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9]+$/.test(value);
}); 

function validaPrestito (form){
	$(form).validate({
		rules: {
			inventario: {
				required: true,			
			},
			nome: {
				required: true
			},
			email: {
				email: true
			},
			telefono: {
				number: true,
				minlength: 6,
				maxlength: 11
			}
		},
		messages: {
			inventario: {
				required: "Inventario obbligatorio"
			},
			nome: {
				required: "Nome obbligatorio"
			},
			email: {
				email: "Formato email non valido"
			},
			telefono: {
				number: "Solo numeri",
				minlength: "Min 6 caratteri",
				maxlength: "Max 6 caratteri"
			}
		},
		errorPlacement: function(error, element) {
			element.before(error);
			error.css("color","#a94442");
		}
	});
}

function validaUtente (form){
	$(form).validate({
		rules: {
			username: {
				required: true,
				alphanumeric: true,
				minlength: 6,
				maxlength: 12
			},
			nome: {
				required: true
			},
			email: {
				email: true
			},
			telefono: {
				number: true,
				minlegth: 6,
				maxlength: 11
			}
		},
		messages: {
			username: {
				required: "Username obbligatorio",
				alphanumeric: "Solo caratteri alfanumerici",
				minlength: "Min 6 caratteri",
				maxlength: "Max 12 caratteri"
			},
			nome: {
				required: "Nome obbligatorio"
			},
			email: {
				email: "Formato email non valido"
			},
			telefono: {
				number: "Solo numeri",
				minlength: "Min 6 caratteri",
				maxlength: "Max 6 caratteri"
			}
		},
		errorPlacement: function(error, element) {
			element.before(error);
			error.css("color","#a94442");
		}
	});
}
