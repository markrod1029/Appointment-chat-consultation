<?php
	session_start();
	include 'include/conn.php';


	if(isset($_SESSION['admin']))
	{
	if(!isset($_SESSION['admin']) || trim($_SESSION['admin']) == ''){
		header('location: home.php');
	}

	$sql = "SELECT * FROM admin_table WHERE id = '".$_SESSION['admin']."'";
	$query = $conn->query($sql);
	$user = $query->fetch_assoc();
	

}
	
else{

	header('location: ../index.php');

}

?>