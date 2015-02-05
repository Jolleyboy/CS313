<?php
 function loadDatabase() { 
  $hostName = 'localhost';
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