<?php 
	session_start();
	require ("includes/dbCon.php"); 
	include 'includes/functions.php';

	if (!isset($_SESSION["admin"]) || !isset($_SESSION["fullname"])) {
	    header("location: index.php");
	}
	if (isset($_SESSION['admin']) && isset($_GET['id']) && isset($_GET['suspend'])) {
		$username = $_GET['id'];
		$suspension = $_GET['suspend'];
		// var_dump($suspension);
		$result = suspendUser($username, $suspension);
		echo $result['message'];

	}
?>