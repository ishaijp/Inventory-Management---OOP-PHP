<?php
require "config.php";

class LoginRegistration{
	
	function __construct(){
		$database = new DatabaseConnection();
	}
	
	public function registerUser($username,$password,$name,$email,$website){
		global $pdo;
		
		$query = $pdo->prepare('SELECT id FROM users WHERE username = ? AND email = ?');
		$query->execute(array($username, $email));
		$num = $query->rowCount();
		
		if($num == 0){
			$query = $pdo->prepare("INSERT INTO users (username,password,name,email,website) VALUES (?, ?, ?, ?, ?)");
		    $query->execute(array($username, $password, $name, $email, $website));
			return true;
		} else {
			print "<span style='color:#e53d7'>Error....username/email already used</span>";
		}
		}
	public function loginUser($email, $password){
		global $pdo;
		$query = $pdo->prepare("SELECT id, username FROM users WHERE email =? AND password =?");
		$query->execute(array($email, $password));
		$userdata = $query->fetch();
		
		$num = $query->rowCount();
		if($num == 1){
			session_start();
			$_SESSION['login'] = true;
			$_SESSION['uid'] = $userdata['id'];
	        $_SESSION['uname'] = $userdata['username'];
            $_SESSION['login_msg'] = 'Login successfully...';
				
				return true;
		} else {
			    return false;
		}
	}		
	
	public function getAllusers(){
		global $pdo;
		$query = $pdo->prepare("SELECT * FROM users ORDER BY id ASC");
		$query->execute();
		return $query->fetchALL(PDO::FETCH_ASSOC);
	}
	
	public function getSession(){
		return @$_SESSION['login'];
	}
 
    public function getUsername($uid){
		global $pdo;
		
		$query = $pdo->prepare("SELECT name FROM users where id = ? ");
		$query->execute(array($uid));
		$result = $query->fetch();
		echo $result['name'];
	}
	
	public function getUserById($id){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM users where id = ? ");
		$query->execute(array($id));
		 return $query->fetchALL(PDO::FETCH_ASSOC);		
	}
    public function updateUser($uid,$username,$name,$email,$website){
		global $pdo;
		
		$query=$pdo->prepare("UPDATE users SET username = ?, name = ?, email = ?, website = ? WHERE id = ?");
		$query->execute(array($username, $name, $email, $website, $uid));
		return true;
	}   
	
	public function getUserDetails($userid){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM users WHERE id = ?");
		$query->execute(array($userid));
		return $query->fetchALL(PDO::FETCH_ASSOC);
	}
	
	public function updatePassword($uid, $new_pass, $old_pass){
		global $pdo;
		
		$query = $pdo->prepare("SELECT id FROM users WHERE password = ? ");
		$query->execute(array($old_pass));
		
		$num = $query->rowCount();
		
		if($num == 0){
			print("<span style='color:#e53d37'>Error...Old Password Not Exist</span>");
		} else {
			$query = $pdo->prepare("UPDATE users SET password = ?  WHERE id = ?");
			$query->execute(array($new_pass, $uid));
			return print("<span style='color:green'>Password Changed Successfully</span>");
		}
	}
	
	public function logOutUser(){
		$_SESSION['login'] = false;
		unset($_SESSION['uid']);
		unset($_SESSION['uname']);
		session_destroy();
	}  
	
	public function addCus($name,$address,$phone,$email){
		global $pdo;
		
		$query = $pdo->prepare('SELECT id FROM customer WHERE name = ? AND email = ?');
		$query->execute(array($name, $email));
		$num = $query->rowCount();
		
		if($num == 0){
			$query = $pdo->prepare("INSERT INTO customer (name,address,phone,email) VALUES (?, ?, ?, ?)");
		    $query->execute(array($name, $address, $phone, $email));
			return true;
		} else {
			print "<span style='color:#e53d7'>Error....username/email already used</span>";
		}
		}
		
	 public function getCusById(){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM customer ");
		$query->execute(array());
		 return $query->fetchALL(PDO::FETCH_ASSOC);		

	}
	
	public function updateCus($cid,$name,$address,$phone,$email){
		global $pdo;
		
		$query=$pdo->prepare("UPDATE customer SET name = ?, address = ?, phone = ?, email = ? WHERE id = ?");
		$query->execute(array($name, $address, $phone, $email, $cid));
		return true;
	}   
	
	public function getCusDetails($cusid){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM customer WHERE id = ?");
		$query->execute(array($cusid));
		return $query->fetchALL(PDO::FETCH_ASSOC);
	}
	
	public function cusDelete($cid){
		global $pdo;
		
		$query = $pdo->prepare("DELETE FROM customer WHERE id = ?");
		$query->execute(array($cid));
		return true;
	}
	
	public function deletecus($id){
		global $pdo;
		$query = $pdo->prepare("DELETE FROM customer WHERE id = ? ");
		$query->execute(array($id));
		return true;
	}

	public function deleteven($id){
		global $pdo;
		$query = $pdo->prepare("DELETE FROM vendor WHERE id = ? ");
		$query->execute(array($id));
		return true;
	}

	public function deletecat($id){
		global $pdo;
		$query = $pdo->prepare("DELETE FROM category WHERE catID = ? ");
		$query->execute(array($id));
		return true;
	}
	
	public function deletepro($id){
		global $pdo;
		$query = $pdo->prepare("DELETE FROM product WHERE proID = ? ");
		$query->execute(array($id));
		return true;
	}	
	
	public function deletecusitem($id,$uid) {
		global $pdo;
		$query = $pdo->prepare("DELETE FROM invoice WHERE InId = '$id' AND ssname = '$uid' ");
		$query->execute(array($id,$uid));
		return true;
	}

	public function deletevenitem($id,$uid) {
		global $pdo;
		$query = $pdo->prepare("DELETE FROM orderp WHERE OrId = '$id' AND ssname = '$uid' ");
		$query->execute(array($id,$uid));
		return true;
	}	
	
	public function deletespe($id) {
		global $pdo;
		$query = $pdo->prepare("DELETE FROM special WHERE id = '$id' ");
		$query->execute(array($id));
		return true;
	}	
	
	public function addVen($name,$address,$phone,$email,$company){
		global $pdo;		
		
		$query = $pdo->prepare('SELECT id FROM vendor WHERE name = ? AND email = ?');
		$query->execute(array($name, $email));
		$num = $query->rowCount();
		
		if($num == 0){
			$query = $pdo->prepare("INSERT INTO vendor (name,address,phone,email,company) VALUES (?, ?, ?, ?, ?)");
		    $query->execute(array($name, $address, $phone, $email, $company));
			return true;
		} else {
			print "<span style='color:#e53d7'>Error....username/email already used</span>";
		}
		}
		
	public function getVenById(){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM vendor ");
		$query->execute(array());
		 return $query->fetchALL(PDO::FETCH_ASSOC);		
	}
	public function updateVen($id,$name,$address,$phone,$email,$company){
		global $pdo;
		
		$query=$pdo->prepare("UPDATE vendor SET name = ?, address = ?, phone = ?, email = ?, company = ? WHERE id = ?");
		$query->execute(array($name, $address, $phone, $email, $company, $id));
		return true;
	}   
	public function getVenDetails($venid){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM vendor WHERE id = ?");
		$query->execute(array($venid));
		return $query->fetchALL(PDO::FETCH_ASSOC);
	}
	public function addCat($name){
		global $pdo;
		
		$query = $pdo->prepare('SELECT id FROM category WHERE catName = ? ');
		$query->execute(array($name));
		$num = $query->rowCount();
		
		if($num == 0){
			$query = $pdo->prepare("INSERT INTO category (catName) VALUES (?)");
		    $query->execute(array($name));
			return true;
		} else {
			print "<span style='color:#e53d7'>Error....category name already taken</span>";
		}
		}
		
	public function getCatById(){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM category ");
		$query->execute(array());
		 return $query->fetchALL(PDO::FETCH_ASSOC);		
	}	
		
	public function addPro($name, $ID, $puprice, $pprice){
		global $pdo;
		
		$query = $pdo->prepare('SELECT proID FROM product WHERE proName = ?, catID = ?, proUPrice = ?, proPrice = ?');
		$query->execute(array($name, $ID, $puprice, $pprice));
		$num = $query->rowCount();
		
		if($num == 0){
			$query = $pdo->prepare("INSERT INTO product (proName, catID, proUPrice, proPrice) VALUES (?, ?, ?, ?)");
		    $query->execute(array($name, $ID, $puprice, $pprice));
			return true;
		} else {
			print "<span style='color:#e53d7'>Error....product name already taken</span>";
		}
		}	
		
	public function getAllCat(){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM category ORDER BY catID ASC");
	    $query->execute(array());	
		return $query->fetchALL(PDO::FETCH_ASSOC);	
	}
	public function getProById(){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM product ORDER BY proName ASC");
		$query->execute(array());
		return $query->fetchALL(PDO::FETCH_ASSOC);		
	}	

	public function updatePro($ID, $name, $puprice, $pprice, $id){
		global $pdo;
		
		$query=$pdo->prepare("UPDATE product SET catID = ?, proName = ?, proUPrice = ?, proPrice = ? WHERE proID=?");
		$query->execute(array($ID, $name,$puprice, $pprice, $id));
		return true;
	} 
	
	public function updateCat($id, $name){
		global $pdo;
		
		$query=$pdo->prepare("UPDATE category SET catID = ?, catName = ?  where catID='$id'");
		$query->execute(array($id, $name));
		return true;
	} 	

	public function getProDetails($proid){
		global $pdo;
		
		$query = $pdo->prepare("SELECT proName, proUPrice, proPrice FROM product WHERE proID = ?");
		$query->execute(array($proid));
		return $query->fetchALL(PDO::FETCH_ASSOC);
	}  	
	
	public function getCatDetails($id){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM category WHERE catID='$id'");
		$query->execute(array($id));
		return $query->fetchALL(PDO::FETCH_ASSOC);
	}  	
	
    public function getproBycatId($id){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM product WHERE catID = '$id'");
		$query->execute(array($id));
		return $query->fetchALL(PDO::FETCH_ASSOC);		
	}
	public function addToCart($quantity, $id){
		global $pdo;

		$query = $pdo->prepare("SELECT * FROM product WHERE proID = '$id' AND proQuantity = '$quantity'");
		$query->execute(array($quantity, $id));
		$result =$query->fetchALL(PDO::FETCH_ASSOC);
		
		$quantity = $result['proQuantity'];
		$id = $result['proID'];
		$name = $result['proName'];
		$price = $result['proUPrice'];
		
			$query1 = $pdo->prepare("INSERT INTO cart (proID, proName, price, quantity) VALUES ($id, $name, $price, $quantity)");
		    $query1->execute(array($name, $ID, $price, $quantity));
			return $query1->fetchALL(PDO::FETCH_ASSOC);
	}
	
	public function addIN($date,$id,$ssname,$proid,$quantity,$uprice,$discount,$price){
		global $pdo;
		
		$query = $pdo->prepare('SELECT InId FROM invoice WHERE date = ?, id = ?, ssname = ?, proID = ?, quanity = ?, uprice = ?, discount = ?, price = ?');
		$query->execute(array($date,$id,$ssname,$proid,$quantity, $uprice,$discount,$price));
		$num = $query->rowCount();
		
		if($num == 0){
			$query = $pdo->prepare("INSERT INTO invoice (date,id,ssname,proID,quantity,uprice,discount,price) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
		    $query->execute(array($date,$id,$ssname,$proid,$quantity,$uprice,$discount,$price));
			return true;
		}
	}		
	
	public function getAllCus(){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM customer ORDER BY id ASC");
	    $query->execute(array());	
		return $query->fetchALL(PDO::FETCH_ASSOC);	
	}	

	public function getInById($pid){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM product WHERE proID='$pid'");
		$query->execute(array($pid));
		return $query->fetchALL(PDO::FETCH_ASSOC);		
	}
	
	public function getInByIdg($did){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM invoice WHERE InId='$did'");
		$query->execute(array($did));
		return $query->fetchALL(PDO::FETCH_ASSOC);		
	}	

	public function getAllVen(){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM vendor ORDER BY id ASC");
	    $query->execute(array());	
		return $query->fetchALL(PDO::FETCH_ASSOC);	
	}
	public function getAllProd(){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM product ORDER BY proName ASC");
	    $query->execute(array());	
		return $query->fetchALL(PDO::FETCH_ASSOC);	
	}	
	
	public function getAllProdi($id){
		global $pdo;
		
		$query = $pdo->prepare("SELECT proUPrice FROM product WHERE proID='$id'");
	    $query->execute(array($id));	
		return $query->fetchALL(PDO::FETCH_ASSOC);	
	}	
	
	public function addOR($date,$id,$ssname,$proid,$quantity,$b,$discount,$price){
		global $pdo;
		
		$query = $pdo->prepare('SELECT OrId FROM orderp WHERE date = ?, id = ?, ssname = ?, proID = ?, quanity = ?,uprice = ?, discount = ?, price = ?');
		$query->execute(array($date,$id,$ssname,$proid,$quantity,$b,$discount,$price));
		$num = $query->rowCount();
		
		if($num == 0){
			$query = $pdo->prepare("INSERT INTO orderp (date,id,ssname,proID,quantity,discount,price,uprice) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
		    $query->execute(array($date,$id,$ssname,$proid,$quantity,$b,$discount,$price));
			return true;
		}
	}	

	public function getOrById($proid){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM product WHERE proID = '$proid'");
		$query->execute(array($proid));
		return $query->fetchALL(PDO::FETCH_ASSOC);		
	}

	public function getInvenBydate1($date){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM invoice WHERE date ='$date' ");
		$query->execute(array($date));
		return $query->fetchALL(PDO::FETCH_ASSOC);		
	}
	
	public function getInvenBydate2($date){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM orderp WHERE date ='$date' ");
		$query->execute(array($date));
		return $query->fetchALL(PDO::FETCH_ASSOC);		
	}
	
    public function getProdById($proid,$date,$date1){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM invoice WHERE proID = '$proid' AND date BETWEEN '$date' AND '$date1'");
		$query->execute(array($proid,$date,$date1));
		return $query->fetchALL(PDO::FETCH_ASSOC);		
	}
	
    public function getProdById2($catid){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM product WHERE catID = '$catid'");
		$query->execute(array($catid));
		return $query->fetchALL(PDO::FETCH_ASSOC);		
	}	
	
	public function getProdById1($proid,$date,$date1){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM orderp WHERE proID = '$proid' AND date BETWEEN '$date' AND '$date1'");
		$query->execute(array($proid,$date,$date1));
		return $query->fetchALL(PDO::FETCH_ASSOC);		
	}

	public function getTotal1($date){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM invoice WHERE date = '$date'");
		$query->execute(array($date));
		return $query->fetchALL(PDO::FETCH_ASSOC);		
	}	

	public function getTotal2($date){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM orderp WHERE date = '$date'");
		$query->execute(array($date));
		return $query->fetchALL(PDO::FETCH_ASSOC);		
	}
	
	public function getInvenBydate($date,$date1){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM invoice WHERE date BETWEEN '$date' AND '$date1'");
		$query->execute(array($date,$date1));
		return $query->fetchALL(PDO::FETCH_ASSOC);		
	}
	
	public function getOrvenBydate($date,$date1){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM orderp WHERE date BETWEEN '$date' AND '$date1'");
		$query->execute(array($date,$date1));
		return $query->fetchALL(PDO::FETCH_ASSOC);		
	}	

	public function getTotal($date,$date1){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM invoice WHERE date BETWEEN '$date' AND '$date1'");
		$query->execute(array($date,$date1));
		return $query->fetchALL(PDO::FETCH_ASSOC);		
	}
	
	public function getTotalt($date,$date1){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM orderp WHERE date BETWEEN '$date' AND '$date1'");
		$query->execute(array($date,$date1));
		return $query->fetchALL(PDO::FETCH_ASSOC);		
	}
	
	public function getTotalIn($proid,$date,$date1){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM invoice WHERE proID = '$proid' AND date BETWEEN '$date' AND '$date1'");
		$query->execute(array($proid,$date,$date1));
		return $query->fetchALL(PDO::FETCH_ASSOC);		
	}

	public function getTotalOr($proid,$date,$date1){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM orderp WHERE proID = '$proid' AND date BETWEEN '$date' AND '$date1'");
		$query->execute(array($proid,$date,$date1));
		return $query->fetchALL(PDO::FETCH_ASSOC);		
	}		

	public function getTotalid($proid){
		global $pdo;
		
		$query = $pdo->prepare("SELECT quantity FROM orderp WHERE proID = '$proid' AND EXTRACT(YEAR FROM date) ");
		$query->execute(array($proid));
		return $query->fetchALL(PDO::FETCH_ASSOC);		
	}	

	public function getTotaliid($proid){
		global $pdo;
		
		$query = $pdo->prepare("SELECT quantity FROM invoice WHERE proID = '$proid' AND EXTRACT(YEAR FROM date) ");
		$query->execute(array($proid));
		return $query->fetchALL(PDO::FETCH_ASSOC);		
	}		
	
	public function getCusByname($id){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM customer WHERE id = '$id' ");
		$query->execute(array($id));
		return $query->fetchALL(PDO::FETCH_ASSOC);		
	}	
	
	public function getVenByname($id){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM vendor WHERE id = '$id' ");
		$query->execute(array($id));
		return $query->fetchALL(PDO::FETCH_ASSOC);		
	}

	public function getproByname($ID){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM product WHERE proID='$ID'");
		$query->execute(array($ID));
		return $query->fetchALL(PDO::FETCH_ASSOC);		
	}
	
	public function livesearch1($search){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM product WHERE proName LIKE '%$search%'");
		$query->execute(array($query));
		$result = $query->fetch();
	
	}

	public function addSpecial($name,$date,$description){
		global $pdo;
		
		$query = $pdo->prepare('SELECT name FROM special WHERE date = ?, description = ?');
		$query->execute(array($date,$description));
		$num = $query->rowCount();
		
		if($num == 0){
			$query = $pdo->prepare("INSERT INTO special (name,date,description) VALUES (?, ?, ?)");
		    $query->execute(array($name,$date,$description));
			return true;
		}
	}	
	
	public function getSpeById(){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM special ");
		$query->execute(array());
		 return $query->fetchALL(PDO::FETCH_ASSOC);		
	}	
	
		public function getThByquan($quantity){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM product WHERE proQuantity <= '$quantity' ");
		$query->execute(array($quantity));
		return $query->fetchALL(PDO::FETCH_ASSOC);		
	}
	
	public function closinStock($year,$id,$sk){
		global $pdo;
		
		$query = $pdo->prepare('SELECT sid FROM stock WHERE year = ?, proID = ?, closing_sk = ?');
		$query->execute(array($year,$id,$sk));
		$num = $query->rowCount();
		
		if($num == 0){
			$query = $pdo->prepare("INSERT INTO stock (year,proID,closing_sk) VALUES (?, ?, ?)");
		    $query->execute(array($year,$id,$sk));
			return true;
		} else{
			print "<span style='color:#e53d7'>Error....product name already taken</span>";
		}
		}
	public function getSkId($proid){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM stock WHERE proID = '$proid'");
		$query->execute(array($proid));
		return $query->fetchALL(PDO::FETCH_ASSOC);		
	}	
	
	public function getInById1($date){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM invoice WHERE date = '$date' ORDER BY InId DESC");
		$query->execute(array($date));
		return $query->fetchALL(PDO::FETCH_ASSOC);		
	}	

	public function getInById2($date){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM orderp WHERE date = '$date' ORDER BY OrId DESC");
		$query->execute(array($date));
		return $query->fetchALL(PDO::FETCH_ASSOC);		
	}

	public function livesearch($search){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM product WHERE proName LIKE '%$search%'");
		$query->execute(array($search));
	    return $query->fetchALL(PDO::FETCH_ASSOC);
	}

	public function getProd(){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM product");
		$query->execute(array());
		return $query->fetchALL(PDO::FETCH_ASSOC);		
	}	
}
?>