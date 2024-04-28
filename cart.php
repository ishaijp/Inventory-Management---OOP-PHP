<?php
 session_start();
require_once "function.php";

 $user     = new LoginRegistration();
 if(isset($_REQUEST['id'])){
	 $id = $_REQUEST['id'];
 } else {
	 header('Location: index.php');
	 exit();
 }
 
      if(!$user->getSession()){
	   header('Location: login.php');
	   exit();
	  }
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Update Product</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>

	<body>
		<div class="wrapper">
			<div class="header">
				<h3><i>i</i>-Inventroy Controller System</h3>
			</div>
			<div class="mainmenu">
				<ul>
				<?php if($user->getSession()){ ?>
					<li><a href="index.php">Home</a></li>
					<li><a href="profile.php">Profile</a></li>
					<li><a href="changepassword.php">Change Password</a></li>
					<li><a href="logout.php">LogOut</a></li>
				<?php } else { ?>
					<li><a href="login.php">LogIn</a></li>
					<li><a href="register.php">Register</a></li>
				<?php } ?>	
				</ul>
			</div>
			
<div class="content">
				<h2>Your Cart</h2>
			 <p class="msg"> 
			
			 </p>
			 			
	 <div class="back">
	<a href="product.php"><img src="img/back.png" alt="back" /></a>
 </div>		 
			</div>
   <div class="footer">
	   <h3>isha_ijp.... :)</h3>
   </div>	
	    </div>		
    </body>	
 </html>	