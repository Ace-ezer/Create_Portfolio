<!--Sign up with Google-->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
<link rel="stylesheet" type="text/css" href="portFormCSS.css">

<?php
 session_start();

	require_once('settings.php');
	require_once('google-login-api.php');
	include 'server.php';

	// Google passes a parameter 'code' in the Redirect Url

	if(isset($_GET['code'])) {
	try {
		$gapi = new GoogleLoginApi();
		
		// Get the access token 
		$data = $gapi->GetAccessToken(CLIENT_ID, CLIENT_REDIRECT_URL, CLIENT_SECRET, $_GET['code']);
		
		// Get user information
		$user_info = $gapi->GetUserProfileInfo($data['access_token']);
		$_SESSION['email']=$user_info['emails'][0]['value'];
    $_SESSION['fname']=$user_info['name']['givenName'];
 		$_SESSION['lname']=$user_info['name']['familyName'];
    
    $_SESSION['loggedin']=false;
        }
	catch(Exception $e) {
		echo $e->getMessage();
		exit();
	  }
	}

 // Following is to store the details of the user after getting username and the password
  $username=$show="";
  $pass=$repass="";
  $userr=$passerr=$repasserr="";
 if($_SERVER['REQUEST_METHOD']=='POST'){

  $use=test($_POST['username']);
  $p=test($_POST['password']);
  $rp=test($_POST['repass']);
  $email=$_SESSION['email'];
  $fname=$_SESSION['fname'];
  $lname=$_SESSION['lname'];

  if(empty($use))
    $userr="Username can't be empty.";
  else{
     if(!preg_match("/^[a-zA-Z_0-9]*$/", $use))
         $userr="Username can only contain Alphabets Digits and Underscore.";
     else{
      $sql="SELECT id FROM form WHERE username='".$use."'";
      $result=mysqli_query($conn,$sql);
      if($result->num_rows>0)
         $userr="Username already taken.";
       else $username=$use; 
     }   
  }  

  if(empty($p))
    $passerr="Password is required.";
  else{
     if(!preg_match("/^[a-zA-Z_@0-9]*$/", $p))
      $passerr="Password can only contain letters,numbers and (_@).";
    else if(strlen($p)<7)$passerr="Password length must be 7 or above.";
    else $pass=$p;
  }
  if(empty($rp))
    $repasserr="Repeat above password.";
  else{
    if($p!=$rp)
      $repasserr="Passwords don't match.";
    else $repass=$rp;
  }
   
   if(empty($userr)&&empty($passerr)&&empty($repasserr)){

      $password=password_hash($pass,PASSWORD_DEFAULT);

      $sql= "INSERT INTO form(username,email,password,first,last) 
         VALUES('$username','$email','$password','$fname','$lname')";
      $result=mysqli_query($conn,$sql);
      if($result) {
        $show="Signup successfull. Log in now!<a href='port-login.php'>Login</a>";
       }
      }
    mysqli_close($conn);
 }

	function test($data){
  	$data=trim($data);
  	$data=stripslashes($data);
  	$data=htmlspecialchars($data);

  	return $data;
 	}
?>

<html>
<body>
  <div class='heading'>
    <a href='#'>Portfolio</a>
    <div class='search-container'>
    <a href='search.php'>Search</a>  
    <a href='port-login.php'>Login</a>
    </div>
  </div>
  <!--Form for username and password-->
  <div class='fillform'>
    <h5>Fill in the following details.</h5>
    <hr>
   <?php echo "<span style='color:white;'>".$show."</span>";?>  
	<form method='POST' action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>'>
   <div class='detail container' id='detail'>
		<div class="row">
      <div class="col-25">
        <label>Username</label>
      </div>
      <div class="col-75">
        <input type="text" name="username" placeholder="Unique name.." value='<?php echo $username;?>'>
        <span class='error'>*<?php echo $userr;?></span>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label>Password</label>
      </div>
      <div class="col-75">
        <input type="password" name="password" placeholder="Password"><span class='error'>*<?php echo $passerr;?></span>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label>Repeat Password</label>
      </div>
      <div class="col-75">
        <input type="password" name="repass" placeholder="repeat password"><span class='error'>*<?php echo $repasserr;?></span>
      </div>
    </div> 
     <div class="row">
      <div class='col-50'>
        <button type='submit' name='submit' style='background-color:green'>Submit</button>
      </div>
      <div class='col-50'>
        <button type='cancel' name='cancel' style='background-color:red'>Cancel</button>
      </div>
    </div> 
   </div>      
	</form>
  </div>
  <hr>
 <footer style='font-family: times new roman'><center>Designed & Developed by Arpit Yadav</center></footer>
</body>
</html>
