<?php
require 'php/include.php';

//définie les variable
$matricule = (!empty($_POST['matricule']) && strlen($_POST['matricule']) <= 20 ) ? htmlspecialchars($_POST['matricule']) : null ;
$pseudo = (!empty($_POST['pseudo']) && strlen($_POST['pseudo']) <= 20 ) ? htmlspecialchars($_POST['pseudo']) : null ;
$firstname = (!empty($_POST['firstname']) && strlen($_POST['firstname']) <= 40 ) ? htmlspecialchars($_POST['firstname']) : null ;
$lastname = (!empty($_POST['lastname']) && strlen($_POST['lastname']) <= 20 ) ? htmlspecialchars($_POST['lastname']) : null ;
$telfixe = (!empty($_POST['telfixe']) && strlen($_POST['telfixe']) <= 13 ) ? htmlspecialchars($_POST['telfixe']) : null ;
$telmobile = (!empty($_POST['telmobile']) && strlen($_POST['telmobile']) <= 13 ) ? htmlspecialchars($_POST['telmobile']) : null ;
$email = (!empty($_POST['email']) && strlen($_POST['email']) <= 60 ) ? htmlspecialchars($_POST['email']) : null ;
$confirmemail = (!empty($_POST['confirmemail'])) ? htmlspecialchars($_POST['confirmemail']) : null ;
$password = (!empty($_POST['password']) && strlen($_POST['password']) <= 100 ) ? htmlspecialchars($_POST['password']) : null ;
$confirmpass = (!empty($_POST['confirmpass'])) ? htmlspecialchars($_POST['confirmpass']) : null ;
$idrole = (!empty($_POST['idrole']) && strlen($_POST['idrole']) <= 11 ) ? intval(htmlspecialchars($_POST['idrole'])) : null ;

//quant le formulaire est activer par le button submitadduser
if (isset($_POST['submitadduser'])) {
  //htmlspecialchars
  if ($matricule != null) {
    if ($pseudo != null) {
      if ($email != null) {
        if ($password != null) {
          if ($idrole != null) {
            if ($email == $confirmemail) {
              if ($password == $confirmpass) {
                $reqemail = $bdd->prepare("SELECT emailUtilisateur FROM utilisateur WHERE emailUtilisateur = ?");
                $reqemail->execute(array($email));
                if ($reqemail->rowCount() == 0) {
                  $insertmbr = $bdd->prepare("INSERT INTO `utilisateur`(`nomUtilisateur`, `prenomUtilisateur`, `nomAfficher`, `mdpUtilisateur`, `actifUtilisateur`, `telUtilisateur`, `telMobileUtilisateur`, `matriculeUtilisateur`, `emailUtilisateur`, `idRole`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                  $insertmbr->execute(array($lastname, $firstname, $pseudo, sha1($password), 1, $telfixe, $telmobile, $matricule, $email, $idrole));
                  header("Location: utilisateur.php");
                } else {
                  $error = "L'adresse email est déjà utiliser.";
                }
              } else {
                $error = "Le mots de passe et le mots de passe de confirmation doivent être identique.";
              }
            } else {
              $error = "L'adresse email et l'adresse email de confirmation doivent être identique.";
            }
          } else {
            $error = "Vous devais choisir un role.";
          }
        } else {
          $error = "le mots de passe ne dois pas faire plus de 100 character de longue!";
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
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ajouterUtilisateur</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/fonts/font-awesome.minAjC.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <style>
    * {
      font-family:'Raleway', sans-serif;
    }
    </style>
  </head>
  <body>
    <div class="container-fluid">
      <form method="post" style="padding:15px;">
        <div class="form-row" style="margin-left:0px;margin-right:0px;padding:10px;">
          <div class="col-12 col-md-6" style="padding-right:20px;padding-left:20px;">
            <fieldset>
              <legend style="font-size:37px;color:rgb(252,174,24);"><i class="fa fa-plus"></i> Ajouter un utilisateur</legend>
              <div class="form-row">
                <div class="col-sm-12 col-md-6">
                  <div class="form-group"><label>Matricule</label><input class="form-control" type="test" name="matricule" required="" value="<?php echo $matricule; ?>"></div>
                </div>
                <div class="col-sm-12 col-md-6">
                  <div class="form-group"><label>Pseudo</label><input class="form-control" type="test" name="pseudo" required="" value="<?php echo $pseudo; ?>"></div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-sm-12 col-md-6">
                  <div class="form-group"><label>Nom</label><input class="form-control" type="text" name="firstname" value="<?php echo $firstname; ?>"></div>
                </div>
                <div class="col-sm-12 col-md-6">
                  <div class="form-group"><label>Prenom</label><input class="form-control" type="text" name="lastname" value="<?php echo $lastname; ?>"></div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-sm-12 col-md-6">
                  <div class="form-group"><label>Telephone - Fixe</label><input class="form-control" type="text" name="telfixe" value="<?php echo $telfixe; ?>"></div>
                </div>
                <div class="col-sm-12 col-md-6">
                  <div class="form-group"><label>Telephone - Mobile</label><input class="form-control" type="text" name="telmobile" value="<?php echo $telmobile; ?>"></div>
                </div>
              </div>
              <div class="form-group">
                <label for="calltime">Roles</label>
                <select class="form-control" name="idrole" required="">
                  <option value="">Roles</option>
                  <?php
                  //charge les role
                  $reqrole = $bdd->prepare("SELECT * FROM role");
                  $reqrole->execute();
                  foreach ($reqrole->fetchAll() as $row) {
                    if ($row["idRole"] == $idrole) {
                      echo '<option value="'.$row["idRole"].'" selected>'.$row["libellerRole"].'</option>';
                    }else {
                      echo '<option value="'.$row["idRole"].'">'.$row["libellerRole"].'</option>';
                    }
                  }
                  ?>
                </select>
              </div>
            </fieldset>
          </div>
          <div class="col-12 col-md-6" style="padding-right:20px;padding-left:20px;">
            <fieldset></fieldset>
            <div class="form-group" style="margin-top:63px;">
              <label for="from_email">Email </label>
              <input class="form-control" type="email" name="email" required="" value="<?php echo $email; ?>">
            </div>
            <div class="form-group">
              <label for="from_email">Confirmation de l'email </label>
              <input class="form-control" type="email" name="confirmemail" autocomplete="off" required="" value="<?php echo $confirmemail; ?>">
            </div>
            <div class="form-row">
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label>Mots de passe</label>
                  <input class="form-control" type="password" name="password" autocomplete="off" required="" value="<?php echo $password; ?>">
                </div>
              </div>
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label>Confirmation du mots de passe</label>
                  <input class="form-control" type="password" name="confirmpass" autocomplete="off" required="" value="<?php echo $confirmpass; ?>">
                </div>
              </div>
            </div>
            <button class="btn btn-success active btn-block btn-lg float-left" type="submit"  name="submitadduser" data-bs-hover-animate="rubberBand" style="max-width:170px;margin-top:none;margin-left:none;">Valider&nbsp;<i class="fa fa-check"></i></button>
            <button class="btn btn-danger active btn-block btn-lg float-right" onclick="document.location.href = 'utilisateur.php'" type="submit" data-bs-hover-animate="shake" style="max-width:170px;margin:none;margin-top:0px;padding-top:none;padding-right:none;">Annuler&nbsp;<i class="fa fa-remove"></i></button>
            <hr>
          </div>
        </div>
      </form>
    </div>
    <script src="/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="/assets/js/BSanimation.js"></script>
  </body>
</html>
