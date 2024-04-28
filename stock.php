<?php
session_start();
require_once "function.php";

 $user     = new LoginRegistration();
 $pro     = new LoginRegistration();
 $sk     = new LoginRegistration();
 $pi     = new LoginRegistration();
 $m     = new LoginRegistration();
 $n     = new LoginRegistration();
 $idn     = new LoginRegistration();
 $idnn     = new LoginRegistration();

  $uid      = $_SESSION['uid'];
 $username = $_SESSION['uname']; 

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Threshold Checking</title>
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
				<h2>Stock Check By Product ID</h2>
			 <p class="msg">  
				
			 </p>
			 <table class="tbl_inv">
					  <form action="stock.php" method="post">
					        <label> <h4>Stock Information By ID :</label>
						<select id="select" name="proID">
						   <option>Select Product</option>
						             <?php
			                           $getProId = $pi->getAllProd();
										foreach($getProId as $pi){
			                            ?>
							<option value="<?php echo $pi['proID']; ?>"><?php echo $pi['proName']; ?></option>
									   <?php } ?>
			            </select> 
						<label> <h4>From :</label>
						<input type="date" name="date" />
						<label> <h4>To :</label>
						<input type="date" name="date1" />
					  <input type="submit" name="submit" value="Submit"/></h3>
					</form>	
				    <?php	
							if($_SERVER['REQUEST_METHOD'] == 'POST'){	
							   $proid = $_POST['proID'];										
							   $date = $_POST['date'];										
							   $date1 = $_POST['date1'];	?>									
 	             <tr>
						<th>In/Or ID</th>
						<th>Cus/Ven ID</th>
						<th>Date</th>
						<th>Product ID</th>
						<th>Quantity</th>
						<th>Unit Price</th>
						<th>Amount</th>				
					  </tr><?php
			   $getProd = $pro->getProdById($proid,$date,$date1);
			   foreach($getProd as $pro){
				   ?>
				    <td><?php echo $pro['InId']; ?></td>
				    <td><?php echo $pro['id']; ?></td>
				    <td><?php echo $pro['date']; ?></td>
				    <td><?php echo $pro['proID']; ?></td>
				    <td><?php echo $pro['quantity']; ?></td>
				    <td><?php echo $pro['uprice']; ?> Tk.</td>
				    <td><?php echo $pro['price']; ?> Tk.</td>
				</tr>
							<?php } ?>
                       	<?php
				 @$sum = 0.0;
				 @$pro = 0;
				if(isset($_POST['proID']) && isset($_POST['date']) && isset($_POST['date1'])){ 
				 $gettotal = $m->getTotalIn($proid,$date,$date1);
			   foreach($gettotal as $m){
			   @$sum += $m['price'];
			   @$pro += $m['quantity'];
			   }
				 ?>
				 <tr>
			        <th>Total Sell:</th>
			        <td><?php  echo @$sum; ?> Tk.</td>
			   </tr>
				 <tr>
			        <th>Total Product Sold:</th>
			        <td><?php  echo @$pro; ?></td>
			   </tr>
			  <tr>
				<?php } ?>	
				<tr>
						<th>In/Or ID</th>
						<th>Cus/Ven ID</th>
						<th>Date</th>
						<th>Product ID</th>
						<th>Quantity</th>
						<th>Unit Price</th>
						<th>Amount</th>				
					  </tr>
							<?php 
				 $getProd1 = $user->getProdById1($proid,$date,$date1);
			   foreach($getProd1 as $user){
				   ?>
			        <td><?php echo $user['OrId']; ?></td>
			        <td><?php echo $user['id']; ?></td>
				    <td><?php echo $user['date']; ?></td>
				    <td><?php echo $user['proID']; ?></td>
				    <td><?php echo $user['quantity']; ?></td>
				    <td><?php echo $user['uprice']; ?> Tk.</td>
				    <td><?php echo $user['price']; ?> Tk.</td>
				</tr>
							<?php } ?><br><br>
						<?php
				 @$sum1 = 0.0;
				 @$pro1 = 0;
				if(isset($_POST['proID']) && isset($_POST['date']) && isset($_POST['date1'])){ 
				 $gettotal = $n->getTotalOr($proid,$date,$date1);
			   foreach($gettotal as $n){
			   @$sum1 += $n['price'];
			   @$pro1 += $n['quantity'];
			   }
				 ?>
				<tr>
			        <th>Total Buy:</th>
			        <td><?php  echo @$sum1; ?> Tk.</td>
			   </tr>
				<tr>
			        <th>Total Product Received:</th>
			        <td><?php  echo @$pro1; ?></td>
			   </tr>
							<?php } ?>
					
				<tr>
				<th>Stock of Selected Product</th>
               <?php 
			   
			   $getIn = $sk->getSkId($proid); 
			   @$sk=0;
				foreach($getIn as $sk)	
			    @$sk = $sk['closing_sk'];
			   @$pk = 0;
				 @$pro3 = 0;
				 @$pro4 = 0;
				if(isset($_POST['proID'])){ 				
				 $gettotalid = $idn->getTotalid($proid);
			   foreach($gettotalid as $idn){
			   @$pro3 += $idn['quantity'];				
						 } 
	          $gettotaliid = $idnn->getTotaliid($proid);
			   foreach($gettotaliid as $idnn){
			   @$pro4 += $idnn['quantity'];				
						 } 	
						 @$pk = @$sk + @$pro3 - @$pro4;
						 ?>
				<tr>
					<th>Current Threshold:</th>
			        <td><?php  echo @$pk; ?>
					</td>
				<?php 
				   if(@$pk<5){ ?>
				   <tr>
				  <p style="color:red;float:left;"><?php echo "**Please Make An Order !!**"; ?><p>
				   <?php }  ?>
			   </tr>			
				<?php } } ?>
			</tr>	
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