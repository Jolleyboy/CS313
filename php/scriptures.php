<?php
  require $_SERVER['DOCUMENT_ROOT'] . '/php/dbConnect.php';
  $db = loadDatabase();

  $stmt = $db->query("SELECT book, chapter, verse, content, topic FROM scriptures as s join scriptureTopic as st ON s.id = st.scriptureId join topic as t ON t.id = st.topicId");
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

  
  function topicMatch($pattern, $subject) 
  {
    return preg_match($pattern, $subject, $matches);
  }

  //merge rows that have the same scripture (more than one topic)
  foreach($results as $i => $row)
  {
    foreach($results as $j => $row2)
    {
      //if the content is equal, the scripture is equal.
      if ($row['content'] == $row2['content'] && 
          !topicMatch('/'.$row['topic'].'/i',  $row2['topic']))
      {
        $results[$i]['topic'] = $row['topic'] . ", " . ucfirst($row2['topic']);
        unset($results[$j]);
      }
    }
  }


  $results = array_filter($results);

  foreach ($results as $row)
  {
    //Find everything that matches the query
    $pattern = '/' . $_POST['search'] . '/i';
    $subject = implode(" ", $row);
    
    if (preg_match($pattern, $subject, $matches))
    {
      echo "<h4>Topic(s): " . ucfirst($row['topic']) . "</h4><br/>";
      echo $row['book'] . " " . $row['chapter'] . ":" . $row['verse'] . " " . $row['content'] . "<br/><br/>";
    }
  }
?>