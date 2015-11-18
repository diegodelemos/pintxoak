<?php

include_once "Relation.php";
include_once "Organizer.php";

class Request extends Relation {

  private $id;
  // organizer is an object
  private $organizer;
  private $email;
  private $password;
  private $state;
  private $address;
  private $ePhoto;
  private $pName;
  private $pPhoto;
  private $pPrice;
  private $ingredients;
  private $eName;

  function __construct($id,$organizer,$address,$email,$password,$ePhoto,
      $pName,$pPhoto,$pPrice,$ingredients,$state,$eName){
    $this->id = $id;
    $this->organizer = $organizer;
    $this->email = $email;
    $this->password = $password;
    $this->state = $state;
    $this->address = $address;
    $this->ePhoto = $ePhoto;
    $this->pName = $pName;
    $this->pPhoto = $pPhoto;
    $this->pPrice = $pPrice;
    $this->ingredients = $ingredients;
    $this->eName = $eName;
  }

  // Inserts the object data in the database.
  function insert()
  {
    if($this->exists())
      throw new Exception("Request already exists");
    $connection = Relation::getConnection();
    $sentence = "INSERT INTO REQUEST (address,email,password,
      e_photo,p_name,p_photo,p_price,ingredients,state) VALUES (?, ?, ?, ?, ?,
      ?, ?, ?, ?, ?)";
    $statement = $connection->prepare($sentence);
    $statement->bind_param("ssssssdsi",
      $this->address,$this->email,$this->password,$this->ePhoto,
      $this->pName,$this->pPhoto,$this->pPrice,$this->ingredients,$this->state,
      $this->eName);
    $statement->execute();
    if($statement->affected_rows == 1){
      $connection->close();
    }
    else{
      $connection->close();
      throw new Exception("Request could not be created");
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
      throw new Exception("Request could not be deleted");
    }
  }

  // Updates the database entry for this object id.
  function update()
  {
    if(!$this->exists())
      throw new Exception("Request doesn't exist");
    $connection = Relation::getConnection();
    $sentence = "UPDATE REQUEST SET o_username = ?, address = ?, email = ?,
      password = ?, e_photo = ?, p_name = ?, p_photo = ?, p_price = ?,
      ingredients = ?, state = ?, e_name = ? WHERE r_id = ?";
    $statement = $connection->prepare($sentence);
    $statement->bind_param("ssssii",$this->organizer->getName(),$this->address,
      $this->email,$this->password,$this->e_photo,$this->pName,$this->pPhoto,
      $this->pPrice,$this->ingredients,$this->state,$this->id,$this->eName);
    $statement->execute();
    if($statement->affected_rows != 1){
      $connection->close();
      throw new Exception("Request could not be updated");
    }
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
    $statement->bind_result($nothing,$this->organizer,$this->address,
      $this->email,$this->password,$this->ePhoto,$this->pName,
      $this->pPhoto,$this->pPrice,$this->state,$this->eName);
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
    $statement->bind_result($id,$organizer,$address,$email,$password,$ePhoto,$pName,
      $pPhoto,$pPrice,$ingredients,$state,$eName);
    $requests=array();
    while($statement->fetch()){
      $requests[] = new Request($id,new Organizer($organizer),$address,$email,
        $password,$ePhoto,$pName,$pPhoto,$pPrice,$ingredients,$state,$eName);
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

  function getAddress(){
    return $this->address;
  }

  function setAddress($address){
    $this->address = $address;
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

  function getEPhoto(){
    return $this->ePhoto;
  }

  function setEPhoto($ePhoto){
    $this->ePhoto = $ePhoto;
  }

  function getPName(){
    return $this->pName;
  }

  function setPName($pName){
    $this->pName = $pName;
  }

  function getPPhoto(){
    return $this->pPhoto;
  }

  function setPPhoto($pPhoto){
    $this->pPhoto = $pPhoto;
  }

  function getPPrice(){
    return $this->pPrice;
  }

  function setPPrice($pPrice){
    $this->pPrice = $pPrice;
  }

  function getIngredients(){
    return $this->ingredients;
  }

  function setIngredients($ingredients){
    $this->ingredients = $ingredients;
  }

  function getState(){
    return $this->state;
  }

  function setState($state){
    $this->state = $state;
  }
  function getEName(){
    return $this->eName;
  }

  function setEName($eName){
    $this->eName = $eName;
  }

}
