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
    if (isset($_SESSION['idUser'])) {

      if (isset($_POST['submiteditcompo'])) {

        $valueidcompo = !empty($_POST['valueidcompo']) ? htmlspecialchars($_POST['valueidcompo']) : null;
        $modifinom = !empty($_POST['modifinom']) ? htmlspecialchars($_POST['modifinom']) : null;
        $modifiref = !empty($_POST['modifiref']) ? htmlspecialchars($_POST['modifiref']) : null;
        $modifisalle = !empty($_POST['modifisalle']) ? intval(htmlspecialchars($_POST['modifisalle'])) : null;
        $modifigabarit = !empty($_POST['modifigabarit']) ? htmlspecialchars($_POST['modifigabarit']) : null;
        $modifitype = !empty($_POST['modifitype']) ? htmlspecialchars($_POST['modifitype']) : null;
        $modififabricant = !empty($_POST['modififabricant']) ? htmlspecialchars($_POST['modififabricant']) : null;
        $modifimodele = !empty($_POST['modifimodele']) ? htmlspecialchars($_POST['modifimodele']) : null;
        $modifinumSerie = !empty($_POST['modifinumSerie']) ? htmlspecialchars($_POST['modifinumSerie']) : null;
        $modifiaddreMAc = !empty($_POST['modifiaddreMAc']) ? htmlspecialchars($_POST['modifiaddreMAc']) : null;


        $requpdateuser = $bdd->prepare("UPDATE `parcComposants` SET nomComposants = ?, gabaritComposants = ?, typeComposants = ?,`fabricantComposants`= ?,`modeleComposants`= ?,`numSerieComposants`= ?,`addressMacComposants`= ?,`referenceComposants`= ?,`idSalle`= ? WHERE idComposants = ?");
        $requpdateuser->execute(array($modifinom, $modifigabarit, $modifitype, $modififabricant, $modifimodele, $modifinumSerie, $modifiaddreMAc, $modifiref, $modifisalle, $valueidcompo));

        }

      if (isset($_POST['submitrmcompo'])) {
        $reqdel = $bdd->prepare("UPDATE `parcComposants` SET corbeilleComposants = 1 WHERE idComposants = ?");
        $reqdel->execute(array($_POST['valueidcompo']));
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
                      <th>id&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th>Nom&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th>Référence&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th>Lieu&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th>Gabarit&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th>Type&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th style="width:110px;">Fabricant&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th>Modèle&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th>Num Série</th>
                      <th>Adresse MAC</th>
                    </tr>
                  </thead>
                  <?php
                  $sql = "SELECT * FROM parcComposants WHERE corbeilleComposants = 0";
                  $reqproduit = $bdd->prepare($sql);
                  $reqproduit->execute();
                  $dbrep = $reqproduit->fetchAll();
                  foreach ($dbrep as $composant) {
                    ?>
                    <tbody>
                      <tr style="font-size:12px;">
                        <form method="post">
                          <td id="compo<?php echo $composant["idComposants"] ?>">
                            <span><?php echo $composant["idComposants"]; ?></span>
                          </td>
                        <td>
                          <span><?php echo $composant['nomComposants']?></span>
                          <input type="text" class="form-control" name="modifinom" value="<?php echo $composant['nomComposants']?>" style="display:none;">
                        </td>
                        <td>
                          <span><?php echo $composant['referenceComposants']?></span>
                          <input type="text" class="form-control" name="modifiref" value="<?php echo $composant['referenceComposants']?>" style="display:none;">
                        </td>
                        <td>
                          <span><?php echo $composant['idSalle']?></span>
                          <input type="text" class="form-control" name="modifisalle" value="<?php echo $composant['idSalle']?>" style="display:none;">
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
                        <td style="width: 150px; display: inline-block;">
                          <input type="hidden" name="valueidcompo" value="<?php echo $composant['idComposants']; ?>">
                          <button class="btn btn-primary" type="button" data-compoid="compo<?php echo $composant['idComposants']; ?>" onclick="startcompoedit(this)" style="margin-right:0px;background-color:rgb(0,133,255);color:rgb(255,255,255);"><i class="fa fa-edit"></i></button>

                          <button type="submit" class="btn btn-success" style="display:none" name="submiteditcompo">✓</button>
                          <button type="button" class="btn btn-danger" style="display:none" data-compoid="compo<?php echo $composant['idComposants'] ?>" onclick="cancelcompoedit(this)">✗</button>
                          <form method="post">
                            <input type="hidden" name="valueidcompo" value="<?php echo $composant['idComposants']; ?>">
                            <button class="btn btn-danger" type="submit" name="submitrmcompo" onclick="return confirm('confirmer la suppression du composant);" style="background-color:rgb(255,15,0);color:rgb(255,255,255);"><i class="fa fa-close"></i></button>
                          </form>
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
    <script src="/assets/js/compo.js"></script>
  </body>
</html>
