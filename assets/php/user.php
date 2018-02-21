<?php
// une class qui contien lutilisateur est son role
//la class est stoquer dans une sassion
/* exemple d'objet :

user = {
  name:"toto",
  role:"visiteur"
}

role = {
  visiteur:{
    creatNote:true,
    deleteNote:false,
    createTiket:true,
    deleteTiket:false
  },
  admin:{
    creatNote:true,
    deleteNote:true,
    createTiket:true,
    deleteTiket:true
  }
}

if (role[user->role]->deleteNote == true) {
  //supprimer la note
}else {
  //l'user n'a pas l'otorisation pour supprimer la note
}
*/



/**
 * classe user
 */
class user{
  //attribut


  //methodes
  function __construct(argument){
    # code...
  }
}

?>
