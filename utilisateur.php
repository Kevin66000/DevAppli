<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utilisateurs</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/fonts/font-awesome.minPTU.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="/assets/css/Navigation-with-SearchPTU.css">
    <link rel="stylesheet" href="/assets/css/stylesAccueil.min.css">
  </head>
  <body>
    <?php include 'php/nav.php';

    //si le button modifier un role est activer
    if (isset($_POST['modifiidrole']) && isset($_POST['valueiduser']) && !empty($_POST['valueiduser'])) {
      $valueiduser = htmlspecialchars($_POST['valueiduser']);
      $modifipseudo = (!empty($_POST['modifipseudo']) && strlen($_POST['modifipseudo']) <= 20 ) ? htmlspecialchars($_POST['modifipseudo']) : null ;
      $modifinom = (!empty($_POST['modifinom']) && strlen($_POST['modifinom']) <= 20 ) ? htmlspecialchars($_POST['modifinom']) : null ;
      $modifiprenom = (!empty($_POST['modifiprenom']) && strlen($_POST['modifiprenom']) <= 40 ) ? htmlspecialchars($_POST['modifiprenom']) : null ;
      $modifiemail = (!empty($_POST['modifiemail']) && strlen($_POST['modifiemail']) <= 60 ) ? htmlspecialchars($_POST['modifiemail']) : null ;
      $modifitel = (!empty($_POST['modifitel']) && strlen($_POST['modifitel']) <= 13 ) ? htmlspecialchars($_POST['modifitel']) : null ;
      $modifitel2 = (!empty($_POST['modifitel2']) && strlen($_POST['modifitel2']) <= 13 ) ? htmlspecialchars($_POST['modifitel2']) : null ;
      $modifitelmobile = (!empty($_POST['modifitelmobile']) && strlen($_POST['modifitelmobile']) <= 13 ) ? htmlspecialchars($_POST['modifitelmobile']) : null ;
      $modifimatricule = (!empty($_POST['modifimatricule']) && strlen($_POST['modifimatricule']) <= 20 ) ? htmlspecialchars($_POST['modifimatricule']) : null ;
      if (isset($_POST['modifiactif'])) {
        $modifiactif = 1;
      }else {
        $modifiactif = 0;
      }
      $modifiidrole = (!empty($_POST['modifiidrole']) && strlen($_POST['modifiidrole']) <= 11 ) ? htmlspecialchars($_POST['modifiidrole']) : null ;

      if ($modifimatricule != null) {
        if ($modifipseudo != null) {
          if ($modifiemail != null) {
            $reqemail = $bdd->prepare("SELECT emailUtilisateur FROM utilisateur WHERE utilisateur.emailUtilisateur = ? AND utilisateur.idUtilisateur <> ?");
            $reqemail->execute(array($modifiemail, $valueiduser));
            if ($reqemail->rowCount() == 0) {
              $requpdateuser = $bdd->prepare("UPDATE utilisateur SET utilisateur.nomAfficher = ?, utilisateur.nomUtilisateur = ?, utilisateur.prenomUtilisateur = ?, utilisateur.emailUtilisateur = ?, utilisateur.telUtilisateur = ?, utilisateur.tel2Utilisateur = ?, utilisateur.telMobileUtilisateur = ?, utilisateur.matriculeUtilisateur = ?, utilisateur.actifUtilisateur = ?, utilisateur.idRole = ? WHERE utilisateur.idUtilisateur = ?");
              $requpdateuser->execute(array($modifipseudo, $modifinom, $modifiprenom, $modifiemail, $modifitel, $modifitel2, $modifitelmobile, $modifimatricule, $modifiactif, $modifiidrole, $valueiduser));
            } else {
              $error = "L'adresse email est déjà utiliser.";
            }
          } else {
            $error = "l'email ne dois pas faire plus de 60 character de longue!";
          }
        } else {
          $error = "le pseudo ne dois pas faire plus de 20 character de longue!";
        }
      } else {
        $error = "le matricule ne dois pas faire plus de 20 character de longue!";
      }
    }

    //si le button supprimer un role est activer
    if (isset($_POST['submitrmuser']) && isset($_POST['valueiduser']) && !empty($_POST['valueiduser'])) {
      $valueiduser = htmlspecialchars($_POST['valueiduser']);
      //supprime le role de la bdd
      $bdd->prepare("DELETE FROM utilisateur WHERE utilisateur.idUtilisateur = ?; DELETE FROM utilise WHERE utilise.idUtilisateur = ?")->execute(array($valueiduser, $valueiduser));
    }

    if (isset($error)) {
      ?>
      <div class="container">
        <div class="alert alert-danger alert-dismissible fade show" role="alert"><?php echo $error; ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
      <?php
    }
    //selectionne les toutes les utilisateurs
    $reqSelectUsers = $bdd->prepare("SELECT * FROM utilisateur");
    $reqSelectUsers->execute();
    $users = $reqSelectUsers->fetchAll();
    ?>
    <div>
      <div class="container">
        <div class="row">
          <div class="col offset-lg-0">
            <div class="form-group" style="margin-top:10px;">
              <form class="float-left" style="width:460px;"><button class="btn btn-link btn-lg" onclick="document.location.href = 'ajouterutilisateur.php'" type="button" data-bs-hover-animate="pulse" style="font-size:23px;margin-bottom:3px;">Ajouter un utilisateur&nbsp;<i class="fa fa-plus"></i></button></form>
              <form class="float-right" style="width:460px;">
                <div class="input-group"><button class="btn btn-primary" type="button" style="margin-top:5px;">Recherche</button><input class="form-control" type="search" name="recherche" style="margin-left:5px;margin-top:5px;"></div>
              </form>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12" style="margin-top:10px;">
            <div>
              <div class="table-responsive">
                <table class="table">
                  <thead style="color:rgb(255,255,255);background-color:#e18416;font-size:12px;">
                    <tr style="font-size:11px;">
                      <th style="min-width: 50px">Id&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th style="min-width: 115px;">Entités (Profil)&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th style="min-width: 120px;">Nom&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th style="min-width: 120px;">Prenom&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th style="min-width: 220px;">Adresse email&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th style="min-width:135px;">Telephone&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th style="min-width: 135px;">Telephone secondaire&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th style="min-width: 135px;">Telephone mobile&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th style="min-width: 120px;">Matricule&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th style="min-width: 63px;">Actif&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th style="min-width: 144px;">Role&nbsp;<i class="fa fa-chevron-down"></i></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    //charge les roles
                    $reqrole = $bdd->prepare("SELECT * FROM role");
                    $reqrole->execute();
                    $reproles = $reqrole->fetchAll();

                    //charge tous les utilisateurs
                    foreach ($users as $user) {
                      ?>
                      <tr style="font-size:12px;">
                        <form method="post">
                          <td id="user<?php echo $user["idUtilisateur"]; ?>">
                            <span><?php  echo $user["idUtilisateur"]; ?></span>
                          </td>
                          <td>
                            <span><?php echo $user['nomAfficher']?></span>
                            <input type="text" class="form-control" name="modifipseudo" value="<?php echo $user['nomAfficher']?>" style="display:none;" required="">
                          </td>
                          <td>
                            <span><?php echo $user['nomUtilisateur']?></span>
                            <input type="text" class="form-control" name="modifinom" value="<?php echo $user['nomUtilisateur']?>" style="display:none;">
                          </td>
                          <td>
                            <span><?php echo $user['prenomUtilisateur']?></span>
                            <input type="text" class="form-control" name="modifiprenom" value="<?php echo $user['prenomUtilisateur']?>" style="display:none;">
                          </td>
                          <td>
                            <span><?php echo $user['emailUtilisateur']?></span>
                            <input type="text" class="form-control" name="modifiemail" value="<?php echo $user['emailUtilisateur']?>" style="display:none;" required="">
                          </td>
                          <td>
                            <span><?php echo $user['telUtilisateur']?></span>
                            <input type="text" class="form-control" name="modifitel" value="<?php echo $user['telUtilisateur']?>" style="display:none;">
                          </td>
                          <td>
                            <span><?php echo $user['tel2Utilisateur']?></span>
                            <input type="text" class="form-control" name="modifitel2" value="<?php echo $user['tel2Utilisateur']?>" style="display:none;">
                          </td>
                          <td>
                            <span><?php echo $user['telMobileUtilisateur']?></span>
                            <input type="text" class="form-control" name="modifitelmobile" value="<?php echo $user['telMobileUtilisateur']?>" style="display:none;">
                          </td>
                          <td>
                            <span><?php echo $user['matriculeUtilisateur']?></span>
                            <input type="text" class="form-control" name="modifimatricule" value="<?php echo $user['matriculeUtilisateur']?>" style="display:none;" required="">
                          </td>
                          <td>
                            <?php
                            if ($user['actifUtilisateur'] == 1) {
                              ?>
                              <input type="checkbox" class="form-control" name="modifiactif[]" value="cocher" checked disabled>
                              <?php
                            }else {
                              ?>
                              <input type="checkbox" class="form-control" name="modifiactif[]" value="cocher" disabled>
                              <?php
                            }?>
                          </td>
                          <td>
                            <?php
                            //charge le role
                            $reqlerole = $bdd->prepare("SELECT * FROM role WHERE idRole = ?");
                            $reqlerole->execute(array($user['idRole'])); ?>
                            <span><?php echo $reqlerole->fetch()['libellerRole']?></span>
                            <select class="form-control" name="modifiidrole" required="" style="display:none;">
                              <option value="">null</option>
                              <?php
                              foreach ($reproles as $row) {
                                if ($row["idRole"] == $user['idRole']) {
                                  echo '<option value="'.$row["idRole"].'" selected>'.$row["libellerRole"].'</option>';
                                }else {
                                  echo '<option value="'.$row["idRole"].'">'.$row["libellerRole"].'</option>';
                                }
                              }
                              ?>
                            </select>
                          </td>
                          <td style="width: 150px; display: inline-block;">
                            <input type="hidden" name="valueiduser" value="<?php echo $user['idUtilisateur']; ?>">
                            <button class="btn btn-primary" type="button" data-userid="user<?php echo $user['idUtilisateur']; ?>" onclick="startuseredit(this)" style="margin-right:0px;background-color:rgb(0,133,255);color:rgb(255,255,255);"><i class="fa fa-edit"></i></button>

                            <button type="submit" class="btn btn-success" style="display:none" name="submitedituser">✓</button>
                            <button type="button" class="btn btn-danger" style="display:none" data-userid="user<?php echo $user['idUtilisateur'] ?>" onclick="canceluseredit(this)">✗</button>
                            <form method="post">
                              <input type="hidden" name="valueiduser" value="<?php echo $user['idUtilisateur']; ?>">
                              <button class="btn btn-danger" type="submit" name="submitrmuser" onclick="return confirm('confirmer la suppression de l\'utilisateur');" style="background-color:rgb(255,15,0);color:rgb(255,255,255);"><i class="fa fa-close"></i></button>
                            </form>
                          </td>
                        </form>
                      </tr>
                      <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/BSanimation.js"></script>
    <script src="/assets/js/user.js"></script>
  </body>
</html>
