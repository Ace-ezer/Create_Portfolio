<!--Contact Edit form-->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
<link rel="stylesheet" type="text/css" href="datacss.css">

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


<style type="text/css">
  .contact input[type=text],.contact button{
  width:100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
  font-size: 15px;
 }

 .contact label {
  padding: 12px 12px 12px 0;
  display: inline-block;
  color: white;
  font-size: 20px;
  font-family: monospace;
 }
 .contact button{
  background:black;
  color:white;
  font-family: times new roman; 
 }
  @media screen and (max-width:600px)
 {

  .contact h3{
    margin-top:100px;
  }
 .contact input[type=text],.contact textarea{
  width:80%;
  padding: 10px;
 }
 .contact button{
  width:100%;
 }
 .contact label {
  padding: 0px;
  display: block;
  font-size: 20px;
  font-family: monospace;
 }
 }
</style>

<!--Topnav-->
<div class='topnav'>
    <a href='data.php'>Home</a>
    <div class='log-container'>
    <form method='POST' action='logout.php'>
      <button type='submit' name='logout'>Exit</button>
    </form>
    </div>
</div>

<!--Following code call cedit function in form.inc.php to submit the edited data.-->
<?php
 $id=$_POST['id'];
 $email=$_POST['email'];
 $con=$_POST['contact'];
 $fb=$_POST['fb'];
 $git=$_POST['git'];
  echo " <div id='contact' class='contact'>
            <div class='deatil'>
            <h3 style='color:white;'>Edit Contacts</h3>
            <hr style='border-color:white;'>
              <form method='POST' action='".cedit($conn)."'>
                <div class='row'>
                 <input type='hidden' name='id' value='".$id."'>
                </div>
                <div class='row'>
                  <div class='col-25'>
                    <label>Email:</label>
                  </div>
                  <div class='col-75'>
                    <input type='text' name='email' value='".$email."'>
                  </div>
                </div>
                <div class='row'>
                  <div class='col-25'>
                    <label>Contact:</label>
                  </div>
                  <div class='col-75'>
                    <input type='text' name='contact' value='".$con."'>
                  </div>
                </div>
                <div class='row'>
      <div class='col-25'>
        <label for='age'>Fb link</label>
      </div>
      <div class='col-75'>
        <input type='text' id='fb' name='fb' value='".$fb."'>
      </div>
    </div>
    <div class='row'>
      <div class='col-25'>
        <label for='age'>Github link</label>
      </div>
      <div class='col-75'>
        <input type='text' id='git' name='git' value='".$git."'>
      </div>
    </div>
              <button type='submit' name='editsubmit'>Edit</button>
              </form>                
            </div>
          <hr style='border-color:white;margin-top:50px;'>
          <footer style='font-family: times new roman;color:white;'><center>Designed & Developed by Arpit Yadav</center></footer>
          </div>";      
?>
    