<?php
session_start();
require_once "function.php";

 $user     = new LoginRegistration();
 $pro     = new LoginRegistration();
 $ty    = new LoginRegistration();
 $pi    = new LoginRegistration();
  $uid      = $_SESSION['uid'];
 $username = $_SESSION['uname']; 
	if(isset($_GET['action']) && !empty($_GET['action'])){
		$id = (int)$_GET['id'];
		if($user->deletevenitem($id,$uid)){
			echo "";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Order</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
		<link rel="stylesheet" type="text/css" href="footer-distributed-with-address-and-phones.css" />		
		<style> 
input[type=text] {
     width: 120px;
    box-sizing: border-box;
}
</style>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.2.min.js"></script>
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
				<h2>Order</h2>
			 <p class="msg">  
			 				<?php
					if($_SERVER['REQUEST_METHOD'] == 'POST'){
						$date = $_POST['date'];
						$id = $_POST['id'];
						$ssname = $_POST['ssname'];
						$proid = $_POST['proID'];
						$quantity = $_POST['quantity'];
						$discount = $_POST['discount'];

				 if(isset($_POST['add'])){
						if(empty($date) or empty($id) or empty($ssname) or empty($proid) or empty($quantity)){
							echo "<span style='color:#e53d37'>Error...Field Must Not Be Empty</span>";
				 } else {
					$getIn = $pro->getOrById($proid);
			   foreach($getIn as $pro)
                       @$b = $pro['proUPrice'];			   
				@$a = $_POST['quantity'];
			        @$c = $_POST['discount'];
				if(isset($_POST['add'])){
					 @$price = ($a*$b)-($b*$c*$a)/100;
				 }
							$addor = $user->addOR($date,$id,$ssname,$proid,$quantity,$discount,@$price,@$b);
						    if($addor){
                                   echo "<span style='color:green'>Order Added</span>";
							}
						}
				 }
					}
				?>	
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
			 			 <div class="login_invoice"> 
<form action="" method="post">
					<table class="tbl_invoice">
						<tr>
							<td>Date</td>
							<td><input type="date" name="date" /></td>
                        </tr>
				       <tr>
					<td><label>  Operator: </label></td>
					<td>
						<select id="select" name="ssname">
						   <option>Select Operator</option>
						             <?php
			                           $getSesIn = $user->getAllusers();
										foreach($getSesIn as $ty){
			                            ?>
							<option value="<?php echo $ty['id']; ?>"><?php echo $ty['username']; ?></option>
									   <?php } ?>
			            </select> 
				     </td>				
					</tr>						
				       <tr>
					<td><label>  Vendor: </label></td>
					<td>
						<select id="select" name="id">
						   <option>Select vendor</option>
						             <?php
			                           $getVenIn = $user->getAllVen();
										foreach($getVenIn as $user){
			                            ?>
							<option value="<?php echo $user['id']; ?>"><?php echo $user['name']; ?></option>
									   <?php } ?>
			            </select> 
				     </td>				
					</tr>
				       <tr>
					<td><label>  Product : </label></td>
					<td>
						<select id="proID" name="proID">
						   <option>Select Product</option>
						             <?php
			                           $getProId = $pi->getAllProd();
										foreach($getProId as $pi){
			                            ?>
							<option value="<?php echo $pi['proID']; ?>" id="<?php echo $pi['proUPrice']; ?>"><?php echo $pi['proName']; ?></option>
									   <?php } ?>
			            </select> 
						</td></tr>
							 <tr>
							 <td>Unit Price</td>
							 <td><input type="text" size="20" name="display" id="display" />
							 <button id ="showVal" type="button">
								Check Unit Price
							</button>(Optional)
							</td>	
				     </td>				
					</tr>
<script>
var el = document.getElementById('display');
 document.getElementById('showVal').onclick = function () {
        select = document.getElementById('proID');
				var selectedOpt = select.options[select.selectedIndex];
 				el.value = selectedOpt.id	;	 				
    }   
</script>					
						<tr>
							<td>Quantity</td>
							<td><input type="text" name="quantity" /></td>
							<td>Discount%</td>
							<td><input type="text" name="discount" /></td>	
                        </tr>
						<tr>							
							<td>Amount</td>
							<td><input type="text" name="price" value="<?php echo @$price; ?>" /></td>								
                         </tr>							
						<tr>
							<td colspan="2"> 
							<span style="float:right">
								<input type="submit" name="add" value="Add" />
								<input type="reset" value="Reset" />
							<span>
							</td>
						</tr>	
		  </table>
			 </form>
			 </div>
			  <a href="ch_or.php" target="_blank">**Check Order(by date)**</a>
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