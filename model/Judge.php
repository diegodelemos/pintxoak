<?php

include_once "User.php";

class Judge extends User
{
  private $name;
  private $pofession;
  private $photo;

  function __construct($username, $name, $profession, $photo, $password = null)
  {
    parent::__construct($username, $password);
    $this->name = $name;
    $this->profession = $profession;
    $this->photo;
  }

  // Inserts the object data in the database.
  function insert()
  {
    if($this->exists())
      throw new Exception("User already exists");
    $connection = Relation::getConnection();
    $connection->begin_transaction();
    $sentence = "INSERT INTO USER VALUES (?, ?)";
    $statement = $connection->prepare($sentence);
    $statement->bind_param("ss",$this->username,$this->password);
    $statement->execute();
    if($statement->affected_rows == 1){
      $sentence = "INSERT INTO JUDGE VALUES (?,?,?,?)";
      $statement = $connection->prepare($sentence);
      $statement->bind_param("ssss", $this->username, $this->name,
        $this->profession, $this->photo);
      $statement->execute();
      if($statement->affected_rows == 1){
        $connection->commit();
        $connection->close();
      }
      else{
        $connection->rollback();
        $connection->close();
        throw new Exception("User could not be created");
      }
    }
    else{
      $connection->rollback();
      $connection->close();
      throw new Exception("User could not be created");
    }
  }

  // Updates the database entry for this object id.
  function update()
  {
    if(!$this->exists())
      throw new Exception("User doesn't exist");
    $connection = Relation::getConnection();
    $connection->begin_transaction();
    $this->userUpdate($connection);
    $sentence = "UPDATE JUDGE SET j_name = ?, j_profession = ?, j_photo = ?
      WHERE j_username = ?";
    $statement = $connection->prepare($sentence);
    $statement->bind_param("ssss",$this->name,$this->profession,$this->photo,
      $this->username);
    $statement->execute();
    if($statement->affected_rows != 1){
      $connection->rollback();
      $connection->close();
      throw new Exception("User could not be updated");
    }
    $connection->commit();
    $connection->close();
  }

  // Populates the object with the data from the database
  // for the entry with id PK
  function populate()
  {
    if(!$this->exists())
      throw new Exception("User doesn't exist");
    $connection = Relation::getConnection();
    $sentence = "SELECT * FROM JUDGE WHERE j_username = ?";
    $statement = $connection->prepare($sentence);
    $statement->bind_param("s",$this->username);
    $statement->execute();
    $statement->bind_result($username,$this->name,$this->profession,$this->photo);
    $statement->fetch();
    $connection->close();
  }

  // Returns an array containing an object for every DB row.
  static function getAll()
  {
    $connection = Relation::getConnection();
    $sentence = "SELECT * FROM JUDGE";
    $statement = $connection->prepare($sentence);
    $statement->execute();
    $statement->bind_result($username,$name,$profession,$photo);
    $judges=array();
    while($statement->fetch()){
      $judges[] = new Judge($username,$name,$profession,$photo);
    }
    $connection->close();
    return $judges;
  }

  // Check if this object exists in the DB.
  function exists()
  {
    $connection = Relation::getConnection();
    $sentence = "SELECT count(*) FROM JUDGE WHERE j_username = ?";
    $statement = $connection->prepare($sentence);
    $statement->bind_param("s",$this->username);
    $statement->execute();
    $statement->bind_result($exists);
    $statement->fetch();
    $connection->close();
    return ($exists==1);
  }

  function getName(){
    return $this->name;
  }

  function setName($name){
    $this->name = $name;
  }

  function getProfession(){
    return $this->profession;
  }

  function setProfession($profession){
    $this->profession = $profession;
  }

  function getPhoto(){
    return $this->photo;
  }

  function setPhoto($photo){
    $this->photo = $photo;
  }
}
