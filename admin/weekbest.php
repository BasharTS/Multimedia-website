<?php 
	session_start();
	require ("includes/dbCon.php"); 
	include 'includes/functions.php';

	if (!isset($_SESSION["admin"]) || !isset($_SESSION["fullname"])) {
	    header("location: index.php");
	}
	if (isset($_SESSION['admin']) && isset($_GET['id']) && isset($_GET['wb'])) {
		$week_best = $_GET['wb'];
		$song_id = $_GET['id'];
		// var_dump($suspension);
		$result = weekBest($song_id, $week_best);
		echo $result['message'];

	}
?>