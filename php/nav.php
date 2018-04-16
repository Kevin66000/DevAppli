<?php
require 'include.php';
?>
<div>
  <nav class="navbar navbar-light navbar-expand-md">
    <div class="container">
      <a class="navbar-brand" href="/accueil.php">Bts SIO</a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="navcol-1">
        <ul class="nav navbar-nav ml-auto">
          <li class="nav-item" role="presentation"><a class="nav-link active" href="/accueil.php">Accueil</a></li>
          <li class="nav-item" role="presentation"><a class="nav-link" href="/parc.php">Parc</a></li>
          <li class="dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">Composant</a>
            <div class="dropdown-menu" role="menu">
              <a class="dropdown-item" role="presentation" href="/composant.php">Ordinateur</a>
              <a class="dropdown-item" role="presentation" href="/composant.php">Imprimant</a>
              <a class="dropdown-item" role="presentation" href="/composant.php">Autre</a>
            </div>
          </li>
          <li class="dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">Assistance</a>
            <div class="dropdown-menu" role="menu">
              <a class="dropdown-item" role="presentation" href="/ticket.php">Tickets</a>
              <a class="dropdown-item" role="presentation" href="/note.php">Notes</a>
            </div>
          </li>
          <li class="dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">Administration</a>
            <div class="dropdown-menu" role="menu">
              <a class="dropdown-item" role="presentation" href="/utilisateur.php">Utilisateur</a>
              <a class="dropdown-item" role="presentation" href="/role.php">Role</a>
            </div>
          </li>
          <li class="dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">Mon compte</a>
            <div class="dropdown-menu" role="menu">
              <a class="dropdown-item" role="presentation" href="/profil.php">Profils</a>
              <a class="dropdown-item" role="presentation" href="/php/deconnexion.php">Deconnexion</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</div>
