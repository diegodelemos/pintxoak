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
  $title = "<h2>".$lang[$userLang]['Modify establishment']."</h2>";
  ob_start();
  ?>
    <form role="form" action="../controller/modifyEstablishmentController.php" enctype="multipart/form-data" method="post">
     <div class="form-group">
       <label for="ename"><?= $lang[$userLang]['Establishment name']; ?></label>
       <input type="text" class="form-control" id="ename" name="ename" value="<?= $session->getData()['name'];?>">
     </div>
     <div class="form-group">
      <label for="address"><?= $lang[$userLang]['Establishment address']; ?></label>
      <input type="text" class="form-control" id="address" name="address" value="<?= $session->getData()['address'];?>">
     </div>
     <div class="text-warning"><?= $lang[$userLang]["Note: if you don't want to change your photo, please, let this field empty before submiting the form"]; ?></div>
     <div class="form-group">
      <label for="ephoto"><?= $lang[$userLang]['Establishment photo']; ?></label>
      <input type="file" name="ephoto" id="ephoto">
      <img style="max-width: 300px; max-height: 200px;" src="<?= $establishmentDir;?>/<?= $session->getData()['photo'];?>">
     </div>
     <div class="form-group">
      <label for="login"><?= $lang[$userLang]['Login']; ?></label>
      <input type="text" class="form-control" id="login" name="login" value="<?= $session->getData()['userName'];?>">
     </div>
     <div class="text-warning"><?= $lang[$userLang]["Note: if you don't want to change your password, please, let the password fields empty before submiting the form"]; ?></div>
     <div class="form-group">
       <label for="oldPass"><?= $lang[$userLang]["Old password"]; ?></label>
       <input type="password" class="form-control" id="oldPass" name="oldPass">
     </div>
     <div class="form-group">
       <label for="newPass"><?= $lang[$userLang]["New password"]; ?></label>
       <input type="password" class="form-control" id="newPass" name="newPass">
     </div>
     <div class="form-group">
       <label for="repNewPass"><?= $lang[$userLang]["Repeat new password"]; ?></label>
       <input type="password" class="form-control" id="repNewPass" name="repNewPass">
     </div>
     <button type="submit" class="btn btn-default" onclick="$('#oldPass').val($.md5($('#oldPass').val())); $('#newPass').val($.md5($('#newPass').val())); $('#repNewPass').val($.md5($('#repNewPass').val()));"><?= $lang[$userLang]['Save']; ?></button>
    </form>
  <?php

  $content = ob_get_clean();
  include_once "layout.php";
