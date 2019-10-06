<?php
	require ("includes/dbCon.php");

	// tester function
	function tester($string){
		var_dump($string);
	}
	// Function to send email
	function sendEmail($senderName, $senderEmail, $senderMessage){
		
		if ($senderName!='' && $senderEmail!='' && $senderMessage!='') {
			$to="bashartukurshehu@gmail.com";
			$subject="Submitted via bashartukurshehu.000webhostapp.com";
			$body="You have recieved a new message from ".$senderName." with email address ".$senderEmail." here is the message: ".$senderMessage;
			$headers="From:bashartukurshehu.000webhostapp.com \r\n";
			$headers .="Reply-To: $senderEmail \r\n";
			$message=wordwrap($body);

			$sent = mail($to, $subject, $message, $headers);
			if ($sent) {
				echo "<p class='lead' style='color:green; margin-left:10px;font-weight:bolder;'>The email has been Sent successfully!</p>";
			}else{
				echo "<p class='lead' style='color:red; margin-left:10px; font-weight:bolder;'>Error!!! Please try again later</p>";
			}
		}else{
			echo "<p class='lead' style='color:red; margin-left:10px; font-weight:bolder;'>All fields are required! </p>";
		}
	}
	// login administrator function
	function login_admin($username, $password){
		$feedback = "";
		if ($username != "" && $password != "") {
			$password= md5($password);
			$query = "SELECT * FROM `admin` WHERE `username`='$username' AND `password`='$password'";
			// connection
			require ("includes/dbCon.php");

			$query_result = mysqli_query($conn, $query);
			if (mysqli_num_rows($query_result)) {
				$feedback["feedback"] = 1;
				$feedback["details"] = mysqli_fetch_assoc($query_result);
			}else{
				$feedback["feedback"] = 0;
				$feedback["message"] = "<div class='error'> Invalid Login Credentials </div>";
			}
		}else{
			echo "<div class='error'> All fields are required </div>";
		}
		if (isset($feedback)) {
			return $feedback;
		}
	}
	// to update last login time of admin
	function updateLoginTimeForAdmin($loginTime){
		if (isset($_SESSION["admin"])) {
			$user = $_SESSION["admin"];
			// connection
			require ("includes/dbCon.php");

			$result = mysqli_query($conn, "UPDATE `admin` SET `last_login` = '$loginTime' WHERE `username` = '$user'");
		}
	}
	// to register new user!
	function register($userpic, $first_name, $last_name, $nickname, $gender, $number, $email_address, $username, $password, $date_joined){
		if ($first_name != "" && $last_name != "" && $nickname != "" && $gender != "" && $number != "" && $email_address != "" && $username != ""  && $password != "") {
			$query1 = "SELECT * FROM `user_tbl` WHERE `username`='$username'";
			$query2 = "SELECT * FROM `admin` WHERE `username`='$username'";
			// connection
			require ("includes/dbCon.php");

			$query1_result = mysqli_query($conn, $query1);
			$query2_result = mysqli_query($conn, $query2);
			if (mysqli_num_rows($query1_result) > 0 || mysqli_num_rows($query2_result) > 0) {
				$feedback["user"] = 1;
				$feedback["alert"] = "<div class='error'> Sorry!!! username already taken </div>";
			}else{
				$password = md5($password);
				$insert_query = "INSERT INTO `user_tbl` (`passport`,`first_name`,`last_name`,`nickname`,`gender`,`number`, `email_address`,`username`,`password`,`date_joined`) VALUES('$userpic','$first_name','$last_name','$nickname','$gender','$number','$email_address','$username','$password','$date_joined')";
				$insert_query_result = mysqli_query($conn, $insert_query);
				if ($insert_query_result) {
				 	$feedback['feedback'] = 1;
				 	$feedback['message'] = "<div class='success'> Registered Successfully!</div>";
				 }else{
					$feedback["feedback"] = 0;
					$feedback["message"] = "<div class='error'> Unable to register! Pls try again </div>";
				}
			}
		}else{
			echo "<div class='error'> All fields are required </div>";
		}
		if (isset($feedback)) {
			return $feedback;
		}
	}
	// to view users by admin
	function viewUsers(){
		$query = "SELECT * FROM `user_tbl`";
		require ("includes/dbCon.php");
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) > 0){
			$feedback['feedback'] = 1;
			$c = 0;
			while ($row = mysqli_fetch_assoc($result)) {
				$feedback['details'][$c] = $row;
				$c++;
			}
		}else{
			$feedback['feedback'] = 0;
			$feedback['message'] = "<div class='error' style='background:#111111; color:#d7af00;padding:30px;'> No record available </div>";
		}
		if (isset($feedback)) {
			return $feedback;
		}
	}
	// get passport
	/*function getPassport($pic,$user){
		$query = "SELECT `passport` FROM `user_tbl` WHERE `username`='$user'";
		require ("includes/dbCon.php");
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) > 0){
			$feedback['feedback'] = 1;
			$feedback['details'] = mysqli_fetch_assoc($result);
		}else{
			$feedback['feedback']=0;
		}
		return $feedback;
	}*/
	// to search user by administrator
	function searchUser($searchKey){
		if ($searchKey != "" ) {
			$query = "SELECT * FROM `user_tbl` WHERE `first_name` = '$searchKey' OR `username` = '$searchKey' OR email = '$searchKey'"; 
			require ("includes/dbCon.php");
			$query_result = mysqli_query($conn, $query);
			if (mysqli_num_rows($query_result) > 0) {
				$feedback['feedback'] = 1;
				$c = 0;
				while ($row = mysqli_fetch_assoc($query_result)) {
					$feedback['details'][$c] = $row;
					$c++;
				}
			}else{
				$feedback['feedback'] = 0;
				$feedback['message'] = "<div class='error'> Sorry! No record found </div>";
			}
		}else{
			echo "<div class='error'>Please provide the search term</div>";
		}
		if (isset($feedback)) {
			return $feedback;
		}
	}
	// function to get user
	function getUser($username, $table){
		$query = "SELECT * FROM `$table` WHERE `username` = '$username'";
		require "includes/dbCon.php";
		$query_result = mysqli_query($conn, $query);
		if (mysqli_num_rows($query_result) > 0) {
			$feedback['feedback'] = 1;
			$feedback['details'] = mysqli_fetch_assoc($query_result);
		}else{
			$feedback['feedback'] = 0;
			$feedback['message'] = "<div class=error> Unable to fetch record </div>";
		}
		return $feedback;
	}
	// to update admin profile!
	function update($username, $firstName, $lastName, $nickname, $gender, $number, $email_address, $password, $table){
		if ($username != "" && $firstName != "" && $lastName != "" && $nickname != "" && $gender != "" && $number != "" && $email_address != "" && $password != "" && $table != "") {
			$query = "UPDATE `$table` SET `first_name` = '$firstName', `last_name` = '$lastName', `nickname` = '$nickname', `gender` = '$gender', `number` = '$number', `email_address` = '$email_address', `username`='$username', `password` = '$password' WHERE `username`='$username'";
			// connection

			require ("includes/dbCon.php");

			$query_result = mysqli_query($conn, $query);
			if (mysqli_affected_rows($conn) > 0) {
				$feedback["feedback"] = 1;
				$feedback["message"] = "<div class='success'> Profile updated successfully </div>";
			}else{
					$feedback["feedback"] = 0;
					$feedback["message"] = "<div class='error'> Unable to update profile! Pls try again </div>";
			}
		}else{
			echo "<div class='error'> All fields are required </div>";
		}
		if (isset($feedback)) {
			return $feedback;
		}
	}
	// To delete account
	function deleteAccount($username){
		if (!empty($username)) {
			$query = "DELETE FROM `user_tbl` WHERE `username` = '$username'";
			include "includes/dbCon.php"; 
			$result = mysqli_query($conn, $query);
			if (mysqli_affected_rows($conn) > 0) {
				$feedback["feedback"] = 1;
				$feedback["message"] = "<div class='success'> Profile deleted successfully </div>";
				header('location:artiste.php');
			}else{
					$feedback["feedback"] = 0;
					$feedback["message"] = "<div class='error'> Unable to delete profile!</div>";
					header('location:artiste.php');
			}
			return $feedback;
		}
	}
	// To delete news
	function deleteNews($id){
		if (!empty($id)) {
			$query = "DELETE FROM `events` WHERE `event_id` = '$id'";
			include "includes/dbCon.php"; 
			$result = mysqli_query($conn, $query);
			if (mysqli_affected_rows($conn) > 0) {
				$feedback["feedback"] = 1;
				$feedback["message"] = "<div class='success'> News deleted successfully </div>";
				header('location:events.php');
			}else{
					$feedback["feedback"] = 0;
					$feedback["message"] = "<div class='error'> Unable to delete profile!</div>";
					header('location:events.php');
			}
			return $feedback;
		}
	}
	// to Upload new track!
	function upload($audio_file_name, $img_file_name, $song_title, $artiste_name, $albumb, $date_released, $privacy, $description, $size, $uploader, $type){
		if ($audio_file_name != "" && $img_file_name != "" && $song_title != "" && $artiste_name != "" && $privacy != "" && $size != "" && $uploader != "" && $type != "") {
			
			include "includes/dbCon.php"; 
			$insert_query = "INSERT INTO `song_tbl` (`file_name`, `thumbnail`, `song_title`,`artiste_name`,`albumb`,`date_released`,`privacy`, `description`,`size`,`uploader`, `type`) VALUES('$audio_file_name','$img_file_name','$song_title','$artiste_name','$albumb','$date_released','$privacy','$description','$size','$uploader', '$type')";
			$insert_query_result = mysqli_query($conn, $insert_query);
			if ($insert_query_result) {
			 	$feedback['feedback'] = 1;
			 	$feedback['message'] = "<div class='success'> File uploaded Successfully!</div>";
			 }else{
				$feedback["feedback"] = 0;
				$feedback["message"] = "<div class='error'> Unable to upload! Pls try again </div>".mysqli_error($conn);
			}
		}else{
			echo "<div class='error'> All fields are required </div>";
		}
		if (isset($feedback)) {
			return $feedback;
		}
	}
	// to convert bytes to kb, mb, gb e.t.c
	function formatBytes($bytes){
		$precision=2;
		if ($bytes > pow(1024,3)){
			return round($bytes/pow(1024,3), $precision)."GB";
		}elseif ($bytes > pow(1024,2)){
			return round($bytes/pow(1024,2), $precision)."MB";
		}elseif ($bytes > 1024){
			return round(($bytes/1024), $precision)."KB";
		}else{
			return $bytes."B";
		}
	}
	// to post news
	function postNews($img, $title, $category, $date_posted, $content){
			$query = "INSERT INTO `events` (`image`, `title`, `category`, `date_posted`, `content`) VALUES('$img','$title', '$category', '$date_posted', '$content')";
		
			include "includes/dbCon.php"; 
			$insert_query_result = mysqli_query($conn, $query);
			if ($insert_query_result) {
			 	$feedback['feedback'] = 1;
			 	$feedback['message'] = "<div class='success'> Posted Successfully!</div>";
			 }else{
				$feedback["feedback"] = 0;
				$feedback["message"] = "<div class='error'> failed! Pls try again </div>";
			}
		if (isset($feedback)) {
			return $feedback;
		}
	}
	// to view all tracks
	function viewTracks(){
		$query = "SELECT * FROM `song_tbl` ORDER BY `song_id` DESC LIMIT 12";
		require ("includes/dbCon.php");
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) > 0){
			$feedback['feedback'] = 1;
			$c = 0;
			while ($row = mysqli_fetch_assoc($result)) {
				$feedback['details'][$c] = $row;
				$c++;
			}
		}else{
			$feedback['feedback'] = 0;
			$feedback['message'] = "<div class='error' style='background:#111111; color:#d7af00; padding:30px;'> No record available </div>";
		}
		if (isset($feedback)) {
			return $feedback;
		}
	}
	// to change password
	function changePassword($new_password1, $new_password2, $username){
		$p1 = md5($new_password1);
		$p2 = md5($new_password2);
		if ($p1==$p2) {
			$query = "UPDATE `admin` SET `password` = '$p1' WHERE `username` = '$username'";
			include "includes/dbCon.php"; 
			$update_query_result = mysqli_query($conn, $query);
			if ($update_query_result) {
			 	$feedback['feedback'] = 1;
			 	$feedback['message'] = "<div class='success'> Password changed Successfully!</div>";
			 }else{
				$feedback["feedback"] = 0;
				$feedback["message"] = "<div class='error'> failed! Pls try again </div>";
			}
		}else{
			$feedback['message'] = "<div class = 'error'>Password does not match</div>";
		}
		if (isset($feedback)) {
			return $feedback;
		}
	}
	// To delete song
	function deleteSong($id){
		if (!empty($id)) {
			$query = "DELETE FROM `song_tbl` WHERE `song_id` = '$id'";
			include "includes/dbCon.php"; 
			$result = mysqli_query($conn, $query);
			if (mysqli_affected_rows($conn) > 0) {
				$feedback["feedback"] = 1;
				$feedback["message"] = "<div class='success'> Song deleted successfully </div>";
				header('location:songs.php');
			}else{
					$feedback["feedback"] = 0;
					$feedback["message"] = "<div class='error'> Unable to delete!</div>";
					header('location:songs.php');
			}
			return $feedback;
		}
	}
	// To delete image
	function deleteImage($id){
		if (!empty($id)) {
			$query = "DELETE FROM `gallary` WHERE `id` = '$id'";
			include "includes/dbCon.php"; 
			$result = mysqli_query($conn, $query);
			if (mysqli_affected_rows($conn) > 0) {
				$feedback["feedback"] = 1;
				$feedback["message"] = "<div class='success'> Image deleted successfully </div>";
				header('location:gallary.php');
			}else{
					$feedback["feedback"] = 0;
					$feedback["message"] = "<div class='error'> Unable to delete!</div>";
					header('location:gallary.php');
			}
			return $feedback;
		}
	}
	// to suspend user
	function suspendUser($username, $suspension){
		if($username !="" && $suspension != ""){
			if ($suspension == 1) {
				$query = "UPDATE `user_tbl` SET `suspension` = '0' WHERE `username` = '$username';";
			}else{
				$query = "UPDATE `user_tbl` SET `suspension` = '1' WHERE `username` = '$username';";
			}
			
			include "includes/dbCon.php"; 
			$result = mysqli_query($conn, $query);
			if (mysqli_affected_rows($conn) > 0) {
				$feedback["feedback"] = 1;
				$feedback["message"] = "<div class='success'> Done successfully </div>";
				header('location:artiste.php');
			}else{
					$feedback["feedback"] = 0;
					$feedback["message"] = "<div class='error'> Unable to complete operation!</div>";
					header('location:artiste.php');
			}
		}else{
			$feedback['message'] = "Username empty";
		}
		if (isset($feedback)) {
			return $feedback;
		}
	}
	// to mark song trending/not
	function markTrend($song_id, $trend){
		if($song_id !="" && $trend != ""){
			if ($trend == 1) {
				$query = "UPDATE `song_tbl` SET `trend` = '0' WHERE `song_id` = '$song_id';";
			}else{
				$query = "UPDATE `song_tbl` SET `trend` = '1' WHERE `song_id` = '$song_id';";
			}
			
			include "includes/dbCon.php"; 
			$result = mysqli_query($conn, $query);
			if (mysqli_affected_rows($conn) > 0) {
				$feedback["feedback"] = 1;
				$feedback["message"] = "<div class='success'> Done successfully </div>";
				header('location:songs.php');
			}else{
					$feedback["feedback"] = 0;
					$feedback["message"] = "<div class='error'> Unable to complete operation!</div>";
					header('location:songs.php');
			}
		}else{
			$feedback['message'] = "Username empty";
		}
		if (isset($feedback)) {
			return $feedback;
		}
	}
	// to mark song as the week best
	function weekBest($song_id, $week_best){
		if($song_id !="" && $week_best != ""){
			if ($week_best == 1) {
				$query = "UPDATE `song_tbl` SET `week_best` = '0' WHERE `song_id` = '$song_id';";
			}else{
				$query = "UPDATE `song_tbl` SET `week_best` = '1' WHERE `song_id` = '$song_id';";
			}
			
			include "includes/dbCon.php"; 
			$result = mysqli_query($conn, $query);
			if (mysqli_affected_rows($conn) > 0) {
				$feedback["feedback"] = 1;
				$feedback["message"] = "<div class='success'> Done successfully </div>";
				header('location:songs.php');
			}else{
					$feedback["feedback"] = 0;
					$feedback["message"] = "<div class='error'> Unable to complete operation!</div>";
					header('location:songs.php');
			}
		}else{
			$feedback['message'] = "Username empty";
		}
		if (isset($feedback)) {
			return $feedback;
		}
	}
	// to fetch events
	function fetch_events($starting_point, $results_per_page){
		$query = "SELECT * FROM `events` ORDER BY `event_id` DESC LIMIT ".$starting_point.",".$results_per_page;;
		require ("includes/dbCon.php");
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) > 0){
			$feedback['feedback'] = 1;
			$c = 0;
			while ($row = mysqli_fetch_assoc($result)) {
				$feedback['details'][$c] = $row;
				$c++;
			}
		}else{
			$feedback['feedback'] = 0;
			$feedback['message'] = "<div class='error' style='color:red; padding:30px; font-weight: bolder;'> No news/event available </div>";
		}
		if (isset($feedback)) {
			return $feedback;
		}
	}
	//encryption
		function encrypt_decrypt($action, $string) {
		    $output = false;

		    $encrypt_method = "AES-256-CBC";
		    $secret_key = 'BTS';
		    $secret_iv = 'BTS';

		    // hash
		    $key = hash('sha256', $secret_key);
		    
		    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		    $iv = substr(hash('sha256', $secret_iv), 0, 16);

		    if ( $action == 'encrypt' ) {
		        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
		        $output = base64_encode($output);
		    } else if( $action == 'decrypt' ) {
		        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		    }

		    return $output;
		}
	 
 ?>