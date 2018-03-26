<?php
class Ticket {
private $statutTickets;
private $titreTickets;
private $dateOuvertureTickets;
private $urgenceTickets;
private $descriptionTickets;
private $proprietaireTickets;

public __construct(){
  $this->statutTickets;
  $this->titreTickets;
  $this->dateOuvertureTickets;
  $this->urgenceTickets;
  $this->descriptionTickets;
  $this->proprietaireTickets;
}

function getStatutTickets(){
  return $this->statutTickets;
}
function setStatutTickets($pStatutTickets){
  $this->statutTickets = $pStatutTickets;
}
function getTitreTckets(){
  return $this->titreTickets;
}
function setTitreTickets($pTitreTickets){
  $this->titreTickets = $pTitreTickets
}
function getDateOuvertureTickets(){
  return $this->dateOuverturerTickets;
}
function setDateOuvertureTickets($pDateOuvertureTickets){
  $this->dateOuvertureTickets = $pDateOuvertureTickets;
}
function getUrgenceTickets(){
  return $this->urgenceTickets;
}
function setUrgenceTickets($pUrgenceTickets){
  $this->urgenceTickets = $pUrgenceTickets;
}
function getDescriptionTickets(){
  return $this->descriptionTickets;
}
function setDescriptionTickets($pDescriptionTickets){
  $this->descriptionTickets = $pDescriptionTickets;
}
function getPropietaireTickets(){
  return $this->proprietaireTickets;
}
function setPropietaireTickets($pPropietaireTickets){
  $this->proprietaireTickets = $pPropietaireTickets;
}

}
 ?>
