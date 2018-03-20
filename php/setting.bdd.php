<?php
session_start();

//connexion a la bdd
try {
  $bdd = new PDO('mysql:host=ppe2.ddns.net;dbname=si6', 'si6', 'si6123');
} catch (Exception $e) {
  echo 'Erreur de connexion a la bdd : '.$e->getMessage();
  die();
}

?>
