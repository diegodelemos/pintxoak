<?php
// para recuperar la ruta donde esta


class Contest {
	

	private $name;
	private $startDate;
	private $endDate;
	private $logo;
	private $file;

	function __construct() {
		include_once "../core/Config.php";
		$this->file = $coreDir.$contestFile;
		$contestInfo = json_decode(file_get_contents($this->file), TRUE);
		$this->name=$contestInfo["name"];
		$this->startDate=$contestInfo["startDate"];
		$this->endDate=$contestInfo["endDate"];
		$this->logo=$contestInfo["logo"];;
	}

	
	function getName(){
		return $this->name;
	}

	function getStartDate(){
		return $this->startDate;
	}

	function getEndDate(){
		return $this->EndDate;
	}

	function getLogo(){
		return $this->logo;
	}

	function setName($name){
		$this->writeToJSONFile("name", $name);
		$this->name = $name;
	}

	function setStartDate($startDate){
		$this->writeToJSONFile("startDate", $startDate);
		$this->startDate = $startDate;
	}


	function setEndDate($endDate){
		$this->writeToJSONFile("endDate", $endDate);
		$this->endDate = $endDate;
	}

	// en el controlador se maneja la creacion del fichero que
	// contiene la imagen, aqui soolo nos quedamos con el nombre
	function setLogo($logo){
		$this->writeToJSONFile("logo", $logo);
		$this->logo = $logo;
	}

	private function writeToJSONFile($key, $value){
		$contestInfo = json_decode(file_get_contents($this->file), TRUE);

		$contestInfo[$key] = $value;

		file_put_contents($this->file, json_encode($contestInfo, TRUE));
	}
}
