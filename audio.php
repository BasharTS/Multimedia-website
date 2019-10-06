<?php
  include "includes/header.php";
  include "includes/functions.php";
  include "includes/dbCon.php";
?>
			<div class="links shadow-effect-1">
				<a href="index.php">Homepage </a>>>
				<a href="audio.php">Audio</a>
			</div>
			<div class="row">
				<div class="col-sm-8">
					<div style="background: #f5f5f5; border: 1px ; border-style: outset; margin-top: 15px; width: 100%;">
						<div class="">
	                		<h5 style="padding: 10px; font-weight: bold; text-align:center; margin-top: 5px; border-bottom: 1px solid blue;"><i class='fa fa-music' aria-hidden='true'></i>   Tracks </h5>
	              		</div>
	              		<br>
	              		<div class="box" style="width: 95%; margin: 0 auto;">
	                		<ul style="width: 98%; text-align: center;">
	                <?php
			                //define how many results you want per page
			                $results_per_page = 15;

			                // find out the number of results stored in database
			                $sql = 'SELECT * FROM song_tbl';
			                $res = mysqli_query($conn, $sql);
			                $number_of_rows = mysqli_num_rows($res);

			                // determine number of total pages available
			                $number_of_pages = ceil($number_of_rows/$results_per_page);

			                // determine which page number visitor is currently on
			                if (!isset($_GET['page'])) {
			                	$page = 1;
			                } else {
			                    $page = $_GET['page'];
			                }
			                // determine the sql LIMIT starting number for the results on the displaying page
			                $starting_point = ($page-1)*$results_per_page;

			                $all_songs = getSongs($starting_point, $results_per_page);
			                if (isset($all_songs) && $all_songs['feedback']==1) {
			                    $songs = $all_songs['details'];
			                      
			                    foreach ($songs as $key) {
	                                $url = $key['date_released'];
	                                $img = $key['thumbnail'];
	                                $file = explode('-', $url);
	                                $folder = $file[0].'_'.$file[1];
	                                $thumbnail_path =  "uploads/media/".$folder."/".$img;
	                                $id = encrypt_decrypt('encrypt', $key['song_id']);
			                        echo "<li id='blink' style='margin:0 auto; padding:0px;'> 
			                              <div class='row' id= 'article' >
			                                <div class='col-sm-4' style=''>
			                                  <img src=".$thumbnail_path." width='100%' height='120' style='margin: 0 auto;'>
			                                </div>
			                                <div class='col-sm-8' style='padding:5px;'>" 
			                                .$key['song_title']." -- ".$key['artiste_name']." 
			                                <br>
			                                <p class='lead' style='font-size: 14px; font-style: italic;'>".$key['size']."<br>  ".$key['date_released']." </p>
			                                <a href='download.php?s=".$id."&t=".urlencode($key['song_title'])."'><i class='fa fa-download' aria-hidden='true'></i> Download</a>
			                                </div>
			                              </div>
			                              </li>
			                              <hr>";
			                    }
			                }else{
			                      echo $all_songs['message'];
			                }
			                if ($number_of_pages > 1) {
			                    // previous and Next button
			                    $prev = $page-1;
			                    $next = $page+1;
			                    if ($prev >=1) {
			                    	echo '<a href="audio.php?page=' . $prev . '" class="page" style = "margin-right:4px;"> Prev </a> ';
			                    }
			                    // display the links to the pages
			                    for ($r=1;$r<=$number_of_pages;$r++) {
			                        $current = ($r == $page? 'class="current"' : 'class="page"');
			                        echo '<a href="audio.php?page=' . $r . '" '. $current .' >' . $r . '</a> ';
			                    }
			                    if ($next < $number_of_pages) {
			                         echo '<a href="audio.php?page=' . $next . '" class="page" > Next </a> ';
			                    }
			                }
			             ?>
							</ul>
			                <br>
			            </div>
					</div>
				</div>
				<div class="col-sm-4">
					<div style="background: #cccccc; border: 1px solid lightblue; border-style: outset;; margin-top: 15px; height: 300px; width: 100%; box-sizing: border-box; text-align: center; color: maroon;">
						<div class="" style="background: yellow;">
	                		<h5 style="padding: 10px; font-weight: bold; text-align:center; margin-top: 0px; border-bottom: 1px solid blue;"><i class='fa fa-info-circle' aria-hidden='true'></i>  Advertisement</h5>
	              		</div>
	              		... * ...
					</div>
					<?php 
						include 'includes/sidebar.php';
					 ?>
				</div>
				<div class="container" style="background: #ffffff;" >
					<div class="row">
						<h5 style="padding: 15px; font-weight: bold; text-align:center; margin: 0 auto; border-bottom: 2px solid #bbb; color: blue; font-weight: bolder; width: 90%; box-sizing: border-box;"><i class='fa fa-music' aria-hidden='true'></i>   Trending Tracks
						</h5><br>
					<?php
					// error_reporting(0);
					  	$trending_songs = getTrendingSongs();
					  	if (isset($trending_songs) && $trending_songs['feedback']==1) {
					  	    $trend = $trending_songs['details'];
					  	    foreach ($trend as $key) {
					  	    	$url = $key['date_released'];
					  	    	$img = $key['thumbnail'];
					  	    	$file = explode('-', $url);
					  	    	$folder = $file[0].'_'.$file[1];
					  	    	$thumbnail_path =  "uploads/media/".$folder."/".$img;
					  	    	$id = encrypt_decrypt('encrypt', $key['song_id']);
					  	    	$block='<div class="col-sm-4" style="margin: 8px 0px; background:#f5f5f5;">
						    				<div class="card" style="width: 100%; padding:10px 8px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); text-align:center;">
						      					<img class="card-img-top" src="'.$thumbnail_path.'" alt="Card image cap"width="90%" height="220px"> <br>
						      					<div class="card-body">
						        					<h4 class="card-title">'.$key["song_title"].' -- '.$key["artiste_name"].'</h4>
						        					<p class="lea" style="font-size: 14px; font-style: italic;">'.$key["size"].'<br>'.$key['date_released'].' </p>
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

		<?php 
		  include "includes/footer.php";
		?>