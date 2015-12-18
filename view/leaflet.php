<?php
  include_once "../core/Session.php";
  $session = new Session();
  if(!$session->isLogged()){
    $session->putFlashMessage("error","You are not signed in");
    header("Location: .");
  }
  if($session->getData()["type"] != "organizer"){
    $session->putFlashMessage("error","You shall not pass");
    header("Location: .");
  }
  include_once "../core/Lang.php";
  include_once "../core/Config.php";
  include_once "../controller/generateLeafletController.php";
  $userLang = $session->getData()["lang"];
  $title = "<h2>".$lang[$userLang]['Generate Leaflet']."</h2>";
  ob_start();
  ?>

	<div class="jumbotron">
          <h1><?=$contest->getName(); ?></h1>
	  <p><?= $lang[$userLang]['Start Date'].": ".$contest->getStartDate()?></p>
	  <p><?= $lang[$userLang]['End Date'].": ".$contest->getEndDate()?></p>
	</div>

  <?php

  $content = ob_get_clean();
  include_once "layout.php";
