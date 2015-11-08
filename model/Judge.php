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
    $sentence = "DELETE FROM JUDGE WHERE j_username = ?";
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
    $connection = Relation::getConnection();
    $connection->begin_transaction();
    $sentence = "SELECT * FROM JUDGE WHERE j_username = ?";
    $statement = $connection->prepare($sentence);
    $statement->execute();
    $statement->bind_result($username,$this->name,$this->profession,$this->photo);
    $statement->fetch();
    $connection->close();
  }

  // Returns an array containing an object for every DB row.
  static function getAll()
  {
    $connection = Relation::getConnection();
    $connection->begin_transaction();
    $sentence = "SELECT * FROM JUDGE";
    $statement = $connection->prepare($sentence);
    $statement->execute();
    $statement->bind_result($username,$name,$profession,$photo);
    $organizers=array();
    while($statement->fetch()){
      $organizers[] = new Judge($username,$name,$profession,$photo);
    }
    $connection->close();
    return $organizers;
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

}
