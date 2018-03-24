<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ajouterCompo</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.minAjC.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.minAjC.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="assets/css/ss-contactAjC.css">
    <link rel="stylesheet" href="assets/css/stylesAjC.css">
</head>

<body>
    <?php include 'php/nav.php';
    //vaérification du drois d'accsé
     if (isset($_SESSION['id']) && $_SESSION['admin'] == 'Admin') {

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
        $referenceCompo = htmlspecialchars($_POST['referenceCompo']) ? htmlspecialchars($_POST['referenceCompo']) : $ternairError = false;


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
    }
      ?>

      <section id="contact" style="padding:40px;padding-right:5px;padding-left:4px;">
          <div class="container-fluid">
              <form action="javascript:void();" method="get" id="contactForm" style="padding:15px;">
                  <div class="form-row" style="margin-left:0px;margin-right:0px;padding:10px;">
                      <div class="col-12 col-md-6" id="message" style="padding-right:20px;padding-left:20px;">
                          <fieldset>
                              <legend style="font-size:37px;color:rgb(252,174,24);"><i class="fa fa-plus"></i> Ajouter un composant&nbsp;</legend>
                          </fieldset>
                          <div class="form-group has-feedback"><label for="from_name">Nom du composant</label><input class="form-control" type="text" name="nomCompo" required="" id="from_name" tabindex="-1"></div>
                          <div class="form-group has-feedback"><label for="from_name">Numéro série</label><input class="form-control" type="text" name="numSerie" required="" id="from_name" tabindex="-1"></div>
                          <div class="form-group has-feedback"><label for="from_email">Adresse MAC</label><input class="form-control" type="email" name="addreMac" required="" id="from_name"></div>
                          <div class="form-row">
                              <div class="col-sm-6">
                                  <div class="form-group"><label for="calltime">Statut</label><select class="form-control" name="Call Time" required="" id="calltime"><option value="">Statut</option><option value="">Active</option><option value="">En cours</option><option value="">...</option></select></div>
                              </div>
                              <div class="col-sm-6">
                                  <div class="form-group"><label for="calltime">Salle</label><select class="form-control" name="Call Time" required="" id="calltime"><option value="">Lieu</option><option value="">111i</option><option value="">110i</option><option value="">109i</option></select></div>
                              </div>
                          </div>
                          <div class="form-group has-feedback"><label for="from_name">Type</label><input class="form-control" type="text" name="type" required="" id="from_name" tabindex="-1"></div>
                      </div>
                      <div class="col-12 col-md-6" id="message" style="padding-right:20px;padding-left:20px;">
                          <fieldset></fieldset>
                          <div class="form-group has-feedback"><label for="from_email">Fabricant</label><input class="form-control" type="email" name="fabricant" required="" id="from_name"></div>
                          <div class="form-row">
                              <div class="col-sm-6">
                                  <div class="form-group has-feedback"><label for="from_phone">Modele</label><input class="form-control" type="text" name="modele" id="from_name"></div>
                              </div>
                              <div class="col-sm-6">
                                  <div class="form-group has-feedback"><label for="from_phone">Gabarit&nbsp;</label><input class="form-control" type="text" name="gabarit" id="from_name"></div>
                              </div>
                          </div>
                          <div class="form-group has-feedback"><label for="from_email">Référence</label><input class="form-control" type="email" name="referenceCompo" required="" id="from_name"></div>
                          <div class="form-group"><label for="Commentaire">Comments</label><textarea class="form-control" rows="5" name="Comments" placeholder="Entrer un commentaire ..." id="comments"></textarea></div><button class="btn btn-success active btn-block btn-lg float-left"
                              type="submit" data-bs-hover-animate="rubberBand" style="max-width:170px;margin-top:none;margin-left:none;">Valider&nbsp;<i class="fa fa-check"></i></button><button class="btn btn-danger active btn-block btn-lg float-right" type="submit"
                              data-bs-hover-animate="shake" style="max-width:170px;margin:none;margin-top:0px;padding-top:none;padding-right:none;">Annuler&nbsp;<i class="fa fa-remove"></i></button>
                          <hr>
                      </div>
                      <div class="col-md-6" style="padding-left:20px;padding-right:20px;">
                      </div>
                      <div class="col-md-6" style="padding-left:20px;padding-right:20px;">
                      </div>
                  </div>
              </form>
          </div>
      </section>

      <script src="assets/js/jquery.minAjC.js"></script>
      <script src="assets/bootstrap/js/bootstrap.minAjC.js"></script>
      <script src="assets/js/bs-animationAjC.js"></script>
  </body>

</html>
