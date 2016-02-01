
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Biblioteca</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		
	  <?php if ($utente->livello >1) : ?>
	  <!-- menu admin -->	
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gestione libri<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('libri/nuovo'); ?>">Nuovo Libro</a></li>
            <li><a href="<?php echo site_url('libri/elenco'); ?>">Elenco libri</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gestione utenti<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Nuovo utente</a></li>
            <li><a href="#">Elenco utenti</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gestione prestiti<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Registra prestito</a></li>
            <li><a href="#">Registra reso</a></li>
            <li><a href="#">Elenco prestiti</a></li>
          </ul>
        </li>
      </ul>
      <!-- fine menu admin -->
      <?php endif ?>
      
      <!-- menu utente -->
      <ul class="nav navbar-nav navbar-right">
        <li><a class="btn btn-link disabled">Benvenuto <?php echo $utente->username." (".$utente->descrizione.")"; ?></a></li>
        <li><a href="<?php echo site_url("logout"); ?>">Logout</a></li>
      </ul>
      <!-- fine menu utente -->
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>