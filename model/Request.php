<?php

include_once "Relation.php";

class Ingredient extends Relation {

  private $id;
  // organizer is an object
  private $organizer;
  private $email;
  private $password;
  private $data;
  private $state;

  function __construct($id,$organizer,$email,$password,$data,$state){
    $this->id = $id;
    $this->organizer = $organizer;
    $this->email = $email;
    $this->password = $password;
    $this->data = $data;
    $this->state = $state;
  }

  // Inserts the object data in the database.
  function insert()
  {
    if($this->exists())
      throw new Exception("Request already exists");
    $connection = Relation::getConnection();
    $sentence = "INSERT INTO REQUEST (o_username,email,password,data,state)
      VALUES (?, ?, ?, ?, ?)";
    $statement = $connection->prepare($sentence);
    $statement->bind_param("ssssi",$this->organizer->getUsername(),
      $this->email,$this->password,$this->data,$this->state);
    $statement->execute();
    if($statement->affected_rows == 1){
      $connection->close();
    }
    else{
      $connection->close();
      throw new Exception("Request could not be created.");
    }
  }

  // Deletes the database entry for this object id.
  function delete()
  {
    if(!$this->exists())
      throw new Exception("Request doesn't exist");
    $connection = Relation::getConnection();
    $sentence = "DELETE FROM REQUEST WHERE r_id = ?";
    $statement = $connection->prepare($sentence);
    $statement->bind_param("i",$this->id);
    $statement->execute();
    if($statement->affected_rows == 1){
      $connection->close();
    }
    else{
      $connection->close();
      throw new Exception("Request could not be deleted.");
    }
  }

  // Updates the database entry for this object id.
  function update()
  {
    if(!$this->exists())
      throw new Exception("Request doesn't exist");
    $connection = Relation::getConnection();
    $sentence = "UPDATE REQUEST SET o_username = ?, email = ?, password = ?,
      data = ?, state = ? WHERE r_id = ?";
    $statement = $connection->prepare($sentence);
    $statement->bind_param("ssssii",$this->organizer->getName(),$this->email,
      $this->password,$this->data,$this->state,$this->id);
    $statement->execute();
    if($statement->affected_rows != 1){
      $connection->close();
      throw new Exception("Request could not be updated.");
    }
    $this->name = $this->newName;
    $connection->close();
  }

  // Populates the object with the data from the database
  // for the entry with id PK
  function populate()
  {
    if(!$this->exists())
      throw new Exception("Request doesn't exist");
    $connection = Relation::getConnection();
    $sentence = "SELECT * FROM REQUEST WHERE i_name = ?";
    $statement = $connection->prepare($sentence);
    $statement->bind_param("s",$this->name);
    $statement->execute();
    $statement->bind_result($name,$this->allergenic);
    $statement->fetch();
    $connection->close();

  }

  // Returns an array containing an object for every DB row.
  static function getAll()
  {
    $connection = Relation::getConnection();
    $sentence = "SELECT * FROM INGREDIENT";
    $statement = $connection->prepare($sentence);
    $statement->execute();
    $statement->bind_result($name,$allergenic);
    $organizers=array();
    while($statement->fetch()){
      $organizers[] = new Ingredient($name,$allergenic);
    }
    $connection->close();
    return $organizers;
  }

  // Check if this object exists in the DB.
  function exists()
  {
    $connection = Relation::getConnection();
    $sentence = "SELECT count(*) FROM INGREDIENT WHERE i_name = ?";
    $statement = $connection->prepare($sentence);
    $statement->bind_param("s",$this->name);
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
    $this->newName = $name;
  }

  function getAllergenic(){
    return $this->allergenic;
  }

  function setAllergenic($allergenic){
    $this->allergenic = $allergenic;
  }

}
