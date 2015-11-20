<?php
  include_once "../core/Session.php";
  $session = new Session();
  if(!$session->isLogged()){
    $session->putFlashMessage("error","You are not signed in");
    header("Location: .");
  }
  else if($session->getData()["type"] != "organizer"){
    $session->putFlashMessage("error","You shall not pass");
    header("Location: .");
  }
  include_once "../core/Lang.php";
  include_once "../core/Config.php";
  include_once "../controller/requestListController.php";
  $userLang = $session->getData()["lang"];
  $title = "<h2>".$lang[$userLang]['Requests']."</h2>";
  ob_start();
  ?> <div> <?php
  foreach($requests as $request) { ?>
    <div class="row">
      <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
          <img style="max-width: 300px; max-height: 200px;" src="<?= $pinchoDir;?>/<?= $request->getPPhoto();?>">
          <img style="max-width: 300px; max-height: 200px;" src="<?= $establishmentDir;?>/<?= $request->getEPhoto();?>">
          <div class="caption">
            <h3><?= $request->getPName(); ?></h3>
            <p><?= sprintf($lang[$userLang]["by %s"],$request->getEName()); ?></p>
            <p><b><?= $lang[$userLang]["Pincho price"];?>:</b> <?= $request->getPPrice();?> €</p>
            <p><b><?= $lang[$userLang]["Pincho ingredients"];?>:</b><br><?= $request->getIngredients();?></p>
            <p>
              <a href="../controller/rejectRequestController.php?id=<?= $request->getId();?>" onclick="return confirm('<?= $lang[$userLang]["Are you sure you want to delete this request?"];?>');" class="btn btn-danger" role="button"><?= $lang[$userLang]["Reject"]; ?></a>
              <a href="../view/acceptRequest.php?id=<?= $request->getId();?>" class="btn btn-success" role="button"><?= $lang[$userLang]["Accept"]; ?></a>
            </p>
          </div>
      </div>
    </div>

  <?php }
  ?> </div> <?php

  $content = ob_get_clean();
  include_once "layout.php";
