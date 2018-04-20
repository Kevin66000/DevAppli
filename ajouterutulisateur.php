<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ajouterCompo</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.minAjC.css">
    <link rel="stylesheet" href="/assets/fonts/font-awesome.minAjC.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="/assets/css/ss-contactAjC.css">
    <link rel="stylesheet" href="/assets/css/stylesAjC.css">
  </head>
  <body>
    <div class="container-fluid">
          <form action="javascript:void();" method="get" id="contactForm" style="padding:15px;">
              <div class="form-row" style="margin-left:0px;margin-right:0px;padding:10px;">
                  <div class="col-12 col-md-6" id="message" style="padding-right:20px;padding-left:20px;">
                      <fieldset>
                          <legend style="font-size:37px;color:rgb(252,174,24);"><i class="fa fa-plus"></i> Ajouter un utilisateur</legend>
                          <div class="form-group has-feedback"><label for="from_email">Matricule</label><input class="form-control" type="email" name="titreTicket" required="" id="from_email"></div>
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
                      </fieldset>
                  </div>
                  <div class="col-12 col-md-6" id="message" style="padding-right:20px;padding-left:20px;">
                      <fieldset></fieldset>
                      <div class="form-group" style="margin-top:63px;"><label>Email </label><input class="form-control" type="email" name="email" autocomplete="off" required=""></div>
                      <div class="form-row">
                          <div class="col-sm-12 col-md-6">
                              <div class="form-group"><label>Password </label><input class="form-control" type="password" name="password" autocomplete="off" required=""></div>
                          </div>
                          <div class="col-sm-12 col-md-6">
                              <div class="form-group"><label>Confirm Password</label><input class="form-control" type="password" name="confirmpass" autocomplete="off" required=""></div>
                          </div>
                      </div><button class="btn btn-success active btn-block btn-lg float-left" type="submit" data-bs-hover-animate="rubberBand" style="max-width:170px;margin-top:none;margin-left:none;">Valider&nbsp;<i class="fa fa-check"></i></button>
                      <button
                          class="btn btn-danger active btn-block btn-lg float-right" type="submit" data-bs-hover-animate="shake" style="max-width:170px;margin:none;margin-top:0px;padding-top:none;padding-right:none;">Annuler&nbsp;<i class="fa fa-remove"></i></button>
                          <hr>
                  </div>
                  <div class="col-md-6" style="padding-left:20px;padding-right:20px;">
                      <fieldset></fieldset>
                  </div>
                  <div class="col-md-6" style="padding-left:20px;padding-right:20px;">
                      <fieldset></fieldset>
                  </div>
              </div>
          </form>
      </div>
    <script src="/assets/js/jquery.minAjC.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.minAjC.js"></script>
    <script src="/assets/js/bs-animationAjC.js"></script>
  </body>
  </html>
