<?php
  include_once "../core/Session.php";
  include_once "../model/Request.php";
  include_once "../model/Establishment.php";
  include_once "../model/Pincho.php";
  include_once "../model/Ingredient.php";
  $session = new Session();
  try{
    if(!$session->isLogged())
      throw new Exception("You are not signed in");
    if($session->getData["type"] != "organizer")
      throw new Exception("You shall not pass");
    try{
      if(isset($_POST["request"])){
        $request = new Request($_POST["request"],null,null,null,null,null,null,
          null,null,null,null,null);
        $request->populate();
        $establishment = new Establishment($request->getEmail(),
          $request->getAddress(), $request->getEName(), $request->getEPhoto,
          $request->getPassword());
        $establishment->insert();
        $pincho = new Pincho(null,$establishment,$request->getPName(),
          $request->getPPhoto(),$request->getPrice(),0);
        try{
          $pincho->insert();
          // WHAT TO DO IF AN INGREDIENT COULD NOT BE INSERTED...
          if(isset($_POST["existingIngredients"])){

          }
        }
        catch(Exception $e){
          $establishment->delete();
          throw new Exception($e->getMessage());
        }
      }
      else
        throw new Exception("You shall not pass");
    }
    catch(Exception $e){
      $session->putFlashMessage("error", $e->getMessage());
      header("Location: ../view/requestList.php");
    }

  }
  catch(Exception $e){
    $session->putFlashMessage("error", $e->getMessage());
    header("Location: ..");
  }
