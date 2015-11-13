<?php

include_once "Relation.php";

class Ingredient extends Relation {

  private $name;
  private $newName;
  private $allergenic;

  function __construct($name,$allergenic){
    $this->name = $name;
    $this->allergenic = $allergenic;
  }

  // Inserts the object data in the database.
  function insert()
  {
    if($this->exists())
      throw new Exception("Ingredient already exists");
    $connection = Relation::getConnection();
    $sentence = "INSERT INTO INGREDIENT VALUES (?, ?)";
    $statement = $connection->prepare($sentence);
    $statement->bind_param("si",$this->name,$this->allergenic);
    $statement->execute();
    if($statement->affected_rows == 1){
      $connection->close();
    }
    else{
      $connection->close();
      throw new Exception("Ingredient could not be created.");
    }
  }

  // Deletes the database entry for this object id.
  function delete()
  {
    if(!$this->exists())
      throw new Exception("Ingredient doesn't exist");
    $connection = Relation::getConnection();
    $sentence = "DELETE FROM INGREDIENT WHERE i_name = ?";
    $statement = $connection->prepare($sentence);
    $statement->bind_param("s",$this->name);
    $statement->execute();
    if($statement->affected_rows == 1){
      $connection->close();
    }
    else{
      $connection->close();
      throw new Exception("Ingredient could not be deleted.");
    }
  }

  // Updates the database entry for this object id.
  function update()
  {
    if(!$this->exists())
      throw new Exception("Ingredient doesn't exist");
    $connection = Relation::getConnection();
    $sentence = "UPDATE INGREDIENT SET i_name = ?, allergenic = ?
      WHERE i_name = ?";
    $statement = $connection->prepare($sentence);
    $statement->bind_param("sis",$this->newName,$this->allergenic,
      $this->name);
    $statement->execute();
    if($statement->affected_rows != 1){
      $connection->close();
      throw new Exception("Ingrediend could not be updated.");
    }
    $this->name = $this->newName;
    $connection->close();
  }

  // Populates the object with the data from the database
  // for the entry with id PK
  function populate()
  {
    if(!$this->exists())
      throw new Exception("Ingredient doesn't exist");
    $connection = Relation::getConnection();
    $sentence = "SELECT * FROM INGREDIENT WHERE i_name = ?";
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
    $ingredients=array();
    while($statement->fetch()){
      $ingredients[] = new Ingredient($name,$allergenic);
    }
    $connection->close();
    return $ingredients;
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
