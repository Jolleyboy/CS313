<?php
   require $_SERVER['DOCUMENT_ROOT'] . '/php/dbConnect.php';
   error_reporting(-1);
   $db = loadDatabase();
   $username = $_POST['username'];
   $password = $_POST['password'];

   $query = "SELECT username, password FROM player WHERE username = :username AND password = :password";
   $stmt = $db->prepare($query);
   $stmt-bindParam(':username', $username);
   $stmt-bindParam(':password', $password);
   $stmt->execute();
   $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

   if (count($results) > 0)
   {
      foreach ($results as $row)
      {
         $_SESSION['username'] = $row['username'];
         echo "Success!";
         echo '<script document.location = \'' . $_SERVER['HTTP_HOST'] . '/arctic/index.html\' </script>'
      }
   }  
   else 
   {
      echo "Invalid login. Please try again.";
   }
?>
