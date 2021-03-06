<?php
  include_once "../model/Contest.php";
  include_once "../core/Config.php";
  if(!isset($contest))
    $contest = new Contest($coreDir.$contestFile);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pintxoak</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/business-frontpage.css" rel="stylesheet">


</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="."><?= $contest->getName(); ?></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                  <?php
                    if(!$session->isLogged()) { ?>
                    <li>
                        <a href="signIn.php"><?= $lang[$userLang]["Sign in"] ?></a>
                    </li>
                    <li>
                        <a href="registerEstablishment.php"><?= $lang[$userLang]["Register establishment"] ?></a>
                    </li>
                    <li>
                        <a href="popularVote.php"><?= $lang[$userLang]["Popular vote"] ?></a>
                    </li>
                  <?php }
                    else {
                      if($session->getData()['type'] == "organizer"){ ?>
                      <li>
                          <a href="requestList.php"><?= $lang[$userLang]["Requests"] ?></a>
                      </li>
	                    <li>
			                    <a href="leaflet.php"><?= $lang[$userLang]["Generate Leaflet"]?></a>
                      </li>
	                    <li>
			                    <a href="modifyContest.php"><?= $lang[$userLang]["Modify contest"]?></a>
                      </li>

                  <?php }
                    else if($session->getData()['type'] == "judge"){ ?>
                      <li>
                          <a href="#"><?= $lang[$userLang]["Evaluate pinchos"] ?></a>
                      </li>
                      <li>
                          <a href="#"><?= $lang[$userLang]["Profile"] ?></a>
                      </li>

                    <?php }
                      else if($session->getData()['type'] == "establishment"){ ?>
                        <li>
                            <a href="codeGenerator.php"><?= $lang[$userLang]["Codes"] ?></a>
                        </li>
                        <li>
                            <a href="modifyEstablishment.php"><?= $lang[$userLang]["Profile"] ?></a>
                        </li>

                    <?php }
                  }?>
                    <li>
                        <a href="#"><?= $lang[$userLang]["Gastromap"] ?></a>
                    </li>
                    <?php
                      if($session->isLogged()) { ?>
                      <li>
                          <a href="../controller/signOutController.php"><?= $lang[$userLang]["Sign out"] ?></a>
                      </li>

                    <?php } ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <?php if(isset($header)) echo $header;?>
    <div class="container">
      <div><?php if(isset($title)) echo $title;?></div>
      <div>
      <?php
        foreach($session->getFlashMessages() as $message){
          if($message["type"] == "error")
            $type = "danger";
          else $type = $message["type"];
          echo "<div class='alert alert-".$type."' role='alert'>";
          echo "<h4>".$lang[$userLang][$message["message"]]."</h4>";
          echo "</div>";
        }
      echo "</div>";
      echo $content;?>
      <hr>

      <!-- Footer -->
      <footer>
          <div class="row">
              <div class="col-lg-6">
                  <p><?= sprintf($lang[$userLang]["by %s"], "Eliot Blanco &amp; Diego Rodr&iacute;guez"); ?></p>
              </div>
              <div class="form-group col-lg-6">
                <div for="lang"><?= $lang[$userLang]["Select language"] ?></div>
                <select class="form-control" id="lang">
                  <?php
                    foreach($availableLangs as $language){
                      $selected = "";
                      if($language == $userLang)
                        $selected = " selected";
                      echo "<option".$selected.">".$language."</option>";
                    } ?>
                </select>
              </div>
          </div>
          <!-- /.row -->
      </footer>
    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.md5.js"></script>
    <script>
      $("#lang").change(function(){
        window.location.replace("../controller/languageController.php?lang="+$("#lang option:selected").text());
      });
    </script>

</body>

</html>
