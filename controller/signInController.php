<?php
include_once "../core/Session.php";
$session = new Session();

try {
  if(isset($_POST["userName"]) && isset($_POST["password"])){
          $session->login($_POST["userName"], $_POST["password"]);
  } else {
      throw new Exception("Authentication failure");
  }
} catch (Exception $e) {
  $session->putFlashMessage("error",$e->getMessage());
}

header("Location: ../view/signIn.php");
