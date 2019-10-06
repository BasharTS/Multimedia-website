<?php 
	session_start();
	require ("includes/dbCon.php"); 
	include 'includes/functions.php';

	if (!isset($_SESSION["admin"]) || !isset($_SESSION["fullname"])) {
	    header("location: index.php");
	}
	if (isset($_SESSION['admin']) && isset($_GET['id'])) {
		$username = $_GET['id'];
		$pic = $_GET['pic'];
		$result = deleteAccount($username);
		$path = "../uploads/passport/".$pic;
		unlink($path);
	}
?>