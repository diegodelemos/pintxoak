<?php
  include_once "../core/Session.php";
  $session = new Session();
  if(!$session->isLogged()){
    $session->putFlashMessage("error","You are not signed in");
    header("Location: .");
  }
  else if($session->getData()["type"] != "establishment"){
    $session->putFlashMessage("error","You shall not pass");
    header("Location: .");
  }
  include_once "../core/Lang.php";
  include_once "../core/Config.php";
  include_once "../controller/generateCodesController.php";
  $userLang = $session->getData()["lang"];
  $title = "<h2>".$lang[$userLang]['Codes']."</h2>";
  ob_start();
  echo "<div class='list_group'>";
  foreach($codes as $code) { ?>
      <p class="list-group-item"><?= $code->getHash(); ?></p>
  <?php }
  echo "</div>";
  $content = ob_get_clean();
  include_once "layout.php";
