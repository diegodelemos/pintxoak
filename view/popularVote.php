<?php
  include_once "../core/Session.php";
  $session = new Session();
  if($session->isLogged()){
    $session->putFlashMessage("error","You shall not pass");
    header("Location: .");
  }
  include_once "../core/Lang.php";
  include_once "../core/Config.php";
  $userLang = $session->getData()["lang"];
  $title = "<h2>".$lang[$userLang]['Popular vote']."</h2>";
  ob_start();
  ?>
<form method="post" class="form-horizontal" action="popularVoteController.php">
  <div class="well well-sm" role="alert">
    <?=$lang[$userLang]['You must enter three codes and select one of them before voting'];?>
  </div>
  <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon">
        <input type="radio" name="code" id="code1" value="code1" required>
      </span>
      <input pattern="[abcdef0-9]{10}" type="text" name="code1" class="form-control" placeholder="<?= $lang[$userLang]['Enter a code']; ?>" required>
    </div>
  </div>
  <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon">
        <input type="radio" name="code" id="code2" value="code2" required>
      </span>
      <input pattern="[abcdef0-9]{10}" type="text" name="code2" class="form-control" placeholder="<?= $lang[$userLang]['Enter a code']; ?>" required>
    </div>
  </div>
  <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon">
        <input type="radio" name="code" id="code3" value="code3" required>
      </span>
      <input pattern="[abcdef0-9]{10}" type="text" name="code3" class="form-control" placeholder="<?= $lang[$userLang]['Enter a code']; ?>" required>
    </div>
  </div>
  <div class="form-group">
    <button class="btn btn-default" type="submit"><?= $lang[$userLang]['Vote']; ?></button>
  </div>s
</form>
  <?php

  $content = ob_get_clean();
  include_once "layout.php";
