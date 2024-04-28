<?php
 session_start();
require_once "function.php";

 $user     = new LoginRegistration();
 $uid      = $_SESSION['uid'];
 
     if(!$user->getSession()){
	   header('Location: login.php');
	   exit();
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Change Password</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
		<link rel="stylesheet" type="text/css" href="footer-distributed-with-address-and-phones.css" />		
	</head>

	<body>
	<div class="wrapper">
			<div class="header">
				<h3><i>i</i>-Stock Management System</h3>
			</div>
		<div class="wrap">
				<ul class="navbar">
				<?php if($user->getSession()){ ?>
					<li><a href="index.php">Home</a></li>
					<li><a href="#">Profile</a>
					<ul>
					<li><a href="profile.php">Special Date</a></li>
					<li><a href="changepassword.php">Change Password</a></li>
					</ul></li>
					<li><a href="#">Cus-Ven</a><ul>
				    <li><a href="customer.php" target="_blank">Customer</a></li>
					<li><a href="vendor.php" target="_blank">Vendors</a></li></ul></li>
					<li><a href="#">Item</a><ul>
					<li><a href="add_category.php" target="_blank">Category</a></li>
					<li><a href="product.php" target="_blank">Product</a></li></ul></li>
					<li><a href="#">Buy & Sell</a><ul>
					<li><a href="invoice.php" target="_blank">Invoice</a></li>
					<li><a href="order.php" target="_blank">Order</a></li></ul></li>
					<li><a href="#">Inventory</a>
					<ul>
					<li><a href="d_inven.php" target="_blank">D-Inventory</a></li>
					<li><a href="inventory.php" target="_blank">W/M-Inventory</a></li>
					</ul></li>
					<li><a href="search.php">Search</a><ul>
					<li><a href="search.php" target="_blank">Search Cus-Ven</a></li>
					<li><a href="search_product.php" target="_blank">Search Product</a></li>
					</ul></li>
					<li><a href="#">Stock</a>
					<ul>
					<li><a href="closing_stock.php" target="_blank">Closing Stock</a></li>
					<li><a href="Stock.php" target="_blank">Threshold Check</a></li>
					</ul>
			        </li>
					<li><a href="logout.php">LogOut</a></li>
				<?php } else{ ?>
					<li><a href="login.php">LogIn</a></li>
					<li><a href="register.php">Register</a></li>
				<?php } ?>	
				</ul>
			</div>
			
			<div class="content">
			<h2>Change Your password</h2>
			<p class="msg"> 
								<?php
					if($_SERVER['REQUEST_METHOD'] == 'POST'){
						$old_pass     = $_POST['old_password'];
						$new_pass     = $_POST['new_password'];
						$confirm_pass = $_POST['confirm_password'];
						
						if(empty($old_pass) or empty($new_pass) or empty($confirm_pass)){
							echo "<span style='color:#e53d37'>Error...Field Must Not Be Empty</span>";
						} else if($new_pass != $confirm_pass){
							echo "<span style='color:#e53d37'>Error...Password not matched</span>";
						} else {
							$old_pass = md5($old_pass);
							$new_pass = md5($new_pass);
							$passUpdate = $user->updatePassword($uid, $new_pass, $old_pass);
						}
					}
				?>
			</p>
                 <div class="random_table"> 
				<form action="" method="post" >
					<table>
						<tr>
							<td>Old Password:</td>
							<td><input type="password" name="old_password" placeholder="Please Enter Your Old Password" /></td>
						</tr>

						<tr>
							<td>New Password:</td>
							<td><input type="password" name="new_password" placeholder="Please Enter Your New Password" /></td>
						</tr>						
						
						<tr>
							<td>Confirm Password</td>
							<td><input type="password" name="confirm_password" placeholder="Please Type Password Again" /></td>
						</tr>		
						
						<tr>
							<td colspan="2"> 
							<span style="float:right">
								<input type="submit" name="update" value="Update" />
								<input type="reset" value="Reset" />
							<span>
							</td>
						</tr>
						
					</table>
				</form>
			</div>   
 <div class="back">
	<a href="index.php"><img src="img/back.png" alt="back" /></a>
 </div>
			</div>
<footer class="footer-distributed">

			<div class="footer-left">

				<h3>Company<span>logo</span></h3>

				<p class="footer-links">
					<a href="index.php">Home</a>
					·
					<a href="#">Blog</a>
					·
					<a href="#">About</a>
					·
					<a href="#">Faq</a>
					·
					<a href="#">Contact</a>
				</p>

				<p class="footer-company-name">isha_ijp &copy; 2016</p>
			</div>

			<div class="footer-center">

				<div>
					<i class="fa fa-map-marker"></i>
					<p><span>x street</span> Dhanmondi, Dhaka</p>
				</div>

				<div>
					<i class="fa fa-phone"></i>
					<p>+880 1947198939</p>
				</div>

				<div>
					<i class="fa fa-envelope"></i>
					<p><a href="mailto:support@company.com">isha_ijp@ymail.com</a></p>
				</div>

			</div>

			<div class="footer-right">

				<p class="footer-company-about">
					<span>About Our Buisness</span>
					This is random small buisness Stock Management System
				</p>
				<div class="footer-icons">

				   <a href="facebook.com"><img src="img/fb.png" alt="fb" /></a>
				   <a href="twitter.com"><img src="img/tw.png" alt="twitter" /></a>
				   <a href="linkedin.com"><img src="img/in.png" alt="Linkedin" /></a>
				</div>
			</div>

		</footer>		
					
			
	    </div>		
    </body>	
</html>	