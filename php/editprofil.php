<?php
require 'include.php';
echo $_POST['firstname'];

if (isset($_SESSION['idUser'])) {
  $modifiprenom = !empty($_POST['firstname']) ? htmlspecialchars($_POST['firstname']) : null ;
  $modifinom = !empty($_POST['lastname']) ? htmlspecialchars($_POST['lastname']) : null ;
  $modifitel = !empty($_POST['tel']) ? htmlspecialchars($_POST['tel']) : null ;
  $modifitelmobile = !empty($_POST['telm']) ? htmlspecialchars($_POST['telm']) : null ;
  $modifiemail = (!empty($_POST['email']) && strlen($_POST['email']) <= 60 ) ? htmlspecialchars($_POST['email']) : null ;
  $modifitel2 = !empty($_POST['tel2']) ? htmlspecialchars($_POST['tel2']) : null ;
  $password = (!empty($_POST['password']) && strlen($_POST['password']) <= 13 ) ? htmlspecialchars($_POST['password']) : null ;
  $confirmpass = (!empty($_POST['confirmpass']) && strlen($_POST['confirmpass']) <= 13 ) ? htmlspecialchars($_POST['confirmpass']) : null ;

  if ($modifiemail != null) {
    $reqemail = $bdd->prepare("SELECT emailUtilisateur FROM utilisateur WHERE utilisateur.emailUtilisateur = ? AND utilisateur.idUtilisateur <> ?");
    $reqemail->execute(array($modifiemail, $valueiduser));
    if ($reqemail->rowCount() == 0) {
      if (strlen($_POST['firstname']) <= 40 ) {
        if (strlen($_POST['lastname']) <= 20) {
          if (strlen($_POST['tel']) <= 13) {
            if (strlen($_POST['telm']) <= 13) {
              if (strlen($_POST['tel2']) <= 13) {
                if ($password != '' && $password != null) {
                  echo "avec mdp";
                  if ($password == $confirmpass) {
                    // $requpdateuser = $bdd->prepare("UPDATE utilisateur SET utilisateur.nomUtilisateur = ?, utilisateur.prenomUtilisateur = ?, utilisateur.emailUtilisateur = ?, utilisateur.telUtilisateur = ?, utilisateur.tel2Utilisateur = ?, utilisateur.telMobileUtilisateur = ?, utilisateur.mdpUtilisateur WHERE utilisateur.idUtilisateur = ?");
                    // $requpdateuser->execute(array($modifinom, $modifiprenom, $modifiemail, $modifitel, $modifitel2, $modifitelmobile, $password, $_SESSION['idUser']));
                  }
                }else {
                  echo "sans mdp";
                  // $requpdateuser = $bdd->prepare("UPDATE utilisateur SET utilisateur.nomUtilisateur = ?, utilisateur.prenomUtilisateur = ?, utilisateur.emailUtilisateur = ?, utilisateur.telUtilisateur = ?, utilisateur.tel2Utilisateur = ?, utilisateur.telMobileUtilisateur = ? WHERE utilisateur.idUtilisateur = ?");
                  // $requpdateuser->execute(array($modifinom, $modifiprenom, $modifiemail, $modifitel, $modifitel2, $modifitelmobile, $_SESSION['idUser']));
                }
                if (isset($_FILES)) {
                  var_dump($_FILES);
                }else {
                  echo "not files";
                }
              }else {
                $error = "Le numéro de téléphone secondaire ne dois pas faire plus de 13 character de longue!";
              }
            }else {
              $error = "Le numéro de téléphone mobile ne dois pas faire plus de 13 character de longue!";
            }
          }else {
            $error = "Le numéro de téléphone fix ne dois pas faire plus de 13 character de longue!";
          }
        } else {
          $error = "Le nom ne dois pas faire plus de 20 character de longue!";
        }
      }else {
        $error = "Le pénom ne dois pas faire plus de 40 character de longue!";
      }
    } else {
      $error = "L'adresse email est déjà utiliser.";
    }
  } else {
    $error = "l'adressee email ne peut pas étre nue est ne dois pas faire plus de 60 character de longue!";
  }
  echo $error;
}
?>
