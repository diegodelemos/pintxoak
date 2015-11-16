<?php
include_once "../core/Session.php";

try {
  if(isset($_POST["userName"]) && isset($_POST["password"])){
          $session = new Session();
          $session->login($_POST["userName"], $_POST["password"]);
          print_r($session->getData());
          echo "login correct";

  } else {
      echo "Failed to auth";
  }
} catch (Exception $e) {
  echo $e->getMessage();
}
