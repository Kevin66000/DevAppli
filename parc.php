<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>parc</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
  </head>

  <body>
    <?php include 'php/nav.php';
    //test si l'utilisateur est connecter
    if (isset($_SESSION['idUser'])) {
      ?>
      <div class="container mb-5">
        <div class="row">
          <div class="col-12 col-md-6 border border-dark">
            <fieldset>
              <legend></legend>
              <div class="col-12 col-md">
                <h2></h2>
                <ul class="list-group" style="overflow:auto; height: 500px;" >
                </ul>
              </div>
            </fieldset>
          </div>
          <div class="col-12 col-md-6 border border-dark">
            <fieldset>
              <legend>salle i111</legend>
              <div class="col-12 col-md">
                <h2>Les machines</h2>
                <ul class="list-group" style="overflow:auto; height: 500px;" >
                  <?php
                  $reqcompoparc = $bdd->prepare("SELECT parcComposants.nomComposants, parcComposants.typeComposants FROM parcComposants, salle WHERE parcComposants.idSalle = salle.idSalle AND salle.libelleSalle = ?");
                  $reqcompoparc->execute(array("111i"));
                  foreach ($reqcompoparc->fetchAll() as $row) {
                    ?>
                    <li class="list-group-item"><?php echo $row['nomComposants']." | ".$row['typeComposants'] ?></li>
                    <?php
                  }
                  ?>
                </ul>
              </div>
            </fieldset>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-md-6 border border-dark">
            <fieldset>
              <legend>salle i110</legend>
              <div class="col-12 col-md">
                <h2>Les machines</h2>
                <ul class="list-group" style="overflow:auto; height: 500px;" >
                  <?php
                  $reqcompoparc = $bdd->prepare("SELECT parcComposants.nomComposants, parcComposants.typeComposants FROM parcComposants, salle WHERE parcComposants.idSalle = salle.idSalle AND salle.libelleSalle = ?");
                  $reqcompoparc->execute(array("110i"));
                  foreach ($reqcompoparc->fetchAll() as $row) {
                    ?>
                    <li class="list-group-item"><?php echo $row['nomComposants']." | ".$row['typeComposants'] ?></li>
                    <?php
                  }
                  ?>
                </ul>
              </div>
            </fieldset>
          </div>
          <div class="col-12 col-md-6 border border-dark">
            <fieldset>
              <legend>salle i111</legend>
              <div class="col-12 col-md">
                <h2>Les machines</h2>
                <ul class="list-group" style="overflow:auto; height: 500px;" >
                  <?php
                  $reqcompoparc = $bdd->prepare("SELECT parcComposants.nomComposants, parcComposants.typeComposants FROM parcComposants, salle WHERE parcComposants.idSalle = salle.idSalle AND salle.libelleSalle = ?");
                  $reqcompoparc->execute(array("111i"));
                  foreach ($reqcompoparc->fetchAll() as $row) {
                    ?>
                    <li class="list-group-item"><?php echo $row['nomComposants']." | ".$row['typeComposants'] ?></li>
                    <?php
                  }
                  ?>
                </ul>
              </div>
            </fieldset>
          </div>
        </div>
      </div>
      <?php
    }else {
      header("Location: /");//redirige ver la pages d'accueil
    }
    ?>
    <script src="/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
