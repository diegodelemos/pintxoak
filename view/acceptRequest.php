<?php
  include_once "../core/Session.php";
  include_once "../controller/requestListController.php";
  $session = new Session();
  if(!$session->isLogged()){
    $session->putFlashMessage("error","You are not signed in");
    header("Location: .");
  }
  if(!isset($_GET["id"])){
    $session->putFlashVariable("error","You shall not pass");
    header("Location: requestList.php");
  }
  else if($session->getData()["type"] != "organizer"){
    $session->putFlashMessage("error","You shall not pass");
    header("Location: .");
  }
  $request = null;
  foreach($requests as $req){
    if($req->getId() == $_GET["id"]){
      $request = $req;
      break;
    }
  }
  if($request == null){
    $session->putFlashMessage("error","Request doesn't exist");
    header("Location: requestList.php");
  }
  include_once "../core/Lang.php";
  include_once "../core/Config.php";
  include_once "../controller/requestListController.php";
  $userLang = $session->getData()["lang"];
  $title = "<h2>".$lang[$userLang]['Validate request']."</h2>";
  ob_start();
  ?>
    <div class="col-lg-12">
      <form class="form">
        <div class="thumbnail col-lg-6">
          <img style="max-width: 300px; max-height: 200px;" src="<?= $pinchoDir;?>/<?= $request->getPPhoto();?>">
          <div class="caption">
            <h3><?= $request->getPName(); ?></h3>
            <p><b><?= $lang[$userLang]["Pincho price"];?>:</b> <?= $request->getPPrice();?> €</p>
            <p><b><?= $lang[$userLang]["Pincho ingredients"];?>:</b><br><?= $request->getIngredients();?></p>
            <div class="standardize">
              <h3><?= $lang[$userLang]["Standardize ingredients"]; ?></h3>
              <!-- TODO AJAX -->
            </div>
          </div>
        </div>
        <div class="thumbnail col-lg-6">
          <img style="max-width: 300px; max-height: 200px;" src="<?= $establishmentDir;?>/<?= $request->getEPhoto();?>">
          <h3><?= sprintf($lang[$userLang]["by %s"],$request->getEName()); ?></h3>
          <p><b><?= $lang[$userLang]["Establishment address"];?>:</b> <?= $request->getAddress();?></p>
          <p><b><?= $lang[$userLang]["E-mail"];?>:</b> <?= $request->getEmail();?></p>
        </div>
      </form>
    </div>
    <p>
      <a href="../view/acceptRequest.phpid=<?= $request->getId();?>" class="btn btn-success" role="button"><?= $lang[$userLang]["Validate"]; ?></a>
    </p>
  <?php

  $content = ob_get_clean();
  include_once "layout.php";
