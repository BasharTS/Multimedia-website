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
        $firstName = "";
        $lastName = "";
        $nick = "";
        $gend = "";
        $no = "";
        $email = "";            
        $user = "";
        $pass = ""; 
    ?>
        <div class="col-sm-9">
            <div class="row">
                <div class="col-sm-1">
                </div>
                <div class="col-sm-10 ">
                    <div id="addFormWrapper">
                        <form method="POST" action="" enctype="multipart/form-data">
                            <div class="form-title-row">
                                <h4 style="color: #d7af00; border-bottom: 3px dotted #d7af00;padding-bottom: 9px;"> <i class="fa fa-upload" aria-hidden="true"></i> Upload Track</h4>
                                <p class="lead" style="text-align: left;">Note! Fields marked with <span style="color: red; font-weight: bolder;">* </span> are required fields</p>
                            </div>
                            <?php 
                                if (isset($_POST["submit"])) {
                                    $song_title = mysqli_real_escape_string($conn, htmlentities(strtoupper($_POST["song_title"])));
                                    $artiste_name = mysqli_real_escape_string($conn, htmlentities(strtoupper($_POST["artiste_name"])));
                                    $albumb = mysqli_real_escape_string($conn, htmlentities(strtoupper($_POST["albumb"])));
                                    $date_released = mysqli_real_escape_string($conn, htmlentities($_POST["date_released"]));
                                    $privacy = mysqli_real_escape_string($conn, htmlentities($_POST["privacy"]));
                                    $description = mysqli_real_escape_string($conn, htmlentities($_POST["description"]));
                                    $type = mysqli_real_escape_string($conn, htmlentities($_POST["type"]));

                                    // deal with passport
                                    $errMSG = "";
                                    $audio_file_name = "";
                                    $img_file_name = "";
                                    $audio_file_pointer = "";
                                    $img_file_pointer = "";
                                    if (count($_FILES['track']['name'])>1) {
                                        $audioFile = $_FILES['track']['name'][0];
                                        $imgFile = $_FILES['track']['name'][1];
                                        $audio_tmp_dir = $_FILES['track']['tmp_name'][0];
                                        $img_tmp_dir = $_FILES['track']['tmp_name'][1];
                                        $audio_size = $_FILES['track']['size'][0];
                                        $img_size = $_FILES['track']['size'][1];
                                        $audio_file_type = $_FILES['track']['type'][0];
                                        $img_file_type = $_FILES['track']['type'][1];

                                        if ($audioFile != "" && $imgFile != "" ) {
                                            $path = "../uploads/media/".date('Y')."_".date('m');
                                            if (!file_exists($path)) {
                                                mkdir($path);
                                            }
                                            // upload directory
                                            $upload_dir = '../uploads/media/'.date('Y').'_'.date('m').'/'; 
                                            
                                            // get image extension
                                            $audio_ext = strtolower(pathinfo($audioFile, PATHINFO_EXTENSION)); 
                                            $img_ext = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); 

                                            // valid media extensions
                                            $audio_valid_extensions = array('mp3', 'aac', 'wav', 'm4a', 'wma', 'mp4', 'webm', 'avi', 'mkv', 'flv', '3gp');
                                            $img_valid_extensions = array('jpg', 'jpeg', 'png', );
                                            
                                            // rename uploading files
                                            $audio_file_name = $song_title."_by_".$artiste_name."_(KBmp3.com).".$audio_ext;
                                            $img_file_name = str_replace(' ', '_', $song_title)."_by_".str_replace(' ', '_', $artiste_name)."_thumb.".$img_ext;
                                            
                                            // For invalid extention
                                            if( empty($audio_ext) or empty($img_ext) ) {
                                                $errMSG = "<div class='error' >Invalid file format. Please make sure it is mp3, mp4, aac, jpeg, png or other porpular file format</div>";
                                            }
                                                
                                            // allow valid image file formats
                                            if(in_array($audio_ext, $audio_valid_extensions) && in_array($img_ext, $img_valid_extensions)){           
                                                // Check  audio file size 'if <15MB'
                                                if($audio_size > 20000000){
                                                    $errMSG = "<div class='error' >Sorry, the audio file is too large.</div>";
                                                    $audio_file_pointer = "../uploads/media/".date('Y/m')."/".$audio_file_name;
                                                    if(file_exists($audio_file_pointer)){
                                                        echo "<div class='error' > ".$audio_file_name." already exist.</div>";
                                                    }
                                                }
                                                // Check  audio file size 'if <2MB'
                                                if($img_size > 2097152){
                                                    $errMSG = "<div class='error' >Sorry, the image file is too large.</div>";
                                                    $img_file_pointer = "../uploads/media/".date('Y/m')."/".$img_file_name;
                                                    if(file_exists($img_file_pointer)){
                                                        echo "<div class='error' > ".$img_file_name." already exist.</div>";
                                                    }
                                                }
                                            }else{
                                                $errMSG = "<div classs='error'> Sorry, only mp3, aac, wav, m4a, mp4, avi, 3gp, png, jpeg, jpg & wma  files are allowed.</div>";        
                                            }
                                        }
                                    }
                                    $audio_actual_size = formatBytes($audio_size);
                                    $img_actual_size = formatBytes($img_size);
                                    // continue upload
                                    if ($errMSG == ""){
                                        $uploader = "CEO KBmp3.com";
                                        // $file_pointer = "../uploads/media/".$fileName;  && isset($mediaFile)
                                        if (!(file_exists($audio_file_pointer)) && !(file_exists($img_file_pointer))) {
                                            $result = upload($audio_file_name, $img_file_name, $song_title, $artiste_name, $albumb, $date_released, $privacy, $description, $audio_actual_size, $uploader,$type);
                                            if (isset($result['feedback'])) {
                                                if ($result["feedback"] == 1) {
                                                    $str1 = move_uploaded_file($audio_tmp_dir, $upload_dir.$audio_file_name);
                                                    $str2 = move_uploaded_file($img_tmp_dir, $upload_dir.$img_file_name);
                                                    if ($str1 && $str2) {
                                                        echo "<div class='success' > File uploaded successfully.</div>";
                                                    }
                                                }elseif ($result["feedback"] == 0) {
                                                        echo $result['message'];
                                                }
                                            }
                                        }else{
                                            $errMSG = "<div class='error' > File already exist.</div>";
                                        }
                                    }else{
                                        echo $errMSG;
                                    }
                                }
                            ?>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <span style='color:red; font-weight:bolder;'>* </span><label for="track" style="color: maroon; font-weight: bolder;">Please select Track </label>
                                                <input type="file" name="track[]" class="form-control" id="track" multiple>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <span style='color:red; font-weight:bolder;'>* </span><label for="image" style="color: maroon; font-weight: bolder;">Please select Image </label>
                                                <input type="file" name="track[]" class="form-control" id="image" multiple>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <span style='color:red; font-weight:bolder;'>* </span><label for="song_title">Song title</label>
                                                <input type="text" class="form-control" name="song_title" id="song_title" placeholder="Title of the song">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <span style='color:red; font-weight:bolder;'>* </span><label for="artiste_name">Artiste name</label>
                                                <input type="text" class="form-control" name="artiste_name" id="artiste_name" placeholder="Name of the artiste">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for=albumb">Albumb</label>
                                                <input type="text" class="form-control" name="albumb" id="albumb" placeholder="Albumb">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <span style='color:red; font-weight:bolder;'>* </span><label for="date_released">Date Released</label>
                                                 <input type="text" class="form-control" name="date_released" id="date_released" placeholder="Date of release in this format (yyyy/mm/dd)" value="<?=date('Y/m/d');?>">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6" >
                                                <span style='color:red; font-weight:bolder;'>* </span><label for="privacy">Privacy</label>
                                                <select id="privacy" name="privacy" class="form-control">
                                                    <option selected>Pls Choose...</option>
                                                    <option value='public'>Public</option>
                                                    <option value='private'>Private</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6" >
                                                <span style='color:red; font-weight:bolder;'>* </span><label for="type">Type</label>
                                                <select id="type" name="type" class="form-control">
                                                    <option selected>Pls Choose...</option>
                                                    <option value='Audio'>Audio</option>
                                                    <option value='Video'>Video</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Song Description</label>
                                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send</button>
                                    </form>
                                </div>
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