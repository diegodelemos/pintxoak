<?php

include_once "Relation.php";
include_once "Establishment.php";
include_once "Code.php";

class Pincho extends Relation {

	private $id;
	private $establishment;
	private $name;
	private $photo;
	private $price;
	private $counter;

	function __construct($id,$establishment,$name,$photo,$price,$counter) {
		$this->id=$id;
		$this->establishment=$establishment;
		$this->name=$name;
		$this->photo=$photo;
		$this->price=$price;
		$this->counter=$counter;
	}

	// Inserts the object data in the database.
	function insert() {
		if($this->exists())
			throw new Exception("Pincho already exists");
		if($this->establishment->exists()) {
			$connection = Relation::getConnection();
			$sentence = "INSERT INTO PINCHO (e_username,p_name,p_photo,p_price,counter)
				VALUES (?, ?, ?, ?, ?)";
			$statement = $connection->prepare($sentence);
			$statement->bind_param("sssdi",$this->establishment->getUsername(),$this->name,
				$this->photo,$this->price,$this->counter);
			$statement->execute();
			if($statement->affected_rows != 1){
				throw new Exception("Pincho could not be created");
			}
			$this->id = $connection->insert_id;
			$connection->close();
		} else {
			throw new Exception("Pincho could not be created");
		}

	}
	// Deletes the database entry for this object id.
	function delete() {
		if(!$this->exists())
			throw new Exception("Pincho doesn't exist");
		$connection = Relation::getConnection();
		$sentence = "DELETE FROM PINCHO WHERE p_id = ?";
		$statement = $connection->prepare($sentence);
		$statement->bind_param("i",$this->id);
		$statement->execute();
		if($statement->affected_rows == 1){
			$connection->close();
		}
		else{
			$connection->close();
			throw new Exception("Pincho could not be deleted");
		}
	}
	// Updates the database entry for this object id.
	function update() {
		if(!$this->exists())
			throw new Exception("Pincho doesn't exist");
		$connection = Relation::getConnection();
		$this->userUpdate($connection);
		$sentence = "UPDATE PINCHO SET e_username = ?, p_name = ?, p_photo = ?,
			p_price = ?, counter = ? WHERE e_username = ?";
		$statement = $connection->prepare($sentence);
		$statement->bind_param("sssdi",$this->establishment->getUsername(),$this->name,$this->photo,
		$this->price, $this->counter);
		$statement->execute();
		if($statement->affected_rows != 1){
			$connection->close();
			throw new Exception("Pincho could not be updated");
		}
		$connection->close();
	}
	// Populates the object with the data from the database
	// for the entry with id PK
	function populate() {
		if(!$this->exists())
			throw new Exception("Pincho doesn't exist");
		$connection = Relation::getConnection();
		$connection->begin_transaction();
		$sentence = "SELECT * FROM PINCHO WHERE p_id = ?";
		$statement = $connection->prepare($sentence);
		$statement->bind_param("i",$this->id);
		$statement->execute();
		$statement->bind_result($this->id,$establishmentReference
			,$this->name,$this->photo,$this->price,$this->counter);

		$statement->fetch();
		$this->establishment = new Establishment($establishmentReference,null,null,null);
		$connection->close();
	}

	// Returns an array containing an object for every DB row.
	static function getAll() {
		$connection = Relation::getConnection();
		$connection->begin_transaction();
		$sentence = "SELECT * FROM PINCHO";
		$statement = $connection->prepare($sentence);
		$statement->execute();
		$statement->bind_result($id,$establishmentReference,$name,$photo,$price,$counter);
		$pinchos=array();
		while($statement->fetch()){
			$establishment = new Establishment($establishmentReference,null,null,null);
			$pinchos[] = new Pincho($id,$establishment,$name,$photo,$price,$counter);
		}
		$connection->close();
		return $pinchos;
	}
	// Check if this object exists in the DB.
	function exists(){
		$connection = Relation::getConnection();
		$sentence = "SELECT count(*) FROM PINCHO WHERE p_id = ?";
		$statement = $connection->prepare($sentence);
		$statement->bind_param("i",$this->id);
		$statement->execute();
		$statement->bind_result($exists);
		$statement->fetch();
		$connection->close();
		return ($exists==1);
	}

	function getId(){
		return $this->id;
	}

	function setId($id){
		$this->id = $id;
	}

	function getName(){
		return $this->name;
	}

	function setName($name){
		$this->name = $name;
	}


	function getEstablishment(){
		return $this->establishment;
	}

	function setEstablishment($establishment){
		$this->establishment = $establishment;
	}

	function getPhoto(){
		return $this->photo;
	}

	function setPhoto($photo){
		$this->photo = $photo;
	}

	function getPrice(){
		return $this->price;
	}

	function setPrice($price){
		$this->price = $price;
	}

	function getCounter(){
		return $this->counter;
	}

	function setCounter($counter){
		$this->counter = $counter;
	}

	static function getByEstablishment($establishment){
			$connection = Relation::getConnection();
			$sentence = "SELECT * FROM PINCHO WHERE e_username = ?";
			$statement = $connection->prepare($sentence);
			$statement->bind_param("s",$establishment->getUsername());
			$statement->execute();
			$statement->bind_result($id,$establishmentReference,$name,$photo,$price,
				$counter);
			$statement->fetch();
			$pincho = new Pincho($id,$establishment,$name,$photo,$price,$counter);
			$connection->close();
			return $pincho;
	}

	function getCodes($number){
		$lastNum = Code::getLastNumber($this);
		$codes = array();
		for($i = 0; $i < $number; $i++){
			$lastNum++;
			$hash = substr(hash("md5",$this->id.$lastNum),0,10);
			$code = new Code($this,$lastNum,0,0,$hash);
			$code->insert();
			$codes[] = $code;
		}
		return $codes;
	}

	function insertIngredient($ingredient){
			$connection = Relation::getConnection();
			$sentence = "INSERT INTO CONTAINS VALUES (?,?)";
			$statement = $connection->prepare($sentence);
			$statement->bind_param("is",$this->getId(),$ingredient->getName());
			$statement->execute();
			if($statement->affected_rows != 1){
				throw new Exception("Ingredient could not be inserted");
			}
			$connection->close();
	}

}
