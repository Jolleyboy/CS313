<?php
  ini_set('display_errors', '1');
  error_reporting(E_ALL);
  require_once $_SERVER['DOCUMENT_ROOT'] . '/php/session.php';
  require_once $_SERVER['DOCUMENT_ROOT'] . '/php/dbConnect.php';

  $db = loadDatabase();
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  
  $username = $_SESSION['username'];

  $results;

  try {
    $query = "SELECT isAlive FROM player WHERE username = :username";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } 
  catch (PDOException $e) {
    echo $e->getMessage();
  }

  foreach ($results as $row) 
  {
    if ($row['isAlive'] == true) 
    {
      try 
      {
        $query = "SELECT hp, warmth, hunger, atk, def, score, isAlive, 
                  hoursLived FROM player WHERE username = :username";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $results2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results2 as $row)
        {
          echo json_encode($row);
        }
      }
      catch (PDOException $e) {
        echo $e->getMessage();
      }
    }
    else 
    {
      try 
      {
        $query = "SELECT hp, warmth, hunger, atk, def, score, isAlive, 
                  hoursLived FROM player WHERE username = 'default'";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $results2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results2 as $row)
        {
          echo json_encode($row);
        }
      }
      catch (PDOException $e) 
      {
        echo $e->getMessage();
      }
    }
  }
?>