<?php
 //connecting to the mysqli database
$conn=mysqli_connect('localhost','root','','portfolio');

if(!$conn)die('connection failed: '.mysqli_connect_error());
?>