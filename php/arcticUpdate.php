<?php
  ini_set('display_errors', '1');
  error_reporting(E_ALL);
  require_once $_SERVER['DOCUMENT_ROOT'] . '/php/session.php';
  require_once $_SERVER['DOCUMENT_ROOT'] . '/php/dbConnect.php';

  $db = loadDatabase();
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  
  $username = $_SESSION['username'];
  $playerInfo = $_POST;
  foreach ($playerInfo as $resourceName => $resourceQuantity)
  {
     
      $query = "UPDATE playerResources SET quantity = :resourceQuantity 
                WHERE playerId = (SELECT id FROM player WHERE username = :username)
                AND resourceId = (SELECT id FROM resource WHERE name = :resourceName)";
      $stmt = $db->prepare($query);
      $stmt->bindValue(':username', $username, PDO::PARAM_STR);
      $stmt->bindValue(':resourceName', $resourceName, PDO::PARAM_STR);
      $stmt->bindValue(':resourceQuantity', $resourceQuantity, PDO::PARAM_INT);
      $stmt->execute();
  }

  try {
    $query = "UPDATE player SET hp = :hp, warmth = :warmth, hunger = :hunger, 
              isAlive = :isAlive, hoursLived = :hoursLived
              WHERE username = :username";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->bindValue(':hp', $playerInfo['hp'], PDO::PARAM_INT);
    $stmt->bindValue(':warmth', $playerInfo['warmth'], PDO::PARAM_INT);
    $stmt->bindValue(':hunger', $playerInfo['hunger'], PDO::PARAM_INT);
    $stmt->bindParam(':isAlive', $playerInfo['isAlive']);
    $stmt->bindParam(':hoursLived', $playerInfo['hoursLived']);
    $stmt->execute();
  }
  catch (PDOException $e) {
    echo $e->getMessage();
  }
?>