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
                                <div id="addFormWrapper" style="margin: 30px auto 40px auto; ">
                                    <div class="form-title-row">
                                        <h4 style="color: #d7af00; border-bottom: 3px dotted #d7af00; padding-bottom:10px; opacity: 0.8"> <i class="fa fa-user-plus" aria-hidden="true"></i> Change Password</h4>
                                    </div>
                                    <form method="POST" action="" id="contactForm" style="margin-bottom:30px; width: 80%; ">
                                        <?php
                                            if (isset($_POST['submit'])) {
                                                $username= $_SESSION['admin'];
                                                $new_password1=htmlentities($_POST['new_password1']);
                                                $new_password2=htmlentities($_POST['new_password2']);
                                                if ($username != "" && $new_password1 != "" && $new_password2 != "") {
                                                    $result = changePassword($new_password1, $new_password2, $username);
                                                    // tester($result);
                                                    if ($result) {
                                                        if ($result["feedback"] == 1) {
                                                            echo $result['message'];
                                                        }else if ($result["feedback"] == 0) {
                                                            echo $result['message'];
                                                        }
                                                    }
                                                }else{
                                                    echo "<div class='error'> All fields are required</div>";

                                                }
                                            }
                                        ?>
                                       <div class="form-group">
                                           <label class="col-form-label" for="date_posted"> New Password</label>
                                           <input type="password" class="form-control" id="new_password1" name="new_password1" placeholder="New password">
                                       </div>
                                       <div class="form-group">
                                           <label for="content"> Confirm New Password</label>
                                           <input type="password" class="form-control" id="new_password2" name="new_password2" placeholder="Confirm New password">
                                       </div>
                                       <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-paper-plane" aria-hidden="true"></i> Change</button>
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