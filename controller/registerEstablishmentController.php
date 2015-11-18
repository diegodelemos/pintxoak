<?php
include_once "../core/ImageUploader.php";
include_once "../model/Organizer.php";
include_once "../model/Request.php";
include_once "../core/Session.php";

try{
	$session = new Session();
	if($session->isLogged())
		throw new Exception("You are already registered");
	checkFormCorretness();

	$ePhoto = uploadImage($_FILES['establishment_photo'], "establishment");
	$pPhoto = uploadImage($_FILES['pincho_photo'], "pincho");

	$request = new Request(null,null, $_POST["address"], $_POST["userName"],
				$_POST["password"], $_POST["address"], $ePhoto, $_POST["pincho_name"],
				$pPhoto, $_POST["pincho_price"], $_POST["ingredients"], false,
				$_POST["establishment_name"]);

	$request->insert();
	$session->putFlashVariable("success","Request created");
	header("Location: ..");
} catch(Exception $e) {
	$session->putFlashVariable("error",$e.getMessage());
	header("Location: ../view/registerEstablishment.php");
}


function checkFormCorretness() {
	if(!isset($_POST['userName']) || $_POST['userName'] == null || $_POST['userName'] == "" )
		throw new Exception("You must enter an username");
	if(!isset($_POST['password']) || $_POST['password'] == null || $_POST['password'] == "" )
		throw new Exception("You must enter a password");
	if(!isset($_POST['establishment_name']) || $_POST['establishment_name'] == null || $_POST['establishment_name'] == "" )
		throw new Exception("You must enter an establishment name");
	if(!isset($_POST['address']) || $_POST['address'] == null || $_POST['address'] == "" )
		throw new Exception("You must enter an address");
	if(!isset($_FILES['establishment_photo']) || $_FILES['establishment_photo'] == null)
		throw new Exception("You must upload a photo of your establishment");
	if(!isset($_POST['pincho_name']) || $_POST['pincho_name'] == null || $_POST['pincho_name'] == "" )
		throw new Exception("You must enter a pincho name");
	if(!isset($_FILES['pincho_photo']) || $_FILES['pincho_photo'] == null)
		throw new Exception("You must upload a photo of your pincho");
	if(!isset($_POST['pincho_price']) || $_POST['pincho_price'] == null || $_POST['pincho_price'] == "" )
		throw new Exception("You must enter the pincho's price");
	if(!isset($_POST['ingredients']) || $_POST['ingredients'] == null || $_POST['ingredients'] == "" )
		throw new Exception("You must enter the pincho ingredients");
	if(!isset($_POST['establishment_name']) || $_POST['establishment_name'] == null || $_POST['establishment_name'] == "" )
		throw new Exception("You must enter the establishment name");
}
