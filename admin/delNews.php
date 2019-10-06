<?php 
	session_start();
	require ("includes/dbCon.php"); 
	include 'includes/functions.php';

	if (!isset($_SESSION["admin"]) || !isset($_SESSION["fullname"])) {
	    header("location: index.php");
	}
	if (isset($_SESSION['admin']) && isset($_GET['id']) && isset($_GET['d'])) {
		$id = $_GET['id'];
		$file = $_GET['d'];
		$date_released = explode('-', $_GET['d']);
		$folder = $date_released[0]."_".$date_released[1];
		$query = "SELECT `image` FROM `events` WHERE `event_id` = '$id'";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) > 0){
			$feedback = mysqli_fetch_assoc($result);
			$img = $feedback['image'];
		}
		$result = deleteNews($id);
		// $path1 = "../uploads/media/".$file;
		$path2 = "../uploads/images/".$folder."/".$img;
		// unlink($path1);
		unlink($path2);
	}
?>