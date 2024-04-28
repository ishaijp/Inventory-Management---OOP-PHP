<?php
session_start();
require_once "function.php";

 $user     = new LoginRegistration();
 $user1     = new LoginRegistration();
 $pro     = new LoginRegistration();
 $pro1     = new LoginRegistration();

  $uid      = $_SESSION['uid'];
 $username = $_SESSION['uname']; 
	if(isset($_GET['action']) && !empty($_GET['action'])){
		$id = (int)$_GET['id'];
		if($user->deletecusitem($id,$uid)){
			echo "";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Daily Inventory</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
		<link rel="stylesheet" type="text/css" href="footer-distributed-with-address-and-phones.css" />		
		<style> 
input[type=text] {
     width: 120px;
    box-sizing: border-box;
}
</style>
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
				<h2>Daily Inventory</h2>
			 <p class="msg">  
				
			 </p>
                <table class="tbl_wrapper">
                   <tr>
				      <td><label>User name: <?php echo $username  ?> 
					  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
					  Location: <?php echo "Dhaka,Bangladesh"  ?></label></td>			  
				   </tr>
				   <tr>
				      <td><label>Date: <?php echo date('d-M-Y'); ?> 
					  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
					  Time: <?php echo date("g.i a"); ?> </label></td>
				   </tr>		
				</table></br></br> 
				
				   <table class="tbl_inv">

					  <form action="d_inven.php" method="post">
					  		<label>Date : </label>	<input type="date" name="date" />
					  			<input type="submit" name="submit" value="Submit"/>
					</form>						
								<?php	
							if($_SERVER['REQUEST_METHOD'] == 'POST'){	
							   $date = $_POST['date'];										
 	
			   $getIn = $pro->getInvenBydate1($date);
			   foreach($getIn as $pro){
				   ?>
					<tr>
						<th>Serial</th>
						<th>Operator</th>
						<th>Customer ID</th>
						<th>Date</th>
						<th>Product ID</th>
						<th>Quantity</th>
						<th>Unit Price</th>
						<th>Discount</th>
						<th>Amount</th>					
					  </tr>   
				<tr>
				    <td><?php echo $pro['InId']; ?></td>
				    <td><?php echo $pro['ssname']; ?></td>
				    <td><?php echo $pro['id']; ?></td>
				    <td><?php echo $pro['date']; ?></td>
				    <td><?php echo $pro['proID']; ?></td>
				    <td><?php echo $pro['quantity']; ?></td>
				    <td><?php echo $pro['uprice']; ?> Tk.</td>
				    <td><?php echo $pro['discount']; ?> %</td>
				    <td><?php echo $pro['price']; ?> Tk.</td>
				</tr>
							<?php }  ?>
				 </br></br>
				 <?php
				 @$sum = 0.0;
				if(isset($_POST['date'])){ 
				 $gettotal = $user->getTotal1($date);
			   foreach($gettotal as $user){
			   @$sum += $user['price'];}
				 ?>
				 <tr>
			        <th></br></br>Total Sell:</th>
			        <td><?php  echo @$sum; ?> Tk.</td>
			   </tr>
				<?php } ?>	
				<?php
			   $getOr = $pro1->getInvenBydate2($date);
			   foreach($getOr as $pro1){
				   ?>
				<tr>
						<th>Serial</th>
						<th>Operator</th>
						<th>Vendor ID</th>
						<th>Date</th>
						<th>Product ID</th>
						<th>Quantity</th>
						<th>Unit Price</th>
						<th>Discount</th>
						<th>Amount</th>					
					  </tr>    
				<tr>
				    <td><?php echo $pro1['OrId']; ?></td>
				    <td><?php echo $pro1['ssname']; ?></td>
				    <td><?php echo $pro1['id']; ?></td>
				    <td><?php echo $pro1['date']; ?></td>
				    <td><?php echo $pro1['proID']; ?></td>
				    <td><?php echo $pro1['quantity']; ?></td>
				    <td><?php echo $pro1['uprice']; ?> Tk.</td>
				    <td><?php echo $pro1['discount']; ?> %</td>
				    <td><?php echo $pro1['price']; ?> Tk.</td>
				</tr>
							<?php }  ?>
				 </br></br>
				 <?php
				 @$sum1 = 0.0;
				if(isset($_POST['date'])){ 
				 $gettotal1 = $user1->getTotal2($date);
			   foreach($gettotal1 as $user1){
			   @$sum1 += $user1['price'];}
				 ?>
				 <tr>
			        <th></br></br>Total Buy:</th>
			        <td><?php  echo @$sum1; ?> Tk.</td>
			   </tr>
							<?php } } ?>					
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