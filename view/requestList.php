<?php
  include_once "../core/Session.php";
  $session = new Session();
  if(!$session->isLogged()){
    $session->putFlashVariable("error","You are not signed in");
    header("Location: .");
  }
  else if($session->getData()[type] != "organizer"){
    $session->putFlashVariable("error","You shall not pass");
    header("Location: .");
  }
  include_once "../core/Lang.php";
  include_once "../core/Config.php";
  include_once "../requestListController.php"
  $userLang = $session->getData()["lang"];
  $title = "<h2>".$lang[$userLang]['Requests']."</h2>";
  ob_start();
  foreach($requests as $request) { ?>
    <div class="row">
      <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
          <img src="<?= $pinchoDir;?>/<?= $request->getPPhoto();?>">
          <img src="<?= $establishmentDir;?>/<?= $request->getEPhoto();?>">
          <div class="caption">
            <h3><?= $request->getPName(); ?></h3>
            <p><?= sprintf($lang[$userLang]["by %s"],$request->getEName()); ?>
          </div>
      </div>
    </div>

  <?php }

<?php
  $content = ob_get_clean();
  include_once "layout.php";
