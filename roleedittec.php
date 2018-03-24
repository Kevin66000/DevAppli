<!DOCTYPE html>
<html>
  <head>
    <title>page technique pour la gestion des role</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  </head>
  <body>

    <div class="container">
      <h2>Ajouter un role</h2>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addrole">Ajouter un role</button>


      <!-- les modale -->
      <div class="modal fade" id="addrole">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Ajouter un role</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form class="" action="" method="post">
              <div class="modal-body">
                <input type="text" name="nomRole" value="" placeholder="Nom du role">
                <?php

                $reqSelectPermissions = $bdd->prepare("SELECT * FROM permission");
                $reqSelectPermissions->execute();
                $permissions = $reqSelectPermissions->fetchAll();

                foreach ($permissions as $pPermission) {
                  ?>
                  <input type="checkbox" name="pe" value="<?php echo $permission['idPermission']; ?>"><?php echo $permission['libellerPermission']; ?>
                  <?php
                }
                ?>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-success" data-dismiss="modal">Valider</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
