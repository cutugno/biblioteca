<script src="<?php echo site_url('js/dropzone.js'); ?>"></script>

<script>
	
	<?php if ($this->session->import==1) :?>
	swal({title:"", text:"<?php echo $this->session->echoimport; ?>", timer:2500, showConfirmButton:false, type: "success"});
	<?php endif ?>
		
	<?php if ($this->session->noimport==1) :?>
	swal({title:"", text:"<?php echo $this->session->echoimport; ?>", timer:2500, showConfirmButton:false, type: "error"});
	<?php endif ?>
	
	// file csv
	var myDropzone = new Dropzone("#loadfile", { 
		url: "<?php echo site_url('import/loadCSV'); ?>", // funzione che carica file
		maxFiles: 1,
		maxFilesize: 1, // MB
		acceptedFiles: ".csv",
		dictFileTooBig: "Dimensioni file: {{filesize}}MB. Dimensioni massime: {{maxFilesize}}MB",
		dictInvalidFileType: "Solo file .csv",
		dictMaxFilesExceeded: "Max un file!",
		thumbnailWidth: 300,
		thumbnailHeight: null,
		previewsContainer: "#csv-preview",
		previewTemplate: document.getElementById('preview-template').innerHTML
	});

	myDropzone.on("success", function(file,msg) {
		$("#loadfile").hide();
		$("#csvname").val(file.name);
		console.log(msg);
		swal({title:"", text:"File caricato correttamente", timer:1500, showConfirmButton:false, type: "success"});
	});
	
	myDropzone.on("error", function(file,msg) {
		swal({title:"", text:msg, timer:5000, showConfirmButton:false, type: "error"});
		setTimeout(function() { 
			myDropzone.removeFile(file);
		}, 5050);		
	});
	
	myDropzone.on("removedfile", function(file) {
		dati="csvfile="+file.name;
		url="<?php echo site_url('import/unlinkCSV'); ?>"; // funzione che elimina il file
		$.post(url,dati,function(msg) { 
			$("#loadfile").show();
			console.log(msg);
			swal({title:"", text:"File rimosso", timer:1500, showConfirmButton:false, type: "success"});
		});
	});
	
</script>
	

