<?php
function getUser($piduser, $bdd){
  //selectionne l'utilisateur grace a son id
  $requser = $bdd->prepare("SELECT utilisateur.idUtilisateur, utilisateur.nomAfficher, utilisateur.nomUtilisateur, utilisateur.prenomUtilisateur, utilisateur.emailUtilisateur, utilisateur.telUtilisateur, utilisateur.tel2Utilisateur, utilisateur.telMobileUtilisateur, utilisateur.matriculeUtilisateur, utilisateur.idRole FROM utilisateur WHERE idUtilisateur = ?");
  $requser->execute(array($piduser));
  $userinfo = $requser->fetch();

  //instencie un nouvelle utilisateur
  $unutilisateur = new User($userinfo['idUtilisateur'], $userinfo['nomAfficher'], $userinfo['nomUtilisateur'], $userinfo['prenomUtilisateur'], $userinfo['emailUtilisateur'], $userinfo['telUtilisateur'], $userinfo['tel2Utilisateur'], $userinfo['telMobileUtilisateur'], $userinfo['matriculeUtilisateur']);

  $droit =  array();//crée un tableaupour stoquer les droit

  //test si l'utilisateur a un role
  if ($userinfo['idRole'] != null) {
    //selection les droit par raport au role
    $reqdroit = $bdd->prepare("SELECT permission.nompermission, droit.blnAvoir FROM droit, permission WHERE droit.idPermission = permission.idPermission AND idRole = ?");
    $reqdroit->execute(array($userinfo['idRole']));

    //remplie le tableau droit avec tous les droit
    foreach ($reqdroit->fetchAll() as $undroit) {
      if ($undroit['blnAvoir']) {
        $droit[$undroit['nompermission']] = true;
      }else {
        $droit[$undroit['nompermission']] = false;
      }
    }
  }else {
    //remplie le tableau droit avec tous les droit
    $reqpermission = $bdd->prepare("SELECT permission.nompermission FROM permission");
    $reqpermission->execute();
    //crée un table avec tous les droit
    foreach ($reqpermission->fetchAll() as $row) {
      $droit[$row['nompermission']] = false;
    }
  }

  //selectionne le nom du role
  $reqrole = $bdd->prepare("SELECT role.libellerRole FROM role WHERE role.idRole = ?");
  $reqrole->execute(array($userinfo['idRole']));
  $unutilisateur->SetRole(new role($reqrole->fetch()['libellerRole'], $droit));//ajoute le role a l'objet utilisateur

  //renvoi l'utilisateur
  return $unutilisateur;
}

//fonction
function nomRoleExiste($pNomRole){
  global $bdd;
  //test si le nom du role est déja utiliser
  $reqSelectNomRole = $bdd->prepare("SELECT * FROM role WHERE libellerRole = ?");
  $reqSelectNomRole->execute(array($pNomRole));
  $reqSelectNomRole->fetchAll();
  if ($reqSelectNomRole->rowCount() >= 1) {
    return false;
  }else {
    return true;
  }
}


function isInList($pid, $pe){//test si l'a permition est dans la list des permition cocher par l'utilisateur
  foreach ($pe as $perm) {
    if ($perm == $pid) {
      return true;
    }
  }
  return false;
}

?>
