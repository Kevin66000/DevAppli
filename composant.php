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
              <form class="float-left" style="width:460px;"><button class="btn btn-link btn-lg" onclick="document.location.href = 'ajoutercomposant.php'" type="button" data-bs-hover-animate="pulse" style="font-size:23px;margin-bottom:3px;">Ajouter un composant&nbsp;<i class="fa fa-plus"></i></button></form>
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
                  <?php
                  $reqSelectComposants = $bdd->prepare("SELECT * FROM utilisateur");
                  $reqSelectComposants->execute();
                  $composants = $reqSelectComposants->fetchAll();
                  foreach ($composants as $composant) {
                    ?>
                    <tbody>
                      <tr style="font-size:12px;">
                        <form method="post">
                          <td id="composant<?php echo $composant["idComposants"] ?>">
                            <span><?php echo $composant["idComposants"]; ?></span>
                        </td>
                        <td>
                          <span><?php echo $comosant['nomComposants']?></span>
                          <input type="text" class="form-control" name="modifinom" value="<?php echo $composant['nomComposants']?>" style="display:none;">
                        </td>
                        <td>
                          <span><?php echo $composant['referenceComposants']?></span>
                          <input type="text" class="form-control" name="modifinom" value="<?php echo $composant['referenceComposants']?>" style="display:none;">
                        </td>
                        <td>
                          <span><?php echo $composant['idSalle']?></span>
                          <input type="text" class="form-control" name="modifilieu" value="<?php echo $composant['idSalle']?>" style="display:none;">
                        </td>
                        <td>
                          <span><?php echo $composant['statutComposants']?></span>
                          <input type="text" class="form-control" name="modifistatut" value="<?php echo $composant['statutComposants']?>" style="display:none;">
                        </td>
                        <td>
                          <span><?php echo $composant['gabaritComposants']?></span>
                          <input type="text" class="form-control" name="modifigabarit" value="<?php echo $composant['gabaritComposants']?>" style="display:none;">
                        </td>
                        <td>
                          <span><?php echo $composant['typeComposants']?></span>
                          <input type="text" class="form-control" name="modifitype" value="<?php echo $composant['typeComposants']?>" style="display:none;">
                        </td>
                        <td>
                          <span><?php echo $composant['fabricantComposants']?></span>
                          <input type="text" class="form-control" name="modififabricant" value="<?php echo $composant['fabricantComposants']?>" style="display:none;">
                        </td>
                        <td>
                          <span><?php echo $composant['modeleComposants']?></span>
                          <input type="text" class="form-control" name="modifimodele" value="<?php echo $composant['modeleComposants']?>" style="display:none;">
                        </td>
                        <td>
                          <span><?php echo $composant['numSerieComposants']?></span>
                          <input type="text" class="form-control" name="modifinumSerie" value="<?php echo $composant['numSerieComposants']?>" style="display:none;">
                        </td>
                        <td>
                          <span><?php echo $composant['addressMacComposants']?></span>
                          <input type="text" class="form-control" name="modifiaddreMAc" value="<?php echo $composant['addressMacComposants']?>" style="display:none;">
                        </td>
                          <?php
                          if ($user['actifUtilisateur'] == 1) {
                            ?>
                            <input type="checkbox" class="form-control" name="modifiactif[]" value="cocher" checked disabled>
                            <?php
                          }else {
                            ?>
                            <input type="checkbox" class="form-control" name="modifiactif[]" value="cocher" disabled>
                            <?php
                          }?>
                        </td>
                      </form>
                    </tr>
                    <?php
                  }
                  ?>
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
