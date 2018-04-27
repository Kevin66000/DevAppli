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


      <?php
    }else {
      header("Location: /");//redirige ver la pages d'accueil
    }
    ?>
    <script src="/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
