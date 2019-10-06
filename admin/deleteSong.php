<?php 
	session_start();
	require ("includes/dbCon.php"); 
	include 'includes/functions.php';

	if (!isset($_SESSION["admin"]) || !isset($_SESSION["fullname"])) {
	    header("location: index.php");
	}
	if (isset($_SESSION['admin']) && isset($_GET['id']) && isset($_GET['file'])) {
		$id = $_GET['id'];
		$file = $_GET['file'];
		$date_released = explode('/', $_GET['file']);
		$folder = $date_released[0];
		$query = "SELECT `thumbnail` FROM `song_tbl` WHERE `song_id` = '$id'";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) > 0){
			$feedback = mysqli_fetch_assoc($result);
			$img = $feedback['thumbnail'];
		}
		$result = deleteSong($id);
		$path1 = "../uploads/media/".$file;
		$path2 = "../uploads/media/".$folder."/".$img;
		unlink($path1);
		unlink($path2);
	}
?>