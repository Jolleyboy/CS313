<?php
  require $_SERVER['DOCUMENT_ROOT'] . '/php/dbConnect.php';
  $db = loadDatabase();
  
  $stmt = $db->query("SELECT * from topic");
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

  foreach ($results as $row)
  {
    echo "<div class='input" . ucfirst($row['topic']) . "'>";
    echo "   <label>" . ucfirst($row['topic']) . "</label>";
    echo "   <input type='checkbox' name='topicArray[]' value='" . $row['id'] . "'/>"; 
    echo "</div> ";
  }
  
?>