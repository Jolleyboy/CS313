<?php 
  require $_SERVER['DOCUMENT_ROOT'] . '/php/dbConnect.php';
  $db = loadDatabase();
  
  $book = $_POST['book'];
  $chapter = $_POST['chapter'];
  $verse = $_POST['verse'];
  $content = $_POST['content'];
  $topics = $_POST['topicArray'];

  print_r($topics);

  $query="INSERT into scriptures (book, chapter, verse, content) values(:book, :chapter, :verse, :content)";
  $stmt = $db->prepare($query);
  $stmt->bindParam(':book',   $book);
  $stmt->bindParam(':chapter',$chapter);
  $stmt->bindParam(':verse',  $verse);
  $stmt->bindParam(':content',$content);
  $stmt->execute();

  $lastScriptureId = $db->lastInsertId();
  echo "The Scripture ID was: $lastScriptureId <br/>";
  
  foreach ($topics as $topic)
  {
    echo "Adding topic: $topic <br/>";
    $query = "INSERT into scriptureTopic (scriptureId, topicId) values (:scriptureId, :topicId)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':scriptureId', $lastScriptureId);
    $stmt->bindParam(':topicId',     $topic);
    $stmt->execute();
  }

  echo "Scripture succesfully inserted";
?>
