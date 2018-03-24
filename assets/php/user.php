<?php
//l'objet est stoquer dans une sassion

/*
user->role->getpermition('libelle')

if (user->rolegetpermission('supprimernote') == true) {
  //supprimer la note
}else {
  //l'user n'a pas l'otorisation pour supprimer la note
}
*/

/**
 * classe user
 */
class user{

  //proprietés
  private $email;
  private $pseudo;
  private $nom;
  private $prenom;
  private $tel;
  private $telMobile;
  private $matricule;
  private $role;

  //methodes
  function __construct($pEmail, $pPseudo, $pNom, $pPrenom, $pTel, $pTelMobile, $pMatricule){
    $this->$email = $pEmail;
    $this->$pseudo = $pPseudo;
    $this->$nom = $pNom;
    $this->$prenom = $pPrenom;
    $this->$tel = $pTel;
    $this->$telMobile = $pTelMobile;
    $this->$matricule = $pMatricule;
  }

  //accesseur
  public function SetPseudo($pPseudo){
    $this->$pseudo = $pPseudo;
  }
  public function GetPseudo(){
    return $this->$pseudo;
  }

  public function SetNom($pNom){
    $this->$nom = $pNom;
  }
  public function GetNom(){
    return $this->$nom;
  }

  public function SetPrenom($pPrenom){
    $this->$prenom = $pPrenom;
  }
  public function GetPrenom(){
    return $this->$prenom;
  }

  public function SetTel($pTel){
    $this->$tel = $pTel;
  }
  public function GetTel(){
    return $this->$tel;
  }

  public function SetPrenom($pTelMobile){
    $this->$telMobile = $pTelMobile;
  }
  public function GetPrenom(){
    return $this->$telMobile;
  }

  public function SetPrenom($pMatricule){
    $this->$matricule = $pMatricule;
  }
  public function GetPrenom(){
    return $this->$matricule;
  }

  public function SetRole(&$pRole){
    $this->$role = $pRole;
  }

  public function GetRole(){
    return $this->role;
  }
}

?>
