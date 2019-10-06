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
                                                <h4 style="color: #d7af00; border-bottom: 3px dotted #d7af00;padding-bottom: 9px;"> <i class="fa fa-user-plus" aria-hidden="true"></i> Update Profile</h4>
                                            </div>
                                            <?php
												if (isset($_SESSION['admin'])) {
													if (isset($_GET['id'])) {
														$username = $_GET['id'];
														$table = 'user_tbl';
														$res = getUser($username, $table);
														if (isset($res['details'])) {
															$details = $res['details'];
															$fName = $details['first_name'];
															$lName = $details['last_name'];
															$nName = $details['nickname'];
															$sex = $details['gender'];
															$num = $details['number'];
															$email = $details['email_address'];
															$pWord = $details['password'];
														}
													}
												}
                                                if (isset($_POST["submit"])) {
                                                    $first_name = mysqli_real_escape_string($conn, htmlentities(strtoupper($_POST["first_name"])));
                                                    $last_name = mysqli_real_escape_string($conn, htmlentities(strtoupper($_POST["last_name"])));
                                                    $nickname = mysqli_real_escape_string($conn, htmlentities(strtoupper($_POST["nickname"])));
                                                    $gender = mysqli_real_escape_string($conn, htmlentities(strtoupper($_POST["gender"])));
                                                    $number = mysqli_real_escape_string($conn, htmlentities(strtoupper($_POST["number"])));
                                                    $email_address = mysqli_real_escape_string($conn, htmlentities(strtolower($_POST["email_address"])));
                                                    $password = mysqli_real_escape_string($conn, htmlentities($_POST["password"]));
                                                    $password = md5($password);
                                    				$result = update($username, $first_name, $last_name, $nickname, $gender, $number, $email_address, $password, $table);
                                    				// tester($result);
                                	    			if (isset($result['feedback'])) {
                                	    				if ($result["feedback"] == 1) {
                                	    						echo $result['message'];
                                	    				}else if ($result["feedback"] == 0) {
                                	    						echo $result['message'];
                                	    				}
                                	    			}
                                    			}
                                            ?>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="first_name">First name</label>
                                                    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Your first name" value="<?=$fName;?>">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="last_name">Last name</label>
                                                    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Your last name" value="<?=$lName;?>">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="nickname">Nickname</label>
                                                    <input type="text" class="form-control" name="nickname" id="nickname" placeholder="Your Nickname" value="<?=$nName;?>">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="gender">Gender</label>
                                                    <select id="gender" name="gender" value="<?=$sex;?>" class="form-control">
                                                        <?php
                                                            if ($sex == "MALE") {
                                                                echo "<option >Choose...</option>
                                                                        <option value='Male' selected>Male</option>
                                                                        <option value='Female'>Female</option>";
                                                            }elseif($sex == "FEMALE"){
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
                                                    <input type="number" class="form-control" name="number" id="number" placeholder="Your phone number" value="<?=$num;?>">
                                                </div>
                                                <div class="form-group col-md-8">
                                                    <label for="email_address">Email address</label>
                                                    <input type="email" class="form-control" name="email_address" id="email_address" placeholder="Your email address" value="<?=$email;?>">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="password">Password</label>
                                                    <input type="password" class="form-control" name="password" id="password" placeholder="Your password" value="<?=$pWord;?>" aria-describedby="password_help">
                                                    <small class="form-text " id="password_help" style="color: red; font-weight: bold;" >You must UPDATE the password due to encryption</small>
                                                </div>
                                            </div>
                                            <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-paper-plane" aria-hidden="true"></i> Update</button>
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