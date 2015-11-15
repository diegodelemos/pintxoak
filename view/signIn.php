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

      <form class="form-signin" action="/controller/signInController.php" method="POST">
        <h2>
		<?= $lang[$userLang]['Pintxoak sign in'];?>
	</h2>
        <label for="userName" class="sr-only">
		<?= $lang[$userLang]['User name'];?>
	</label>
        <input type="text" id="userName" class="form-control" placeholder="<?= $lang[$userLang]['User name'];?>" required autofocus>
        <label for="inputPassword" class="sr-only">
		<?= $lang[$userLang]['Password'];?>
	</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="<?= $lang[$userLang]['Password'];?>" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">
		<?= $lang[$userLang]['Sign in'];?>
	</button>
      </form>

    </div>
    <div class="col-sm-4 col-md-5 xs-hidden"></div>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>

