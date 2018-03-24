<?php require 'setting.bdd.php'; ?>
<div>
  <nav class="navbar navbar-light navbar-expand-md">
    <div class="container"><a class="navbar-brand" href="accueil.php">Bts SIO</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse"
      id="navcol-1">
      <ul class="nav navbar-nav ml-auto">
        <li class="nav-item" role="presentation"><a class="nav-link active" href="accueil.php">Accueil </a></li>
        <li class="dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">Composent </a>
          <div class="dropdown-menu" role="menu">
            <a class="dropdown-item" role="presentation" href="parcCompo.php">Ordinateur</a>
            <a class="dropdown-item" role="presentation" href="parcCompo.php">Imprimant</a>
            <a class="dropdown-item" role="presentation" href="parcCompo.php">Autre</a>
          </div>
        </li>
        <li class="dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">Assistance</a>
          <div class="dropdown-menu" role="menu">
            <a class="dropdown-item" role="presentation" href="ticket.php">Tickets</a>
            <a class="dropdown-item" role="presentation" href="#">Notes</a>
          </div>
        </li>
        <li class="dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">Administrateur</a>
          <div class="dropdown-menu" role="menu">
            <a class="dropdown-item" role="presentation" href="administrateur.php">Utilisateur</a>
            <a class="dropdown-item" role="presentation" href="#">Groupe</a>
            <a class="dropdown-item" role="presentation" href="#">Profils</a>
          </div>
        </li>
        <li class="dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">Mon compte</a>
          <div class="dropdown-menu" role="menu">
            <a class="dropdown-item" role="presentation" href="#">Grade</a>
            <a class="dropdown-item" role="presentation" href="#">Notification</a>
            <a class="dropdown-item" role="presentation" href="#">Modification</a>
            <a class="dropdown-item" role="presentation" href="deconnexion.php">Deconnexion</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
</div>
