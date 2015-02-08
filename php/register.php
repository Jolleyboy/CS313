<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/php/session.php';
  require_once $_SERVER['DOCUMENT_ROOT'] . '/php/dbConnect.php';

  $db = loadDatabase();
  $username   = trim($_POST['username']);
  $password   = trim($_POST['password']);
  $playername = trim($_POST['playername']);

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

  $query = "INSERT into player (password, name, username) VALUES (:password, :playername, :username)";

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

?>
