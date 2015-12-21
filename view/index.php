<?php
  include_once "../core/Session.php";
  include_once "../core/Lang.php";
  include_once "../controller/mainPageController.php";
  include_once "../core/Config.php";
  $session = new Session();
  $userLang = $session->getData()["lang"];
  ob_start();?>

    <!-- Image Background Page Header -->
    <!-- Note: The background image is set within the business-casual.css file. -->
    <header class="business-header" style="background-image: url('<?= $pageDir.$contest->getLogo();?>')">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="tagline"><?=$contest->getName()?></h1>
                </div>
            </div>
        </div>
    </header>
  <?php
    $header = ob_get_clean();
    ob_start();
    ?>

    <!-- Page Content -->
        <!-- /.row -->

        <hr>

        <div class="row">
          <?php
            foreach ($pinchos as $pincho) {
              $name = $pincho->getEstablishment()->getName(); ?>
            <div class="col-sm-4" style="margin-bottom:30px">
                <img class="img-thumbnail img-responsive img-center" style="height: 300px;width:500px" src=<?= $pinchoDir.$pincho->getPhoto(); ?> alt="">
                <div class="carousel-caption"
				style="max-width: 550px;padding: 0 20px;margin:0 auto;margin-top: 200px;text-align:center;background-color:black;opacity:0.5">
			<h4><?= $pincho->getName(); ?></h4>
                	<p><?= sprintf($lang[$userLang]["by %s"],$name); ?></p>
		</div>
            </div>

            <?php } ?>
        </div>
<?php
  $content = ob_get_clean();

  include_once("layout.php");
  ?>
