<?php

include_once "Relation.php";

abstract class User extends Relation
{
  protected $username;
  protected $password;
  // necessary for the update. To update the username we need to know the actual
  // and new username
  protected $newUsername;

  function __construct($username, $password = null)
  {
    $this->username = $username;
    $this->password = $password;
    $this->newUsername = $username;
  }

  // Deletes the database entry for this object id.
  function delete()
  {
    if(!$this->exists())
      throw new Exception("User doesn't exist");
    $connection = Relation::getConnection();
    $sentence = "DELETE FROM USER WHERE username = ?";
    $statement = $connection->prepare($sentence);
    $statement->bind_param("s",$this->username);
    $statement->execute();
    if($statement->affected_rows == 1){
      $connection->close();
    }
    else{
      $connection->close();
      throw new Exception("User could not be deleted.");
    }
  }

  // Base user update
  protected function userUpdate($connection){
    if($this->username != $this->newUsername){
      $sentence = "UPDATE USER SET username = ? WHERE username = ?";
      $statement = $connection->prepare($sentence);
      $statement->bind_param("ss",$this->newUsername,$this->username);
      $statement->execute();
      if($statement->affected_rows != 1){
        $connection->rollback();
        $connection->close();
        throw new Exception("User could not be updated");
      }
      else{
        $this->username = $this->newUsername;
      }
    }
    if($this->password != null){
      $sentence = "UPDATE USER SET password = ? WHERE username = ?";
      $statement = $connection->prepare($sentence);
      $statement->bind_param("ss",$this->password,$this->username);
      $statement->execute();
      if($statement->affected_rows != 1){
        $connection->rollback();
        $connection->close();
        throw new Exception("User could not be updated");
      }
    }
  }


  function getUsername()
  {
    return $this->username;
  }

  function setUsername($username)
  {
    $this->newUsername = $username;
  }

  function getPassword()
  {
    return $this->password;
  }

  function setPassword($password)
  {
    $this->password = $password;
  }
  function checkPassword($password){
    $connection = $this->getConnection();
    $sentence = "SELECT count(*) FROM USER WHERE username = ? AND password = ?";
    $statement = $connection->prepare($sentence);
    $statement->bind_param("ss",$this->username,$password);
    $statement->execute();
    $statement->bind_result($exists);
    $statement->fetch();
    $connection->close();
    return ($exists==1);
  }
}
