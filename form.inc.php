<?php
//Contains all the utility functions 

function name($conn)//To get the name of the user
{
	$username=$_SESSION['username'];
	$sql="SELECT * FROM form WHERE username='$username';";
	$result=mysqli_query($conn,$sql);
	if($result)
	{  $row=$result->fetch_assoc();
		echo "<h5>".$row['first']." ".$row['last']."</h5>";
	}
}

function getabout($conn)//To get the About details of the user
{
   $username=$_SESSION['username'];
	$sql="SELECT * FROM form WHERE username='$username';";
	$result=mysqli_query($conn,$sql);
	if($result)
	{  $row=$result->fetch_assoc();
		echo "<div class='row'><div class='col-75'><p>".$row['description']."</p></div></div>
		    <div class='row'>
 				<div class='col-25'>
 						Gender:
 			    </div>
 			<div class='col-75'>
 				".$row['gender']."
 			 </div>
			</div>
			<div class='row'>
			<div class='col-25'>
			from:
			</div>
			<div class='col-75'>
			".$row['country'].",".$row['city']."
			</div>
			</div>";
	}
}

function getportfolio($conn)//To get the portfolio details of the user
{
	$username=$_SESSION['username'];
	$sql="SELECT * FROM form WHERE username='$username';";
	$result=mysqli_query($conn,$sql);
	if($result){
		$row=$result->fetch_assoc();
		echo "<div>
               	<div class='row'>
					<div class='col-25'>
						Education:
					</div>
				<div class='col-75'>
					<p>".$row['education']."</p>
				</div>
    		   	</div>
				<div class='row'>
					<div class='col-25'>
						Technical skills:
					</div>
				<div class='col-75'>
					<p>".$row['techinal_skills']."</p>
				</div>
				</div>
				<div class='row'>
					<div class='col-25'>
						Achievements:
					</div>
					<div class='col-75'>
						<p>".$row['achievements']."</p>
					</div>
					</div>
			  </div>";
	}
}

function getcontact($conn)//To obtain the contact details of the user
{
	$username=$_SESSION['username'];
	$sql="SELECT * FROM form WHERE username='$username';";
	$result=mysqli_query($conn,$sql);
	if($result){
		$row=$result->fetch_assoc();
    echo "<div class='row'>
			<div class='col-50'>
				<a href='".$row['fb']."' class='fa fa-facebook'> Facebook</a>
			</div>	
			<div class='col-50'>
				<a href='".$row['git']."' class='fa fa-github'> GitHub</a>
			</div>
		</div>
		<div class='row'>
		 	<div class='col-25'>
		 	Email:
		 	</div>
		 	<div class='col-25'>
			 ".$row['email']."
			</div>
		</div>
		<div class='row'>
			<div class='col-25'>
				Phone no.:
			</div>
			<div class='col-75'>
			 ".$row['contact']."
			</div>
		</div>";   
	}	
}

function pedit($conn)//To edit portfolio details
{
	if(isset($_POST['editsubmit'])){
	$id=$_POST['id'];
	$education=$_POST['education'];
	$sql="UPDATE form SET education='$education' WHERE id='$id';";
	$result=mysqli_query($conn,$sql);
    $techn=$_POST['tech'];
    $sql="UPDATE form SET techinal_skills='$techn' WHERE id='$id';";
	$result=mysqli_query($conn,$sql);
	$achieve=$_POST['achievements'];
	$sql="UPDATE form SET achievements='$achieve' WHERE id='$id';";
	$result=mysqli_query($conn,$sql);
	header('location:data.php');
 }
}

function aedit($conn)//To edit About details
{
	if(isset($_POST['editsubmit'])){
		$id=$_POST['id'];
   		$fname=$_POST['fname'];
   		$lname=$_POST['lname'];
   		$age=$_POST['age'];
   		$gender=$_POST['gender'];
   		$country=$_POST['country'];
   		$city=$_POST['city'];
   		$descr=$_POST['description'];

		$sql="UPDATE form SET first='$fname'WHERE id='$id';";
		$result=mysqli_query($conn,$sql);
		$sql="UPDATE form SET last='$lname'WHERE id='$id';";
		$result=mysqli_query($conn,$sql);
		$sql="UPDATE form SET age='$age'WHERE id='$id';";
		$result=mysqli_query($conn,$sql);
		$sql="UPDATE form SET gender='$gender'WHERE id='$id';";
		$result=mysqli_query($conn,$sql);
		$sql="UPDATE form SET country='$country'WHERE id='$id';";
		$result=mysqli_query($conn,$sql);
		$sql="UPDATE form SET city='$city'WHERE id='$id';";
		$result=mysqli_query($conn,$sql);
		$sql="UPDATE form SET description='$descr'WHERE id='$id';";
		$result=mysqli_query($conn,$sql);
		header('location:data.php');
 }
}

function cedit($conn)//To edit Contact details
{
 if(isset($_POST['editsubmit'])){
		$id=$_POST['id'];
   		$email=$_POST['email'];	
   		$con=$_POST['contact'];
   		$sql="UPDATE form SET email='$email' WHERE id='$id';";
		$result=mysqli_query($conn,$sql);
		$sql="UPDATE form SET contact='".$con."' WHERE id='".$id."';";
		$result=mysqli_query($conn,$sql);
        $sql="UPDATE form SET fb='".$fb."' WHERE id='".$id."';";
		$result=mysqli_query($conn,$sql);
        $sql="UPDATE form SET git='".$git."' WHERE id='".$id."';";
		$result=mysqli_query($conn,$sql);
		header('location:data.php');
   	}
}

function search($conn)//To Search portfolio of a person
{
	if(isset($_POST['searchsubmit'])){
		$username=$_POST['searchtxt'];
		$sql="SELECT * FROM form WHERE username='".$username."';";
		$result=mysqli_query($conn,$sql);
		if($result->num_rows>0){
             session_start();
             $_SESSION['username']=$username;
             header('location:searchdata.php');
		}
		else echo "No such user exists.";
	}
}

?>

