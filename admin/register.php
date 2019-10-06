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
                                                <h4 style="color: #d7af00; border-bottom: 3px dotted #d7af00;padding-bottom: 9px;"> <i class="fa fa-user-plus" aria-hidden="true"></i> Register</h4>
                                            </div>
                                            <?php 
                                                if (isset($_POST["submit"])) {
                                                    $first_name = mysqli_real_escape_string($conn, htmlentities(strtoupper($_POST["first_name"])));
                                                    $last_name = mysqli_real_escape_string($conn, htmlentities(strtoupper($_POST["last_name"])));
                                                    $nickname = mysqli_real_escape_string($conn, htmlentities(strtoupper($_POST["nickname"])));
                                                    $gender = mysqli_real_escape_string($conn, htmlentities(strtoupper($_POST["gender"])));
                                                    $number = mysqli_real_escape_string($conn, htmlentities(strtoupper($_POST["number"])));
                                                    $email_address = mysqli_real_escape_string($conn, htmlentities(strtolower($_POST["email_address"])));
                                                    $username = mysqli_real_escape_string($conn, htmlentities(strtoupper(trim($_POST["username"]))));
                                                    $password = mysqli_real_escape_string($conn, htmlentities($_POST["password"]));
                                                    $date_joined = date('Y/m/d');

                                                    // deal with passport
                                                    $errMSG = "";
                                                    $userpic = "";
                                                    if ($_FILES) {
                                                        // var_dump($_FILES);
                                                        $imgFile = $_FILES['passport']['name'];
                                                        $tmp_dir = $_FILES['passport']['tmp_name'];
                                                        $imgSize = $_FILES['passport']['size'];
                                                        
                                                        if ($imgFile != "") {
                                                            $upload_dir = '../uploads/passport/'; // upload directory
                                                            
                                                            $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
                                                            
                                                            // valid image extensions
                                                            $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
                                                            
                                                            // rename uploading image
                                                            $imgF = explode('.', $imgFile)[0];
                                                            $userpic = $imgF."-".rand(10,1000).".".$imgExt;
                                                           
                                                            if(empty($imgExt)){
                                                                $userpic = '';
                                                            }
                                                                
                                                            // allow valid image file formats
                                                            
                                                            if(in_array($imgExt, $valid_extensions)){           
                                                                // Check file size '5MB'
                                                                if($imgSize > 5000000){
                                                                    $errMSG = "<div class='error' >Sorry, your file is too large.</div>";
                                                                }
                                                            }else{
                                                                $errMSG = "<div classs='error'> Sorry, only JPG, JPEG, PNG & GIF files are allowed.</div>";        
                                                            }
                                                        }
                                                    }
                                                    // end dealing with passport
                                                    if ($errMSG == "") {
                                                        
                                                        $result = register($userpic, $first_name, $last_name, $nickname, $gender, $number, $email_address, $username, $password, $date_joined);
                                                        if (isset($result['user'])) {
                                                            if($result['user'] == 1){
                                                                $firstName = $_POST["first_name"];
                                                                $lastName = $_POST["last_name"];
                                                                $nick = $_POST["nickname"];
                                                                $gend = $_POST["gender"];
                                                                $no = $_POST["number"];
                                                                $email = $_POST["email_address"];
                                                                $user = $_POST["username"];
                                                                $pass = $_POST["password"];
                                                                // echo "<script> if(document.getElementById){setFocus('username'); }</script> ";
                                                                echo $result['alert'];
                                                            }
                                                        }
                                                        if (isset($result['feedback'])) {
                                                            if ($result["feedback"] == 1) {
                                                                    move_uploaded_file($tmp_dir, $upload_dir.$userpic);
                                                                    echo $result['message'];
                                                                    $firstName = "";
                                                                    $lastName = "";
                                                                    $nick = "";
                                                                    $gend = "";
                                                                    $no = "";
                                                                    $email = "";            
                                                                    $user = "";
                                                                    $pass = ""; 
                                                            }else if ($result["feedback"] == 0) {
                                                                    echo $result['message'];
                                                            }
                                                        }
                                                    }else{
                                                        echo $errMSG;
                                                    }
                                                }
                                            ?>
                                            <div class="form-group">
                                                <label for="passport">Select passport</label>
                                                <input type="file" name="passport" class="form-control" id="passport">
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="first_name">First name</label>
                                                    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Your first name" value="<?=$firstName;?>">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="last_name">Last name</label>
                                                    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Your last name" value="<?=$lastName;?>">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="nickname">Nickname</label>
                                                    <input type="text" class="form-control" name="nickname" id="nickname" placeholder="Your Nickname" value="<?=$nick;?>">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="gender">Gender</label>
                                                    <select id="gender" name="gender" value="<?=$gend;?>" class="form-control">
                                                        <?php
                                                            if ($gend == "Male") {
                                                                echo "<option >Choose...</option>
                                                                        <option value='Male' selected>Male</option>
                                                                        <option value='Female'>Female</option>";
                                                            }elseif($gend == "Female"){
                                                                echo "<option >Choose...</option>
                                                                        <option value='Male'>Male</option>
                                                                        <option value='Female' selected>Female</option>";

                                                            }else{
                                                                echo "<option selected>Choose...</option>
                                                                        <option value='Male'>Male</option>
                                                                        <option value='Female'>Female</option>";
                                                            }
                                                        ?>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="number">Number</label>
                                                    <input type="number" class="form-control" name="number" id="number" placeholder="Your phone number" value="<?=$no;?>">
                                                </div>
                                                <div class="form-group col-md-8">
                                                    <label for="email_address">Email address</label>
                                                    <input type="email" class="form-control" name="email_address" id="email_address" placeholder="Your email address" value="<?=$email;?>">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="username">Username</label>
                                                    <input type="text" class="form-control" name="username" id="username" placeholder="Your username" value="<?=$user;?>">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="password">Password</label>
                                                    <input type="password" class="form-control" name="password" id="password" placeholder="Your password" value="<?=$pass;?>">
                                                </div>
                                            </div>
                                            <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-paper-plane" aria-hidden="true"></i> Submit</button>
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