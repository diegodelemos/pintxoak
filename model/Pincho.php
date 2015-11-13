<?php

include_once "Relation.php";
incluse_once "Establishment.php";

class Pincho extends Relation {

	private id;
	private establishment;
	private name;
	private photo;
	private price;
	private counter;

	function __construc($id,$esblishment,$name,$photo,$price,$counter) {
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
		if(establishment.exists()) {
			$connection = Relation::getConnection();
			$sentence = "INSERT INTO PINCHO (e_username,p_name,p_photo,p_price,counter) 
				VALUES (?, ?, ?, ?, ?)";
			$statement = $connection->prepare($sentence);
			$statement->bind_param("sssdi",$this->establishment->getUsername(),$this->name,
				$this->photo,$this->price,$this->counter);
			$statement->execute();
			if($statement->affected_rows != 1){
				throw new Exception("Pincho could not be created.");
			}
			$connection->close();
		} else {
			throw new Exception("Pincho could not be created.");	
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
			throw new Exception("Pincho could not be deleted.");
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
			throw new Exception("Pincho could not be updated.");
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
		$this->establishment = new Establishment($establishmentReference,null,null,null);;
		$statement->fetch();
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
		$statement->bind_param("s",$this->id);
		$statement->execute();
		$statement->bind_result($exists);
		$statement->fetch();
		$connection->close();
		return ($exists==1);
	}
}
