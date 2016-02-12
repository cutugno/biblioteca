<div class="container">
	<a href="<?php echo site_url('homepage'); ?>" class="btn btn-link pull-right">Nuova ricerca</a>
	<?php if (!empty($risultati)) : ?> 
	<h1>Prestito #<?php echo $risultati->codice; ?></h1>
	<div class="spacer-10"></div>
	<div class="row">
		<div class="col-md-9">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-4">
					<label>Data prestito</label> 
					<p><?php echo $risultati->data_prestito; ?><p>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-4">
					<label>Data reso</label> 
					<p><?php echo $risultati->data_reso; ?></p>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-4">
					<label>Comodato</label> 
					<p><?php echo $risultati->comodato ? "SI" : "NO"; ?></p>
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
					<p><?php echo $risultati->inventario; ?><p>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-4">
					<label>ISBN</label> 
					<p><?php echo $risultati->isbn ?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-6">
					<label>Autore</label> 
					<p><?php echo $risultati->autore; ?></p>
				</div>
				<div class="col-xs-12 col-sm-6">
					<label>Titolo</label> 
					<p><?php echo $risultati->titolo; ?></p>
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
					<p><?php echo $risultati->utente; ?><p>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-4">
					<label>Classe</label> 
					<p><?php echo $risultati->classe ?></p>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-4">
					<label>Email</label> 
					<p><?php echo $risultati->email ?></p>
				</div>
			</div>		
		</div>
		<div class="col-md-3">
			<div class="row">
				<div class="col-xs-12">
					<?php if ($risultati->disp==0) : ?>		
					<!-- <p>pulsante stampa ricevuta</p> -->				
					<!-- <p>pulsante annulla prestito</p> -->				
						<a href="<?php echo site_url('prestiti/reso/'.$risultati->id); ?>" class="btn btn-success"><i class="fa fa-reply"></i> REGISTRA RESO</a>
					<?php endif ?>					
				</div>
			</div>
		</div>
	</div>
	<?php else : ?>
	<h1>Risultati ricerca</h1>
	<div class="row">
		<div class="col-xs-12">Nessun risultato</div>
	</div>
	<?php endif ?>
</div>