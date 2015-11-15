<?php
include_once "../core/Lang.php";
$userLang = 'en';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $lang[$userLang]['Pintxoak sign in'];?></title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

  </head>

  <body>
    <div class="col-sm-4 col-md-5 xs-hidden"></div>
    <div class="container col-sm-4 col-md-2 col-xs-12">

      <form class="form-signin" action="../controller/registerEstablishmentController.php" method="POST" enctype='multipart/form-data'>
        <h2>
		<?= $lang[$userLang]['Register establishment'];?>
	</h2>

        <label for="userName" class="sr-only">
		<?= $lang[$userLang]['E-mail'];?>
	</label>
        <input type="email" name="userName" id="userName" class="form-control" placeholder="<?= $lang[$userLang]['E-mail'];?>" required autofocus>

        <label for="password" class="sr-only">
		<?= $lang[$userLang]['Password'];?>
	</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="<?= $lang[$userLang]['Password'];?>" required>

	<label for="r_password" class="sr-only">
		<?= $lang[$userLang]['Repeat your password'];?>
	</label>
        <input type="password" name="r_password" id="r_password" class="form-control" placeholder="<?= $lang[$userLang]['Repeat your password'];?>" required>

	<label for="establishment_name" class="sr-only">
		<?= $lang[$userLang]['Establishment name'];?>
	</label>
        <input type="text" name="establishment_name" id="establishment_name" class="form-control" placeholder="<?= $lang[$userLang]['Establishment name'];?>" required>
	
	<label for="address" class="sr-only">
		<?= $lang[$userLang]['Esblishment address'];?>
	</label>
        <input type="text" name="address" id="adress" class="form-control" placeholder="<?= $lang[$userLang]['Establishment address'];?>" required>
	
	<label for="establishment_photo">
		<?= $lang[$userLang]['Establishment photo'];?>
	</label>
        <input type="file" name="establishment_photo" id="establishment_photo" required>

	<label for="pincho_name" class="sr-only">
		<?= $lang[$userLang]['Pincho name'];?>
	</label>
        <input type="text" name="pincho_name" id="pincho_name" class="form-control" placeholder="<?= $lang[$userLang]['Pincho name'];?>" required>

	<label for="pincho_photo">
		<?= $lang[$userLang]['Pincho photo'];?>
	</label>
        <input type="file" name="pincho_photo" id="pincho_photo" required>

	<label for="pincho_price">
		<?= $lang[$userLang]['Pincho price'];?>
	</label>
        <input type="number" step="any" name="pincho_price" id="pincho_price" placeholder="<?= $lang[$userLang]['Pincho price'];?>" required/>
	
	<label for="ingredients">
		<?= $lang[$userLang]['Pincho ingredients'];?>
	</label>
        <textarea name="ingredients" id="ingredients"required></textarea>


        <button class="btn btn-lg btn-primary btn-block" type="submit">
		<?= $lang[$userLang]['Sign in'];?>
	</button>
      </form>

    </div>
    <div class="col-sm-4 col-md-5 xs-hidden"></div>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>

