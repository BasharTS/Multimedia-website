<?php 
  include 'includes/header.php';
 ?>      <div class="links shadow-effect-1">
            <a href="index.php">Homepage </a>>>
            <a href="posts.php">News</a>
          </div>
        <div class="container" id = "container-style" style="padding: 10px; margin-top: 5px;">
          
          <div class="row">
            <div class="col-sm-7" >
              <?php 
                require ("admin/includes/dbCon.php");
                require ("includes/functions.php");
                if (isset($_GET['id'])) {
                  $id = htmlentities($_GET['id']);
                  $real_id = encrypt_decrypt('decrypt', $id);
                  // var_dump($real_id);
                  $res = getNews($real_id);
                  if ($res['feedback'] == 1) {
                    $result = $res['details'];
                    $url = $result['date_posted'];
                    $file = explode('-', $url); 
                    if (is_array($file) && sizeof($file) > 1) {
                      $folder = $file[0]."_".$file[1];
                      $title = $result['image'];
                      // var_dump($title);
                      $imgPath = 'uploads/images/'.$folder.'/'.$title;
                    }else{
                      $imgPath = 'uploads/images/no_image3.png';
                    }
                    
                    $block = '
                              <div class="title">
                                <h5 style="font-weight: bold; text-align:center;"><i class="fa fa-newspaper" aria-hidden="true"></i> '  .$result["title"].'</h5>
                              </div>
                              <img src='.$imgPath.' alt="No photo" height="300" width="100%" style = "padding:0 40px; box-sizing: border-box; text-align:center;">
                              <br> <hr><p style="box-sizing: border-box; padding-left: 10px;">'.wordwrap($result["content"]).'</p> <br> <hr>
                              <p>Date posted: '.$result["date_posted"].'</p>
                              <p>Share:<a href="#"> Facebook</a> <a href="#"> Whatsapp</a></p>';
                    echo "$block";
                  }else{
                    echo '<div class="title">
                        <h5 style="font-weight: bold; text-align:center;">News... .</h5>
                        </div>
                        <p class="error" style="text-align:center; padding:20px;">Sorry! No record found';
                  }
                }else{
                  echo '<div class="title">
                        <h5 style="font-weight: bold; text-align:center;">News... .</h5>
                        </div>
                        <p class="error" style="text-align:center; padding:20px;">Sorry! You have to click on news link  -->';
                }
              ?>
              
              
            </div>

            <div class="col-sm-5">
              <div class="title" style="background: #ffd700;">
                <h5 style="font-weight: bold; text-align:center; color: green;">MORE NEWS</h5>
              </div>

              <div class="box">
                <ul>
                  <?php
                    // require ("admin/includes/dbCon.php");
                    // require ("includes/functions.php");
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
                        echo "<li id='blink'><a href='news.php?id=".$id."'>".$key['title']."</a> <br><br>
                              Dategory: ".$key['category']."<br> Date: ".$key['date_posted']."
                              </li><hr>";
                      }
                    }else{
                      echo $result['message'];
                    }
                    /*if ($number_of_pages > 1) {
                      // previous and Next button
                      $prev = $news-1;
                      $next = $news+1;
                      if ($prev >=1) {
                        echo '<a href="news.php?n=' . $prev . '" class="page" style = "margin-right:4px;"> Prev </a> ';
                      }
                      // display the links to the pages
                      for ($r=1;$r<=$number_of_pages;$r++) {
                        $current = ($r == $news? 'class="current"' : 'class="page"');
                        echo '<a href="news.php?n=' . $r . '" '. $current .' >' . $r . '</a> ';
                      }
                      if ($next < $number_of_pages) {
                         echo '<a href="news.php?n=' . $next . '" class="page" > Next </a> ';
                      }
                    }*/
                  ?>
                </ul>
              </div>
            </div>
          </div>
          <!-- end of music container row -->
          <!-- <div>
            <div class="title2">
              <h5 style="font-weight: bold; text-align:center;">You Might also like...</h5>
            </div>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
              consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
              cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
              proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          </div> -->
        </div>
      </div>
       <?php 
          include 'includes/footer.php';
        ?>
    </div>
  </body>
</html>