<?php 
	require "../includes/functions.php";
	/*$bytes="3609720";
	echo formatBytes($bytes);
	echo "<br>";
	echo "<br>";
	echo "<br>";
	echo date("Y/m/d");
	echo "<br>";
	$file = "ERASER_by_ED SHEERAN_(downloaded from KBmp3.com).mp3";
	$file_pointer = "../uploads/audio/".$file;
	if (file_exists($file_pointer)) {
	    echo "<div class='error' > file already exist.</div>";
	}else{
		echo "<div class='error' > Go ahead.</div>";
	}
	clearstatcache();
	$text = 'The young upcoming artiste KILLER and his crew are set to perform on monday 29/10/2018 at the cst main hall. It is also believed that awards would be presented to the most deserving winner on that very day.';*/
	$starting_point = 0;
	$results_per_page = 5;
	$resul = getSongs($starting_point, $results_per_page);
	// print_r($resul);
	echo "<br>";
 // connect to database
$con = mysqli_connect('localhost','root','');
mysqli_select_db($con, 'music');

// define how many results you want per page
$results_per_page = 5;

// find out the number of results stored in database
$sql='SELECT * FROM song_tbl';
$result = mysqli_query($con, $sql);
$number_of_results = mysqli_num_rows($result);

// determine number of total pages available
$number_of_pages = ceil($number_of_results/$results_per_page);

// determine which page number visitor is currently on
if (!isset($_GET['page'])) {
  $page = 1;
} else {
  $page = $_GET['page'];
}

// determine the sql LIMIT starting number for the results on the displaying page
$this_page_first_result = ($page-1)*$results_per_page;

// retrieve selected results from database and display them on page
$sql='SELECT * FROM song_tbl LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
$result = mysqli_query($con, $sql);

while($row = mysqli_fetch_array($result)) {
  echo $row['song_id'] . ' ' . $row['song_title']. '<br>';
}

// display the links to the pages
for ($page=1;$page<=$number_of_pages;$page++) {
  echo '<a href="test.php?page=' . $page . '">' . $page . '</a> ';
}
echo "<hr>";
//To update download
	/*function downloaded($id, $c){
		$songId = $id;
		$count = $c+1;
		if (isset($songId)) {
			$query = "UPDATE `song_tbl` SET `download_count` = '".$count."' WHERE `song_tbl`.`song_id` = '".$songId."'";

			require ("includes/dbCon.php");

			$result = mysqli_query($conn, $query);
		}
	}*/
// var_dump(download(4, 2));	
	echo 
?>