<?php
/**
 *classe role
 */
class role{
  //property
  private $libelleRole;
  private $permissions;

  //methode
  public function __construct($pLblbRole, $pPermissions){
    $this->$libellerole = $pLblbRole;
    $this->$permissions = $pPermissions;
  }

  public function GetRole(){
    return $this->$libellerole
  }

  public function GetPermission($pPermission){
    return $this->$permissions[$pPermission];
  }
}

?>
