<?php
  include_once "../model/Request.php";
  include_once "../core/Session.php";
  try{
    $requests = Request::getAll();
  }
  catch(Exception $e){
    $session->putFlashMessage("error",$e->getMessage());
    header("Location: ..");
  }
