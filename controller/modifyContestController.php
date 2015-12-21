<?php
include_once "../core/Session.php";
include_once "../core/ImageUploader.php";
include_once "../model/Contest.php";
include_once "../core/Config.php";

$session = new Session();
try {
  if($session->isLogged()){
    if($session->getData()["type"] == "organizer"){
      if(isset($_POST)){
        $contest = new Contest($coreDir."/".$contestFile);
        if($_POST['name'] != null && $_POST['name'] != "")
          $contest->setName($_POST['name']);
        if($_POST['date1'] != null && $_POST['date1'] != "")
          $contest->setStartDate($_POST['date1']);
          if($_POST['date2'] != null && $_POST['date2'] != "")
          $contest->setEndDate($_POST['date2']);
        $oldImage = $contest->getLogo();
        if($_FILES["logo"]["error"] == 0){
          $newImage = uploadImage($_FILES["logo"],"page");
          $contest->setLogo($newImage);
          deleteImage($oldImage,"page");
        }
        $session->putFlashMessage("success","The contest data has been successfuly modified");
      }
      else
        throw new Exception("You shall not pass");
    }
    else
      throw new Exception("You shall not pass");
  } else
    throw new Exception("You are not signed in");
} catch (Exception $e) {
  $session->putFlashMessage("error",$e->getMessage());
}
header("Location: ../view/modifyContest.php");
