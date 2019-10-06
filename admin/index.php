<!doctype html>
<html lang="en">
	<?php 
        
        session_start();
        include 'includes/admin_header.php'; 
        require ("includes/dbCon.php");
        require "includes/functions.php";

    ?>
    <body>
    	<div class="container-fluid" id="main_container">
    		<!-- inner container -->
    		<div class="container" id="inner_central_container">
    			<div class="container" id="wrapper">
    				<div class="heading">
    					<h1 class="h4 text-center" id="heading"><i class="fa fa-home" aria-hidden="true"></i> ADMINISTRATOR</h1>
    				</div>
    				<div class="row">
    				    
                        <div class="col-sm-3">
                            
                        </div>

                        <div class="col-sm-6 form_div">
                            <form method="POST" action="" id="form">
                                <h3 class="h3 text-center" id="form_heading"><i class="fa fa-key" aria-hidden="true"></i> LOGIN</h3>
                                <?php 
                                    if (isset($_POST["submit"])) {
                                        $username = mysqli_real_escape_string($conn, htmlentities($_POST["username"]));
                                        $password = mysqli_real_escape_string($conn, htmlentities($_POST["password"]));

                                        $result = login_admin($username, $password);
                                        if (isset($result['feedback'])) {   
                                            if ($result["feedback"] == 1) {
                                                $details = $result["details"];

                                                $loginTime =  date("l")."&nbsp".date("Y/m/d")."&nbsp".date("h:i:sa");
                                                // start session for a period of user activity
                                                $_SESSION["fullname"] = $details["first_name"] ." ". $details["last_name"];
                                                $_SESSION["admin"] = $details["username"];
                                                $_SESSION["last_login"] = $details["last_login"];
                                                // end
                                                //update login time
                                                updateLoginTimeForAdmin($loginTime);
                                                header("location: home.php");
                                            }else{
                                                echo $result["message"];
                                            }
                                        }
                                    }
                                ?>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text"  name="username" class="form-control" id="username" placeholder="Input your username">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" aria-describedby="password_help">
                                    <small class="form-text text-muted" id="password_help" >Don't share your login credentials with anyone</small>
                                </div>
                                <button type="submit" name="submit" class="btn btn-orange"><i class="fa fa-sign-in-alt" aria-hidden="true"></i> Sign in</button>
                            </form>
                        </div>

                        <div class="col-sm-3">

    				    </div>

    				</div>

    			</div>
                <!-- end of inner container -->
                <?php 
                    include 'includes/footer.php'
                ?>
            </div>
		</div>

	    <!-- Optional JavaScript -->
	    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    	<script src="../assets/jquery-3.3.1.js"> </script>
		<script src="../assets/popper.js"> </script>
		<script type="text/javascript" src="../js/bootstrap.js"></script>
		<!-- <script type="text/javascript" src="../js/script.js"></script> -->
  </body>
</html>