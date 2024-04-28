<?php
session_start();
require_once "function.php";

 $user     = new LoginRegistration();
 $tim     = new LoginRegistration();
 $pro     = new LoginRegistration();
 $p     = new LoginRegistration();
 $pi     = new LoginRegistration();
 $uid      = $_SESSION['uid'];
 $username = $_SESSION['uname']; 

	if(isset($_GET['action']) && !empty($_GET['action'])){
		$id = (int)$_GET['id'];
		if($user->deletepro($id)){
			echo "";
		}
	}
?>
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
					<td><label>  Product : </label></td>
					<td>
						<select id="display" name="proID" >
						   <option>Select Product</option>
						             <?php
			                           $getProId = $pi->getAllProd();
										foreach($getProId as $pi){
			                            ?>			
							<option value="<?php echo $pi['proID'] ;?>" id="<?php echo $pi['proUPrice']; ?>"><?php echo $pi['proName'] ;?></option>
										<?php } ?>
			            </select> 
						<button id ="showVal" type="button">
								Check Unit Price
							</button>
							 </td></tr>
					<script>
var el = document.getElementById('display');
 document.getElementById('showVal').onclick = function () {
        select = document.getElementById('catID');
				var selectedOpt = select.options[select.selectedIndex];				
                 el.value = selectedOpt.value	;			
    }   
</script>
	