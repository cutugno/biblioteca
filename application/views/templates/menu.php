
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <span class="navbar-brand">Biblioteca</span>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">	
      <!-- menu funzioni -->			
      <ul class="nav navbar-nav">
		<li><a href="<?php echo base_url(); ?>">Ricerca</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gestione libri<span class="caret"></span></a>
          <ul class="dropdown-menu">
			<?php if ($utente->livello>=2) : ?>
            <li><a href="<?php echo site_url('libri/nuovo'); ?>">Nuovo Libro</a></li>
            <?php endif ?>
            <li><a href="<?php echo site_url('libri/elenco'); ?>">Elenco libri</a></li>
          </ul>
        </li>
        <?php if ($utente->livello >= 1) : ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gestione prestiti<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('prestiti/nuovo'); ?>">Registra prestito</a></li>
            <li><a href="<?php echo site_url('prestiti/elenco'); ?>">Elenco prestiti</a></li>
          </ul>
        </li>
        <?php endif ?>
        <?php if ($utente->livello >= 2) : ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gestione utenti<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php if ($utente->livello >= 3) : ?>
            <li><a href="<?php echo site_url('utenti/nuovo'); ?>">Nuovo utente</a></li>
			<?php endif ?>
            <li><a href="<?php echo site_url('utenti/elenco'); ?>">Elenco utenti</a></li>
          </ul>
        </li>
        <?php endif  ?>
        <?php if ($utente->livello >= 3) : ?>
		 <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Strumenti<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('import'); ?>">Importazione libri</a></li>            
          </ul>
        </li>
		<?php endif ?>
      </ul>
      <!-- /menu funzioni -->
          
      <?php if (($utente->livello >= 0) && (isset($utente->nome))) : ?>
      <!-- menu info -->
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> <?php echo $utente->username." (".$utente->descrizione.")"; ?></a>
			<ul class="dropdown-menu">
				<li><a href="<?php echo site_url('profilo'); ?>">Profilo</a></li>
				<li><a href="<?php echo site_url('modifica-password'); ?>">Modifica Password</a></li>
				<li role="separator" class="divider"></li>
				<li><a href="<?php echo site_url("logout"); ?>">Logout</a></li>
            </ul>
		</li>       
      </ul>
      <!-- /menu info -->
      <?php endif ?>
      
      <?php if ((!isset($utente->nome)) && ($this->uri->segment(1)!="login")) : ?>
       <!-- menu login -->
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo site_url("login"); ?>">Login</a></li>
      </ul>
      <!-- /menu login -->
      <?php endif ?>
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
