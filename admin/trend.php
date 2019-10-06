<?php 
	session_start();
	require ("includes/dbCon.php"); 
	include 'includes/functions.php';

	if (!isset($_SESSION["admin"]) || !isset($_SESSION["fullname"])) {
	    header("location: index.php");
	}
	if (isset($_SESSION['admin']) && isset($_GET['id']) && isset($_GET['trend'])) {
		$trend = $_GET['trend'];
		$song_id = $_GET['id'];
		// var_dump($suspension);
		$result = markTrend($song_id, $trend);
		echo $result['message'];

	}
?>