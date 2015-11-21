<?php
  include_once "../model/Pincho.php";
  include_once "../core/Session.php":
  $session = new Session();

  try{
    $pinchos = Pincho::getAll();
    foreach ($pinchos as $pincho) {
      $pincho->getEstablishment()->populate();
    }
  }
  catch(Exception $e){
    $session->putFlashMessage("error",$e->getMessage());
  }
