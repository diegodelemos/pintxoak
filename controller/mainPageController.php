<?php
  include_once "../model/Pincho.php";

  try{
    $pinchos = Pincho::getAll();
    foreach ($pinchos as $pincho) {
      $pincho->getEstablishment()->populate();
    }
  }
  catch(Exception $e){
    $session->putFlashMessage("error",$e->getMessage());
  }
