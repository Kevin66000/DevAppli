<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Untitled</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/css/swiper.min.css">
    <link rel="stylesheet" href="./assets/css/stylesAccueil.min.css">
</head>

<body>
    <?php include '../nav.php'; ?>
    <?php
    //vaérification du drois d'accsé
     if (isset($_SESSION['id']) && $_SESSION['pseudo'] == 'Admin') {

      //si le boutton Valider est clicker
      if (isset($_POST['formjoutercomposent'])) {

        //variable
        $ternairError = true;

        $nomCompo = !empty($_POST['nomCompo']) ? htmlspecialchars($_POST['nomCompo']) : $ternairError = false;
        $lieu = intval(htmlspecialchars($_POST['lieu']));
        $statut = intval(htmlspecialchars($_POST['statut']));
        $gabarit = htmlspecialchars($_POST['gabarit']);
        $type = htmlspecialchars($_POST['type']);
        $fabricant = htmlspecialchars($_POST['fabricant']);
        $modele = htmlspecialchars($_POST['modele']);
        $numSerie = htmlspecialchars($_POST['numSerie']);
        $addrMac = htmlspecialchars($_POST['addreMac']);


        //test si les champs ne son pas vide
        if ($ternairError) {//!empty($_POST['nomCompo']) && !empty($_POST['lieu']) && !empty($_POST['statut']) && !empty($_POST['gabarit']) && !empty($_POST['type']) && !empty($_POST['fabricant']) && !empty($_POST['modele']) && !empty($_POST['numSerie'])
          echo "oui";
          //test si les type son correcte
          if (is_numeric($_POST['prix']) && is_numeric($_POST['quantite']) && is_numeric($_POST['categorie'])) {

            //vairiffie si la référence n'existe pas
            $reqref = $bdd->prepare("SELECT Reference FROM produits WHERE Reference = ?");
            $reqref->execute(array($reference));
            $refexist = $reqref->rowCount();
            if($refexist == 0) {
              //ajoute le produit
              $insertproduit = $bdd->prepare("INSERT INTO produits(LibelleProduit, PrixUnitaireHT, Reference, QuantiteProduit, IdCategorie, DescriptionProduit) VALUES(?, ?, ?, ?, ?, ?)");
              $insertproduit->execute(array($nomproduit, $prix, $reference, $quantite, $categorie, $description));

              //teste si il y a une image envoyer
              if (!empty($_POST['ingsJSON'])) {
                $reqProduitId = $bdd->prepare("SELECT IDProduit FROM produits WHERE Reference = ?");
                $reqProduitId->execute(array($reference));
                // TODO: insére dans photoproduit le photo avec idproduit
                echo '<script> console.log("image teeeeest"); document.location.replace("modifierCatalogue.php")</script>';

              }else {
                echo '<script> console.log("Pas d\'image ajouter. Image par default utiliser"); document.location.replace("modifierCatalogue.php")</script>';
              }
            }else {
              $erreur = "La reference \"".$reference."\" est déjà utilisé !";
            }
          }else {
            $erreur = "Le champ Prix Unitair HT et/ou Quantité ne dois comptenir que des chiffre !";
          }
        }else {
          $erreur = "Tous les champs doivent être complétés !";
      }else {
        echo "non";
      }
      }
    }
      ?>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>
