<?php
include_once "Relation.php";
include_once "Pincho.php";

class Code extends Relation {

	private pincho;
	private codeNum;
	private used;
	private winner;
	private hash;

	function __construc($pincho,$codeNum,$used,$winner,$hash) {
		$this->pincho=$pincho;
		$this->codeNum=$codeNum;
		$this->used=$used;
		$this->winner=$winner;
		$this->hash=$hash;
	}

	// Inserts the object data in the database.
	function insert(){
		if($this->exists())
			throw new Exception("Code already exists");
		if(pincho->exists()) {
			$connection = Relation::getConnection();
			$sentence = "INSERT INTO CODE (p_id,code_num,used,winner,hash) 
				VALUES (?, ?, ?, ?, ?)";
			$statement = $connection->prepare($sentence);
			$statement->bind_param("iiiis",$this->pincho->getId(),$this->codeNum,
				$this->used,$this->winner,$this->hash);
			$statement->execute();
			if($statement->affected_rows != 1){
				throw new Exception("Code could not be created.");
			}
			$connection->close();
		} else {
			throw new Exception("Code could not be created.");	
		}
	}
	// Deletes the database entry for this object id.
	function delete() {
		if(!$this->exists())
			throw new Exception("Code doesn't exist");
		$connection = Relation::getConnection();
		$sentence = "DELETE FROM CODE WHERE p_id = ?, code_num = ?";
		$statement = $connection->prepare($sentence);
		$statement->bind_param("ii",$this->pincho->getId(),$this->codeNum);
		$statement->execute();
		if($statement->affected_rows == 1){
			$connection->close();
		}
		else{
			$connection->close();
			throw new Exception("Code could not be deleted.");
		}
	}
	// Updates the database entry for this object id.
	function update() {
		if(!$this->exists())
			throw new Exception("Code doesn't exist");
		$connection = Relation::getConnection();
		$this->userUpdate($connection);
		$sentence = "UPDATE CODE SET used = ?, winner = ?, hash = ? 
				WHERE p_id = ?, code_num = ?";
		$statement = $connection->prepare($sentence);
		$statement->bind_param("iisii",$this->used,$this->winner,$this->hash,
			$this->pincho->getId(), $this->codeNum);
		$statement->execute();
		if($statement->affected_rows != 1){
			$connection->close();
			throw new Exception("Code could not be updated.");
		}
		$connection->close();
	}
	// Populates the object with the data from the database
	// for the entry with id PK
	function populate() {
		if(!$this->exists())
			throw new Exception("Code doesn't exist");
		$connection = Relation::getConnection();
		$connection->begin_transaction();
		$sentence = "SELECT * FROM CODE WHERE p_id = ?, code_num = ?";
		$statement = $connection->prepare($sentence);
		$statement->bind_param("ii",$this->pincho->getId(),$this->codeNum);
		$statement->execute();
		$statement->bind_result($pinchoId,$this->codeNum,$this->used,
			,$this->winner,$this->hash);

		$statement->fetch();
		$this->pincho = new Pincho($pinchoId,null,null,null,null,null);
		$connection->close();
	}
	// Returns an array containing an object for every DB row.
	static function getAll() {
		$connection = Relation::getConnection();
		$connection->begin_transaction();
		$sentence = "SELECT * FROM CODE";
		$statement = $connection->prepare($sentence);
		$statement->execute();
		$statement->bind_result($pinchoId,$codeNum,$used,$winner,$hash);
		$codes=array();
		while($statement->fetch()){
			$pincho = new Pincho($pinchoId,null,null,null,null,null);
			$codes[] = new Code($pincho,$codeNum,$used,$winner,$hash);
		}
		$connection->close();
		return $codes;
	}
	// Check if this object exists in the DB.
	function exists() {
		$connection = Relation::getConnection();
		$sentence = "SELECT count(*) FROM CODE WHERE p_id = ?, code_num = ?";
		$statement = $connection->prepare($sentence);
		$statement->bind_param("ii",$this->pincho->getId(),$this->codeNum);
		$statement->execute();
		$statement->bind_result($exists);
		$statement->fetch();
		$connection->close();
		return ($exists==1);
	}

	function getPincho(){
		return $this->pincho;
	}

	function setPincho($pincho){
		$this->pincho = $pincho;
	}
	
	function getCodeNum(){
		return $this->codeNum;
	}

	function setCodeNum($codeNum){
		$this->codeNum = $codeNum;
	}

	function getUsed(){
		return $this->used;
	}

	function setUsed($used){
		$this->used = $used;
	}


	function getWinner(){
		return $this->winner;
	}

	function setWinner($winner){
		$this->winner = $winner;
	}

	function getHash(){
		return $this->hash;
	}

	function setHash($hash){
		$this->hash = $hash;
	}






