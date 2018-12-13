<?php
//deleting an image 
session_start();
include_once 'server.php';

$id=$_SESSION['username'];

$filename="photos/profile".$id."*"; //file name in the root folder 
$fileinfo=glob($filename);//file info in array format

$fileext=explode(".", $fileinfo[0]);
$fileActualExt=$fileext[1];

$file="photos/profile".$id.".".$fileActualExt; //file path to be deleted

 $sql="UPDATE form SET status=0 WHERE username='$id'"; 
 $result=mysqli_query($conn,$sql);
 
 header('location:data.php?imagedeleted');
?>