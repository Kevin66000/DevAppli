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
class User{

  //proprietés
  private $iduser;
  private $pseudo;
  private $nom;
  private $prenom;
  private $email;
  private $tel;
  private $tel2;
  private $telMobile;
  private $matricule;
  private $role;

  //methodes
  function __construct(){
    $this->iduser = '';
    $this->pseudo = '';
    $this->nom = '';
    $this->prenom = '';
    $this->email = '';
    $this->tel = '';
    $this->tel2 = '';
    $this->telMobile = '';
    $this->matricule = '';
  }
  public function SurchargeBuilder($pId, $pPseudo, $pNom, $pPrenom, $pEmail, $pTel, $pTel2, $pTelMobile, $pMatricule){
    $this->iduser = $pId;
    $this->pseudo = $pPseudo;
    $this->nom = $pNom;
    $this->prenom = $pPrenom;
    $this->email = $pEmail;
    $this->tel = $pTel;
    $this->tel2 = $pTel2;
    $this->telMobile = $pTelMobile;
    $this->matricule = $pMatricule;
  }

  //accesseur
  public function SetIdUser($pId){
    $this->iduser = $pId;
  }
  public function GetIdUser(){
    return $this->iduser;
  }

  public function SetPseudo($pPseudo){
    $this->pseudo = $pPseudo;
  }
  public function GetPseudo(){
    return $this->pseudo;
  }

  public function SetNom($pNom){
    $this->nom = $pNom;
  }
  public function GetNom(){
    return $this->nom;
  }

  public function SetPrenom($pPrenom){
    $this->prenom = $pPrenom;
  }
  public function GetPrenom(){
    return $this->prenom;
  }

  public function SetEmail($pEmail){
    $this->email = $pEmail;
  }
  public function GetEmail(){
    return $this->email;
  }

  public function SetTel($pTel){
    $this->tel = $pTel;
  }
  public function GetTel(){
    return $this->tel;
  }

  public function SetTel2($pTel){
    $this->tel2 = $pTel;
  }
  public function GetTel2(){
    return $this->tel2;
  }

  public function SetTelMobile($pTelMobile){
    $this->telMobile = $pTelMobile;
  }
  public function GetTelMobile(){
    return $this->telMobile;
  }

  public function SetMatricule($pMatricule){
    $this->matricule = $pMatricule;
  }
  public function GetMatricule(){
    return $this->matricule;
  }

  public function SetRole(&$pRole){
    $this->role = $pRole;
  }

  public function GetRole(){
    return $this->role;
  }
}

?>
