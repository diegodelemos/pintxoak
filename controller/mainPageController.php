<?php
  include_once "../model/Pincho.php";
  include_once "../model/Contest.php";
  include_once "../core/Config.php";

  try{
    $pinchos = Pincho::getAll();
    foreach ($pinchos as $pincho) {
      $pincho->getEstablishment()->populate();
    }
    $contest = new Contest($coreDir.$contestFile);
  }
  catch(Exception $e){
    $session->putFlashMessage("error",$e->getMessage());
  }
