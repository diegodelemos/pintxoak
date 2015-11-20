<?php
include_once "../core/Session.php";
include_once "../model/Request.php";
if(!isset($session)) $session = new Session();
try {
  if($session->isLogged()){
    if($session->getData()["type"] == "organizer"){
      if(isset($_GET["id"])){
        $request = new Request($_GET['id'],null,null,null,null,null,null,null,
        null,null,null,null);
        $request->delete();
      }
      else
        throw new Exception("You shall not pass");
    }
    else
      throw new Exception("You shall not pass");
  } else
    throw new Exception("You are not signed in");
} catch (Exception $e) {
  $session->putFlashMessage("error",$e->getMessage());
}
header("Location: ../view/requestList.php");
