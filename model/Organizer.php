<?php

include_once "User.php";

class Organizer extends User
{

  function __construct($username, $password = null)
  {
    parent::__construct($username, $password);
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
      $sentence = "INSERT INTO ORGANIZER VALUES (?)";
      $statement = $connection->prepare($sentence);
      $statement->bind_param("s",$this->username);
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

  // Deletes the database entry for this object id.
  function delete()
  {
    if(!$this->exists())
      throw new Exception("User doesn't exist");
    $connection = Relation::getConnection();
    $connection->begin_transaction();
    $sentence = "DELETE FROM ORGANIZER WHERE o_username = ?";
    $statement = $connection->prepare($sentence);
    $statement->bind_param("s",$this->username);
    $statement->execute();
    if($statement->affected_rows == 1){
      $sentence = "DELETE FROM USER WHERE username = ?";
      $statement = $connection->prepare($sentence);
      $statement->bind_param("s",$this->username);
      $statement->execute();
      if($statement->affected_rows == 1){
        $connection->commit();
        $connection->close();
      }
      else{
        $connection->rollback();
        $connection->close();
        throw new Exception("User could not be deleted.");
      }
    }
    else{
      $connection->rollback();
      $connection->close();
      throw new Exception("User could not be deleted.");
    }



  }

  // Updates the database entry for this object id.
  function update()
  {
    // TODO ask Analia on update cascade
  }

  // Populates the object with the data from the database
  // for the entry with id PK
  function populate()
  {
    if(!$this->exists())
      throw new Exception("User doesn't exist");

  }

  // Returns an array containing an object for every DB row.
  static function getAll()
  {
    $connection = Relation::getConnection();
    $connection->begin_transaction();
    $sentence = "SELECT * FROM ORGANIZER";
    $statement = $connection->prepare($sentence);
    $statement->execute();
    $statement->bind_result($username);
    $organizers=array();
    while($statement->fetch()){
      $organizers[] = new Organizer($username);
    }
    return $organizers;
  }

  // Check if this object exists in the DB.
  function exists()
  {
    $connection = Relation::getConnection();
    $sentence = "SELECT count(*) FROM ORGANIZER WHERE o_username = ?";
    $statement = $connection->prepare($sentence);
    $statement->bind_param("s",$this->username);
    $statement->execute();
    $statement->bind_result($exists);
    $statement->fetch();
    $connection->close();
    return ($exists==1);
  }

}
