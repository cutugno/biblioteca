

<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-4">
			<label>Data prestito</label> 
			<p><?php echo $prestito->data_prestito; ?><p>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-4">
			<label>Data reso</label> 
			<p><?php echo $prestito->data_reso; ?></p>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-4">
			<label>Comodato</label> 
			<p><?php echo $prestito->comodato ? "SI" : "NO"; ?></p>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<p class="lead" style="display:inline">Info libro</p>					
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-4">
			<label>Inventario</label> 
			<p><?php echo $prestito->inventario; ?><p>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-4">
			<label>ISBN</label> 
			<p><?php echo $prestito->isbn ?></p>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-6">
			<label>Autore</label> 
			<p><?php echo $prestito->autore; ?></p>
		</div>
		<div class="col-xs-12 col-sm-6">
			<label>Titolo</label> 
			<p><?php echo $prestito->titolo; ?></p>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<p class="lead">Info utente</p>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-4">
			<label>Nome</label> 
			<p><?php echo $prestito->utente; ?><p>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-4">
			<label>Classe</label> 
			<p><?php echo $prestito->classe ?></p>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-4">
			<label>Email</label> 
			<p><?php echo $prestito->email ?></p>
		</div>
	</div>	
</div>
