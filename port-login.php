<!--Login Form-->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
<link rel="stylesheet" type="text/css" href="portFormCSS.css">

<!--PHP for verification and login-->
<?php
 session_start();
 if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true)
  {
  header('location:data.php');
  exit;
  }

 include 'server.php';
 require_once 'google_signup\settings.php';

    $err="";
 if($_SERVER['REQUEST_METHOD']=='POST'){

	$username=$_POST['username'];
	$password=$_POST['password'];
	$sql="SELECT * FROM form WHERE username='$username'";
	$result=mysqli_query($conn,$sql);

	if($result){
		$row=$result->fetch_assoc();
		$hashed_password=$row['password'];
         if(password_verify($password,$hashed_password)){
          session_start();
          $_SESSION['username']=$username;
          $_SESSION['loggedin']=true;
          header("location:data.php");
         }
         else $err="Incorrect Username or Password.";
	}
	else $err="Incorrect username";
 }
 mysqli_close($conn);
?>

<style type="text/css">
  span{
     color:white;
   }
	.logcontainer{
		padding:100px 100px;
		background:purple; 
		color:black;
	}
  @media screen and (max-width:600px)
  {
    .logcontainer{
      padding:40px 40px;
    }
    .logcontainer input[type=text] {
    width: 100%;
    padding: 10px;
  }
  .logcontainer button{
    margin:20px;
    width:100%;
  }
  .row{
    width:100%;
  }
     .col-25,.col-50.col-75 {
        width: 100%;
    }
  }
</style>

<!DOCTYPE html>
<html>
<body>
  <!--Topnav-->
  <div class='heading'>
    <a href='#'>Portfolio</a>
    <div class='search-container'>
    <a href='search.php'>Search</a>  
    <a href='port-form.php'>Create</a>
    </div>
  </div>
  <!--Form-->
  <div class='fillform'> 
    <h4 style='font-family: times new roman;'>Login</h4>
    <hr> 	
    <form method='POST' action='<?php htmlspecialchars($_SERVER['PHP_SELF']);?>'>
 	  <div class='detail logcontainer'>
 	  <span class='error'><?php echo $err;?></span>
 	  <div class='row'>
 		 <div class='col-25'>
 			<label>Username:</label>
 		 </div>
 		<div class='col-75'>
 	        <input type='text' name='username'>
 	    </div>
    </div>
    <div class='row'>
    	<div class='col-25'>
    		<label>Password:</label>
    	</div>
    	<div class='col-75'>
 	        <input type='password' name='password'>
        </div>
    </div>
  <div class='row'>  
 	<button type='submit' name='login' style='background: grey;'>Login</button>
  </div>
  <br>
  <!--Unregistered user can either Signup manually or Signup with Google-->
  <div class='row'>
   <span>Don't have an Account?</span><a href='port-form.php'>Create </a><span>or</span><a href="<?= 'https://accounts.google.com/o/oauth2/v2/auth?scope=' . urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.me') . '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID . '&access_type=online' ?>"> Signup with Google</a>
  </div>
 </div>
 </form>
 </div>
  <hr>
  <footer style='font-family: times new roman'><center>Designed & Developed by Arpit Yadav</center></footer>
  </body>
</html>