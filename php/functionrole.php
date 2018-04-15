<?php

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
