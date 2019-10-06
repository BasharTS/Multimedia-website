<!doctype html>
<html lang="en">
    <?php 
        include 'includes/admin_header.php';

        require ("includes/dbCon.php"); 
        include 'includes/functions.php';

        session_start();
        if (!isset($_SESSION["admin"]) || !isset($_SESSION["fullname"])) {
            header("location: index.php");
        }
        include 'includes/menu.php';
    ?>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-1">
                            </div>
                            <div class="col-sm-10 ">
                                <div id="addFormWrapper">
                                    <div class="form-title-row">
                                        <h4 style="color: #d7af00; border-bottom: 3px dotted #d7af00; padding-bottom:10px; opacity: 0.8"> <i class="fa fa-user-plus" aria-hidden="true"></i> Events/News Update</h4>
                                    </div>
                                    <form method="POST" action="" enctype="multipart/form-data" id="contactForm" >
                                        <?php
                                            if (isset($_POST['submit'])) {
                                                $title=mysqli_real_escape_string($conn, htmlentities($_POST['title']));
                                                $date_posted=mysqli_real_escape_string($conn, htmlentities($_POST['date_posted']));
                                                $category=mysqli_real_escape_string($conn, htmlentities($_POST['category']));
                                                $content=mysqli_real_escape_string($conn, htmlentities($_POST['content']));

                                                $img_name = $_FILES['image']['name'];
                                                $img_size = $_FILES['image']['size'];
                                                $img_type = $_FILES['image']['type'];
                                                $img_tmp = $_FILES['image']['tmp_name'];
                                                // $img = '';
                                                if ($img_name != '') {
                                                
                                                    $path = "../uploads/images/".date('Y')."_".date('m');
                                                    if (!file_exists($path)) {
                                                        mkdir($path);
                                                    }
                                                    //extensions
                                                    $valid_extensions = array('png','jpg','jpeg', 'gif');
                                                    // upload directory
                                                    $upload_dir = '../uploads/images/'.date('Y').'_'.date('m').'/'; 
                                                    // get image extension
                                                    $img_ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
                                                    if(!empty($img_ext)){

                                                        if (!(in_array($img_ext, $valid_extensions))) {
                                                            $error = 'Invalid File Format';
                                                        }else{
                                                            if ($img_size > 2097152) {
                                                                $error = 'File too large';
                                                            }else{
                                                                //rename image b4 upload
                                                                $img = str_replace(' ', '_', $title).rand(10,1000).".".$img_ext;
                                                                //
                                                            }
                                                        }
                                                    }
                                                }else{
                                                    $img = '';
                                                }
                                                // var_dump($img);
                                                if ($title != "" && $date_posted != "" && $content != "") {
                                                    if ($img != '') {
                                                        move_uploaded_file($img_tmp, $upload_dir.$img);
                                                    }
                                                    $result = postNews($img, $title, $category, $date_posted, $content);
                                                    if ($result["feedback"] == 1) {
                                                        echo $result['message'];
                                                    }else if ($result["feedback"] == 0) {
                                                        echo $result['message'];
                                                    }
                                                }else{
                                                    echo "<div class='error'> All fields are required</div>";

                                                }
                                            }
                                        ?>
                                       <div class="form-group">
                                           <label class="col-form-label" for="image">Image</label>
                                           <input type="file" class="form-control" name="image" id="image" placeholder="Please select">
                                       </div>
                                       <div class="form-group">
                                           <label class="col-form-label" for="title">Title</label>
                                           <input type="text" class="form-control" id="title" name="title" placeholder="Please enter the title">
                                       </div>
                                       <div class="form-group">
                                           <label class="col-form-label" for="title">Category</label>
                                           <input type="text" class="form-control" id="category" name="category" placeholder="Please enter news category">
                                       </div>
                                       <div class="form-group">
                                           <label class="col-form-label" for="date_posted"> Date</label>
                                           <input type="text" class="form-control" id="date_posted" name="date_posted" value="<?=date('Y/m/d');?>" placeholder="Please Enter date">
                                       </div>
                                       <div class="form-group">
                                           <label for="content"> Content</label>
                                           <textarea class="form-control" id="content" name="content" rows="4" placeholder="Event/news in full"></textarea>
                                       </div>
                                       <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-paper-plane" aria-hidden="true"></i> Post</button>
                                    </form> 
                                </div>
                                <!-- NEWS start -->
                                                    <div class="box" style="width: 90%; margin: 0 auto; background: #f5f5f5; box-sizing: border-box; padding: 10px 0px;">
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
                                                              // var_dump($details);
                                                              foreach ($details as $key) {
                                                                $url = $key['date_posted'];
                                                                if ($key['image'] != '') {
                                                                    $img = $key['image'];
                                                                    $file = explode('-', $url);
                                                                    $folder = $file[0].'_'.$file[1].'/';
                                                                    $thumbnail_path =  "../uploads/images/".$folder."/".$img;
                                                                }else{
                                                                    $img = 'no_image3.png';
                                                                    $folder = '';
                                                                    $thumbnail_path =  "../uploads/images/".$img;
                                                                }
                                                                 $id = encrypt_decrypt('encrypt', $key['event_id']);
                                                                echo "<div class='row'  id = 'article'>
                                                                        <div class='col-sm-4' style=''>
                                                                          <img src=".$thumbnail_path." width='100%' height='200px' style='margin: 0 auto;'>
                                                                        </div>
                                                                        <div class='col-sm-8'
                                                                            <li id='blink'>
                                                                            <a href='#' style='font-size:18px;'>".$key['title']."</a> 
                                                                            <br>
                                                                            <p class='lead' style='font-size: 14px; font-style: italic;'>Category: ".$key['category']."</p>
                                                                            <p class='lead' style='font-size: 14px; font-style: italic;'>Date: ".$key['date_posted']."</p>
                                                                          </li>
                                                                          <a href='delNews.php?id=".$key['event_id']."&d=".$key['date_posted']."' class='btn-danger' style='padding:10px; border-radius:5px;'>Delete</a>
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
                                                                echo '<a href="events.php?n=' . $prev . '" class="page" style = "margin-right:4px;"> Prev </a> ';
                                                              }
                                                              // display the links to the pages
                                                              for ($r=1;$r<=$number_of_pages;$r++) {
                                                                $current = ($r == $news? 'class="current"' : 'class="page"');
                                                                echo '<a href="events.php?n=' . $r . '" '. $current .' >' . $r . '</a> ';
                                                              }
                                                              if ($next < $number_of_pages) {
                                                                 echo '<a href="events.php?n=' . $next . '" class="page" > Next </a> ';
                                                              }
                                                            }
                                                      ?>
                                                        </ul>
                                                        <br>
                                                    </div>
                                <!-- NEWS end -->
                            </div>
                            <div class="col-sm-1">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <?php include 'includes/dashboard_footer.php'?>
        </div>
        <!-- end of inner container -->
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../assets/jquery-3.3.1.js"> </script>
    <script src="../assets/popper.js"> </script>
    <script type="text/javascript" src="../js/bootstrap.js"></script>
    <!-- <script type="text/javascript" src="../js/script.js"></script> -->
  </body>
</html>