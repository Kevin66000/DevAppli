<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.minProfil.css">
    <link rel="stylesheet" href="assets/css/Profile-Edit-FormProfil.css">
    <link rel="stylesheet" href="assets/css/Profile-Edit-Form1Profil.css">
    <link rel="stylesheet" href="assets/css/stylesProfil.css">
</head>

<body>
      <?php include 'php/nav.php'; ?>
    <div class="container profile profile-view" id="profile">
        <div class="row">
            <div class="col-md-12 alert-col relative">
                <div class="alert alert-info absolue center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span>Profile save with success</span></div>
            </div>
        </div>
        <form>
            <div class="form-row profile-row">
                <div class="col-md-4 relative">
                    <div class="avatar">
                        <div class="avatar-bg center"></div>
                    </div><input type="file" name="avatar-file" class="form-control"></div>
                <div class="col-md-8">
                    <h1>Profile - (Speudo)</h1>
                    <hr>
                    <div class="form-row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>Nom</label><input class="form-control" type="text" name="firstname"></div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>Prenom</label><input class="form-control" type="text" name="lastname"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>Telephone - Fixe</label><input class="form-control" type="text" name="firstname"></div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>Telephone - Mobile</label><input class="form-control" type="text" name="firstname"></div>
                        </div>
                    </div>
                    <div class="form-group"><label>Email </label><input class="form-control" type="email" name="email" autocomplete="off" required=""></div>
                    <div class="form-row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>Password </label><input class="form-control" type="password" name="password" autocomplete="off" required=""></div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"><label>Confirm Password</label><input class="form-control" type="password" name="confirmpass" autocomplete="off" required=""></div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="col-md-12 content-right"><button class="btn btn-primary form-btn" type="submit">SAVE </button><button class="btn btn-danger form-btn" type="reset">CANCEL </button></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="assets/js/jquery.minProfil.js"></script>
    <script src="assets/bootstrap/js/bootstrap.minProfil.js"></script>
    <script src="assets/js/Profile-Edit-FormProfil.js"></script>
</body>

</html>
