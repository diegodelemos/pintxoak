<?php

function uploadImage($image, $type, $maxPhotoSize){
    include("Config.php");
    $establishment_target_dir = $establishmentDir;
    $pincho_target_dir = $pinchoDir;
    if($type == "pincho")
	$target_dir = $pincho_target_dir;
    else if($type == "establishment")
	$target_dir = $establishment_target_dir;
    else
	throw new Exception("Wrong image type");

    $target_file = generateTargetFile($target_dir, $image['name']);

    isValidImage($image, $target_file, $maxPhotoSize);


    if (!move_uploaded_file($image["tmp_name"], $target_file)) {
	throw new Exception("Error uploading file");
    }
    return end(explode("/",$target_file));
}

function deleteImage($image, $type){
  include("Config.php");
  if($type = "pincho")
    $target_dir = $pinchoDir;
  else if($type = "establishment")
    $target_dir = $establishmentDir;
  else
    throw new Exception("Wrong image type");
  $target_file = $target_dir."/".$image['name'];
  unlink($target_file);

}

function generateTargetFile($target_dir, $name) {

	$target_file = $target_dir . substr(md5($name),0,10) . "." . end(explode(".", $name));

	while(file_exists($target_file)) {
	    $target_file = $target_dir . substr(md5($target_file),0,10) . "." . end(explode(".", $name));
        }
	return $target_file;
}



function isValidImage($image, $target_file, $maxPhotoSize){
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image

	$check = getimagesize($image["tmp_name"]); // nombre del fichero temporal en servidor
	if($check == false) {
		throw new Exception("File is not an image");
	}

	// Check file size
	if ($image["size"] > $maxPhotoSize) {
	    throw new Exception("File too large");
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
	    throw new Exception("Only JPG, JPEG or PNG files are supported");
	}
}
