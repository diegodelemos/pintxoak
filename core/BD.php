<?php

class BD
{
  public static function getConnection()
  {
    $host = "localhost";
    $user = "pinadmin";
    $pass = "pinpass";
    $db = "pintxoak";
    $connection = new mysqli($host,$user,$pass,$db);
    if(mysqli_connect_errno())
      throw new Exception("Unable to connect to the database");
    return($connection);
  }

}
