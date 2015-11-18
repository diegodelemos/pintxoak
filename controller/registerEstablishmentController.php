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
				$pPhoto, $_POST["pincho_price"], $_POST["ingredients"], false, $_POST["establishment_name"]);

	$request->insert();
	$session->putFlashVariable("success","Request created");
	header("Location: ..");
} catch(Exception $e) {
	$session->putFlashVariable("error",$e.getMessage());
	header("Location: ../view/registerEstablishment.php");
}


function checkFormCorretness() {
	if(!isset($_POST['userName']) || $_POST['userName'] == null || $_POST['userName'] == "" )
		echo "username error";
	if(!isset($_POST['password']) || $_POST['password'] == null || $_POST['password'] == "" )
		echo "password error";
	if(!isset($_POST['establishment_name']) || $_POST['establishment_name'] == null || $_POST['establishment_name'] == "" )
		echo "establishment name error";
	if(!isset($_POST['address']) || $_POST['address'] == null || $_POST['address'] == "" )
		echo "address error";
	if(!isset($_FILES['establishment_photo']) || $_FILES['establishment_photo'] == null)
		echo "establishment photo error";
	if(!isset($_POST['pincho_name']) || $_POST['pincho_name'] == null || $_POST['pincho_name'] == "" )
		echo "pincho name error";
	if(!isset($_FILES['pincho_photo']) || $_FILES['pincho_photo'] == null)
		echo "pincho photo error";
	if(!isset($_POST['pincho_price']) || $_POST['pincho_price'] == null || $_POST['pincho_price'] == "" )
		echo "pincho price error";
	if(!isset($_POST['ingredients']) || $_POST['ingredients'] == null || $_POST['ingredients'] == "" )
		echo "ingredients error";
	if(!isset($_POST['establishment_name']) || $_POST['establishment_name'] == null || $_POST['establishment_name'] == "" )
		echo "establishment name error";
}
