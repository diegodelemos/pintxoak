<?php

include_once "Relation.php";

abstract class User extends Relation
{
  protected $username;
  protected $password;

  function __construct($username, $password = null)
  {
    $this->username = $username;
    $this->password = $password;
  }

  function getUsername()
  {
    return $this->username;
  }

  function setUsername($username)
  {
    $this->username = $username;
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
