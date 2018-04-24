<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>role</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.minPTU.css">
    <link rel="stylesheet" href="/assets/fonts/font-awesome.minPTU.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="/assets/css/Navigation-e-commercePTU.css">
    <link rel="stylesheet" href="/assets/css/Navigation-with-SearchPTU.css">
    <link rel="stylesheet" href="/assets/css/stylesPTU.css">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/stylesAccueil.min.css">
  </head>
  <body>
    <?php include 'php/nav.php';
    //selectionne les toutes les permissions
    $reqSelectPermissions = $bdd->prepare("SELECT * FROM permission");
    $reqSelectPermissions->execute();
    $permissions = $reqSelectPermissions->fetchAll();

    //si le button ajouter un role est activer
    if (isset($_POST['submitaddrole'])) {
      if (!empty($_POST['nomRole'])) {//test si un nom a êtait donner au role
        //variable
        $nomRole = htmlspecialchars($_POST['nomRole']);
        $pe = !empty($_POST['pe'])? $_POST['pe'] : [];


        if (nomRoleExiste($nomRole)) {
          $bdd->prepare("INSERT INTO role(libellerRole) VALUES(?)")->execute(array($nomRole));//ajoute un role
          $reqGetIdRole = $bdd->prepare("SELECT role.idRole FROM role WHERE libellerRole = ?");//récupére l'id du role
          $reqGetIdRole->execute(array($nomRole));
          $repGetIdRole = $reqGetIdRole->fetch();

          //ajoute les permissions au role
          foreach ($permissions as $permission) {
            if (isInList($permission["idPermission"], $pe)) {
              //ajoute la permition a true
              $bdd->prepare("INSERT INTO droit(blnAvoir, idRole, idPermission) VALUES(true, ?, ?)")->execute(array($repGetIdRole['idRole'], $permission["idPermission"]));
            }else {
              //ajoute la permition a false
              $bdd->prepare("INSERT INTO droit(blnAvoir, idRole, idPermission) VALUES(false, ?, ?)")->execute(array($repGetIdRole['idRole'], $permission["idPermission"]));
            }
          }

        }else {
          ?>
          <div class="container">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">le role existe déja!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>

            </div>
          </div>
          <?php
        }
      }else {
        ?>
        <div class="container">
          <div class="alert alert-warning alert-dismissible fade show" role="alert">Donner un nom au role!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
        <?php
      }
    }

    //si le button modifier un role est activer
    if (isset($_POST['submiteditrole']) && isset($_POST['valueidrole']) && !empty($_POST['valueidrole'])) {
      $valueidrole = htmlspecialchars($_POST['valueidrole']);
      $epe = !empty($_POST['ePe'])? $_POST['ePe'] : [];

      //modifie les permissions du role
      foreach ($permissions as $permission) {
        if (isInList($permission["idPermission"], $epe)) {
          //modifie la permition a true
          $bdd->prepare("UPDATE droit SET droit.blnAvoir = true WHERE droit.idRole = ? AND droit.idPermission = ?")->execute(array($valueidrole, $permission["idPermission"]));
        }else {
          //modifie la permition a false
          $bdd->prepare("UPDATE droit SET droit.blnAvoir = false WHERE droit.idRole = ? AND droit.idPermission = ?")->execute(array($valueidrole, $permission["idPermission"]));
        }
      }
    }

    //si le button supprimer un role est activer
    if (isset($_POST['submitrmrole']) && isset($_POST['valueidrole']) && !empty($_POST['valueidrole'])) {
      $valueidrole = htmlspecialchars($_POST['valueidrole']);
      //supprime le role de la bdd
      $bdd->prepare("DELETE FROM droit WHERE droit.idRole = ?; DELETE FROM role WHERE role.idRole = ?")->execute(array($valueidrole, $valueidrole));
    }

    //selectionne les toutes les roles
    $reqSelectRoles = $bdd->prepare("SELECT role.idRole, role.libellerRole FROM role;");
    $reqSelectRoles->execute();
    $roles = $reqSelectRoles->fetchAll();
    ?>

    <!-- les modale -->
    <!-- modale pour ajouter un role -->
    <div class="modal fade" id="addrole">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Ajouter un role</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <form class="" action="" method="post">
            <div class="modal-body">
              <input type="text" name="nomRole" value="" placeholder="Nom du role">
              <div class="row m-2">
                <?php
                //affiche toutes les permissions
                foreach ($permissions as $permission) {
                  ?>
                  <div class="col-*-* m-1">
                    <input type="checkbox" name="pe[]" value="<?php echo $permission['idPermission']; ?>"> <?php echo $permission['libellerPermission']; ?>
                  </div>
                  <?php
                }
                ?>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
              <button type="submit" class="btn btn-success" name="submitaddrole">Valider</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div>
      <div class="container">
        <div class="row">
          <div class="col offset-lg-0">
            <div class="form-group" style="margin-top:10px;">
                <button class="btn btn-link btn-lg" type="button" data-bs-hover-animate="pulse" data-toggle="modal" data-target="#addrole" style="font-size:23px;margin-bottom:3px;">Ajouter un role&nbsp;<i class="fa fa-plus"></i></button>
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
                      <th>nom role&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th>voir les élément du parc&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th>modifier les éléments du parc&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th>voir ces composant&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th>voir tous les composants&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th>gérer les composants&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th>voir les tickets&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th>ajouter des tickets&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th>voir tous les tickets&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th>gérer les tickets&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th>voir les notes&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th>ajouter des notes&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th>supprimer des notes&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th>gérer les utilisateurs&nbsp;<i class="fa fa-chevron-down"></i></th>
                      <th>gérer les rôles&nbsp;<i class="fa fa-chevron-down"></i></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    //affiche toutes les role avec leur permissions
                    foreach ($roles as $role) {
                      //recupére les pérmissions d'un role
                      $reqSelectRolePermissions = $bdd->prepare("SELECT * FROM droit WHERE droit.idRole = ? ORDER BY droit.idPermission ASC");
                      $reqSelectRolePermissions->execute(array($role['idRole']));
                      $RolePermissions = $reqSelectRolePermissions->fetchAll();
                      ?>
                      <tr id="role<?php echo $role["idRole"] ?>" style="font-size:12px;">
                        <form action="" method="post">
                          <td><?php echo $role["libellerRole"] //affiche le nom du role?></td>
                          <?php

                          //affiche toute les permissions
                          foreach ($RolePermissions as $RolePermission) {
                            if ($RolePermission['blnAvoir'] == 1) {
                              ?>
                              <td style="text-align: center;">
                                <input type="checkbox" name="ePe[]" value="<?php echo $RolePermission['idPermission'] ?>" checked disabled>
                              </td>
                              <?php
                            }else {
                              ?>
                              <td style="text-align: center;">
                                <input type="checkbox" name="ePe[]" value="<?php echo $RolePermission['idPermission'] ?>" disabled>
                              </td>
                              <?php
                            }
                          }
                          ?>
                          <td style="width:110px;">
                            <input type="hidden" name="valueidrole" value="<?php echo $role['idRole']; ?>">
                            <button class="btn btn-primary float-left" type="button" data-roleid="role<?php echo $role["idRole"] ?>" onclick="startroleedit(this)" style="margin-right:0px;background-color:rgb(0,133,255);color:rgb(255,255,255);"><i class="fa fa-edit"></i></button>

                            <button type="submit" class="btn btn-success" style="display:none" name="submiteditrole">✓</button>
                            <button type="button" class="btn btn-danger" style="display:none" data-roleid="role<?php echo $role["idRole"] ?>" onclick="cancelroleedit(this)">✗</button>
                          </td>
                          <td>
                            <form action="" method="post">
                              <input type="hidden" name="valueidrole" value="<?php echo $role['idRole']; ?>">
                              <button class="btn btn-danger float-right" type="submit" name="submitrmrole" onclick="return confirm('confirmer la suppression du role');" style="background-color:rgb(255,15,0);color:rgb(255,255,255);"><i class="fa fa-close"></i></button>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/jquery.minPTU.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.minPTU.js"></script>
    <script src="/assets/js/bs-animationPTU.js"></script>
    <script src="/assets/js/role.js"></script>
  </body>
</html>
