<?php
  include "includes/header.php";
  include "includes/functions.php";
  include "includes/dbCon.php";
  ?>
          <div class="container">
            <div class="row">
              <div class="col-sm-2"> </div>
              <div class="col-sm-8">
                <div style="width: 98%; margin: 20px auto;">
                  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                    </ol>
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img class="d-block w-100" src="img/slide/welcome1.png" id="slider" alt="First slide">
                      </div>
                      <div class="carousel-item">
                        <img class="d-block w-100" src="img/slide/multimedia.png" id="slider" alt="second slide">
                      </div>
                      <div class="carousel-item">
                        <img class="d-block w-100" src="img/slide/people1.png" id="slider" alt="Third slide">
                      </div>
                      <div class="carousel-item">
                        <img class="d-block w-100" src="img/slide/advert2.png" id="slider" alt="fouth slide">
                      </div>
                      <div class="carousel-item">
                        <img class="d-block w-100" src="img/slide/sale1.png" id="slider" alt="fifth slide">
                      </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-sm-2"></div>
            </div>
          </div>
        <div class="container" style="padding: 0px; margin-top: 15px;">
          <div class="row" style=' margin: 0 auto;'>
            <div class="col-sm-8">
              <!-- Search Box -->
                <?php 
                  include 'includes/search.php'; 
                ?>
                <!-- End of search box -->
              <div class="" style=" padding: 15px; width: 90%; margin: 0 auto;">
                <h3 style="font-weight: bold; text-align:center;"><i class="fa fa-newspaper" aria-hidden="true"></i>   Top Stories</h3>
              </div>
              <div class="box" style="width: 95%; margin: 10px; auto;">
                <ul>
                <?php
                    //define how many results you want per page
                    $results_per_page = 5;
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
                                <div class='col-sm-4'>
                                  <img src=".$thumbnail_path.">
                                </div>
                                <div class='col-sm-8'
                                  <li id='blink'>
                              <a href='news.php?id=".$id."' style='font-size:18px;'>".$key['title']."</a> 
                              <br>
                                  <p class='lead' style='font-size: 14px; font-style: italic;'>".$key['date_posted']."</p>
                                </li>
                               </div>
                              </div> <hr>";
                      }
                    }else{
                      echo $result['message'];
                    }
                    if ($number_of_pages > 1) {
                      // previous and Next button
                      $prev = $news-1;
                      $next = $news+1;
                      if ($prev >=1) {
                        echo '<a href="index.php?n=' . $prev . '" class="page" style = "margin-right:4px;"> Prev </a> ';
                      }
                      // display the links to the pages
                      for ($r=1;$r<=$number_of_pages;$r++) {
                        $current = ($r == $news? 'class="current"' : 'class="page"');
                        echo '<a href="index.php?n=' . $r . '" '. $current .' >' . $r . '</a> ';
                      }
                      if ($next < $number_of_pages) {
                         echo '<a href="index.php?n=' . $next . '" class="page" > Next </a> ';
                      }
                    }
                ?>
                </ul>
                <br>
              </div>
            </div>
            <div class="col-sm-4" style="padding-right: 0px;">
              <div id="advert">
                <div class="" style="">
                  <h5 style="padding: 10px; font-weight: bold; text-align:center; margin: 0px auto; border-bottom: 1px solid green;"><i class='fa fa-info-circle' aria-hidden='true'></i>  Advertisement</h5>
                </div>
                    ... * ...<br> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
              </div>
          </div>
          </div>
        </div>
        <div class="container" style="margin-top: 25px;">
          <div class="row">
            <div class="col-sm-8" >
              <!-- <div style="border: 1px solid #bbb; width: 95%;"> -->
                <div class="title" style="color: white;">
                  <h5 style="font-weight: bold; text-align:center;">[ MUSIC ] Latest Songs</h5>
                </div>
                <div class="box" style="width: 95%; margin: 0 auto;">
                  <ul>
                    <?php
                    //define how many results you want per page
                    $results_per_page = 15;
                    // find out the number of results stored in database
                    $sql='SELECT * FROM song_tbl';
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
                                <div class='row' id = 'article'>
                                  <div class='col-sm-4' style=''>
                                    <img src=".$thumbnail_path." width='100%' height='120' style='margin: 0 auto; border-radius:5px;'>
                                  </div>
                                  <div class='col-sm-8' style='padding:0px;text-align:center;'>" 
                                  .$key['song_title']."-_-".$key['artiste_name']." 
                                  <br>
                                  <p class='lead' style='font-size: 14px; font-style: italic;'>".$key['size']."<br>
                                  ".$key['date_released']." </p>
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
                          echo '<a href="index.php?page=' . $prev . '" class="page" style = "margin-right:4px;"> Prev </a> ';
                        }
                        // display the links to the pages
                        for ($r=1;$r<=$number_of_pages;$r++) {
                          $current = ($r == $page? 'class="current"' : 'class="page"');
                          echo '<a href="index.php?page=' . $r . '" '. $current .' >' . $r . '</a> ';
                        }
                        if ($next < $number_of_pages) {
                           echo '<a href="index.php?page=' . $next . '" class="page" > Next </a> ';
                        }
                      }
                    ?>
                  </ul>
                  <br>
                </div>
            </div>
            <div class="col-sm-4">
              <script>
              document.getElementById('trending').style.display = "block";
              function openCity(evt, cityName) {
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                  tabcontent[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                  tablinks[i].className = tablinks[i].className.replace(" active", "");
                }
                document.getElementById(cityName).style.display = "block";
                evt.currentTarget.className += " active";
              }
              </script>
              <!-- Trending music -->
              <div class="tab" style="" >
                <button class="tablinks active" onclick="openCity(event, 'trending')">Trending Music </button>
                <button class="tablinks" onclick="openCity(event, 'tdownloads')">Top Downloads</button>
              </div>
              <div class="tabcontent" id="trending" style="display: block;">
                  <?php
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
                          echo '<div class="row" style="padding: 15px; margin-top: 0px; text-align:center; " >
                                  <div style="width:100%; border:1px solid #bbb; border-radius: 5px; background: #fff;box-sizing: border-box; padding-top: 15px;">
                                    <img src="'.$thumbnail_path.'" width="80%" height="200px" style="border-radius:5px;">
                                    <hr>
                                    <p style="color:#000000;"> '.$key["song_title"].' -- '.$key["artiste_name"].'  
                                      <p class="lead" style="font-size: 14px; font-style: italic; color:#000000; margin-left:10px;">'.$key['size'].'<br>'.$key['date_released'].'
                                      </p>
                                      <a href="download.php?s='.$id.'&t='.urlencode($key["song_title"]).'" ><i class="fa fa-download" aria-hidden="true"></i> Download
                                      </a>
                                    </p>
                                  </div>
                                  <hr>
                                </div>';
                      }
                    }else{
                      echo $trending_songs['message'];
                    }
                    ?>
              </div>
            <!-- End -->
              <div id="tdownloads" class="tabcontent">
                  <?php
                    $downloadedSongs = getDownloadCount();
                    if (isset($downloadedSongs) && $downloadedSongs['feedback']==1) {
                      $dwn = $downloadedSongs['details'];
                      foreach ($dwn as $key) {
                        $url = $key['date_released'];
                        $img = $key['thumbnail'];
                        $file = explode('-', $url);
                        $folder = $file[0].'_'.$file[1];
                        $thumbnail_path =  "uploads/media/".$folder."/".$img;
                        $id = encrypt_decrypt('encrypt', $key['song_id']);
                        echo '<div class="row" style="padding: 15px; margin-top0px; text-align:center;" >
                                  <div style="width:100%; border:1px solid #bbb; border-radius: 5px; background: #ffffff;box-sizing: border-box; padding-top: 15px;">
                                    <img src="'.$thumbnail_path.'" width="80%" height="200px" style="border-radius:5px;">
                                    <hr>
                                    <p style="color:#000000;"> '.$key["song_title"].' -- '.$key["artiste_name"].'  
                                      <p class="lead" style="font-size: 14px; font-style: italic; color:#000000; margin-left:10px;">'.$key['size'].'<br>'.$key['date_released'].'
                                      </p>
                                      <a href="download.php?s='.$id.'&t='.urlencode($key["song_title"]).'" ><i class="fa fa-download" aria-hidden="true"></i> Download
                                      </a>
                                    </p>
                                  </div>
                                  <hr>
                                </div> ';
                      }
                    }else{
                      echo $downloadedSongs['message'];
                    }
                  ?>
              </div>
            </div>
          </div>
        </div>
      <!-- End of Music Container -->
      <div id = "container-style" style="background: url('bg/slide-2.jpg'); border-radius: 50px 50px 0 0; color: #000000; width: 100%;">
        <div class="title2" style="background: #333333; border: 1px solid #eee8aa;">
          <h5 style="font-weight: bold; text-align:center; color: #eee8aa; ">You Might also like...</h5>
        </div>
        <!-- <div class="container"> -->
        <div class="row" style="margin: 3px;">
          <?php
            //define how many results you want per page
            $videos_per_page = 3;
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
                  echo '<div class="col-sm-4" style=" margin-top:5px; padding-bottom: 10px; 
                        text-align:center;" >
                          <video width="100%" height="auto" controls id="video">
                            <source src="uploads/media/'.$folder."/".$key["file_name"] .'"type="video/mp4">
                            <source src="movie.ogg" type="video/ogg"> Your browser does not support the video tag.
                          </video>
                            <p style="color:#eee8aa;"> '.$key["song_title"].' -- '.$key["artiste_name"].'  
                              <p class="lead" style="font-size: 14px; font-style: italic; color:#eee8aa; margin-left:10px;">'.$key['size'].'<br>'.$key['date_released'].'
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
<?php 
  include 'includes/footer.php';
 ?>