<?php
session_start();
require_once "function.php";

 $user     = new LoginRegistration();
 $pro     = new LoginRegistration();
 $ty    = new LoginRegistration();
  $uid      = $_SESSION['uid'];
 $username = $_SESSION['uname']; 
  if(isset($_REQUEST['id'])){
	 $id = $_REQUEST['id'];
 } else {
	 header('Location: index.php');
	 exit();
 }
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
		<title>Receipt</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
		<link rel="stylesheet" type="text/css" href="footer-distributed-with-address-and-phones.css" />	
		<style> 
input[type=text] {
     width: 120px;
    box-sizing: border-box;
}
td, th { text-align: right; }
tr th:first-child, tr td:first-child { text-align: left; }
tbody tr:last-child td { font-weight: bold;  }
table { border-collapse: collapse; }
tbody tr:last-child { border-top: thick black solid; }
</style>
	</head>

	<body>
		<div class="wrapper">
			<div class="header">
				<h3><i>i</i>-Stock Management System</h3>
			</div>
			<div class="content">
				<h2>Receipt</h2>
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
				<table>
  <thead>
    <tr>
      <th>product ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
      <th>Quantity&nbsp;&nbsp;&nbsp;&nbsp;</th>
      <th>Rate&nbsp;&nbsp;&nbsp;&nbsp;</th>
      <th>Discount&nbsp;&nbsp;&nbsp;&nbsp;</th>
      <th>Amount&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
      <th>Date&nbsp;&nbsp;</th>
    </tr>
  </thead>
  <tbody>
      					  <?php
			   $getIn = $pro->getInByIdg($id);
			   foreach($getIn as $pro){
				   ?>
				<tr>
	     <td><?php echo $pro['proID']; ?></td>
		 <td><?php echo $pro['quantity']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 <td><?php echo $pro['uprice']; ?> Tk.&nbsp;&nbsp;</td>
		 <td><?php echo $pro['discount']; ?> %&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 <td><?php echo $pro['price']; ?> Tk.&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 <td><?php echo $pro['date']; ?></td>
	</tr>
	<?php } ?>
  </tbody>
  </table></br></br></br></br>
           <button onclick="myFunction()">Print this page</button>
		     <script>
function myFunction() {
    window.print();
}
</script>
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