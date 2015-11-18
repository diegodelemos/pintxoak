<?php
include_once "../core/ImageUploader.php";
include_once "../model/Organizer.php";
include_once "../model/Request.php";
include_once "../core/Session.php";

try{
	$session = new Session();
	if($session->isLogged())
		throw new Exception("You are already registered");
	if(!formIsCorrect())
		throw new Exception("Check the form");
	}

	$ePhoto = uploadImage($_FILES['establishment_photo'], "establishment");
	$pPhoto = uploadImage($_FILES['pincho_photo'], "pincho");

	$request = new Request(null,null, $_POST["address"], $_POST["userName"],
				$_POST["password"], $_POST["address"], $ePhoto, $_POST["pincho_name"],
				$pPhoto, $_POST["pincho_price"], $_POST["ingredients"], false,
				$_POST["establishment_name"]);

	$request->insert();
	$session->putFlashMessage("success","Request created");
	header("Location: ..");
} catch(Exception $e) {
	$session->putFlashMessage("error",$e.getMessage());
	header("Location: ../view/registerEstablishment.php");
}


function formIsCorrect() {
	$correct = true;
	if(!isset($_POST['userName']) || $_POST['userName'] == null || $_POST['userName'] == "" ){
		$session->putFlashMessage("error","You must enter an username");
		$correct = false;
	}
	if(!isset($_POST['password']) || $_POST['password'] == null || $_POST['password'] == "" )
		$session->putFlashMessage("error","You must enter a password");
		$correct = false;
	}
	if(!isset($_POST['establishment_name']) || $_POST['establishment_name'] == null || $_POST['establishment_name'] == "" )
		$session->putFlashMessage("error","You must enter an establishment name");
		$correct = false;
	}
	if(!isset($_POST['address']) || $_POST['address'] == null || $_POST['address'] == "" )
		$session->putFlashMessage("error","You must enter an address");
		$correct = false;
	}
	if(!isset($_FILES['establishment_photo']) || $_FILES['establishment_photo'] == null)
		$session->putFlashMessage("error","You must upload a photo of your establishment");
		$correct = false;
	}
	if(!isset($_POST['pincho_name']) || $_POST['pincho_name'] == null || $_POST['pincho_name'] == "" )
		$session->putFlashMessage("error","You must enter a pincho name");
		$correct = false;
	}
	if(!isset($_FILES['pincho_photo']) || $_FILES['pincho_photo'] == null)
		$session->putFlashMessage("error","You must upload a photo of your pincho");
		$correct = false;
	}
	if(!isset($_POST['pincho_price']) || $_POST['pincho_price'] == null || $_POST['pincho_price'] == "" )
		throw new Exception("You must enter the pincho's price");
		$correct = false;
	}
	if(!isset($_POST['ingredients']) || $_POST['ingredients'] == null || $_POST['ingredients'] == "" )
		throw new Exception("You must enter the pincho ingredients");
		$correct = false;
	}
	if(!isset($_POST['establishment_name']) || $_POST['establishment_name'] == null || $_POST['establishment_name'] == "" )
		$session->putFlashMessage("error","You must enter the establishment name");
		$correct = false;
	}
	return $correct;
}
