<?php

include_once "User.php";

class Establishment extends User
{
  private $address;
  private $name;
  private $photo;

  function __construct($username, $address, $name, $photo, $password = null)
  {
    parent::__construct($username, $password);
    $this->address = $address;
    $this->name = $name;
    $this->photo = $photo;
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
      $sentence = "INSERT INTO ESTABLISHMENT VALUES (?,?,?,?)";
      $statement = $connection->prepare($sentence);
      $statement->bind_param("s",$this->username, $this->address, $this->name,
        $this->photo);
      $statement->execute();
      if($statement->affected_rows == 1){
        $connection->commit();
        $connection->close();
      }
      else{
        $connection->rollback();
        $connection->close();
        throw new Exception("User could not be created.");
      }
    }
    else{
      $connection->rollback();
      $connection->close();
      throw new Exception("User could not be created.");
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
    $sentence = "UPDATE ESTABLISHMENT SET e_name = ?, address = ?, e_photo = ?
      WHERE e_username = ?";
    $statement = $connection->prepare($sentence);
    $statement->bind_param("ssss",$this->name,$this->address,$this->photo,
      $this->username);
    $statement->execute();
    if($statement->affected_rows != 1){
      $connection->rollback();
      $connection->close();
      throw new Exception("User could not be updated.");
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
    $sentence = "SELECT * FROM ESTABLISHMENT WHERE e_username = ?";
    $statement = $connection->prepare($sentence);
    $statement->execute();
    $statement->bind_result($username,$this->address,$this->name,$this->photo);
    $statement->fetch();
    $connection->close();

  }

  // Returns an array containing an object for every DB row.
  static function getAll()
  {
    $connection = Relation::getConnection();
    $sentence = "SELECT * FROM ESTABLISMENT";
    $statement = $connection->prepare($sentence);
    $statement->bind_param("s",$this->username);
    $statement->execute();
    $statement->bind_result($username,$address,$name,$photo);
    $establishments=array();
    while($statement->fetch()){
      $establishments[] = new Establishment($username,$address,$name,$photo);
    }
    $connection->close();
    return $establishments;
  }

  // Check if this object exists in the DB.
  function exists()
  {
    $connection = Relation::getConnection();
    $sentence = "SELECT count(*) FROM ESTABLISHMENT WHERE j_username = ?";
    $statement = $connection->prepare($sentence);
    $statement->bind_param("s",$this->username);
    $statement->execute();
    $statement->bind_result($exists);
    $statement->fetch();
    $connection->close();
    return ($exists==1);
  }

  function getAddress(){
    return $this->address;
  }

  function setAddress($address){
    $this->address = $address;
  }

  function getName(){
    return $this->name;
  }

  function setName($name){
    $this->name = $name;
  }

  function getPhoto(){
    return $this->photo;
  }

  function setPhoto($photo){
    $this->photo = $photo;
  }

}
