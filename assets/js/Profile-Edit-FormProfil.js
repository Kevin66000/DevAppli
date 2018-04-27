$(function(){
  function readURL(input) {

    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('.avatar-bg').css({
          'background':'url('+e.target.result+')',
          'background-size':'cover',
          'background-position': '50% 50%'
        });
      };

      reader.readAsDataURL(input.files[0]);
    }
  }

  function toggleAlert(clasz, display, text){
    $(".alert")
    .removeClass("display")
    .removeClass("alert-info")
    .removeClass("alert-success")
    .removeClass("alert-danger")
    .addClass(clasz);
    if(display){
      $(".alert").addClass("display")
    }
    if(clasz === "alert-success"){
      $(".alert > span").text(text);
    }else if(clasz === "alert-danger"){
      $(".alert > span").text(text);
    }
  }

  $("input.form-control[name=avatar-file]").change(function(){
    readURL(this);
  });

  $('#profile').on('submit', 'form', function (e) {
    var inst = this;
    var formData = new FormData($(this)[0]);

    $(inst).find("button[type = submit]").addClass("loading").prop("disabled", true);

    $.ajax({
      url: "/php/editprofil.php",
      method: "post",
      data: formData,
      enctype: 'multipart/form-data',
      contentType: false,
      processData: false,
      success: function (result) {
        toggleAlert("alert-success", true, result);
      },
      error: function (error) {
        console.log("erreur : "+error.responseText);
      }
    })

    setTimeout(function(){
      $(inst).find("button[type = submit]").removeClass("loading").prop("disabled", false);
      toggleAlert("alert-success");
    },4000);

    return false;
  });

  $('#profile').on('reset', 'form', function (e) {
    var inst = this;
    var formData = new FormData($(this)[0]);

    $(inst).find("button[type = reset]").addClass("loading").prop("disabled", true);
    toggleAlert("alert-danger",true, 'Modification annuler');

    setTimeout(function(){
      $(inst).find("button[type = reset]").removeClass("loading").prop("disabled", false);
      toggleAlert("alert-danger");
    },1000);

    if (confirm("voulez-vous annuler les modification ?")) {
      return true;
    }else {
      return false;
    }
  });
})
