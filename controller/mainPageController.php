<?php
  include_once "../model/Pincho.php";
  try{
    $pinchos = Pincho::getAll();
  }
  catch(Exception $e){
    echo $e->getMessage();
  }
