<!--Searched Index/Portfolio page-->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
<link rel="stylesheet" type="text/css" href="datacss.css">
<link href="https://fonts.googleapis.com/css?family=Raleway:200,100,400" rel="stylesheet" type="text/css" />

<?php
 session_start();
   if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true)
  {
  header('location:data.php');
  exit;
  }

 include 'server.php';
 include 'form.inc.php';
 ?>

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
     data-rotate='["Welcome!","This Portfolio belongs to <?php echo $_SESSION['username'];?>.", "Take a look around." ]'></span>
  </h1>
  </div>

 <!--About section-->
  <div id='about' class='about'>
  	<div class='container'>
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
          echo "</div>";  
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
   <h3>Portfolio</h3>
   <hr>
   <?php getportfolio($conn);?>
   </div>
  </div>

 <!--Contact Section-->
  <div id='contact' style='color:white;'>
   <h3>Contact</h3>
   <hr>
   <?php getcontact($conn);?>
  </div>
  <hr>
  <footer style='font-family: times new roman'><center>Designed & Developed by Arpit Yadav</center></footer>
</html>