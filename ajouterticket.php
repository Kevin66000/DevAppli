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
      if (isset($_POST['formjouterticket'])) {

        //variable
        $ternairError = true;

        $nomCompo = !empty($_POST['titreTicket']) ? htmlspecialchars($_POST['titreTicket']) : $ternairError = false;
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
                            <legend style="font-size:37px;color:rgb(252,174,24);"><i class="fa fa-plus"></i> Ajouter un ticket</legend>
                            <div class="form-group has-feedback"><label for="from_email">Titre</label><input class="form-control" type="text" name="titreTicket"></div>
                            <div class="form-group"><label for="calltime">Urgence</label>
                              <select class="form-control" name="Call Time" required="" id="calltime">
                                <option value="">Etat</option>
                                <option value="">Très haute</option>
                                <option value="">Haute</option>
                                <option value="">Moyenne</option>
                                <option value="">Basse</option>
                                <option value="">Très basse</option>
                              </select>
                            </div>
                        </fieldset>
                        <div class="form-group has-feedback">
                          <label for="from_phone">Type</label>
                          <select class="form-control" name="Call Time" required="" id="calltime">
                            <option value="">Type</option>
                            <option value="">Incident</option>
                            <option value="">Demande</option>
                          </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6" id="message" style="padding-right:20px;padding-left:20px;">
                        <fieldset></fieldset>
                        <div class="form-group"><label for="Commentaire">Description</label><textarea class="form-control" rows="5" name="Comments" placeholder="Entrer un description" id="comments"></textarea></div><button class="btn btn-success active btn-block btn-lg float-left"
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
