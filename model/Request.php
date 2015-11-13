<?php

include_once "Relation.php";
include_once "Organizer.php";

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
    $sentence = "SELECT * FROM REQUEST WHERE r_id = ?";
    $statement = $connection->prepare($sentence);
    $statement->bind_param("i",$this->id);
    $statement->execute();
    $statement->bind_result($nothing,$organizer,$email,$password,$data,$state);
    $statement->fetch();
    $this->organizer = new Organizer($organizer);
    $connection->close();

  }

  // Returns an array containing an object for every DB row.
  static function getAll()
  {
    $connection = Relation::getConnection();
    $sentence = "SELECT * FROM REQUEST";
    $statement = $connection->prepare($sentence);
    $statement->execute();
    $statement->bind_result($id,$organizer,$email,$password,$data,$state);
    $requests=array();
    while($statement->fetch()){
      $requests[] = new Ingredient($id,new Organizer($organizer),$email,
        $password,$data,$state);
    }
    $connection->close();
    return $requests;
  }

  // Check if this object exists in the DB.
  function exists()
  {
    $connection = Relation::getConnection();
    $sentence = "SELECT count(*) FROM REQUEST WHERE r_id = ?";
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

  function getOrganizer(){
    return $this->organizer;
  }

  function setOrganizer($organizer){
    $this->organizer = $organizer;
  }

  function getEmail(){
    return $this->email;
  }

  function setEmail($email){
    $this->email = $email;
  }

  function getPassword(){
    return $this->password;
  }

  function setPassword($password){
    $this->password = $password;
  }

  function getData(){
    return $this->data;
  }

  function setData($data){
    $this->data = $data;
  }

  function getState(){
    return $this->state;
  }

  function setState($state){
    $this->state = $state;
  }

}
