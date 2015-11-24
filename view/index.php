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
    <header class="business-header" style="background-image: url('<?= $pageDir;?>main.jpeg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="tagline">Pintxoak</h1>
                </div>
            </div>
        </div>
    </header>
  <?php
    $header = ob_get_clean();
    ob_start();
    ?>

    <!-- Page Content -->

        <hr>

        <div class="row">
            <div class="col-sm-8">
                <h2>What We Do</h2>
                <p>Introduce the visitor to the business using clear, informative text. Use well-targeted keywords within your sentences to make sure search engines can find the business.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et molestiae similique eligendi reiciendis sunt distinctio odit? Quia, neque, ipsa, adipisci quisquam ullam deserunt accusantium illo iste exercitationem nemo voluptates asperiores.</p>
                <p id="search">
                    <a class="btn btn-default btn-lg" href="#">Call to Action &raquo;</a>
                </p>
            </div>
            <div class="col-sm-4">
                <h2><?= $lang[$userLang]["Follow us"]; ?></h2>
                <address>
                    <strong>Start Bootstrap</strong>
                    <br>3481 Melrose Place
                    <br>Beverly Hills, CA 90210
                    <br>
                </address>
                <address>
                    <abbr title="Phone">P:</abbr>(123) 456-7890
                    <br>
                    <abbr title="Email">E:</abbr> <a href="mailto:#">name@example.com</a>
                </address>
            </div>
        </div>
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
