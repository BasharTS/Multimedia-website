<?php  
	require ("includes/dbCon.php"); 
	include 'includes/functions.php';

	session_start();
	if (!isset($_SESSION["admin"]) || !isset($_SESSION["fullname"])) {
	    header("location: index.php");
	}
	if (isset($_GET)) {
		$track_name = $_GET['fileName'];
		$song_id = $_GET['id'];
	
		$file_pointer = "../uploads/audio/".$track_name;
		if (file_exists($file_pointer)) {
			$download = "";
			tester($file_pointer);
		}
	}
?>