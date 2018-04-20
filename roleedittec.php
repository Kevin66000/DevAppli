<?php
require 'php/include.php';


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
          </button>'roleedittec.php'

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
<!DOCTYPE html>
<html>
  <head>
    <title>page technique pour la gestion des role</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/stylesAccueil.min.css">
  </head>
  <body>

    <div class="container">
      <h2>Ajouter un role</h2>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addrole">Ajouter un role</button>


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

      <!-- role chart -->
      <table>
        <tr>
          <th>nom role</th>
          <th>voir les élément du parc</th>
          <th>modifier les éléments du parc</th>
          <th>voir ces composant</th>
          <th>voir tous les composants</th>
          <th>gérer les composants</th>
          <th>voir les tickets</th>
          <th>ajouter des tickets</th>
          <th>voir tous les tickets</th>
          <th>gérer les tickets</th>
          <th>voir les notes</th>
          <th>ajouter des notes</th>
          <th>supprimer des notes</th>
          <th>gérer les utilisateurs</th>
          <th>gérer les rôles</th>
        </tr>
        <?php

        //affiche toutes les role avec leur permissions
        foreach ($roles as $role) {
          //recupére les pérmissions d'un role
          $reqSelectRolePermissions = $bdd->prepare("SELECT * FROM droit WHERE droit.idRole = ? ORDER BY droit.idPermission ASC");
          $reqSelectRolePermissions->execute(array($role['idRole']));
          $RolePermissions = $reqSelectRolePermissions->fetchAll();
          ?>
          <tr id="role<?php echo $role["idRole"] ?>" >
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
              <td>
                <input type="hidden" name="valueidrole" value="<?php echo $role['idRole']; ?>">
                <button type="button" class="btn btn-warning" data-roleid="role<?php echo $role["idRole"] ?>" onclick="startroleedit(this)">Modifier</button>
                <button type="submit" class="btn btn-success" style="display:none" name="submiteditrole">✓</button>
                <button type="button" class="btn btn-danger" style="display:none" data-roleid="role<?php echo $role["idRole"] ?>" onclick="cancelroleedit(this)">✗</button>
              </td>
              <td>
                <form action="" method="post">
                  <input type="hidden" name="valueidrole" value="<?php echo $role['idRole']; ?>">
                  <button type="submit" class="btn btn-danger" name="submitrmrole" onclick="return confirm('confirmer la suppression du role');">Supprimer</button>
                </form>
              </td>
            </form>
          </tr>
          <?php
        }
        ?>
      </table>
    </div>
    <script src="/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/role.js"></script>
  </body>
</html>
