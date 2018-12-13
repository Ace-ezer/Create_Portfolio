<!--Search any user's Portfolio-->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
<link rel="stylesheet" type="text/css" href="portFormCSS.css">

<style type="text/css">
	@import url(https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css);
    
    .search{
    	padding: 100px 100px;
    	font-family: times new roman;
    	background:purple; 
       }
    .row:after{
    	clear: "";
    	align-content: left;
    }
   .col-50 a{
      float: left;
   display: block;
   text-decoration: none;
   background:#A0A0A0;
   color:white;
   padding: 10px 15px;
   margin: 10px;
    }
    .col-50{
    	width:50%;
    }
    input[type=text]{
    	width:100%;
    	border-radius: 2px;
    	padding: 10px;
    	font-family: georgia;
    }
    button{
    	width:50%;
    	color:white;
    	padding: 12px;
    	background:grey;
    	border:none;
    	cursor:pointer;
    }
    @media screen and (max-width:600px)
    {
      .search{
      padding:40px 40px;
    }
    .fillform input[type=text] {
    width: 100%;
    padding: 10px;
    }
  .fillform button{
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

<!--Topnav-->
<div class='heading'>
    <a href='#'>Portfolio</a>
    <div class='search-container'>
    <a href='port-form.php'>Create</a>  
    <a href='port-login.php'>Login</a>
    </div>
</div>

<!--Following calls search function in form.inc.php to display user data-->
<?php 
  session_start();
   if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true)
  {
  header('location:data.php');
  exit;
  }

 include 'server.php';
 include 'form.inc.php';
  echo "<div class='fillform'>
        <h3>Search</h3>
        <hr>
        <div class='search'>
        <form method='POST' action='".search($conn)."'>
  			<div class='row'>
  			<div class='col-50'>
  				<input type='text' name='searchtxt'>
  			</div>
  			<div class='col-50'>	
  				<button type='submit' name='searchsubmit'>Search</button>
  			</div>	
  			</div>
  		</form>
  		";
?>
<center>or</center>
<hr>
 <div class='row'>
	<div class='col-50'>
		<a href='port-login.php'>Login</a>
	</div>
	<div class='col-50'>
		<a href='port-form.php'>Signup</a>
	</div>
 </div>
</div>
<hr>
<footer style='font-family: times new roman'><center>Designed & Developed by Arpit Yadav</center></footer>
</div>