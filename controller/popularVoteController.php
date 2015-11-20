<?php
include_once "../core/Session.php";
include_once "../model/Code.php";

if(!isset($session)) $session = new Session();
try {
  if(!$session->isLogged()){
    checkFormCorrectness();
    $code1 = new Code(null,null,null,null,$_POST["code1"]);
    $code1->populateByHash();
    $code2 = new Code(null,null,null,null,$_POST["code2"]);
    $code2->populateByHash();
    $code3 = new Code(null,null,null,null,$_POST["code3"]);
    $code3->populateByHash();
    checkCodeCorrectness($code1,$code2,$code3);
    if($_POST["code"] == "code1"){
      $code1->setWinner(true);
      $code1->setUsed(true);
      $code2->setUsed(true);
      $code3->setUsed(true);
    }
    if($_POST["code"] == "code2"){
      $code2->setWinner(true);
      $code1->setUsed(true);
      $code2->setUsed(true);
      $code3->setUsed(true);
    }
    if($_POST["code"] == "code3"){
      $code3->setWinner(true);
      $code1->setUsed(true);
      $code2->setUsed(true);
      $code3->setUsed(true);
    }
    $code1->update();
    $code2->update();
    $code3->update();
    $session->putFlashMessage("success","Vote registered successfuly");
  } else
    throw new Exception("You shall not pass");
} catch (Exception $e) {
  $session->putFlashMessage("error",$e->getMessage());
}
header("Location: ../view/popularVote.php");


function checkFormCorrectness(){
  if(!isset($_POST["code"])
    || ($_POST["code"]!="code1" && $_POST["code"] != "code2" && $_POST["code"] != "code3")
    || !isset($_POST["code1"]) || $_POST["code1"] == null || $_POST["code1"] == ""
    || !isset($_POST["code2"]) || $_POST["code2"] == null || $_POST["code2"] == ""
    || !isset($_POST["code3"]) || $_POST["code3"] == null || $_POST["code3"] == "")
    throw new Exception("Check the form");
}

function checkCodeCorrectness($code1, $code2, $code3){
  if($code1->getPincho()->getId() == $code2->getPincho()->getId()
    || $code1->getPincho()->getId() == $code3->getPincho()->getId()
    || $code2->getPincho()->getId() == $code3->getPincho()->getId())
    throw new Exception("Codes must be from different pinchos");
  if($code1->getUsed() || $code2->getUsed() || $code3->getUsed())
    throw new Exception("Some of the codes were used before");

}
