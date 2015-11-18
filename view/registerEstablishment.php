<?php
  include_once "../core/Session.php";
  $session = new Session();
  if($session->isLogged()){
    $session->putFlashMessage("error","You are already registered");
    header("Location: .");
  }
  include_once "../core/Lang.php";
  include_once "../core/Config.php";
  $userLang = $session->getData()["lang"];
  $title = "<h2>".$lang[$userLang]['Register establishment']."</h2>";
  ob_start();
?>
      <form class="form-horizontal" action="../controller/registerEstablishmentController.php" method="POST" enctype='multipart/form-data'>
        <div class="form-group">
          <label for="userName" class="sr-only">
		          <?= $lang[$userLang]['E-mail'];?>
	        </label>
          <input type="email" name="userName" id="userName" class="form-control" placeholder="<?= $lang[$userLang]['E-mail'];?>" required autofocus>
        </div>
        <div class="form-group">
        <label for="password" class="sr-only">
		<?= $lang[$userLang]['Password'];?>
	</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="<?= $lang[$userLang]['Password'];?>" required>
      </div>
      <div class="form-group">
	<label for="r_password" class="sr-only">
		<?= $lang[$userLang]['Repeat your password'];?>
	</label>
        <input type="password" name="r_password" id="r_password" class="form-control" placeholder="<?= $lang[$userLang]['Repeat your password'];?>" required>
      </div>
      <div class="form-group">
	<label for="establishment_name" class="sr-only">
		<?= $lang[$userLang]['Establishment name'];?>
	</label>
        <input type="text" name="establishment_name" id="establishment_name" class="form-control" placeholder="<?= $lang[$userLang]['Establishment name'];?>" required>
      </div>
      <div class="form-group">
	<label for="address" class="sr-only">
		<?= $lang[$userLang]['Esblishment address'];?>
	</label>
        <input type="text" name="address" id="adress" class="form-control" placeholder="<?= $lang[$userLang]['Establishment address'];?>" required>
      </div>
      <div class="form-group">
	<label for="establishment_photo">
		<?= $lang[$userLang]['Establishment photo'];?>
	</label>
        <input type="file" name="establishment_photo" id="establishment_photo" required>
      </div>
      <div class="form-group">
	<label for="pincho_name" class="sr-only">
		<?= $lang[$userLang]['Pincho name'];?>
	</label>
        <input type="text" name="pincho_name" id="pincho_name" class="form-control" placeholder="<?= $lang[$userLang]['Pincho name'];?>" required>
      </div>
      <div class="form-group">
	<label for="pincho_photo">
		<?= $lang[$userLang]['Pincho photo'];?>
	</label>
        <input type="file" name="pincho_photo" id="pincho_photo" required>
      </div>
      <div class="form-group">
	<label for="pincho_price">
		<?= $lang[$userLang]['Pincho price'];?>
	</label>
        <input type="number" step="any" name="pincho_price" id="pincho_price" placeholder="<?= $lang[$userLang]['Pincho price'];?>" required/>
      </div>
      <div class="form-group">
	<label for="ingredients">
		<?= $lang[$userLang]['Pincho ingredients'];?>
	</label>
  <br/>
        <textarea name="ingredients" id="ingredients" style ="width: 100%; height: 100px;" required></textarea>

      </div>
      <div class="form-group">
        <button class="btn btn-lg btn-primary btn-block" type="submit">
		<?= $lang[$userLang]['Sign up'];?>
	</button></div>
      </form>
<?php
  $content = ob_get_clean();
  include_once "layout.php";
