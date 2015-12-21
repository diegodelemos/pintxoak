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
  $title = "<h2>".$lang[$userLang]['Modify contest']."</h2>";
  ob_start();
  ?>
  <form method="post" action="../controller/modifyContestController.php" enctype="multipart/form-data">
    <div class="form-group">
      <label for="name"><?= $lang[$userLang]['Contest name']; ?></label>
      <input type="text" class="form-control" id="name" name="name" value="<?= $contest->getName();?>">
    </div>
    <div class="form-group">
      <label for="date1"><?= $lang[$userLang]['Start Date']; ?></label>
      <input pattern="(0[1-9]|[12]\d|3[01])\.(0[1-9]|1[012])\.(0[1-9]|[1-9][0-9])" type="text" class="form-control" id="date1" name="date1" value="<?= $contest->getStartDate();?>">
    </div>
    <div class="form-group">
      <label for="date2"><?= $lang[$userLang]['End Date']; ?></label>
      <input pattern="(0[1-9]|[12]\d|3[01])\.(0[1-9]|1[012])\.(0[1-9]|[1-9][0-9])" type="text" class="form-control" id="date2" name="date2" value="<?= $contest->getEndDate();?>">
    </div>
    <div class="text-warning"><?= $lang[$userLang]["Note: if you don't want to change your photo, please, let this field empty before submiting the form"]; ?></div>
    <div class="form-group">
      <label for="logo"><?= $lang[$userLang]['Contest photo']; ?></label>
      <input type="file" id="logo" name="logo">
      <img class="img-thumbnail img-responsive img-center" style="height: 300px;width:500px" src="<?= $pageDir; ?>/<?= $contest->getLogo(); ?>" />
    </div>
    <div class="form-group">
      <button class="btn btn-default" type="submit"><?= $lang[$userLang]['Save']; ?></button>
    </div>
  </form>

  <?php

  $content = ob_get_clean();
  include_once "layout.php";
