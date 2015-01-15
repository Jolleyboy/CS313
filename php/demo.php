<?php 
  echo "PHP says: Hello World!";
  for ($i = 0; $i < 3; $i++) 
    echo "<div>This is div $i</div>";

  echo "Send email to: <input id='email>\n";
  $email = "jolleyboy@gmail.com";
  echo "<a href='mailto:$email'>$email</a>";

?>