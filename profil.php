<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Profile-Edit-FormProfil.css">
  </head>

  <body>
    <?php include 'php/nav.php';
    //test si l'utilisateur est connecter
    if (isset($_SESSION['idUser'])) {
      $requser = $bdd->prepare("SELECT * FROM utilisateur WHERE idUtilisateur = ?");
      $requser->execute(array($_SESSION['idUser']));
      $userinfo = $requser->fetch();
      ?>
      <div class="container profile profile-view" id="profile">
        <div class="row">
          <div class="col-md-12 alert-col relative">
            <div class="alert alert-info absolue center" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
              <span>Profile save with success</span>
            </div>
          </div>
        </div>
        <form method="post">
          <div class="form-row profile-row">
            <div class="col-md-4 relative">
              <div class="avatar"><div class="avatar-bg center"></div></div>
              <input type="file" name="avatar-file" class="form-control">
            </div>
            <div class="col-md-8">
              <h1>Profile - <?php echo $userinfo['nomAfficher']; ?> - <?php echo $userinfo['matriculeUtilisateur']; ?></h1>
              <hr>
              <div class="form-row">
                <div class="col-sm-12 col-md-6">
                  <div class="form-group"><label>Nom</label><input class="form-control" type="text" name="firstname" value="<?php echo $userinfo['prenomUtilisateur']; ?>"></div>
                </div>
                <div class="col-sm-12 col-md-6">
                  <div class="form-group"><label>Prenom</label><input class="form-control" type="text" name="lastname" value="<?php echo $userinfo['nomUtilisateur']; ?>"></div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-sm-12 col-md-6">
                  <div class="form-group"><label>Telephone - Fixe</label><input class="form-control" type="text" name="tel" value="<?php echo $userinfo['telUtilisateur']; ?>"></div>
                </div>
                <div class="col-sm-12 col-md-6">
                  <div class="form-group"><label>Telephone - Mobile</label><input class="form-control" type="text" name="telm" value="<?php echo $userinfo['telMobileUtilisateur']; ?>"></div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-sm-12 col-md-6">
                  <div class="form-group"><label>Adresse email</label><input class="form-control" type="email" name="email" value="<?php echo $userinfo['emailUtilisateur']; ?>" autocomplete="off" required=""></div>
                </div>
                <div class="col-sm-12 col-md-6">
                  <div class="form-group"><label>Telephone - secondaire</label><input class="form-control" type="text" name="tel2" value="<?php echo $userinfo['tel2Utilisateur']; ?>"></div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-sm-12 col-md-6">
                  <div class="form-group"><label>Mots de passe</label><input class="form-control" type="password" name="password" autocomplete="off"></div>
                </div>
                <div class="col-sm-12 col-md-6">
                  <div class="form-group"><label>Confirmation du mots de passe</label><input class="form-control" type="password" name="confirmpass" autocomplete="off"></div>
                </div>
              </div>
              <hr>
              <div class="form-row">
                <div class="col-md-12 content-right">
                  <button class="btn btn-primary form-btn" type="submit">Sauvegarder</button>
                  <button class="btn btn-danger form-btn" type="reset">Annuler</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <?php
    }else {
      header("Location: /");//redirige ver la pages d'accueil
    }
    ?>
    <script src="/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="/assets/js/Profile-Edit-FormProfil.js"></script>
  </body>
</html>
