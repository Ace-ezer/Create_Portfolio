<!--To Edit/Upload/Delete a profile picture-->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
<link rel="stylesheet" type="text/css" href="datacss.css">

<?php
  session_start();

 if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: port-login.php");
    exit;
 }
  include 'server.php';
  include 'form.inc.php';
?>

<style type="text/css">
  @media screen and (max-width:600px)
  {
    .container
    {
      margin-top:100px;
    }
  }
</style>


<html>
  <div class='topnav'>
    <a href='data.php'>Home</a>
    <div class='log-container'>
    <form method='POST' action='logout.php'>
      <button type='submit' name='logout'>Exit</button>
    </form>
  </div>
  </div>
    <div id='about' class='about'>
    <div class='container'> 
    <h3>About</h3>
    <hr style='margin-bottom: 50px;'>
 <?php

  //user profile pic and username section
 $id=$_SESSION['username'];
 $sql="SELECT * FROM form WHERE username='$id'";
 $result=mysqli_query($conn,$sql);
 $row=$result->fetch_assoc();
 if($result->num_rows>0){
          echo "<div  class='row'>";
          if ($row['status']==1) {
            echo "<div class='col-50'><img src='photos/profile".$id.".jpg' alt='avatar' class='avatar'></div>";
          }
          else {
          echo "<div class='col-50'><img src='photos/profilepic1.jpg'></div>";
           }
          echo "</div>";  
 }
  //section to upload or delete your profile image
 echo " <div class='row'>
   <div class='col-50'>
   <form method='POST' action='upload.php' enctype='multipart/form-data'>
   <input type='file' name='file'>
   <button type='submit' name='imgsubmit'>Upload</button>
  </form> </div>
   <div class='col-50'>
  <form method='POST' action='deleteimage.php'>
   <button type='submit' name='delsubmit'>Delete</button>
  </form>
   </div>
  </div>";
 ?> 
    <div class='row'>
      <div class='col-75'>
      </div>
      <div class='col-25'>
        <?php name($conn);?>
      </div>
    </div>
    <?php getabout($conn);?>
  </div>
  <hr style='border-color:white;margin-top:50px;'>
  <footer style='font-family: times new roman;color: white;'><center>Designed & Developed by Arpit Yadav</center></footer>
  </div>