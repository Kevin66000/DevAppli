<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Untitled</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/css/swiper.min.css">
    <link rel="stylesheet" href="./assets/css/stylesAccueil.min.css">
</head>

<body>
    <?php include 'nav.php'; ?>
    <table class="table">
        <thead>
            <tr style="color:rgb(0,0,0);font-size:19px;">
                <th class="align-content-center"><span style="text-decoration: underline;">Nom</span></th>
                <th><span style="text-decoration: underline;">Reference</span></th>
                <th><span style="text-decoration: underline;">Lieu</span></th>
                <th><span style="text-decoration: underline;">Statut</span></th>
                <th><span style="text-decoration: underline;">Gabarit</span></th>
                <th><span style="text-decoration: underline;">Type</span></th>
                <th><span style="text-decoration: underline;">Fabricant</span></th>
                <th><span style="text-decoration: underline;">Modèle</span></th>
                <th><span style="text-decoration: underline;">Num Série</span></th>
                <th><span style="text-decoration: underline;">Adresse Mac</span></th>
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
                <td>Cell 3</td>
            </tr>
        </tbody>
    </table>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>
