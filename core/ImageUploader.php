<?php
 

function uploadImage($image, $type){
    $establishment_target_dir = "../photos/establishment/";
    $pincho_target_dir = "../photos/pincho/";
    if($type == "pincho")
	$target_dir = $pincho_target_dir;
    else if($type == "establishment")
	$target_dir = $establishment_target_dir;
    else
	throw new Exception("Wrong image type");

    $target_file = generateTargetFile($target_dir, $image['name']);

    isValidImage($image, $target_file);


    if (!move_uploaded_file($image["tmp_name"], $target_file)) {
	throw new Exception("Sorry, there was an error uploading your file.");
    }
    return end(explode("/",$target_file));
}

function generateTargetFile($target_dir, $name) {
	
	$target_file = $target_dir . substr(md5($name),0,10) . "." . end(explode(".", $name));
	
	while(file_exists($target_file)) {
	    $target_file = $target_dir . substr(md5($target_file),0,10) . "." . end(explode(".", $name));
        }
	return $target_file;
}



function isValidImage($image, $target_file){
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	
	$check = getimagesize($image["tmp_name"]); // nombre del fichero temporal en servidor
	if($check == false) {
		throw new Exception("File is not an image.");
	}
	
	// Check file size
	if ($image["size"] > 500000) {
	    throw new Exception("Sorry, your file is too large.");
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
	    throw new Exception("Sorry, only JPG, JPEG, PNG files are allowed.");
	}
}