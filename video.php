<?php
  include "includes/header.php";
  include "includes/functions.php";
  include "includes/dbCon.php";
?>
			<div class="links shadow-effect-1">
				<a href="index.php">Homepage </a>>>
				<a href="video.php">Video</a>
			</div>
			<div class="row">
				<div class="col-sm-8">
					<div style="background: #f5f5f5; border: 1px ; border-style: outset; margin-top: 15px; width: 100%;">
						<div class="">
	                		<h5 style="padding: 10px; font-weight: bold; text-align:center; margin-top: 5px; border-bottom: 1px solid blue;"><i class="fa fa-video" aria-hidden="true"></i> Videos</h5>
	              		</div>
	              		<br>
	              		<div class="row" >
	                		<?php
	                		  //define how many results you want per page
	                		  $videos_per_page = 12;

	                		  // find out the number of results stored in database
	                		  $query='SELECT * FROM song_tbl where `type`="video" && `privacy`="public"';
	                		  $rslt = mysqli_query($conn, $query);
	                		  $number_of_rows = mysqli_num_rows($rslt);

	                		  // determine number of total pages available
	                		  $number_of_pages = ceil($number_of_rows/$videos_per_page);

	                		  // determine which page number visitor is currently on
	                		  if (!isset($_GET['v'])) {
	                		    $v = 1;
	                		  } else {
	                		    $v = $_GET['v'];
	                		  }
	                		  // determine the sql LIMIT starting number for the results on the displaying page
	                		  $starting_point = ($v-1)*$videos_per_page;

	                		    $all_videos = getVideos($starting_point, $videos_per_page);
	                		    if (isset($all_videos) && $all_videos['feedback']==1) {
	                		      $videos = $all_videos['details'];
	                		      foreach ($videos as $key) {
	                		        $file = explode('-', $key['date_released']);
	                		        $folder = $file[0]."_".$file[1];
	                		        $id = encrypt_decrypt('encrypt', $key['song_id']);
	                		        echo '<div class="col-sm-6" style=" margin-top:0px; padding-bottom: 10px; 
	                		              text-align:center;" >
	                		                <video width="auto" height="auto" controls id="video">
	                		                  <source src="uploads/media/'.$folder."/".$key["file_name"] .'"type="video/mp4">
	                		                  <source src="movie.ogg" type="video/ogg"> Your browser does not support the video tag.
	                		                </video>
	                		                  <p style="color:#000000;"> '.$key["song_title"].' By '.$key["artiste_name"].'  
	                		                    <p class="lead" style="font-size: 14px; font-style: italic; color:#000000; margin-left:10px;"> Size: '.$key['size'].'<br> Date: '.$key['date_released'].'
	                		                    </p>
	                		                    <a href="download.php?s='.$id.'&t='.urlencode($key["song_title"]).'" ><i class="fa fa-download" aria-hidden="true"></i> Download
	                		                    </a>
	                		                  </p>
	                		              </div> 
	                		              <br>';
	                		      }
	                		    }else{
	                		      echo "<div style='text-align:center; width:100%;'>".$all_videos['message']."</div";
	                		    }

	                		    echo "</div>
	                		          <div style = 'width:100%; height: 35px; background:#eee8dc; text-align:center; padding-top:5px; clear: both;'>";
	                		    if ($number_of_pages > 1) {
	                		      // previous and Next button
	                		      $prev = $v-1;
	                		      $next = $v+1;
	                		      if ($prev >=1) {
	                		        echo '<a href="index.php?v=' . $prev . '" class="page" style = "margin-right:4px;"> Prev </a> ';
	                		      }
	                		      // display the links to the pages
	                		      for ($r=1;$r<=$number_of_pages;$r++) {
	                		        $current = ($r == $v? 'class="current"' : 'class="page"');
	                		        echo '<a href="index.php?v=' . $r . '" '. $current .' >' . $r . '</a> ';
	                		      }
	                		      if ($next <= $number_of_pages) {
	                		         echo '<a href="index.php?v=' . $next . '" class="page" > Next </a> ';
	                		      }
	                		    }
	                		?>
			            </div>
					</div>
				</div>
				<div class="col-sm-4">
					<div style="background: #cccccc; border: 1px solid lightblue; border-style: outset;; margin-top: 15px; height: 300px; width: 100%; box-sizing: border-box; text-align: center; color: maroon;">
						<div class="" style="background: yellow;">
	                		<h5 style="padding: 10px; font-weight: bold; text-align:center; margin-top: 0px; border-bottom: 1px solid blue;"><i class='fa fa-info-circle' aria-hidden='true'></i>     Advertisement</h5>
	              		</div>
	              		... * ...
					</div>
					<?php 
						include 'includes/sidebar.php';
					 ?>
				</div>
				<div class="container" style="background: #f5f5f5;" >
					<div class="row">
						<h5 style="padding: 15px; box-sizing: border-box; font-weight: bold; text-align:center; margin: 0 auto; border-bottom: 2px solid #bbb; color: blue; font-weight: bolder; width: 89%;"> <i class='fa fa-video' aria-hidden='true'></i>  Porpular Videos
						</h5><br>
					  	<?php
					  	// error_reporting(0);
					  	  	$trending_songs = getTrendingVideos();
					  	  	if (isset($trending_songs) && $trending_songs['feedback']==1) {
					  	  	    $trend = $trending_songs['details'];
					  	  	    foreach ($trend as $key) {
					  	  	    	$url = $key['date_released'];
					  	  	    	$vid = $key['file_name'];
					  	  	    	$file = explode('-', $url);
					  	  	    	$folder = $file[0].'_'.$file[1];
					  	  	    	$thumbnail_path =  "uploads/media/".$folder."/".$vid;
					  	  	    	$id = encrypt_decrypt('encrypt', $key['song_id']);
					  	  	    	$block='<div class="col-sm-4" style="margin: 8px 0px; background:#f5f5f5;">
					  		    				<div class="card" style="width: 100%; padding:8px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
					  		      					<video width="auto" height="auto" controls id="video">
					  		      					  <source src="'.$thumbnail_path.'"type="video/mp4">
					  		      					  <source src="movie.ogg" type="video/ogg"> Your browser does not support the video tag.
					  		      					</video> <hr>
					  		      					<div class="card-body text-center">
					  		        					<h4 class="card-title">'.$key["song_title"].' By '.$key["artiste_name"].'</h4>
					  		        					<p class="lea" style="font-size: 14px; font-style: italic;">Size: '.$key["size"].'<br>
					  	  	            				Date: '.$key['date_released'].' </p>
					  	  	            				
					  		        					<a href="download.php?s='.$id.'&t='.urlencode($key['song_title']).'"><i class="fa fa-download" aria-hidden="true"></i> Download
					  		        					</a>
					  		      					</div>
					  		    				</div>
					  	  					</div>';
					  	  					echo $block;
					  	  	    }
					  	  	}else{
					  	  	    echo '<div style="width:100%; text-align:center; padding:30px;">'.$trending_songs['message'].'</div>';
					  	  	}
					  	 ?>
					</div>
				</div>
			</div>
		</div>

		<?php 
		  include "includes/footer.php";
		?>

	</div>
</body>
</html>