<?php 
	session_start();
	require ("includes/dbCon.php"); 
	include 'includes/functions.php';

	if (!isset($_SESSION["admin"]) || !isset($_SESSION["fullname"])) {
	    header("location: index.php");
	}
	if (isset($_SESSION['admin']) && isset($_GET['id']) && isset($_GET['img'])) {
		$id = mysqli_real_escape_string($conn, htmlentities($_GET['id']));
		$file = mysqli_real_escape_string($conn, htmlentities($_GET['img']));

		
		$result = deleteImage($id);
		$path = "../uploads/gallary/".$file;
		
		unlink($path);
	}
?>