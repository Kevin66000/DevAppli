<?php
require 'php/setting.bdd.php';

$erreur = true;
$lbl = isset($_POST['lbl']) && !empty($_POST['lbl'])? $_POST['lbl'] : $erreur = false;
$nom = isset($_POST['nom']) && !empty($_POST['nom'])? $_POST['nom'] : $erreur = false;
if ($erreur) {
  $prepreqt = $bdd->prepare("INSERT INTO `permission`(libellerPermission, nompermission) VALUES (?, ?)");
  $prepreqt->execute(array($lbl, $nom));
}else {
  echo "tous les champs ne sont pas remplie";
}

?>
<form class="" action="" method="post">
  <input type="text" name="lbl" value="" placeholder="nomfficher de la permotion">
  <input type="text" name="nom" value="" placeholder="nom de la permotion">
  <button type="submit" name="button">ajouter la permition</button>
</form>
<h1>cette pages est provisoire elle sera supprimer</h1>
