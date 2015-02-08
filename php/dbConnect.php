<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/php/session.php';
   
  function loadDatabase() { 
  $hostName = $_SERVER['SERVER_ADDR'];
  $dbName = 'arctic';
  $userName = 'jolley';
  $password = 'just4u';
  
  try
  {
    $db = new PDO("mysql:host=$hostName;dbname=$dbName",$userName, $password);
  }
  catch (PDOException $ex) 
  {
    echo "Error!: " . $ex->getMessage();
    die(); 
  }
  return $db;
}
?>