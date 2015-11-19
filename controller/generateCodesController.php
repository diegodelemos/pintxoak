<?php
include_once "../core/Session.php";
include_once "../model/Establishment.php";
$session = new Session();
try {
  if($session->isLogged()){
    if($session->getData()["type"] == "establishment"){
      if(isset($_POST["numberCodes"])&&$_POST["numberCodes"]){
        $establishment = new Establishment($session->getData["userName"],null,
          null,null,null);
        $numCode
        $codes = $establishment->getPincho()->getCodes($_POST["numberCodes"]);
        include_once "../view/codes.php";
      }
      else
        throw new Exception("You must enter a number of codes to generate");
    }
    else
      throw new Exception("You shall not pass");
  } else
    throw new Exception("You are not signed in");
} catch (Exception $e) {
  $session->putFlashMessage("error",$e->getMessage());
}

header("Location: ../view/generateCodes.php");
