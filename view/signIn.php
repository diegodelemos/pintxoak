<?php
  include_once "../core/Session.php";
  $session = new Session();
  if($session->isLogged()){
    $session->putFlashMessage("error","You are already signed in");
    header("Location: .");
  }
  include_once "../core/Lang.php";
  include_once "../core/Config.php";
  $userLang = $session->getData()["lang"];
  $title = "<h2>".$lang[$userLang]['Pintxoak sign in']."</h2>";
  ob_start();
?>
      <form class="form-horizontal" action="../controller/signInController.php" method="POST">
      <div class="form-group">
        <label for="userName" class="sr-only">
		<?= $lang[$userLang]['User name'];?>
	</label>
        <input type="text" name="userName" id="userName" class="form-control" placeholder="<?= $lang[$userLang]['User name'];?>" required autofocus>
      </div>
      <div class="form-group">
        <label for="password" class="sr-only">
		<?= $lang[$userLang]['Password'];?>
	</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="<?= $lang[$userLang]['Password'];?>" required>
      </div>
      <div class="form-group">
        <button class="btn btn-lg btn-primary btn-block" type="submit">
		<?= $lang[$userLang]['Sign in'];?>
	</button>
</div>
      </form>
<?php
  $content = ob_get_clean();
  include_once "layout.php";
