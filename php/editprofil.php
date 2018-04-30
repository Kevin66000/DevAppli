<?php
require 'include.php';

//test si l'utilisateur est connecter
if (isset($_SESSION['idUser'])) {

  //reponse en json
  //$msg = array();

  //remplie les variable avec les donner du form
  $modifiprenom = !empty($_POST['firstname']) ? htmlspecialchars($_POST['firstname']) : null ;
  $modifinom = !empty($_POST['lastname']) ? htmlspecialchars($_POST['lastname']) : null ;
  $modifitel = !empty($_POST['tel']) ? htmlspecialchars($_POST['tel']) : null ;
  $modifitelmobile = !empty($_POST['telm']) ? htmlspecialchars($_POST['telm']) : null ;
  $modifiemail = (!empty($_POST['email']) && strlen($_POST['email']) <= 60 ) ? htmlspecialchars($_POST['email']) : null ;
  $modifitel2 = !empty($_POST['tel2']) ? htmlspecialchars($_POST['tel2']) : null ;
  $password = (!empty($_POST['password']) && strlen($_POST['password']) <= 13 ) ? htmlspecialchars($_POST['password']) : null ;
  $confirmpass = (!empty($_POST['confirmpass']) && strlen($_POST['confirmpass']) <= 13 ) ? htmlspecialchars($_POST['confirmpass']) : null ;

  //test si l'email n'est pas null
  if ($modifiemail != null) {
    //récupére les adresse email identique a celle dans le form
    $reqemail = $bdd->prepare("SELECT emailUtilisateur FROM utilisateur WHERE utilisateur.emailUtilisateur = ? AND utilisateur.idUtilisateur <> ?");
    $reqemail->execute(array($modifiemail, $_SESSION['idUser']));
    //si l'adresse email n'ai pas utiliser alors on continue
    if ($reqemail->rowCount() == 0) {
      //teste la longuer des chaine
      if (strlen($_POST['firstname']) <= 40 ) {
        if (strlen($_POST['lastname']) <= 20) {
          if (strlen($_POST['tel']) <= 13) {
            if (strlen($_POST['telm']) <= 13) {
              if (strlen($_POST['tel2']) <= 13) {
                //test si il faut changer le mdp
                if ($password != '' && $password != null) {
                  //test si le mots de passe est le mots de passe de confirmation sont identique
                  if ($password == $confirmpass) {
                    //modifie l'utilisateur ainsi que sont mdp
                    $requpdateuser = $bdd->prepare("UPDATE utilisateur SET utilisateur.nomUtilisateur = ?, utilisateur.prenomUtilisateur = ?, utilisateur.emailUtilisateur = ?, utilisateur.telUtilisateur = ?, utilisateur.tel2Utilisateur = ?, utilisateur.telMobileUtilisateur = ?, utilisateur.mdpUtilisateur = ? WHERE utilisateur.idUtilisateur = ?");
                    $requpdateuser->execute(array($modifinom, $modifiprenom, $modifiemail, $modifitel, $modifitel2, $modifitelmobile, sha1($password), $_SESSION['idUser']));
                    $msg = "Profil sauvegarder et mots de passe changer";
                  }
                }else {
                  //modifie l'utisilateur
                  $requpdateuser = $bdd->prepare("UPDATE utilisateur SET utilisateur.nomUtilisateur = ?, utilisateur.prenomUtilisateur = ?, utilisateur.emailUtilisateur = ?, utilisateur.telUtilisateur = ?, utilisateur.tel2Utilisateur = ?, utilisateur.telMobileUtilisateur = ? WHERE utilisateur.idUtilisateur = ?");
                  $requpdateuser->execute(array($modifinom, $modifiprenom, $modifiemail, $modifitel, $modifitel2, $modifitelmobile, $_SESSION['idUser']));
                  $msg = "Profil sauvegarder";
                }
                //test si il faut changer l'image ou non
                if (!empty($_FILES['avatar-file']['name'])) {
                  //récupére le nom de l'image actuelle
                  $reqavatar = $bdd->prepare("SELECT utilisateur.avatar FROM utilisateur WHERE utilisateur.idUtilisateur = ?");
                  $reqavatar->execute(array($_SESSION['idUser']));

                  $avatar = $reqavatar->fetch()['avatar'];
                  if (!empty($avatar)) {
                    //supprime l'image
                    @unlink("../assets/img/imagesupload/".$avatar);
                  }

                  $path = "../assets/img/imagesupload/";
                  $name = basename($_FILES['avatar-file']["name"]);
                  $actual_name = pathinfo($name,PATHINFO_FILENAME);
                  $extension = pathinfo($name, PATHINFO_EXTENSION);
                  $imageFileType = strtolower($extension);
                  $uploadOk = 1;
                  $causeerreur = 'inconnue';

                  $i = 1;
                  while(file_exists($path.$actual_name.".".$extension)){
                    $actual_name = (string)$actual_name.$i;
                    $name = $actual_name.".".$extension;
                    $i++;
                  }

                  if ($_FILES['avatar-file']["size"] > 5000000) {
                    $uploadOk = 0;
                    $causeerreur = 'image trop lourde';
                  }

                  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "ico") {
                    $uploadOk = 0;
                    $causeerreur = 'ce fichier n\'est pas une image';
                  }

                  if ($uploadOk && @move_uploaded_file($_FILES['avatar-file']["tmp_name"], $path.$name)) {
                    $requpdateavatar = $bdd->prepare("UPDATE utilisateur SET utilisateur.avatar = ? WHERE utilisateur.idUtilisateur = ?");
                    $requpdateavatar->execute(array($name, $_SESSION['idUser']));
                    $msg .= " Et l'avatar a bien êtait modifier";
                  } else {
                    header('HTTP/1.1 500 Internal Server Error');
                    print $causeerreur;
                    die();
                  }
                }
              }else {
                $msg = "Le numéro de téléphone secondaire ne dois pas faire plus de 13 character de longue!";
              }
            }else {
              $msg = "Le numéro de téléphone mobile ne dois pas faire plus de 13 character de longue!";
            }
          }else {
            $msg = "Le numéro de téléphone fix ne dois pas faire plus de 13 character de longue!";
          }
        } else {
          $msg = "Le nom ne dois pas faire plus de 20 character de longue!";
        }
      }else {
        $msg = "Le pénom ne dois pas faire plus de 40 character de longue!";
      }
    } else {
      $msg = "L'adresse email est déjà utiliser.";
    }
  } else {
    $msg = "l'adressee email ne peut pas étre nue est ne dois pas faire plus de 60 character de longue!";
  }
  echo $msg;
}
?>
