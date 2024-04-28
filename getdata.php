<?php
session_start();
require_once "function.php";

if(!empty($_POST['catID'])){

     $cid = $_POST['catID'];
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM product WHERE catID='$cid'");
	    $query->execute(array());	
		foreach($query as $pro){
			?>
			<option value="<?php echo $pro['proID']; ?>"><?php echo $pro['proName']; ?></option>
		<?php
		}
}
?>

		