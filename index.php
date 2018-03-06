<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/stylesIndex.min.css">
  </head>
  <body>
    <div class="login-dark" style="background-image:url(&quot;assets/img/blackground.jpg&quot;);">
        <form method="post">
          <?php
          if(isset($_POST['formconnexion'])) {
            $adminconnect = htmlspecialchars($_POST['adminconnect']);
            $mdpconnect = sha1($_POST['mdpconnect']);
            if(!empty($adminconnect) AND !empty($mdpconnect)) {
              $requser = $bdd->prepare("SELECT client.IDClient, client.Admin, FROM client WHERE Admin = ? AND MotDePasse = ?");
              $requser->execute(array($adminconnect, $mdpconnect));
              $userexist = $requser->rowCount();
              if($userexist == 1) {
                $userinfo = $requser->fetch();
                $_SESSION['id'] = $userinfo['IDClient'];
                $_SESSION['admin'] = $userinfo['Admin'];
                $_SESSION['mail'] = $userinfo['Email'];

                //remplachement du header("Location: index.php); par du js a cause d'une erreur
                echo '<script> document.location.replace("accueil.php"); </script>';
              } else {
                $erreur = "<br />Mauvais pseudo ou mot de passe !";
              }
            } else {
              $erreur = "<br />Tous les champs doivent être complétés !";
            }
          }
          ?>
            <h2 class="sr-only">Formulaire de connexion</h2>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="form-group">
                <input type="text" name="adminconnect" placeholder="Admin" class="form-control" />
            </div>
            <div class="form-group"><input class="form-control" type="password" name="mdpconnect" placeholder="Mot de passe"></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="formconnexion">Connexion</button>
            </div></form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
