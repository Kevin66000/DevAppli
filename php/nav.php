<?php
require 'include.php';

//test si l'utilisateur est connecter
if (isset($_SESSION['idUser'])) {
  //recupére l'utilisateur
  $unutilisateur = getUser($_SESSION['idUser'], $bdd);//appelle la fonction qui crée l'objet utilisateur
}
?>
<div>
  <nav class="navbar navbar-light navbar-expand-md">
    <div class="container">
      <a class="navbar-brand" href="/accueil.php">Bts SIO</a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="navcol-1">
        <ul class="nav navbar-nav ml-auto">
          <li class="nav-item" role="presentation"><a class="nav-link active" href="/accueil.php">Accueil</a></li>
          <?php
          //test si l'utilisateur a la permition
          if ($unutilisateur->GetRole()->GetPermission()['voirparc'] || $unutilisateur->GetRole()->GetPermission()['modifierparc']) {
            ?>
            <li class="nav-item" role="presentation"><a class="nav-link" href="/parc.php">Parc</a></li>
            <?php
          }

          //test si l'utilisateur a la permition
          if ($unutilisateur->GetRole()->GetPermission()['voircomposant'] || $unutilisateur->GetRole()->GetPermission()['voirtouscomposants']) {
            ?>
            <li class="dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">Composant</a>
              <div class="dropdown-menu" role="menu">
                <a class="dropdown-item" role="presentation" href="/composant.php">Ordinateur</a>
                <a class="dropdown-item" role="presentation" href="/composant.php">Imprimant</a>
                <a class="dropdown-item" role="presentation" href="/composant.php">Autre</a>
              </div>
            </li>
            <?php
          }

          //test si l'utilisateur a le drois a au moins une permition
          if (($unutilisateur->GetRole()->GetPermission()['voirtickets'] || $unutilisateur->GetRole()->GetPermission()['voirtouslestickets']) || $unutilisateur->GetRole()->GetPermission()['voirnotes']) {
            ?>
            <li class="dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">Assistance</a>
              <div class="dropdown-menu" role="menu">
                <?php
                //test si l'utilisateur a la permition
                if ($unutilisateur->GetRole()->GetPermission()['voirtickets'] || $unutilisateur->GetRole()->GetPermission()['voirtouslestickets']) {
                  ?>
                  <a class="dropdown-item" role="presentation" href="/ticket.php">Tickets</a>
                  <?php
                }
                if ($unutilisateur->GetRole()->GetPermission()['voirnotes']) {
                  ?>
                  <a class="dropdown-item" role="presentation" href="/note.php">Notes</a>
                  <?php
                }
                ?>
              </div>
            </li>
            <?php
          }

          //test si l'utilisateur a le drois a au moins une permition
          if ($unutilisateur->GetRole()->GetPermission()['gererutilisateurs'] || $unutilisateur->GetRole()->GetPermission()['gererroles']) {
            ?>
            <li class="dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">Administration</a>
              <div class="dropdown-menu" role="menu">
                <?php
                //test si l'utilisateur a la permition
                if ($unutilisateur->GetRole()->GetPermission()['gererutilisateurs']) {
                  ?>
                  <a class="dropdown-item" role="presentation" href="/utilisateur.php">Utilisateur</a>
                  <?php
                }

                //test si l'utilisateur a la permition
                if ($unutilisateur->GetRole()->GetPermission()['gererroles']) {
                  ?>
                  <a class="dropdown-item" role="presentation" href="/role.php">Role</a>
                  <?php
                }
                ?>
              </div>
            </li>
            <?php
          }
          ?>
          <li class="dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">Mon compte (<?php echo $unutilisateur->GetPseudo(); ?>)</a>
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
