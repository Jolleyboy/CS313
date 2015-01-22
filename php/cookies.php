<?php
  if (isset($_COOKIE['userCount']))
    setcookie('userCount', $_COOKIE['userCount'] + 1, time() + 60 * 10);
  else
  {  
    $CookieName = "userCount";
    $count = 0;
    setcookie($CookieName, $count, time() + 60 * 10);
  }
?> 