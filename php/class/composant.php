<?php

  class Composant {
    private $nomCompo;
    private $lieu;
    private $statut;
    private $gabarit;
    private $type;
    private $fabricant;
    private $modele;
    private $numSerie;
    private $addrMac;
    private $referenceCompo;

    function __construct() {
      this->nomCompo;
      this->lieu;
      this->statut;
      this->gabarit;
      this->type;
      this->fabricant;
      this->modele;
      this->numSerie;
      this->addrMac;
      this->referenceCompo;
    }

    function getNomCompo() {
      return this->nomCompo;
    }
    function setNomCompo($pNomCompo) {
      this->nomCompo = $pNomCompo;
    }
    function getLieu() {
      return this->lieu;
    }
    function setLieu($pLieu) {
      this->lieu = $pLieu;
    }
    function getStatut() {
      return this->statut;
    }
    function setStatut($pStatut) {
      this->statut = $pStatut
    }
    function getGabarit() {
      return this->gabarit;
    }
    function setGabarit($pGabarit) {
      this->gabarit = $pGabarit;
    }
    function getType() {
      return this->type;
    }
    function setType($pType) {
      this->type = $pType;
    }
    function getFabricant() {
      return this->fabricant;
    }
    function setType($pFabricant) {
      this->fabricant = $pFabricant;
    }
    function getModele() {
      return this->modele;
    }
    function setModele($pModele) {
      this->modele = $pModele;
    }
    function getNumSerie() {
      return this->numSerie;
    }
    function setNumSerie($pNumSerie) {
      this->numSerie = $pNumSerie;
    }
    function getAddrMac() {
      return this->addrMac;
    }
    function setAddrMac($pAddrMac) {
      this->addrMac = $pAddrMac;
    }
    function getReferenceCompo() {
      return this->referenceCompo;
    }
    function setReferenceCompo($pReferenceCompo) {
      this->referenceCompo = $pReferenceCompo;
    }
}

 ?>
