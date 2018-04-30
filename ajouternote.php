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
    if (isset($_SESSION['id']) && $_SESSION['admin'] == 'Admin') {

      //si le boutton Valider est clicker
      if (isset($_POST['formjoutercomposent'])) {

        //variable
        $ternairError = true;

        $nomCompo = !empty($_POST['titreNote']) ? htmlspecialchars($_POST['titreNote']) : $ternairError = false;
        $statut = htmlspecialchars($_POST['statut']) ? intval(htmlspecialchars($_POST['statut'])) : $ternairError = false;
        $gabarit = htmlspecialchars($_POST['dateDebut']) ? htmlspecialchars($_POST['dateFin']) : $ternairError = false;
        $type = htmlspecialchars($_POST['descriptionNote']) ? htmlspecialchars($_POST['descriptionNote']) : $ternairError = false;

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
                            <legend style="font-size:37px;color:rgb(252,174,24);"><i class="fa fa-plus"></i> Ajouter une note</legend>
                            <div class="form-group has-feedback"><label for="from_email">Titre</label><input class="form-control" type="text" name="titreNote"></div>
                            <div class="form-group"><label for="calltime">Statue</label><input class="form-control" type="text" name="statutNote"></div>
                            <div class="form-row">
                                <div class="col-sm-6">
                                    <div class="form-group"><label for="calltime">Date - début&nbsp;</label><input class="form-control" type="date" name="dateDebut"></div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group"><label for="calltime">Date - Fin</label><input class="form-control" type="date" name="dateFin"></div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-12 col-md-6" id="message" style="padding-right:20px;padding-left:20px;">
                        <fieldset></fieldset>
                        <div class="form-group"><label for="Commentaire">Description</label><textarea class="form-control" rows="5" name="descriptionNote" placeholder="Entrer un description" id="comments"></textarea></div><button class="btn btn-success active btn-block btn-lg float-left"
                            type="submit" data-bs-hover-animate="rubberBand" style="max-width:170px;margin-top:none;margin-left:none;">Valider&nbsp;<i class="fa fa-check"></i></button><button class="btn btn-danger active btn-block btn-lg float-right" type="submit"
                            data-bs-hover-animate="shake" style="max-width:170px;margin:none;margin-top:0px;padding-top:none;padding-right:none;">Annuler&nbsp;<i class="fa fa-remove"></i></button>
                        <hr>
                    </div>
                    <div class="col-md-6" style="padding-left:20px;padding-right:20px;">
                        <fieldset></fieldset>
                    </div>
                    <div class="col-md-6" style="padding-left:20px;padding-right:20px;">
                        <fieldset></fieldset>
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
