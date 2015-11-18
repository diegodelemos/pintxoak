<?php
  include_once "../model/Request.php";
  try{
    $requests = Request::getAll();
  }
  catch(Exception $e){
    echo $e->getMessage();
  }
