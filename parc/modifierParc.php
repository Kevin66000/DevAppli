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
    <?php include '../php/nav.php';
      //vaérification du drois d'accsé
      if (isset($_SESSION['id']) && $_SESSION['admin'] == 'Admin') {

        //teste si la propriéter id est présente
        if (isset($_GET['id'])) {

          //test si il y a un id set
          if (!empty($_GET['id'])) {

            //si le boutton Valider est clicker
            if (isset($_POST['formmodifierparc'])) {

              $ternairError = true;

              $nomCompo = !empty($_POST['nomCompo']) ? htmlspecialchars($_POST['nomCompo']) : $ternairError = false;
              $lieu = intval(htmlspecialchars($_POST['lieu'])) ? htmlspecialchars($_POST['lieu']) : $ternairError = false;
              $statut = intval(htmlspecialchars($_POST['statut'])) ? htmlspecialchars($_POST['statut']) : $ternairError = false;
              $gabarit = htmlspecialchars($_POST['gabarit']) ? htmlspecialchars($_POST['gabarit']) : $ternairError = false;
              $type = htmlspecialchars($_POST['type']) ? htmlspecialchars($_POST['type']) : $ternairError = false;
              $fabricant = htmlspecialchars($_POST['fabricant']) ? htmlspecialchars($_POST['fabricant']) : $ternairError = false;
              $modele = htmlspecialchars($_POST['modele']) ? htmlspecialchars($_POST['modele']) : $ternairError = false;
              $numSerie = htmlspecialchars($_POST['numSerie']) ? htmlspecialchars($_POST['numSerie']) : $ternairError = false;
              $addrMac = htmlspecialchars($_POST['addreMac']) ? htmlspecialchars($_POST['addreMac']) : $ternairError = false;
              $referenceCompo = htmlspecialchars($_POST['referenceCompo']) ? htmlspecialchars($_POST['referenceCompo']) : $ternairError = false;


              //test si les champs ne son pas vide
              if (!empty($_POST['nomproduit']) && !empty($_POST['prix']) && !empty($_POST['reference']) && !empty($_POST['quantite']) && !empty($_POST['categorie']) && !empty($_POST['description'])) {

                //test si les type son correcte
                if (is_numeric($_POST['prix']) && is_numeric($_POST['quantite']) && is_numeric($_POST['categorie'])) {

                  //vairiffie si la référence n'existe pas
                  $reqref = $bdd->prepare("SELECT * FROM produits WHERE Reference = ? AND IDProduit != ?");
                  $reqref->execute(array($reference, $idproduit));
                  $refexist = $reqref->rowCount();
                  if($refexist == 0) {
                    //update le produit
                    $insertproduit = $bdd->prepare("UPDATE produits SET LibelleProduit = ?, PrixUnitaireHT = ?, Reference = ?, QuantiteProduit = ?, IdCategorie = ?, DescriptionProduit = ? WHERE IDProduit = ?");
                    $insertproduit->execute(array($nomproduit, $prix, $reference, $quantite, $categorie, $description, $idproduit));

                    //teste si il y a une image envoyer
                    if (!empty($_POST['ingsJSON'])) {

                      // TODO: insére dans photoproduit le photo avec $idproduit

                      echo '<script> console.log("image teeeeest"); document.location.replace("modifierCatalogue.php")</script>';

                    }else {
                      echo '<script> console.log("Pas d\'image ajouter. Image par default utiliser"); document.location.replace("modifiercatalogue.php")</script>';
                    }
                  }else {
                    $erreur = "La reference \"".$reference."\" est déjà utilisé !";
                  }
                }else {
                  $erreur = "Le champ Prix Unitair HT et/ou Quantité ne dois comptenir que des chiffre !";
                }
              }else {
                $erreur = "Tous les champs doivent être complétés !";
              }
            }

            //charge les information actuelle du produit

            //sql SELECT * FROM produit where
            $reqproduit = $bdd->prepare("SELECT * FROM produits WHERE IDProduit = ?");
            $reqproduit->execute(array($_GET['id']));
            $dbrep = $reqproduit->fetch();

            //le resultat remplie des variable
            $nomproduit = $dbrep["LibelleProduit"];
            $prix = $dbrep["PrixUnitaireHT"];
            $reference = $dbrep["Reference"];
            $quantite = $dbrep["QuantiteProduit"];
            $categorie = $dbrep["IdCategorie"];
            $description = $dbrep["DescriptionProduit"];
        ?>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>
