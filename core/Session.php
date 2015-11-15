<?php

  include_once '../User.php';
  class Session {
    private $logged;
    private $data;

    function __construct(){
      session_start();
      if (isset($_SESSION['logged']) && ($_SESSION['logged'])) {
        foreach($_SESSION as $key => $value){
          $this->data[$key] = $value;
        }
        $this->logged = true;
      }
      else{
        if(isset($_SESSION['lang'])) $this->data=$_SESSION['lang'];
        else {
          $this->data['lang'] = "es";
          $_SESSION['lang'] = $this->data['lang'];
        }
      }
    }
    public function login($dni,$password,$userLang = 'en'){
      $user = new Organizer($dni,null);
      if($user->checkPassword()){
        if($user->exists()){
          $_SESSION['type'] = 'organizer';
          $this->data['type'] = 'organizer';
          $_SESSION['lang'] = $userLang;
          $this->data['lang'] = $userLang;
          $_SESSION['logged'] = true;
          $this->logged = true;
        }
        else{
          $user = new Judge($dni,null,null,null,null);
          if($user->exists()){
            $user->populate();
            $_SESSION['name'] = $user->getName();
            $this->data['name'] = $user->getName();
            $_SESSION['profession'] = $user->getProfession();
            $this->data['profession'] = $user->getProfession();
            $_SESSION['photo'] = $user->getPhoto();
            $this->data['photo'] = $user->getPhoto();
            $_SESSION['type'] = 'judge';
            $this->data['type'] = 'judge';
            $_SESSION['lang'] = $userLang;
            $this->data['lang'] = $userLang;
            $_SESSION['logged'] = true;
            $this->logged = true;
          }
          else{
            $user = new Establishment($dni,null,null,null,null);
            if($user->exists()){
              $user->populate();
              $_SESSION['name'] = $user->getName();
              $this->data['name'] = $user->getName();
              $_SESSION['address'] = $user->getAddress();
              $this->data['address'] = $user->getAddress();
              $_SESSION['photo'] = $user->getPhoto();
              $this->data['photo'] = $user->getPhoto();
              $_SESSION['type'] = 'establishment';
              $this->data['type'] = 'establishment';
              $_SESSION['lang'] = $userLang;
              $this->data['lang'] = $userLang;
              $_SESSION['logged'] = true;
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
      $this->data['lang']=$userLang;
      $_SESSION['lang']=$userLang;
    }

  }
