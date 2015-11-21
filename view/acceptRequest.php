<?php
  include_once "../core/Session.php";
  include_once "../controller/requestListController.php";
  $session = new Session();
  if(!$session->isLogged()){
    $session->putFlashMessage("error","You are not signed in");
    header("Location: .");
  }
  if(!isset($_GET["id"])){
    $session->putFlashVariable("error","You shall not pass");
    header("Location: requestList.php");
  }
  else if($session->getData()["type"] != "organizer"){
    $session->putFlashMessage("error","You shall not pass");
    header("Location: .");
  }
  $request = null;
  foreach($requests as $req){
    if($req->getId() == $_GET["id"]){
      $request = $req;
      break;
    }
  }
  if($request == null){
    $session->putFlashMessage("error","Request doesn't exist");
    header("Location: requestList.php");
  }
  include_once "../core/Lang.php";
  include_once "../core/Config.php";
  include_once "../controller/requestListController.php";
  include_once "../controller/ingredientController.php";
  $userLang = $session->getData()["lang"];
  $title = "<h2>".$lang[$userLang]['Validate request']."</h2>";
  ob_start();
  ?>
    <div class="col-lg-12">
      <form class="form">
        <div class="thumbnail col-lg-6">
          <img style="max-width: 300px; max-height: 200px;" src="<?= $pinchoDir;?>/<?= $request->getPPhoto();?>">
          <div class="caption">
            <h3><?= $request->getPName(); ?></h3>
            <p><b><?= $lang[$userLang]["Pincho price"];?>:</b> <?= $request->getPPrice();?> €</p>
            <p><b><?= $lang[$userLang]["Pincho ingredients"];?>:</b><br><?= $request->getIngredients();?></p>
            <div class="standardize">
              <h3><?= $lang[$userLang]["Standardize ingredients"]; ?></h3>
              <div>
                <h4><?= $lang[$userLang]["Choose from existing ingredients"]; ?></h4>
                <div class="col-lg-5">
                  <h5><?= $lang[$userLang]["Available ingredients"]; ?></h5>
                  <select id="availableIngredients" size="8" class="col-lg-12">
                    <?php foreach ($ingredients as $ingredient) {
                      echo "<option value='".$ingredient->getName()."'>".$ingredient->getName()."</option>";
                    } ?>
                  </select>
                </div>
                <div class="col-lg-2">
                  <p class="btn btn-default" id="add" onclick="moveIngredient('availableIngredients','selectedIngredients')">&gt;&gt;</p>
                  <p class="btn btn-default" id="remove" onclick="moveIngredient('selectedIngredients','availableIngredients')">&lt;&lt;</p>
                </div>
                <div class="col-lg-5">
                  <h5><?= $lang[$userLang]["Selected ingredients"]; ?></h5>
                  <select id="selectedIngredients" size="8" class="col-lg-12">
                  </select>
                </div>
                <script>
                function moveIngredient(origin, destiny) {
                  var x = document.getElementById(origin);
                  var value = x.options[x.selectedIndex].text;
                  x.remove(x.selectedIndex);
                  var option = document.createElement("option");
                  option.text = value;
                  document.getElementById(destiny).add(option);
                }
                </script>
              </div>
              <div>
                <script>
                  function addNewIngredient(){
                    var allergenicName="<?= $lang[$userLang]['Allergenic']; ?>";
                    var ingF = document.getElementById("ingredField");
                    if(ingF.value!=""){
                      var ing = ingF.value;
                      ingF.value="";
                      var newIngList = document.getElementById("createdIngredients");
                      var newIng = "<div id='ingredient"+ing+"' class='input-group'>";
                      newIng += "<input class='form-control' type='text' name='newIng[]' value='"+ing+"' aria-label='...'/>";
                      newIng +='<span class="input-group-addon">';
                      newIng += "<label>"+allergenicName+"</label>"
                      newIng += "<input type='checkbox' name='newIngAllerg[]'/></span>";;
                      newIng += "<span class='input-group-btn'>";
                      newIng += "<p class='btn btn-default' type='button' onclick='removeNewIngredient(\"ingredient"+ing+"\");'><i class='glyphicon glyphicon-minus'></i></p>";
                      newIng += "</span></p></div>";
                      newIngList.innerHTML += newIng;
                    }
                  }
                  function removeNewIngredient(ingredientDiv){
                    var div = document.getElementById(ingredientDiv);
                    div.parentNode.removeChild(div);
                  }
                </script>
                <div id="createdIngredients">
                  <h4><?= $lang[$userLang]["Add new ingredient"]; ?></h4>
                  <div class="input-group">
                    <input type="text" id="ingredField" class="form-control" aria-label="...">
                    <span class="input-group-btn">
                      <p class="btn btn-default" type="button" onclick="addNewIngredient();"><i class="glyphicon glyphicon-plus"></i></p>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="thumbnail col-lg-6">
          <img style="max-width: 300px; max-height: 200px;" src="<?= $establishmentDir;?>/<?= $request->getEPhoto();?>">
          <h3><?= sprintf($lang[$userLang]["by %s"],$request->getEName()); ?></h3>
          <p><b><?= $lang[$userLang]["Establishment address"];?>:</b> <?= $request->getAddress();?></p>
          <p><b><?= $lang[$userLang]["E-mail"];?>:</b> <?= $request->getEmail();?></p>
        </div>
      </form>
    </div>
    <p>
      <a href="../view/acceptRequest.phpid=<?= $request->getId();?>" class="btn btn-success" role="button"><?= $lang[$userLang]["Validate"]; ?></a>
    </p>
  <?php

  $content = ob_get_clean();
  include_once "layout.php";
