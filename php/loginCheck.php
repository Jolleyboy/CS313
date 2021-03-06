<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/php/session.php';
  require_once $_SERVER['DOCUMENT_ROOT'] . '/php/dbConnect.php';

  $db = loadDatabase();
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);

  $query = "SELECT username, password, name FROM player WHERE username = :username";
  $stmt = $db->prepare($query);
  $stmt->bindValue(':username', $username, PDO::PARAM_STR);
  $stmt->execute();
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if (count($results) > 0)
  {
    foreach ($results as $row)
    {
      if (password_verify($password, $row['password'])) {
        // Correct Password
        $_SESSION['username'] = $row['username'];
        $_SESSION['name'] = $row['name'];
        echo "<script> $('.loginResults').css('color', 'green')</script>";
        echo "Success! Logged in as " . $_SESSION['username'];
        echo '<script> document.location = \'/arctic/index.html\' </script>';
      } else {
        // Wrong password
        echo "<script> $('.loginResults').css('color', 'red')</script>";
        echo "Invalid login. Please try again.";
      } 
    }
  }  
  else 
  {
    echo "<script> $('.loginResults').css('color', 'red')</script>";
    echo "Invalid login. Please try again.";
  }
?>
