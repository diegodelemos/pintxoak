<?php

include_once "../core/BD.php";

abstract class Relation
{

	protected  getConnection() {
		   return BD::getConnection();	
	}

	// Inserts the object data in the database.
	abstract function insert();
	// Deletes the database entry for this object id.
	abstract function delete();
	// Updates the database entry for this object id.
	abstract function update();
	// Populates the object with the data from the database
	// for the entry with id PK
	abstract populate();
	// Returns an array containing an object for every DB row.
	abstract static getAll();
}

?>