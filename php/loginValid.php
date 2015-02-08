<?php
  require_once $_SERVER['DOCUMENT_ROOT'] . '/php/session.php';
  
  if (!isset($_SESSION['username']) )
  {
    header('Location: /arctic/login.html');
  }

?>
