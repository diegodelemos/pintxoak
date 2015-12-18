<?php
  include_once "../model/Contest.php";
  include_once "../core/Session.php";
  include_once "../core/Config.php";
  try{
    $contest = new Contest($coreDir.$contestFile);
  }
  catch(Exception $e){
    $session->putFlashMessage("error",$e->getMessage());
    header("Location: ..");
  }
