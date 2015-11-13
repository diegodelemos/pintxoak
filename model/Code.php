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
		if(pincho.exists()) {
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
	function delete();
	// Updates the database entry for this object id.
	function update();
	// Populates the object with the data from the database
	// for the entry with id PK
	function populate();
	// Returns an array containing an object for every DB row.
	static function getAll();
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






