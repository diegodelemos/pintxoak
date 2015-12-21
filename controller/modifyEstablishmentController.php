<?php
include_once "../core/Session.php";
include_once "../model/Establishment.php";
include_once "../core/ImageUploader.php";
$session = new Session();
try {
  if($session->isLogged()){
    if($session->getData()["type"] == "establishment"){
      if(isset($_POST)){
        $establishment = new Establishment($session->getData()['userName'],null,
          null,null,null);
        $establishment->populate();
        if($_POST["login"] != null && $_POST["login"] != "")
          $establishment->setUserName($_POST["login"]);
        if($_POST["address"] != null && $_POST["address"] != "")
          $establishment->setAddress($_POST["address"]);
        if($_POST["ename"] != null && $_POST["ename"] != "")
          $establishment->setName($_POST["ename"]);
        if($_POST["oldPass"] != "d41d8cd98f00b204e9800998ecf8427e" &&
          $_POST["newPass"] != "d41d8cd98f00b204e9800998ecf8427e" &&
          $_POST["repNewPass"] != "d41d8cd98f00b204e9800998ecf8427e"){
          if($_POST["oldPass"] == $establishment->getPassword()){
            if($_POST["newPass"] == $_POST["repNewPass"]){
              $establishment->setPassword($_POST["newPass"]);
            }
            else
              throw new Exception("The new password and the repeated are not the same");
          }
          else
            throw new Exception("The password you entered is not the same as the old one");
        }
        $oldImage = $establishment->getPhoto();
        $newImage = null;
        try{
          if($_FILES["ephoto"]["error"] == 0){
            $newImage = uploadImage($_FILES["ephoto"],"establishment");
            $establishment->setPhoto($newImage);
          }
          $establishment->update();
          deleteImage($oldImage,"establishment");
        } catch (Exception $e){
          $establishment->setPhoto($oldImage);
          if($newImage != null)
            deleteImage($newImage,"establishment");
          throw $e;
        }
        $_SESSION["userName"] = $establishment->getUsername();
        $_SESSION["name"] = $establishment->getName();
        $_SESSION["address"] = $establishment->getAddress();
        $_SESSION["photo"] = $establishment->getPhoto();
        $session->putFlashMessage("success","Your data has been successfuly modified");
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
header("Location: ../view/modifyEstablishment.php");
