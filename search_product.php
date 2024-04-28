<?php
session_start();
require_once "function.php";

 $user     = new LoginRegistration();
 $userp     = new LoginRegistration();

 $uid      = $_SESSION['uid'];
 $username = $_SESSION['uname'];
 
	if(isset($_GET['action']) && !empty($_GET['action'])){
		$id = (int)$_GET['id'];
		if($user->deletecus($id)){
			echo "";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Search List</title>
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
				    <li><a href="customer.php">Customer</a></li>
					<li><a href="vendor.php">Vendors</a></li></ul></li>
					<li><a href="#">Item</a><ul>
					<li><a href="add_category.php">Category</a></li>
					<li><a href="product.php">Product</a></li></ul></li>
					<li><a href="#">Buy & Sell</a><ul>
					<li><a href="invoice.php">Invoice</a></li>
					<li><a href="order.php">Order</a></li></ul></li>
					<li><a href="#">Inventory</a>
					<ul>
					<li><a href="d_inven.php">D-Inventory</a></li>
					<li><a href="inventory.php">W/M-Inventory</a></li>
					</ul></li>
					<li><a href="search.php">Search</a><ul>
					<li><a href="search.php">Search Cus-Ven</a></li>
					<li><a href="search_product.php">Search Product</a></li>
					</ul></li>
					<li><a href="stock.php">Stock</a>
			        </li>
					<li><a href="logout.php">LogOut</a></li>
				<?php } else{ ?>
					<li><a href="login.php">LogIn</a></li>
					<li><a href="register.php">Register</a></li>
				<?php } ?>	
				</ul>
			</div>

			<div class="content">
				<h2>Search List</h2>
			 <p class="msg"> 				
			 </p>
			 			       </br><table class="tbl_inv">
					  
					  <form action="search_product.php" method="post">
					        <label> <h3>Product Search By product ID:</label>
					  			<input type="number" size="20" name="proID" />
					  			<input type="submit" name="submit" value="Submit"/></h3>
					</form>			
								<?php	
					if($_SERVER['REQUEST_METHOD'] == 'POST'){	
							   $ID = $_POST['proID'];					
                if(empty($ID)){
					echo "<span style='color:#e53d37'>Error...Field Must Not Be Empty</span>";
				}	else { 	?><tr>
						<th>Product ID</th>
						<th>Category ID</th>
						<th>Product Name</th>
						<th>Product Price</th>
						<th>Unit</th>
				
					  </tr>
					  <?php
			   $getpro = $userp->getProByname($ID);
			   foreach($getpro as $userp){
				   ?>
				<tr>
				    <td><?php echo $userp['proID']; ?></td>
				    <td><?php echo $userp['catID']; ?></td>
				    <td><?php echo $userp['proName']; ?></td>
				    <td><?php echo $userp['proUPrice']; ?> Tk.</td>
				    <td><?php echo $userp['proPrice']; ?></td>
				</tr>
							<?php } } }?></br></br>
		   
               </table>
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