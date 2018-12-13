<!--Index/Portfolio page-->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
<link rel="stylesheet" type="text/css" href="datacss.css">
<link href="https://fonts.googleapis.com/css?family=Raleway:200,100,400" rel="stylesheet" type="text/css" />


<?php
 session_start();

 if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: port-login.php");
    exit;
 }
 include 'server.php';
 include 'form.inc.php';
?>

 <meta name="viewport" content="width=device-width,height=device-height, initial-scale=1.0"> 

<!--For Home section text-->
<script type="text/javascript">
  
  var TxtRotate = function(el, toRotate, period) {
  this.toRotate = toRotate;
  this.el = el;
  this.loopNum = 0;
  this.period = parseInt(period, 10) || 2000;
  this.txt = '';
  this.tick();
  this.isDeleting = false;
  };

  TxtRotate.prototype.tick = function() {
  var i = this.loopNum % this.toRotate.length;
  var fullTxt = this.toRotate[i];

  if (this.isDeleting) {
    this.txt = fullTxt.substring(0, this.txt.length - 1);
  } else {
    this.txt = fullTxt.substring(0, this.txt.length + 1);
  }

  this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

  var that = this;
  var delta = 300 - Math.random() * 100;

  if (this.isDeleting) { delta /= 2; }

  if (!this.isDeleting && this.txt === fullTxt) {
    delta = this.period;
    this.isDeleting = true;
  } else if (this.isDeleting && this.txt === '') {
    this.isDeleting = false;
    this.loopNum++;
    delta = 500;
  }

  setTimeout(function() {
    that.tick();
  }, delta);
  };

  window.onload = function() {
  var elements = document.getElementsByClassName('txt-rotate');
  for (var i=0; i<elements.length; i++) {
    var toRotate = elements[i].getAttribute('data-rotate');
    var period = elements[i].getAttribute('data-period');
    if (toRotate) {
      new TxtRotate(elements[i], JSON.parse(toRotate), period);
    }
  }
  // INJECT CSS
  var css = document.createElement("style");
  css.type = "text/css";
  css.innerHTML = ".txt-rotate > .wrap { border-right: 0.08em solid #666 }";
  document.body.appendChild(css);
  };
</script>

<html>
  <div class='topnav'>
    <a href='#home'>Home</a>
    <a href='#about'>About</a>
    <a href='#portfolio'>Portfolio</a>
    <a href='#contact'>Contact</a>
    <div class='log-container'>
    <form method='POST' action='logout.php'>
      <button type='submit' name='logout'>Exit</button>
    </form>
  </div>
  </div>
<!--Home section-->
<div id='home'>
  <h1>
  <span
     class="txt-rotate"
     data-period="2000"
     data-rotate='["Welcome!","Call Me-"," <?php echo $_SESSION['username'];?>" ]'></span>
  </h1>
</div>

<!--About section-->
  <div id='about' class='about'>
  	<div class='container'>
      <!--Edit functionality-->
      <div class='aedit'>
      <?php
      $username=$_SESSION['username'];
      $sql="SELECT * FROM form WHERE username='$username';";
      $result=mysqli_query($conn,$sql);
      if($result){
      $row=$result->fetch_assoc();
      echo"
      <form method='POST' action='aedit.php'>
      <input type='hidden' name='id' value='".$row['id']."'>
      <input type='hidden' name='fname' value='".$row['first']."'>
      <input type='hidden' name='lname' value='".$row['last']."'>
      <input type='hidden' name='age' value='".$row['age']."'>
      <input type='hidden' name='gender' value='".$row['gender']."'>
      <input type='hidden' name='country' value='".$row['country']."'>
      <input type='hidden' name='city' value='".$row['city']."'>
      <input type='hidden' name='description' value='".$row['description']."'>
      <button type='submit' name='edit'>Edit</button>
      </form>";
       }
      ?>
      </div>  
    <h3>About</h3>
    <hr style='margin-bottom: 50px;'>
    <!--profile picture-->
    <div class='row'>
    	<div class='col-75'>
      <?php
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
          echo "<a href='editimg.php' style='text-decoration:none; color:black;'>Edit</a></div>";  
         }
      ?>
    	</div>
    	<div class='col-25'>
    		<?php name($conn);?>
    	</div>
    </div>
    <?php getabout($conn);?>
  </div>
  </div>

<!--Portfolio section-->
  <div id='portfolio' class='portfolio'>
   <div class='pcontainer'>
    <!--Edit functionality-->
     <div class='pedit'>
      <?php
      $username=$_SESSION['username'];
      $sql="SELECT * FROM form WHERE username='$username';";
      $result=mysqli_query($conn,$sql);
      if($result){
      $row=$result->fetch_assoc();
      echo"
      <form method='POST' action='pedit-form.php'>
      <input type='hidden' name='id' value='".$row['id']."'>
      <input type='hidden' name='education' value='".$row['education']."'>
      <input type='hidden' name='tech' value='".$row['techinal_skills']."'>
      <input type='hidden' name='achievements' value='".$row['achievements']."'>
      <button type='submit' name='edit'>Edit</button>
      </form>";
       }
      ?>
      </div>
   <h3>Portfolio</h3>
   <hr>
   <?php getportfolio($conn);?>
   </div>
  </div>

<!--Contact Section-->
  <div id='contact' style='color:white;'>
    <div class='cedit'>
      <!--Edit functionality-->
      <?php
      $username=$_SESSION['username'];
      $sql="SELECT * FROM form WHERE username='$username';";
      $result=mysqli_query($conn,$sql);
      if($result){
      $row=$result->fetch_assoc();
      echo"
      <form method='POST' action='cedit.php'>
      <input type='hidden' name='id' value='".$row['id']."'>
      <input type='hidden' name='email' value='".$row['email']."'>
      <input type='hidden' name='contact' value='".$row['contact']."'>
      <input type='hidden' name='fb' value='".$row['fb']."'>
      <input type='hidden' name='git' value='".$row['git']."'>      
      <button type='submit' name='edit'>Edit</button>
      </form>";
       }
      ?>
      </div>
   <h3>Contact</h3>
   <hr style='border-color:white;'>
   <?php getcontact($conn);?>
  </div>
  <hr>
  <footer style='font-family: times new roman'><center>Designed & Developed by Arpit Yadav</center></footer>
</html> 