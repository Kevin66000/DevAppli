function startuseredit(e) {
  let elmUserId = "#"+$(e).attr("data-userid"); //selection la ligne corespondent au role

  $(e).
  hide().next().show().next().show(); //masque le button modifier est affichier les button valider et annuler

  $(elmUserId).next().children().hide().next().show()
  .parent().next().children().hide().next().show()
  .parent().next().children().hide().next().show()
  .parent().next().children().hide().next().show()
  .parent().next().children().hide().next().show()
  .parent().next().children().hide().next().show()
  .parent().next().children().hide().next().show()
  .parent().next().children().hide().next().show()
  .parent().next().children().attr("disabled", false)
  .parent().next().children().hide().next().show();//masque les span et affiche les input
}

function canceluseredit(e) {
  let elmUserId = "#"+$(e).attr("data-userid"); //selection la ligne corespondent au role

  $(e).hide().prev().hide().prev().show(); //masque les button valider et annuler et affiche le button modifier
  $(elmUserId).next().children().show().next().hide()
  .parent().next().children().show().next().hide()
  .parent().next().children().show().next().hide()
  .parent().next().children().show().next().hide()
  .parent().next().children().show().next().hide()
  .parent().next().children().show().next().hide()
  .parent().next().children().show().next().hide()
  .parent().next().children().show().next().hide()
  .parent().next().children().attr("disabled", true)
  .parent().next().children().show().next().hide();//masque les input et affiche les span

}
