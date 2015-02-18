<?php
  ini_set('display_errors', '1');
  error_reporting(E_ALL);
  require_once $_SERVER['DOCUMENT_ROOT'] . '/php/session.php';
  require_once $_SERVER['DOCUMENT_ROOT'] . '/php/dbConnect.php';

  $db = loadDatabase();
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  
  $username   = trim($_POST['username']);
  $password   = trim($_POST['password']);
  $playername = trim($_POST['playername']);

  $password = password_hash($password, PASSWORD_DEFAULT);

  try {
    //check if the username is already taken
    $query = "SELECT username FROM player WHERE username = :username";

    $stmt = $db->prepare($query);
    $stmt->bindValue(':username',   $username,   PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($results) > 0)
    {
      echo "<script> $('.loginResults').css('color', 'red')</script>";
      exit("I'm sorry, that account name is already taken. Please choose another account name.");
    }
  } 
  catch (PDOException $e) {
    echo $e->getMessage();
  } 

  try {
    //check if the playername is already taken
    $query = "SELECT username FROM player WHERE name = :playername";

    $stmt = $db->prepare($query);
    $stmt->bindValue(':playername', $playername, PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($results) > 0)
    {
      echo "<script> $('.loginResults').css('color', 'red')</script>";
      exit("I'm sorry, that player name is already taken. Please choose another player name.");
    }
  } 
  catch (PDOException $e) {
    echo $e->getMessage();
  }

  try {
    //Make a new player
    $query = "INSERT into player (password, name, username, hp, warmth, hunger, 
              atk, def, score, highScore, isAlive, hoursLived) 
              VALUES (:password, :playername, :username, 15, 15, 15, 0, 0, 0, 0, false, 0)";

    $stmt = $db->prepare($query);
    $stmt->bindValue(':username',   $username,   PDO::PARAM_STR);
    $stmt->bindValue(':playername', $playername, PDO::PARAM_STR);
    $stmt->bindValue(':password',   $password,   PDO::PARAM_STR);
     
    if( $stmt->execute() )
    {
      echo "<script> $('.loginResults').css('color', 'green')</script>";
      echo 'You have successfully registered.  Please login using the form on the left.';
    }
    else
    {
      echo "<script> $('.loginResults').css('color', 'red')</script>";
      print_r($db->errorInfo());
    }
  } 
  catch (PDOException $e) {
    echo $e->getMessage();
  }

  $playerId = $db->lastInsertId();

  try {
    //insert initial resources for the player
    $query = "SELECT id FROM resource";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $waterId = 5;
    $foodId = 1;

    foreach ($results as $row)
    {
      $resourceId = $row['id'];
      if ($resourceId != $waterId && $resourceId != $foodId)
      {
        $value = 0;
      }
      else
      {
        $value = 20;
      }
      
      $query = "INSERT into playerResources (playerId, resourceId, quantity) 
                VALUES ($playerId, $resourceId, $value)";
      $stmt = $db->prepare($query);
      $stmt->execute();
      
    }
  } 
  catch (PDOException $e) {
    echo $e->getMessage();
  }
?>
