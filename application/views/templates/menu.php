
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
		
	  <?php if ($utente->livello >=1) : ?>
	  <!-- menu admin -->	
      <ul class="nav navbar-nav">
		<li><a href="<?php echo site_url('homepage'); ?>">Ricerca</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gestione libri<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('libri/nuovo'); ?>">Nuovo Libro</a></li>
            <li><a href="<?php echo site_url('libri/elenco'); ?>">Elenco libri</a></li>
          </ul>
        </li>
        <?php if ($utente->livello >=2) : ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gestione utenti<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Nuovo utente</a></li>
            <li><a href="#">Elenco utenti</a></li>
          </ul>
        </li>
        <?php endif ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gestione prestiti<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('prestiti/nuovo'); ?>">Registra prestito</a></li>
            <!-- <li><a href="<?php echo site_url('prestiti/reso'); ?>">Registra reso</a></li> -->
            <li><a href="<?php echo site_url('prestiti/elenco'); ?>">Elenco prestiti</a></li>
          </ul>
        </li>
      </ul>
      <!-- fine menu admin -->
      <?php else : ?>
      <!-- menu utente -->
	  <ul class="nav navbar-nav">	
		<li><a href="<?php echo site_url('homepage'); ?>">Ricerca</a></li>
		<li><a href="<?php echo site_url('libri/elenco'); ?>">Elenco libri</a></li>
	  </ul> 
      <!-- fine menu utente -->
      <?php endif ?>
      
      <?php if ($utente->livello > 0) : ?>
      <!-- menu info -->
      <ul class="nav navbar-nav navbar-right">
        <li><a class="btn btn-link disabled">Benvenuto <?php echo $utente->username." (".$utente->descrizione.")"; ?></a></li>
        <li><a href="<?php echo site_url("logout"); ?>">Logout</a></li>
      </ul>
      <!-- fine menu info -->
      <?php endif ?>
      
      <?php if (($utente->livello==0) && ($this->uri->segment(1)!="login")) : ?>
       <!-- menu login -->
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo site_url("login"); ?>">Login</a></li>
      </ul>
      <!-- fine menu login -->
      <?php endif ?>
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>