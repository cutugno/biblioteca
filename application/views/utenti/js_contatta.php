<script>	

		
	$(document).ready(function() {	
		
		<?php if ($this->session->okemail==1) :?>
		swal({title:"", text:"Email inviata", timer:2000, showConfirmButton:false, type: "success"});
		<?php endif ?>
		
		<?php if ($this->session->noemail==1) :?>
		swal({title:"", text:"Problemi durante l'invio della mail. Riprova", timer:2000, showConfirmButton:false, type: "error"});
		<?php endif ?>
		
		// text editor	
	    $('.summernote').summernote({
	  	  height:200,
	  	  toolbar: [
			['style', ['bold', 'italic', 'underline', 'clear']],
			['para', ['ul', 'ol', 'paragraph']],
			['codeview', ['codeview']],
		  ]
	    });
		
	});
	
</script>
	

