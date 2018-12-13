<!--About Edit Form-->

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
<link rel="stylesheet" type="text/css" href="datacss.css">

<style type="text/css">
  .about input[type=text],.about button,.about textarea{
  width:100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
  font-size: 15px;
 }
 .about button{
  color:white;
 }
 .about label {
  padding: 12px 12px 12px 0;
  display: inline-block;
  font-size: 15px;
  font-family: monospace;
 }
 .about button{
  background:black;
  font-family: times new roman; 
 }

 @media screen and (max-width:600px)
 {

  .container{
    margin-top:100px;
    margin-bottom: 50px;
  }
 .about input[type=text],.about textarea{
  width:80%;
  padding: 10px;
 }
 .about button{
  width:100%;
 }
 .about label {
  padding: 0px;
  display: block;
  font-size: 20px;
  font-family: monospace;
 }
 }
</style>

<?php
  session_start();
   if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: port-login.php");
    exit;
  }
  include 'server.php';
  include 'form.inc.php';
?>

<!--Topnav-->
 <div class='topnav'>
    <a href='data.php' style='padding: 26px 16px;'>Home</a>
    <div class='log-container'>
    <form method='POST' action='logout.php'>
      <button type='submit' name='logout'>Exit</button>
    </form>
    </div>
 </div>
 
 <!--Edit form which call aedit function in form.inc.php to Store edited data-->
 <?php

   $id=$_POST['id'];
   $first=$_POST['fname'];
   $last=$_POST['lname'];
   $age=$_POST['age'];
   $gender=$_POST['gender'];
   $country=$_POST['country'];
   $city=$_POST['city'];
   $description=$_POST['description'];


   echo " <div id='about' class='about'>
            <div class='container'><h3>Edit About</h3>
             <hr>
             <form method='POST' action='".aedit($conn)."'>
                <div class='row'>
          	     <input type='hidden' name='id' value='".$id."'>
                </div>
                <div class='row'>
                  <div class='col-25'>
                    <label>First name:</label>
                  </div>
                  <div class='col-75'>
                    <input type='text' name='fname' value='".$first."'>
                  </div>
                </div>
                <div class='row'>
                  <div class='col-25'>
                    <label>last name:</label>
                  </div>
                  <div class='col-75'>
                    <input type='text' name='lname' value='".$last."'>
                  </div>
                </div>
                <div class='row'>
                  <div class='col-25'>
                    <label>age:</label>
                  </div>
                  <div class='col-75'>
                    <input type='text' name='age' value='".$age."'>
                  </div>
                </div>
                <div class='row'>
                  <div class='col-25'>
                    <label>Gender:</label>
                  </div>
                  <div class='col-75'>
                    <input type='text' name='gender' value='".$gender."'>
                  </div>
                </div>
                <div class='row'>
                  <div class='col-25'>
                    <label>Country:</label>
                  </div>
                  <div class='col-75'>
                    <input type='text' name='country' value='".$country."'>
                  </div>
                </div>
                <div class='row'>
                  <div class='col-25'>
                    <label>City:</label>
                  </div>
                  <div class='col-75'>
                    <input type='text' name='city' value='".$city."'>
                  </div>
                </div>
                <div class='row'>
                  <div class='col-25'>
                    <label>Description:</label>
                  </div>
                  <div class='col-75'>
                    <textarea name='description'>".$description."</textarea>
                  </div>
                </div>
      		      <button type='submit' name='editsubmit'>Edit</button>
              </form>
            </div>
  <hr style='border-color:white;margin-top:50px;'>
  <footer style='font-family: times new roman; color:white;'><center>Designed & Developed by Arpit Yadav</center></footer>  
          </div>";   
 ?>
 