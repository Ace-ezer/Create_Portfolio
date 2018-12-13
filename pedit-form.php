<!--Portfolio section edit form-->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
<link rel="stylesheet" type="text/css" href="datacss.css">

<style type="text/css">
  .portfolio button,.portfolio textarea{
  width:100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
  font-size: 15px;
 }
 .portfolio button{
  color:white;
 }
 .portfolio label {
  padding: 12px 12px 12px 0;
  display: inline-block;
  font-size: 20px;
  font-family: monospace;
 }
 .portfolio button{
  background:black;
  font-family: times new roman; 
 }

  @media screen and (max-width:600px)
 {

  .pcontainer{
    margin-top:100px;
    margin-bottom: 50px;
  }
 .portfolio input[type=text],.portfolio textarea{
  width:80%;
  padding: 10px;
 }
 .portfolio button{
  width:80%;
 }
 .portfolio label {
  padding: 0px;
  display: block;
  font-size: 15px;
  font-family: monospace;
 }
 }
</style>


<?php
  session_start();
  if(!isset($_SESSION['loggedin'])&&$_SESSION['loggedin']!==true)
  {
  header('location:port-login.php');
  exit;
  }

  include 'server.php';
  include 'form.inc.php';
?>

<div class='topnav'>
    <a href='data.php'>Home</a>
    <div class='log-container'>
    <form method='POST' action='logout.php'>
      <button type='submit' name='logout'>Exit</button>
    </form>
    </div>
</div>

<!--Following calls pedit function in form.inc.php to store edited data-->
 <?php
   $id=$_POST['id'];
   $education=$_POST['education'];
   $tech=$_POST['tech'];
   $achievements=$_POST['achievements'];

   echo "<div class='portfolio'>
          <div class='pcontainer'>
            <h3>Edit Portfolio</h3>
            <hr>
              <form method='POST' action='".pedit($conn)."'>
                <div class='row'>
                   <input type='hidden' name='id' value='".$id."'>
                </div>
                <div class='row'>
                  <div class='col-25'>
          	       <label>Education:</label>
                  </div>
                  <div class='col-75'> 
      		          <textarea name='education'>".$education."</textarea>
                  </div>
                </div>
                <div class='row'>
                  <div class='col-25'>    
      		          <label>Technical skills:</label>
                  </div>
                  <div class='col-75'>  
      		          <textarea name='tech'>".$tech."</textarea>
                  </div>
                </div>  
                  <div class='row'>
                    <div class='col-25'>  
      		            <label>Achievements:</label>
                    </div>
                    <div class='col-75'>  
      		            <textarea name='achievements'>".$achievements."</textarea>
                    </div>
                  </div>
                  <div class='row'>    
      		          <button type='text' name='editsubmit'>Edit</button>
                  </div>   
              </form>
          </div>   
        </div>";
 ?>
 <hr>
 <footer style='font-family: times new roman'><center>Designed & Developed by Arpit Yadav</center></footer>