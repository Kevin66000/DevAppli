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

    //selectionne les toutes les utilisateurs
    $reqSelectUsers = $bdd->prepare("SELECT * FROM utilisateur");
    $reqSelectUsers->execute();
    $users = $reqSelectUsers->fetchAll();
    ?>
    <div>
      <div class="container">
        <div class="row">
          <div class="col offset-lg-0">
            <div class="form-group" style="margin-top:10px;">
              <form class="float-left" style="width:460px;"><button class="btn btn-link btn-lg" onclick="document.location.href = 'ajouterutilisateur.php'" type="button" data-bs-hover-animate="pulse" style="font-size:23px;margin-bottom:3px;">Ajouter un utilisateur&nbsp;<i class="fa fa-plus"></i></button></form>
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
                      <th>Identifiant&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th>Entités (Profil)&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th>Nom&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th>Prenom&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th>Adresse email&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th style="min-width:110px;">Telephone&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th>Telephone secondaire&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th>Telephone portable&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th>Matricule&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th>Actif&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th>Role&nbsp;<i class="fa fa-chevron-down"></i></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($users as $user) {
                      ?>
                      <tr style="font-size:12px;">
                        <td id="user<?php echo $user["idUtilisateur"]; ?>">
                          <span><?php  echo $user["idUtilisateur"]; ?></span>
                        </td>
                        <td>
                          <span><?php echo $user['nomAfficher']?></span>
                          <input type="text" name="modifipseudo" value="<?php echo $user['nomAfficher']?>">
                        </td>
                        <td>
                          <span><?php echo $user['nomUtilisateur']?></span>
                          <input type="text" name="modifipseudo" value="<?php echo $user['nomUtilisateur']?>">
                        </td>
                        <td>
                          <span><?php echo $user['prenomUtilisateur']?></span>
                          <input type="text" name="modifipseudo" value="<?php echo $user['prenomUtilisateur']?>">
                        </td>
                        <td>
                          <span><?php echo $user['emailUtilisateur']?></span>
                          <input type="text" name="modifipseudo" value="<?php echo $user['emailUtilisateur']?>">
                        </td>
                        <td>
                          <span><?php echo $user['telUtilisateur']?></span>
                          <input type="text" name="modifipseudo" value="<?php echo $user['telUtilisateur']?>">
                        </td>
                        <td>
                          <span><?php echo $user['tel2Utilisateur']?></span>
                          <input type="text" name="modifipseudo" value="<?php echo $user['tel2Utilisateur']?>">
                        </td>
                        <td>
                          <span><?php echo $user['telMobileUtilisateur']?></span>
                          <input type="text" name="modifipseudo" value="<?php echo $user['telMobileUtilisateur']?>">
                        </td>
                        <td>
                          <span><?php echo $user['matriculeUtilisateur']?></span>
                          <input type="text" name="modifipseudo" value="<?php echo $user['matriculeUtilisateur']?>">
                        </td>
                        <td>
                          <span><?php echo $user['actifUtilisateur']?></span>
                          <input type="text" name="modifipseudo" value="<?php echo $user['actifUtilisateur']?>">
                        </td>
                        <td>
                          <span><?php echo $user['idRole']?></span>
                          <select class="form-control" name="idrole" required="">
                            <?php
                            //charge les roles
                            $reqsalle = $bdd->prepare("SELECT * FROM role");
                            $reqsalle->execute();
                            foreach ($reqsalle->fetchAll() as $row) {
                              if ($row["idRole"] == $user['idRole']) {
                                echo '<option value="'.$row["idRole"].'" selected>'.$row["libellerRole"].'</option>';
                              }else {
                                echo '<option value="'.$row["idRole"].'">'.$row["libellerRole"].'</option>';
                              }
                            }
                            ?>
                          </select>
                        </td>
                        <td style="width:110px;">
                          <button class="btn btn-primary float-left" type="button" onclick="document.location.href = 'parc/ajouterParcCompo.php'" style="margin-right:0px;background-color:rgb(0,133,255);color:rgb(255,255,255);"><i class="fa fa-edit"></i></button>
                          <button class="btn btn-danger float-right" type="button" name="delproduit" style="background-color:rgb(255,15,0);color:rgb(255,255,255);"><i class="fa fa-close"></i></button>
                        </td>
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
