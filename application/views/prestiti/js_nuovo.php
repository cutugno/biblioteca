<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="<?php echo site_url('js/jquery.validate.js'); ?>"></script>
<script src="<?php echo site_url('js/jquery.maskedinput.min.js'); ?>"></script>
<script src="<?php echo site_url('js/validation.js'); ?>"></script>

<script>
	
	validaPrestito("#schedaprestito");
	
	$(document).ready(function() {
		
		// input mask
	    $("#inventario").mask("aa9999");
		
		$("#inventario").focusin(function(){
			$(this).siblings(".text-danger").hide();
		});
		
		$("#inventario").focusout(function(){
			$("#preload_inv").show();
			var questo=$(this);
			var inventario=questo.val();
			if (inventario=="__-____") {
				$("#error_inv").show();
			}else{
				$("#error_inv").hide();
			}
			data="inventario="+inventario;
			url="<?php echo site_url('libri/ajaxFetchLibro'); ?>";
			$.post(url,data,function(msg) {	
				$("#preload_inv").hide();
				if (msg=="false") {
					questo.val("");
					swal({title:"", text:"Codice inventario inesistente", timer:1500, showConfirmButton:false, type: "error"});
				}else if (msg=="no"){
					questo.val("");
					swal({title:"", html:true, text:"Questo libro non è disponibile per il prestito (cod. inv. <strong>"+inventario+"</strong>)", timer:1500, showConfirmButton:false, type: "warning"});
				}else{
					msg=jQuery.parseJSON(msg);
					$("#autore").val(msg.autore);
					$("#titolo").val(msg.titolo);				
					$("#isbn").val(msg.isbn);
					$("#cdd").val(msg.cdd);
					$("#id_libro").val(msg.id);
				}
			});		
		});
				
		$("#nome").autocomplete({
			source: function(request, response) {
				$("#preload_ute").show();
				$.ajax({
					url: "<?php echo site_url('utenti/ajaxFetch'); ?>",
					dataType: "json",
					data: {term: request.term},
					success: function(data) {
						$("#preload_ute").hide();
						response($.map(data, function(item) {
						return {
							label: item.nome,
							id: item.id
							};
						}));
					}
				});
			},
			minLength: 3,
			select: function(event, ui) {
				$('#nome').val(ui.item.nome);
				$('#id_utente').val(ui.item.id);
				// ajax per caricare singolo utente
				data="id="+ui.item.id;
				url="<?php echo site_url('utenti/ajaxFetchSingolo'); ?>";
				$.post(url,data,function(msg) {	
					msg=jQuery.parseJSON(msg);
					$("#classe").val(msg.classe);
					$("#email").val(msg.email);
				});
			}
		});
		
		

	});
	
</script>
	

