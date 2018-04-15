function startroleedit(e) {
  let elmRoleId = "#"+$(e).attr("data-roleid"); //selection la ligne corespondent au role

  $(e).hide().next().show().next().show(); //masque le button modifier est affichier les button valider et annuler

  $(elmRoleId).find("input").each(function() {
    $( this ).attr("disabled", false);
  });
}

function cancelroleedit(e) {
  let elmRoleId = "#"+$(e).attr("data-roleid"); //selection la ligne corespondent au role

  $(e).hide().prev().hide().prev().show(); //masque les button valider et annuler et affiche le button modifier

  $(elmRoleId).find("input").each(function() {
    $( this ).attr("disabled", true);
  });
}
