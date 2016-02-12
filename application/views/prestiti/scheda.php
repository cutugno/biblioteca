<div class="container">
	<a href="<?php echo site_url('prestiti/elenco'); ?>" class="btn btn-link pull-right">Torna all'elenco</a>
	<h1>Prestito #<?php echo $prestito->codice; ?></h1>
	<div class="spacer-10"></div>
	<div class="row">
		<div class="col-md-9">
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
			<div class="spacer-25"></div>
			<div class="row">
				<div class="col-xs-12">
					<p class="lead">Info libro</p>
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
			<div class="spacer-25"></div>
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
		<div class="col-md-3">
			<div class="row">
				<div class="col-xs-12">
					<?php if ($prestito->disp==0) : ?>		
					<!-- <p>pulsante stampa ricevuta</p> -->				
					<!-- <p>pulsante annulla prestito</p> -->				
						<a href="<?php echo site_url('prestiti/reso/'.$prestito->id); ?>" class="btn btn-success"><i class="fa fa-reply"></i> REGISTRA RESO</a>
					<?php endif ?>					
				</div>
			</div>
		</div>
	</div>
</div>