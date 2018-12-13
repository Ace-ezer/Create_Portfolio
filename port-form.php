<!--Sign up Form-->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
<link rel="stylesheet" type="text/css" href="portFormCSS.css">

<!--PHP for verifying and submitting user details-->
<?php
 session_start();
   if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true)
  {
  header('location:data.php');
  exit;
  }

 require_once "server.php";
   
  $username=$fname=$lname=$age=$gender=$country=$city=$education=$achieve=$tech=$email=$description=$con=$fb=$git="";
  $pass=$repass="";
  $userr=$emailerr=$passerr=$repasserr="";
 if($_SERVER['REQUEST_METHOD']=='POST'){

  $use=test($_POST['username']);
  $mail=test($_POST['email']);
  $p=test($_POST['password']);
  $rp=test($_POST['repass']);

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
  if(empty($mail))
     $emailerr="Email required.";
   else{
     if(!filter_var($mail,FILTER_VALIDATE_EMAIL))
       $emailerr="Wrong Format.";
     else{
         $email=$mail;
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
   
      $fname=test($_POST['firstname']);
      $lname=test($_POST['lastname']);
      $age=test($_POST['age']);
      if(isset($_POST['gender']))
      {
      $gender=$_POST['gender'];
       }
      $country=test($_POST['country']);
      $city=test($_POST['city']);
      $education=test($_POST['education']);
      $achieve=test($_POST['achievements']);
      $tech=test($_POST['techskills']);
      $description=test($_POST['description']);
      $con=test($_POST['contact']);
      $fb=test($_POST['fb']);
      $git=test($_POST['git']);

   if(empty($userr)&&empty($emailerr)&&empty($passerr)&&empty($repasserr)){

      $password=password_hash($pass,PASSWORD_DEFAULT);

      $sql= "INSERT INTO form(username,email,password,first,last,age,gender,country,city,education,techinal_skills,achievements,description,contact,fb,git) 
         VALUES('$username','$email','$password','$fname','$lname','$age','$gender','$country','$city','$education','$tech','$achieve','$description','$con','$fb','$git')";
      $result=mysqli_query($conn,$sql);
      if($result) {
        header("location:port-login.php");
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
 <!--Topnav-->
  <div class='heading'>
    <a href='#'>Portfolio</a>
    <div class='search-container'>
    <a href='search.php'>Search</a>  
    <a href='port-login.php'>Login</a>
    </div>
  </div>
  <!--Form-->
  <div class='fillform'>
    <h5>Fill in details</h5><span class='error' style='color:lightred;'>(fields marked with * are compulsory)</span>
    <hr>
    <form method='POST' action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>'>
      <div class="detail container" id="details">
    <div class="row">
      <img src="https://cdn1.iconfinder.com/data/icons/avatar-3/512/Manager-512.png" class="avatar" alt="avatar">
    </div>

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
        <label>Email</label>
      </div>
      <div class="col-75">
        <input type="text" name="email" placeholder="Email id" value='<?php echo $email;?>'><span class='error'>*<?php echo $emailerr;?></span>
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
      <div class="col-25">
        <label>First Name</label>
      </div>
      <div class="col-75">
        <input type="text" name="firstname" placeholder="Your name.." value='<?php echo $fname;?>'>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="lname">Last Name</label>
      </div>
      <div class="col-75">
        <input type="text" id="lname" name="lastname" placeholder="Your last name.." value='<?php echo $lname;?>'>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="age">Age</label>
      </div>
      <div class="col-75">
        <input type="text" id="age" name="age" placeholder="Your age.." value='<?php echo $age;?>'>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="gender">Gender</label>
      </div>
      <div class="col-75">
        <input type="radio" id="male" name="gender" value="male" >Male
        <input type="radio" id="female" name="gender" value="female">Female
        <input type="radio" id="others" name="gender" value="other">others
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="age">Contact</label>
      </div>
      <div class="col-75">
        <input type="text" id="contact" name="contact" placeholder="Mobile number.." value='<?php echo $con;?>'>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="country">Country</label>
      </div>
      <div class="col-75">
       <input type="text" name="country" placeholder="Your country.." value='<?php echo $country;?>'>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="city">City</label>
      </div>
      <div class="col-75">
        <input type="text" id="city" name="city" placeholder="Your city.." value='<?php echo $city;?>'>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="education">Education</label>
      </div>
      <div class="col-75">
        <textarea id="education" name="education" placeholder="Qualifications.." style="height:100px" value='<?php echo $education;?>'></textarea>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="techskills">Technical Skills</label>
      </div>
      <div class="col-75">
        <textarea id="techs" name="techskills" placeholder="Technical skills" style="height:100px" value='<?php echo $tech;?>'></textarea>
      </div>    
        </div>
      <div class="row">
      <div class="col-25">
        <label for="Achievements">Achievements</label>
      </div>
      <div class="col-75">
        <textarea id="achievements" name="achievements" placeholder="Your Achievements" style="height:100px" value='<?php echo $achieve;?>'></textarea>
      </div>
        </div>
     <div class="row">
      <div class="col-25">
        <label for="description">Description</label>
      </div>
      <div class="col-75">
        <textarea id="description" name="description" placeholder="Write something about yourself.." style="height:200px" value='<?php echo $description;?>'></textarea>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="age">Fb link</label>
      </div>
      <div class="col-75">
        <input type="text" id="fb" name="fb" placeholder="Facebook link.." value='<?php echo $fb;?>'>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="age">Github link</label>
      </div>
      <div class="col-75">
        <input type="text" id="git" name="git" placeholder="Github link.." value='<?php echo $git;?>'>
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
  <h5>Already have an account?<a name='login' href='port-login.php'>Login</a></h5>    
  </div>
  <hr>
 <footer style='font-family: times new roman'><center>Designed & Developed by Arpit Yadav</center></footer>
