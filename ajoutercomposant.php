<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ajouterCompo</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.minAjC.css">
    <link rel="stylesheet" href="/assets/fonts/font-awesome.minAjC.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="/assets/css/ss-contactAjC.css">
    <link rel="stylesheet" href="/assets/css/stylesAjC.css">
  </head>

  <body>
    <?php include 'php/nav.php';
    //vaérification du drois d'accsé
    if (isset($_SESSION['idUser'])) {

      //si le boutton Valider est clicker
      if (isset($_POST['formjoutercomposent'])) {

        //variable
        $ternairError = true;

        $nomCompo = !empty($_POST['nomCompo']) ? htmlspecialchars($_POST['nomCompo']) : $ternairError = false;
        $numSerie = !empty($_POST['numSerie']) ? htmlspecialchars($_POST['numSerie']) : $ternairError = false;
        $addrMac = !empty($_POST['addreMac']) ? htmlspecialchars($_POST['addreMac']) : null;
        $salle = !empty($_POST['salle']) ? htmlspecialchars($_POST['salle']) : null;
        $gabarit = !empty($_POST['gabarit']) ? htmlspecialchars($_POST['gabarit']) : null;
        $type = !empty($_POST['type']) ? htmlspecialchars($_POST['type']) : $ternairError = null;
        $fabricant = !empty($_POST['fabricant']) ? htmlspecialchars($_POST['fabricant']) : null;
        $modele = !empty($_POST['modele']) ? htmlspecialchars($_POST['modele']) : null;
        $referenceCompo = !empty($_POST['referenceCompo']) ? htmlspecialchars($_POST['referenceCompo']) : null;

        //test si les champs ne son pas vide
        if ($ternairError) {

            //vairiffie si la référence n'existe pas
            $reqref = $bdd->prepare("SELECT numSerieComposants FROM parcComposants WHERE numSerieComposants = ?");
            $reqref->execute(array($numSerie));
            $refexist = $reqref->rowCount();
            if($refexist == 0) {
              //ajoute le produit
              $insertcompo = $bdd->prepare("INSERT INTO parcComposants(nomComposants, idSalle, statutComposants, gabaritComposants, typeComposants, fabricantComposants, modeleComposants, numSerieComposants, addressMacComposants, referenceComposants, corbeilleComposants) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
              $insertcompo->execute(array($nomCompo, $salle, 'actif', $gabarit, $type, $fabricant, $modele, $numSerie, $addrMac, $referenceCompo, 0));

            }else {
              $erreur = "La reference \"".$referenceCompo."\" est déjà utilisé !";
            }
          }else {
            $erreur = "erreur système !";
          }
        }
    }
    ?>

    <section style="padding:40px;padding-right:5px;padding-left:4px;">
      <div class="container-fluid">
        <form method="POST" style="padding:15px;">
          <div class="form-row" style="margin-left:0px;margin-right:0px;padding:10px;">
            <div class="col-12 col-md-6" id="message" style="padding-right:20px;padding-left:20px;">
              <fieldset>
                <legend style="font-size:37px;color:rgb(252,174,24);"><i class="fa fa-plus"></i> Ajouter un composant&nbsp;</legend>
              </fieldset>
              <div class="form-group has-feedback"><label for="from_name">Nom du composant</label><input class="form-control" type="text" name="nomCompo" required="" tabindex="1"></div>
              <div class="form-group has-feedback"><label for="from_name">Numéro série</label><input class="form-control" type="text" name="numSerie" required="" tabindex="2"></div>
              <div class="form-group has-feedback"><label for="from_name">Adresse MAC</label><input class="form-control" type="text" name="addreMac"></div>
              <div class="form-group has-feedback">
                <label for="calltime">Salle</label>
                <select class="form-control" name="salle">
                  <option value="">Lieu</option>
                  <?php
                  //charge les salles
                  $reqsalle = $bdd->prepare("SELECT * FROM salle");
                  $reqsalle->execute();
                  $salleinfo = $reqsalle->fetchAll();
                  foreach ($salleinfo as $row) {
                    echo '<option value="'.$row["idSalle"].'">'.$row["libelleSalle"].'</option>';
                  }
                  ?>
                </select>
              </div>
              <div class="form-group has-feedback"><label for="from_name">Type</label><input class="form-control" type="text" name="type" required="" tabindex="-1"></div>
            </div>
            <div class="col-12 col-md-6" style="padding-right:20px;padding-left:20px;">
              <fieldset></fieldset>
              <div class="form-group has-feedback"><label for="from_email">Fabricant</label><input class="form-control" type="email" name="fabricant" ></div>
              <div class="form-row">
                <div class="col-sm-6">
                  <div class="form-group has-feedback"><label for="from_phone">Modele</label><input class="form-control" type="text" name="modele"></div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group has-feedback"><label for="from_phone">Gabarit&nbsp;</label><input class="form-control" type="text" name="gabarit"></div>
                </div>
              </div>
              <div class="form-group has-feedback"><label for="from_email">Référence</label><input class="form-control" type="email" name="referenceCompo"></div>
              <div class="form-group">
                <label for="Commentaire">Comments</label>
                <textarea class="form-control" rows="5" name="Comments" placeholder="Entrer un commentaire ..."></textarea>
              </div>
              <button class="btn btn-success active btn-block btn-lg float-left" name="formjoutercomposent" type="submit" data-bs-hover-animate="rubberBand" style="max-width:170px;margin-top:none;margin-left:none;">Valider&nbsp;<i class="fa fa-check"></i></button>
              <button class="btn btn-danger active btn-block btn-lg float-right" onclick="document.location.href = 'composant.php'" type="button" data-bs-hover-animate="shake" style="max-width:170px;margin:none;margin-top:0px;padding-top:none;padding-right:none;">Annuler&nbsp;<i class="fa fa-remove"></i></button>
              <hr>
            </div>
          </div>
        </form>
      </div>
    </section>
    <script src="/assets/js/jquery.minAjC.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.minAjC.js"></script>
    <script src="/assets/js/bs-animationAjC.js"></script>
  </body>
</html>
