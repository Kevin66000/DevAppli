<?php require 'php/include.php';
if(isset($_POST['formconnexion'])) {
  $adminconnect = htmlspecialchars($_POST['adminconnect']);// REVIEW: (adminconnect = emailUtilisateur ) : l'identifien de l'utilisateur
  $mdpconnect = sha1($_POST['mdpconnect']);
  if(!empty($adminconnect) AND !empty($_POST['mdpconnect'])) {
    $requser = $bdd->prepare("SELECT * FROM utilisateur WHERE emailUtilisateur = ? AND mdpUtilisateur = ?");
    $requser->execute(array($adminconnect, $mdpconnect));
    $userexist = $requser->rowCount();
    if($userexist == 1) {
      $userinfo = $requser->fetch();
      if ($userinfo['actifUtilisateur']) {
        //instensiation de l'objet utilisateur
        $unutilisateur = new User($userinfo['idUtilisateur'], $userinfo['nomAfficher'], $userinfo['nomUtilisateur'], $userinfo['prenomUtilisateur'], $userinfo['emailUtilisateur'], $userinfo['telUtilisateur'], $userinfo['tel2Utilisateur'], $userinfo['telMobileUtilisateur'], $userinfo['matriculeUtilisateur']);

        echo $unutilisateur->GetPseudo();
        var_dump($unutilisateur);
        $unrole = new role('test', array('test', 'test'));
        var_dump($unrole);
        //header("Location: accueil.php");
        //echo '<script> document.location.replace("accueil.php"); </script>';
      }else {
        $erreur = "<br />Ce compte est désactiver.";
      }
    } else {
      $erreur = "<br />Mauvais email ou mot de passe.".$mdpconnect;
    }
  } else {
    $erreur = "<br />Tous les champs doivent être complétés.";
  }
}
?>
<!DOCTYPE html>
<html style="height: 100%;">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="/assets/css/stylesIndex.min.css">
  </head>
  <body style="height: 100%;">
    <div class="login-dark" style="background-image:url(&quot;assets/img/blackground.jpg&quot;);height: 100%;">
      <form method="post">
        <h2 class="sr-only">Formulaire de connexion</h2>
        <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
        <div class="form-group">
          <input type="text" name="adminconnect" placeholder="Login" class="form-control" />
        </div>
        <div class="form-group"><input class="form-control" type="password" name="mdpconnect" placeholder="Password"></div>
        <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="formconnexion">Connexion</button></div>
        <p><?php if(isset($erreur)) echo $erreur; ?></p>
      </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
<?php

?>
