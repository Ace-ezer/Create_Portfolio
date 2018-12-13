<?php
//Logout/exit 
session_start();
$_SESSION=array();
session_destroy();
header('location:port-login.php');
exit();
?>