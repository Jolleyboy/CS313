<?php
   require_once $_SERVER['DOCUMENT_ROOT'] . '/php/session.php';
   require_once $_SERVER['DOCUMENT_ROOT'] . '/php/dbConnect.php';
   
   $db = loadDatabase();
   
   $query = "SELECT username, name, highScore FROM player";
   $stmt = $db->prepare($query);
   $stmt->execute();
   $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

   if (count($results) > 0)
   {
      echo '<h1> Players </h1>';
      foreach ($results as $row)
      {
         echo '<div style="float:left; width:170px; margin:10px 10px; padding 10px; background:rgba(255,255,255,.8); border-radius:5px;">Account: ' . ucfirst($row['username']) . '<br/>Player:&nbsp;&nbsp;&nbsp;&nbsp;' . ucfirst($row['name']) . '<br/>High Score: ' . (empty($row['highScore']) ? "0" : $row['highScore'])  . '</div>';
      }
   }  
   else 
   {
      echo "<script> $('.loginResults').css('color', 'red')</script>";
      echo "Error Please try again.";
   }
?>