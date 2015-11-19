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
  $userLang = $session->getData()["lang"];
  $title = "<h2>".$lang[$userLang]['Code generator']."</h2>";
  ob_start();
  ?>

  <form method="post" action="../controller/generateCodesController.php">
    <div class="input-group">
      <input type="number" name="numberCodes" class="form-control" placeholder="<?= $lang[$userLang]['Number of codes']; ?>" required>
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit"><?= $lang[$userLang]['Generate']; ?></button>
      </span>
    </div><!-- /input-group -->
  </form>
  <?php

  $content = ob_get_clean();
  include_once "layout.php";
