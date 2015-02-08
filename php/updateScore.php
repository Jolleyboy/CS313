<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/php/session.php';
  require_once $_SERVER['DOCUMENT_ROOT'] . '/php/dbConnect.php';

  $db = loadDatabase();
 
  $username   = $_SESSION['username'];
  $score      = $_POST['score'];

  $query = "SELECT highScore FROM player WHERE username = :username";

  $stmt = $db->prepare($query);
  $stmt->bindValue(':username', $username, PDO::PARAM_STR);
  $stmt->execute();
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $highScore = 0;
  foreach ($results as $row)
  {
    $highScore = $row['highScore'];
    if ($score > $highScore)
    {
      $query = "UPDATE player SET score = :score, highScore = :score WHERE username = :username";
      $stmt = $db->prepare($query);
      $stmt->bindValue(':username', $username, PDO::PARAM_STR);
      $stmt->bindValue(':score',    $score,    PDO::PARAM_INT);
      $stmt->execute();

      if( $stmt->execute() )
      {
        echo "New High Score: " . $score;
      }
      else
      {
        print_r($db->errorInfo());
      }
    }
    else
    {
      $query = "UPDATE player SET score = :score WHERE username = :username";
      $stmt = $db->prepare($query);
      $stmt->bindValue(':username', $username, PDO::PARAM_STR);
      $stmt->bindValue(':score',    $score,    PDO::PARAM_INT);
      $stmt->execute();

      if( $stmt->execute() )
      {
        echo "Score: " . $score . "\nHigh Score: " . $highScore;
      }
      else
      {
        print_r($db->errorInfo());
      }
    }
  }
?>
