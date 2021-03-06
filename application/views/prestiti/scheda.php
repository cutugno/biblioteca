<div class="container">
	<?php if ($this->session->fromsearch) : ?>
	<a href="<?php echo site_url('search'); ?>" class="btn btn-link pull-right">Torna ai risultati</a>
	<?php else : ?>
	<a href="<?php echo site_url('prestiti/elenco'); ?>" class="btn btn-link pull-right">Torna all'elenco</a>
	<?php endif ?>
	<h1>Prestito #<?php echo $prestito->codice; ?></h1>
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
			<!--
			<div class="row">
				<div class="col-xs-12">
					<a href="<?php echo site_url('libri/scheda/'.$prestito->id_libro); ?>" class="btn btn-xs btn-primary"><i class="fa fa-book"></i> SCHEDA LIBRO</a>
				</div>
			</div>
			-->
			<div class="spacer-25"></div>
			<div class="row">
				<div class="col-xs-12">
					<p class="lead">Info utente</p> 
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-3">
					<label>Nome</label> 
					<p><?php echo $prestito->utente; ?><p>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-3">
					<label>Classe</label> 
					<p><?php echo $prestito->classe ?></p>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-3">
					<label>Email</label> 
					<p><?php echo $prestito->email ?></p>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-3">
					<label>Telefono</label> 
					<p><?php echo $prestito->telefono ?></p>
				</div>
			</div>	
			<?php if ($this->session->utente->livello >= 2) :?>
			<!--
			<div class="row">
				<div class="col-xs-12">
					<a href="<?php echo site_url('utenti/scheda/'.$prestito->id_utente); ?>" class="btn btn-xs btn-primary"><i class="fa fa-user"></i> SCHEDA UTENTE</a>
				</div>
			</div>	
			-->
			<?php endif ?>
		</div>
		<div class="col-md-3 text-right center-sm">
			<div class="row">
				<div class="col-xs-12">						
					<div class="row">
						<?php if ($prestito->data_reso=="") : ?>
						<div class="col-xs-12">
							<a id="stamparicevuta" href="<?php echo site_url('stampa/ricevuta/'.$prestito->id); ?>" class="btn btn-primary" target="_blank"><i class="fa fa-print"></i> STAMPA RICEVUTA</a>										
						</div>			
						<div class="col-xs-12 spacer-10"></div>	
						<div class="col-xs-12">
							<a id="annullaprestito" href="#" class="btn btn-warning"><i class="fa fa-times"></i> ANNULLA PRESTITO</a>										
						</div>
						<?php endif ?>
						<div class="col-xs-12 spacer-10"></div>
						<?php if ($prestito->disp==0) : ?>	
						<div class="col-xs-12">
							<a href="<?php echo site_url('prestiti/reso/'.$prestito->id); ?>" class="btn btn-success"><i class="fa fa-reply"></i> REGISTRA RESO</a>
						</div>
						<?php endif ?>	
						<?php if (null!=$prestito->email) : ?>
						<div class="col-xs-12 spacer-10"></div>
						<div class="col-xs-12">
							<a href="<?php echo site_url('utenti/contatta/'.$prestito->id_utente); ?>" class="btn btn-danger"><i class="fa fa-envelope-o"></i> CONTATTA UTENTE</a>
						</div>	
						<?php endif ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>