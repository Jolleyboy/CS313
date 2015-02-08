<?php

session_start();

if ( !$_SESSION['teacherId'] )
{
    header('Location: ../login.php');

}

?>