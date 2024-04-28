<?php
session_start();
require_once "function.php";

 $user     = new LoginRegistration();
 $tim     = new LoginRegistration();
 $pro     = new LoginRegistration();
 $p     = new LoginRegistration();
 $uid      = $_SESSION['uid'];
 $username = $_SESSION['uname']; 

	if(isset($_GET['action']) && !empty($_GET['action'])){
		$id = (int)$_GET['id'];
		if($user->deletepro($id)){
			echo "";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Product</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
		<link rel="stylesheet" type="text/css" href="footer-distributed-with-address-and-phones.css" />		
		<style> 
			input[type=number] {
			width: 100%;
			float: center;
			margin: 0 auto;
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
				<h2>Product List</h2>
			 <p class="msg"> 
				<?php
					if($_SERVER['REQUEST_METHOD'] == 'POST'){
						$name = $_POST['proName'];
						$ID = $_POST['catID'];
						$puprice = $_POST['proUPrice'];
						$pprice = $_POST['proPrice'];
						
						if(empty($name) or empty($ID) or empty($puprice) or empty($pprice)){
							echo "<span style='color:#e53d37'>Error...Field Must Not Be Empty</span>";
						} else {
							$addcus = $user->addPro($name, $ID, $puprice, $pprice);
						    if($addcus){
								echo "<span style='color:green'>Product Added</span>";
							}  else {
								echo "<span style='color:#e53d7'>Product already exist</span>";
							}
						}
					}
					
				?>	 
			 </p>
<div class="random_table"> 
			    <form action="product.php" method="post">
					<table>
											<tr>
					<td><label>  Category: </label></td>
					<td>
						<select id="select" name="catID">
						   <option>Select Category</option>
						             <?php
			                           $getCatPro = $user->getAllCat();
										foreach($getCatPro as $user){
			                            ?>
							<option value="<?php echo $user['catID']; ?>"><?php echo $user['catName']; ?></option>
									   <?php } ?>
			            </select> 
				     </td>				
					</tr>
						<tr>
							<td>Name</td>
							<td><input type="text" name="proName" placeholder="Please Enter Product Name" /></td>
						</tr>
						<tr>
							<td>Unit Price</td>
							<td><input type="text" name="proUPrice" placeholder="Please Enter Unit Price" /></td>
						</tr>							
						<tr>
							<td>Unit</td>
							<td><input type="text" name="proPrice" placeholder="Please Enter Price" /></td>
						</tr>
						<tr>
							<td>TH(min)</td>
							<td><input type="text" name="th_min" placeholder="Minimum Threshold" /></td>
						</tr>
							<tr>
							<td>TH(max)</td>
							<td><input type="text" name="th_max" placeholder="Maximum Threshold" /></td>
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
		    </br></br><table class="tbl_inv">
					<tr>
						<th>Product ID</th>
						<th>Category</th>
						<th>Product Name</th>
						<th>Unit Price</th>
						<th>Unit</th>					
						<th>TH(min|max)</th>					
					</tr>
			<?php
			   $getCus = $pro->getProById();
			   foreach($getCus as $pro){
			?>
				<tr>
					<td><?php echo $pro['proID']; ?></td>
					<td><?php echo $pro['catID']; ?></td>
					<td><?php echo $pro['proName']; ?></td>
					<td><?php echo $pro['proUPrice']; ?> Tk.</td>
					<td><?php echo $pro['proPrice']; ?></td>
					<td><?php echo $pro['th_min']; ?><-|-><?php echo $pro['th_max']; ?></td>
					<td><a href="edit_product.php?id=<?php echo $pro['proID']; ?>">Edit</a></td>
					<td><a href="product.php?action=delete&id=<?php echo $pro['proID']; ?>">Del</a></td>
			   </tr>			   
			   <?php } ?>
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