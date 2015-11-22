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
    if($session->getData()['type'] != "organizer")
      throw new Exception("You shall not pass");
    try{
      if(isset($_POST["request"])){
        $request = new Request($_POST["request"],null,null,null,null,null,null,
          null,null,null,null,null);
        $request->populate();
        $establishment = new Establishment($request->getEmail(),
          $request->getAddress(), $request->getEName(), $request->getEPhoto(),
          $request->getPassword());
        $establishment->insert();
        $pincho = new Pincho(null,$establishment,$request->getPName(),
          $request->getPPhoto(),$request->getPPrice(),0);
        try{
          $pincho->insert();
          try{
            if(isset($_POST["existingIngredients"])){
              foreach($_POST["existingIngredients"] as $ingrName){
                $ingredient = new Ingredient($ingrName,null);
                if(!$ingredient->exists())
                  throw new Exception("Ingredient doesn't exist");
                $pincho->insertIngredient($ingredient);
              }
            }
            if(isset($_POST["newIng"])){
              foreach($_POST["newIng"] as $ingrName){
                $allergenic = false;
                if(isset($_POST["allergenic".$ingrName]))
                  $allergenic = true;
                $newingredient = new Ingredient($ingrName,$allergenic);
                $newingredient->insert();
                $pincho->insertIngredient($newingredient);
              }
            }
            // as all the process has been completed correctly, we proceed to delete the request
            $request->delete();
            $session->putFlashMessage("success","Request has been accepted correctly");
            header("Location: ../view/requestList.php");
          } catch(Exception $e){
            $pincho->delete();
            throw new Exception($e->getMessage());
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
