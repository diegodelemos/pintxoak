<?php
  include_once "../core/Session.php";
  include_once "../core/Config.php";

  $session = new Session();

  if(isset($_GET["lang"]) && in_array($_GET["lang"],$availableLangs))
    $session->setLang($_GET["lang"]);

  header("Location: ..");
