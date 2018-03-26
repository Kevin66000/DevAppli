<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Untitled</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/css/swiper.min.css">
    <link rel="stylesheet" href="/assets/css/stylesAccueil.min.css">
  </head>

  <body>
    <?php include 'php/nav.php'; ?>
    <table class="table">
      <thead>
        <tr style="color:rgb(0,0,0);font-size:19px;">
          <th class="align-content-center"><span style="text-decoration: underline;">Identifiant</span></th>
          <th><span style="text-decoration: underline;">Entités (Profil)</span></th>
          <th><span style="text-decoration: underline;">Nom</span></th>
          <th><span style="text-decoration: underline;">Prénom</span></th>
          <th><span style="text-decoration: underline;">Adresse mail</span></th>
          <th><span style="text-decoration: underline;">Téléphone</span></th>
          <th><span style="text-decoration: underline;">Lieu</span></th>
          <th><span style="text-decoration: underline;">Actif</span></th>
          <th><span style="text-decoration: underline;">Langue</span></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><strong>Cell 1</strong></td>
          <td>Cell 2</td>
          <td>Cell 3</td>
          <td>Cell 3</td>
          <td>Cell 3</td>
          <td>Cell 3</td>
          <td>Cell 3</td>
          <td>Cell 3</td>
          <td>Cell 3</td>
        </tr>
      </tbody>
    </table>

    <div class="simple-slider"></div>
    <div></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js"></script>
  </body>
</html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compo</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.minPTU.css">
    <link rel="stylesheet" href="/assets/fonts/font-awesome.minPTU.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="/assets/css/Navigation-e-commercePTU.css">
    <link rel="stylesheet" href="/assets/css/Navigation-with-SearchPTU.css">
    <link rel="stylesheet" href="/assets/css/stylesPTU.css">
    <link rel="stylesheet" href="/assets/css/stylesAccueil.min.css">
  </head>

  <body>
    <?php include 'php/nav.php';
    if (isset($_SESSION['id']) && $_SESSION['pseudo'] == 'Admin') {
      if (isset($_POST['delproduit'])) {
        $reqdel = $bdd->prepare("DELETE FROM photoproduit WHERE IDProduit = ?");
        $reqdel->execute(array($_POST['id']));
        $reqdel = $bdd->prepare("DELETE FROM produits WHERE IDProduit = ?");
        $reqdel->execute(array($_POST['id']));
      }
    }
    ?>
    <div>
      <div class="container">
        <div class="row">
          <div class="col offset-lg-0">
            <div class="form-group" style="margin-top:10px;">
              <form class="float-left" style="width:460px;"><button class="btn btn-link btn-lg" onclick="document.location.href = 'parc/ajouterParcCompo.php'" type="button" data-bs-hover-animate="pulse" style="font-size:23px;margin-bottom:3px;">Ajouter un composant&nbsp;<i class="fa fa-plus"></i></button></form>
              <form class="float-right" style="width:460px;">
                <div class="input-group"><button class="btn btn-primary" type="button" style="margin-top:5px;">Recherche</button><input class="form-control" type="search" name="recherche" style="margin-left:5px;margin-top:5px;"></div>
              </form>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12" style="margin-top:10px;">
            <div>
              <div class="table-responsive">
                <table class="table">
                  <thead style="color:rgb(255,255,255);background-color:#e18416;font-size:12px;">
                    <tr style="font-size:11px;">
                      <th>Nom&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th>Référence&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th>Lieu&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th style="max-width:66px;">Statut&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th>Gabarit&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th>Type&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th style="width:110px;">Fabricant&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th>Modèle&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th>Num Série</th>
                      <th>Adresse MAC</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr style="font-size:12px;">
                      <td><strong>Cell 1</strong></td>
                      <td>Cell 2</td>
                      <td>Cell 3</td>
                      <td>Cell 4</td>
                      <td>Cell 5</td>
                      <td>Cell 6</td>
                      <td>Cell 7</td>
                      <td>Cell 8</td>
                      <td>Cell 9</td>
                      <td>Cell 10</td>
                      <td style="max-width:98px;">
                        <button class="btn btn-primary float-left" type="button" onclick="document.location.href = 'parc/ajouterParcCompo.php'" style="margin-right:0px;background-color:rgb(0,133,255);color:rgb(255,255,255);"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-primary float-right" type="button" name="delproduit" style="background-color:rgb(255,15,0);color:rgb(255,255,255);"><i class="fa fa-close"></i></button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="/assets/js/jquery.minPTU.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.minPTU.js"></script>
    <script src="/assets/js/bs-animationPTU.js"></script>
  </body>
</html>
