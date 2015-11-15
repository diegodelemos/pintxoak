<?php

  include_once "../model/User.php";
  include_once "../model/Organizer.php";
  include_once "../model/Judge.php";
  include_once "../model/Establishment.php";

  class Session {
    private $logged;
    private $data;
    private $flash = array();

    function __construct(){
      session_start();
      if (isset($_SESSION["logged"]) && ($_SESSION["logged"])) {
        foreach($_SESSION as $key => $value){
          $this->data[$key] = $value;
        }
        $this->logged = true;
      }
      else{
        if(isset($_SESSION["lang"])) $this->data=$_SESSION["lang"];
        else {
          $this->data["lang"] = "es";
          $_SESSION["lang"] = $this->data["lang"];
        }
      }
      if(isset($_SESSION["flash"]))
        $this->flash = $_SESSION["flash"];
      else
        $_SESSION["flash"] = array();
    }
    public function login($username,$password,$userLang = "en"){
      $user = new Organizer($username,null);
      if($user->checkPassword($password)){
        if($user->exists()){
	  $_SESSION["userName"] = $user->getUserName();
          $this->data["userName"] = $user->getUserName();
          $_SESSION["type"] = "organizer";
          $this->data["type"] = "organizer";
          $_SESSION["lang"] = $userLang;
          $this->data["lang"] = $userLang;
          $_SESSION["logged"] = true;
          $this->logged = true;
        }
        else{
          $user = new Judge($dni,null,null,null,null);
          if($user->exists()){
            $user->populate();
	    $_SESSION["userName"] = $user->getUserName();
            $this->data["userName"] = $user->getUserName();
            $_SESSION["name"] = $user->getName();
            $this->data["name"] = $user->getName();
            $_SESSION["profession"] = $user->getProfession();
            $this->data["profession"] = $user->getProfession();
            $_SESSION["photo"] = $user->getPhoto();
            $this->data["photo"] = $user->getPhoto();
            $_SESSION["type"] = "judge";
            $this->data["type"] = "judge";
            $_SESSION["lang"] = $userLang;
            $this->data["lang"] = $userLang;
            $_SESSION["logged"] = true;
            $this->logged = true;
          }
          else{
            $user = new Establishment($dni,null,null,null,null);
            if($user->exists()){
              $user->populate();
	      $_SESSION["userName"] = $user->getUserName();
              $this->data["userName"] = $user->getUserName();
              $_SESSION["name"] = $user->getName();
              $this->data["name"] = $user->getName();
              $_SESSION["address"] = $user->getAddress();
              $this->data["address"] = $user->getAddress();
              $_SESSION["photo"] = $user->getPhoto();
              $this->data["photo"] = $user->getPhoto();
              $_SESSION["type"] = "establishment";
              $this->data["type"] = "establishment";
              $_SESSION["lang"] = $userLang;
              $this->data["lang"] = $userLang;
              $_SESSION["logged"] = true;
              $this->logged = true;

            }
            else
              throw new Exception("Failed at signing in");
          }
        }
      }
      else
        throw new Exception("Failed at signing in");
    }
    public function logout(){
      session_unset();
      session_destroy();
    }
    public function isLogged(){
      return $this->logged;
    }
    public function setLang($userLang){
      $this->data["lang"]=$userLang;
      $_SESSION["lang"]=$userLang;
    }

    public function getData() {
      return $this->data;
    }

    // types are warning, success and error
    public function putFlashMessage($type, $message){
      array_push($this->flash, array("type" => $type, "message" => $message));
      array_push($_SESSION['flash'], array("type" => $type, "message" => $message));
    }

    public function getFlashMessages(){
      $flash = $this->flash;
      $this->flash = array();
      $_SESSION["flash"] = array();
      return $flash;
    }

  }
