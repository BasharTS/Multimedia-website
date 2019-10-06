<?php
  include "includes/header.php";
  include "includes/functions.php";
  include "includes/dbCon.php";
?>
			<div class="links shadow-effect-1">
				<a href="index.php">Homepage </a>>>
				<a href="posts.php">Gist</a>
			</div>
			<div class="row">
				<div class="col-sm-8">
					<div style="background: #f5f5f5; border: 1px ; border-style: outset; margin-top: 15px; width: 100%;">
						<div class="">
	                		<h5 style="padding: 10px; font-weight: bold; text-align:center; margin-top: 5px; border-bottom: 1px solid blue;"><i class="fa fa-newspaper" aria-hidden="true"></i> Latest News</h5>
	              		</div>
	              		<br>
	              		<div class="box" style="width: 95%; margin: 0 auto;">
	                		<ul style="width: 98%;">
			                <?php
			                    //define how many results you want per page
			                    $results_per_page = 12;

			                    // find out the number of results stored in database
			                    $sql='SELECT * FROM events';
			                    $eventResult = mysqli_query($conn, $sql);
			                    $number_of_rows = mysqli_num_rows($eventResult);

			                    // determine number of total pages available
			                    $number_of_pages = ceil($number_of_rows/$results_per_page);

			                    // determine which page number visitor is currently on
			                    if (!isset($_GET['n'])) {
			                      $news = 1;
			                    } else {
			                      $news = $_GET['n'];
			                    }
			                    // determine the sql LIMIT starting number for the results on the displaying page
			                    $starting_point = ($news-1)*$results_per_page;

			                    $result = fetch_events($starting_point, $results_per_page);
			                    if (isset($result) && $result['feedback']==1) {
			                      $details = $result['details'];
			                      foreach ($details as $key) {
			                      	$url = $key['date_posted'];
	                                if ($key['image'] != '') {
	                                	$img = $key['image'];
	                                	$file = explode('-', $url);
	                                	$folder = $file[0].'_'.$file[1].'/';
	   	                            	$thumbnail_path =  "uploads/images/".$folder."/".$img;
	   	                            }else{
	   	                            	$img = 'no_image3.png';
	   	                            	$folder = '';
	   	                            	$thumbnail_path =  "uploads/images/".$img;
	   	                            }
	   	                             $id = encrypt_decrypt('encrypt', $key['event_id']);
			                        echo "<div class='row'  id = 'article'>
			                                <div class='col-sm-4' style=''>
			                                  <img src=".$thumbnail_path." width='90%' height='120px' style='margin: 0 auto;'>
			                                </div>
			                                <div class='col-sm-8'
				                                <li id='blink'>
				                        		<a href='news.php?id=".$id."' style='font-size:18px;'>".$key['title']."</a>
				                              	<p class='lead' style='font-size: 14px; font-style: italic;'>Date: ".$key['date_posted']."</p>
				                              </li>
				                             </div>
				                            </div>
			                              <hr>";
			                      }
			                    }else{
			                      echo $result['message'];
			                    }
			                    if ($number_of_pages > 1) {
			                      // previous and Next button
			                      $prev = $news-1;
			                      $next = $news+1;
			                      if ($prev >=1) {
			                        echo '<a href="posts.php?n=' . $prev . '" class="page" style = "margin-right:4px;"> Prev </a> ';
			                      }
			                      // display the links to the pages
			                      for ($r=1;$r<=$number_of_pages;$r++) {
			                        $current = ($r == $news? 'class="current"' : 'class="page"');
			                        echo '<a href="posts.php?n=' . $r . '" '. $current .' >' . $r . '</a> ';
			                      }
			                      if ($next < $number_of_pages) {
			                         echo '<a href="posts.php?n=' . $next . '" class="page" > Next </a> ';
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
	                		<h5 style="padding: 10px; font-weight: bold; text-align:center; margin-top: 0px; border-bottom: 1px solid blue;">Advertisement</h5>
	              		</div>
	              		... * ...
					</div>
					<div class="" style="background: #ffffff; margin: 10px auto; width: 100%; box-sizing: border-box; box-shadow: 2px 3px 0px #bbb;" >
						<div class="" >
	                		<h5 style="padding: 10px; font-weight: bold; text-align:center; margin-top: 0px; border-bottom: 1px solid white; color: #ffffff; font-weight: bolder; background: purple;">Video Of the Week</h5>
	              		</div>
	              			<?php 
	              				$result = weekBestVideo();
	              				if (isset($result) && $result['feedback']==1) {
	              					$best = $result['details'];
	              					$url = $best['date_released'];
	              					$vid = $best['file_name'];
                                	$file = explode('-', $url);
                                	$folder = $file[0].'_'.$file[1];
                                	$thumbnail_path =  "uploads/media/".$folder."/".$vid;
	              				    
              				        echo '<div class="" style="padding-bottom:10px; text-align:center; " >
                                  			<div style="width:90%; border:1px solid #bbb; border-radius: 5px; background: #f5f5f5; margin:0 auto;">
                                    			<video width="auto" height="auto" controls id="video" style="width:100%; height:200px; border-radius:5px;">
                            						<source src="uploads/media/'.$folder."/".$best["file_name"] .'"type="video/mp4">
                            						<source src="movie.ogg" type="video/ogg"> Your browser does not support the video tag.
                          						</video>
                                    			<hr>
                                    			<p style="color:#000000;"> '.$best["song_title"].' By '.$best["artiste_name"].'  
                                      				<p class="lead" style="font-size: 14px; font-style: italic; color:#000000; margin-left:10px;">'.$best['size'].'<br>'.$best['date_released'].'
                                      				</p>
                                      				<a href="download.php?id='.$best["song_id"].'&title='.$folder."/".urlencode($best["song_title"]).'" ><i class="fa fa-download" aria-hidden="true"></i> Download
                                      				</a>
                                    			</p>
                                  			</div>
                                		</div>';
	              				 
	              				}else{
	              				    echo $result['message'];
	              				}
	              			 ?>
	              	</div>
              		<div class="" style="background: #ffffff; margin: 10px auto; width: 100%; box-sizing: border-box; box-shadow: 2px 3px 0px #bbb;">
						<div class="" style="background: purple;">
	                		<h5 style="padding: 10px; font-weight: bold; text-align:center; margin-top: 0px; border-bottom: 1px solid white; color: #ffffff; font-weight: bolder;">Music Of The Week</h5>
	              		</div>
	              			<?php 
	              				$result = weekBest();
	              				if (isset($result) && $result['feedback']==1) {
	              					$best = $result['details'];
	              					$url = $best['date_released'];
	              					$img = $best['thumbnail'];
                                	$file = explode('-', $url);
                                	$folder = $file[0].'_'.$file[1];
                                	$thumbnail_path =  "uploads/media/".$folder."/".$img;
	              				    
              				        echo '<div class="" style="padding-bottom:10px; text-align:center; " >
                                  			<div style="width:90%; border:1px solid #bbb; border-radius: 5px; background: #f5f5f5; margin:0 auto;">
                                    			<img src="'.$thumbnail_path.'" width="100%" height="200px" style="border-radius:5px;">
                                    			<hr>
                                    			<p style="color:#000000;"> '.$best["song_title"].' -- '.$best["artiste_name"].'  
                                      				<p class="lead" style="font-size: 14px; font-style: italic; color:#000000; margin-left:10px;">'.$best['size'].'<br>'.$best['date_released'].'
                                      				</p>
                                      				<a href="download.php?id='.$best["song_id"].'&title='.$folder."/".urlencode($best["song_title"]).'" ><i class="fa fa-download" aria-hidden="true"></i> Download
                                      				</a>
                                    			</p>
                                  			</div>
                                		</div>';
	              				 
	              				}else{
	              				    echo $result['message'];
	              				}
	              			 ?>
	              	</div>
				</div>
				<div class="container" style="background: maroon;" >
					
				</div>
			</div>
		</div>

		<?php 
		  include "includes/footer.php";
		?>

	</div>
</body>
</html>