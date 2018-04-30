<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.minPTU.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.minPTU.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="assets/css/stylesPTU.css">
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
                        <form class="float-left" style="width:460px;"><button class="btn btn-link btn-lg" onclick="document.location.href = 'ajouternote.php'" type="button" data-bs-hover-animate="pulse" style="font-size:23px;margin-bottom:3px;">Ajouter une note&nbsp;<i class="fa fa-plus"></i></button></form>
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
                                <thead style="color:rgb(255,255,255);background-color:#e18416;font-size:11px;">
                                    <tr>
                                        <th style="width:92px;">Titre&nbsp;<i class="fa fa-chevron-down"></i></th>
                                        <th style="width:90px;">Statuts&nbsp;<i class="fa fa-chevron-down"></i></th>
                                        <th style="width:120px;">Date début note&nbsp;<i class="  fa fa-chevron-down"></i></th>
                                        <th style="width:110px;">Date fin note&nbsp;<i class="fa fa-chevron-down"></i></th>
                                        <th style="width:106px;">Urgence&nbsp;<i class="fa fa-chevron-down"></i></th>
                                        <th>Description&nbsp;<i class="fa fa-chevron-down"></i></th>
                                        <th style="width:163px;">Proprietaire&nbsp;<i class="fa fa-chevron-down"></i></th>
                                    </tr>
                                </thead>
                                <?php
                                $sql = "SELECT * FROM note";
                                $reqproduit = $bdd->prepare($sql);
                                $reqproduit->execute();
                                $dbrep = $reqproduit->fetchAll();
                                foreach ($dbrep as $note) {
                                  ?>
                                  <tbody>
                                    <tr style="font-size:12px;">
                                      <form method="post">
                                        <td id="ticket<?php echo $note["idNotes"] ?>">
                                          <span><?php echo $note["idNotes"]; ?></span>
                                      </td>
                                      <td>
                                        <span><?php echo $note['titreNotes']?></span>
                                        <input type="text" class="form-control" name="modifititre" value="<?php echo $note['titreNotes']?>" style="display:none;">
                                      </td>
                                      <td>
                                        <span><?php echo $note['statutNotes']?></span>
                                        <input type="text" class="form-control" name="modifistatut" value="<?php echo $note['statutNotes']?>" style="display:none;">
                                      </td>
                                      <td>
                                        <span><?php echo $note['dateDebutNotes']?></span>
                                        <input type="text" class="form-control" name="modifidatedeb" value="<?php echo $note['dateDebutNotes']?>" style="display:none;">
                                      </td>
                                      <td>
                                        <span><?php echo $note['dateFinNotes']?></span>
                                        <input type="text" class="form-control" name="modifidatefin" value="<?php echo $note['dateFinNotes']?>" style="display:none;">
                                      </td>
                                      <td>
                                        <span><?php echo $note['descriptionNotes']?></span>
                                        <input type="text" class="form-control" name="modifidescription" value="<?php echo $note['descriptionNotes']?>" style="display:none;">
                                      </td>
                                      <td>
                                        <span><?php echo $note['proprietairetNotes']?></span>
                                        <input type="text" class="form-control" name="modifiproprietaire" value="<?php echo $note['proprietairetNotes']?>" style="display:none;">
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
    <script src="assets/js/jquery.minPTU.js"></script>
    <script src="assets/bootstrap/js/bootstrap.minPTU.js"></script>
    <script src="assets/js/bs-animationPTU.js"></script>
  </body>


</html>
