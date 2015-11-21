<?php
  include_once "../model/Ingredient.php";
  include_once "../core/Session.php";
  try{
    $ingredients = Ingredient::getAll();
  }
  catch(Exception $e){
    $session->putFlashMessage("error",$e->getMessage());
  }
