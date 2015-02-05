<?php
  require $_SERVER['DOCUMENT_ROOT'] . '/php/dbConnect.php';
  $db = loadDatabase();
  $stmt = $db->query("SELECT book, chapter, verse, content FROM scriptures");
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);


  foreach ($results as $row)
  {
    //Find everything that matches the query
    $pattern = '/' . $_POST['search'] . '/';
    $subject = implode(" ", $row);
    
    if (preg_match($pattern, $subject, $matches))
    {
      echo $row['book'] . " " . $row['chapter'] . ":" . $row['verse'] . " " . $row['content'] . "<br/><br/>";
    }
  }
?>