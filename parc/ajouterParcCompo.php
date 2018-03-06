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
    <?php include '../nav.php';
    //vaérification du drois d'accsé
     if (isset($_SESSION['id']) && $_SESSION['pseudo'] == 'Admin') {

      //si le boutton Valider est clicker
      if (isset($_POST['formjoutercomposent'])) {

        //variable
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
        $referenceCompo = htmlspecialchars($_POST['referenceCompo']);


        //test si les champs ne son pas vide
        if ($ternairError) {
          //test si les type son correcte
          if (is_numeric($_POST['lieu']) && is_numeric($_POST['statut'])) {

            //vairiffie si la référence n'existe pas
            $reqref = $bdd->prepare("SELECT referenceComposants FROM parcComposants WHERE referenceComposants = ?");
            $reqref->execute(array($referenceCompo));
            $refexist = $reqref->rowCount();
            if($refexist == 0) {
              //ajoute le produit
              $insertcompo = $bdd->prepare("INSERT INTO composant(LibelleComposant, Lieu, Statut, Gabarit, Type, Fabricant, Modele, NumSerie, AddreMac, Reference) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
              $insertcompo->execute(array($nomCompo, $lieu, $statut, $gabarit, $type, $fabricant, $modele, $numSerie, $addrMac, $referenceCompo));

            }else {
              $erreur = "La reference \"".$referenceCompo."\" est déjà utilisé !";
            }
        }else {
          $erreur = "erreur système !";
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
