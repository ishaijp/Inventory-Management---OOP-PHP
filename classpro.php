<?php
require "config.php";

class LoginRegistration{
	
	function __construct(){
		$database = new DatabaseConnection();
	}
	public function getAllCat(){
		global $pdo;
		
		$query = $pdo->prepare("SELECT * FROM category ORDER BY catID ASC");
	    $query->execute(array());
		return $query;	
	}		
}	