<!doctype html>
<html lang="en">
	<?php 
		include 'includes/admin_header.php';

        require ("includes/dbCon.php"); 

		session_start();
		if (!isset($_SESSION["admin"]) || !isset($_SESSION["fullname"])) {
			header("location: index.php");
		}
        include 'includes/menu.php';
	?>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-sm-2">
                                </div>
		    				    <div class="col-sm-8" style="height: 450px; margin: 10px 0px;">
    				      			<div class="starts">
    				      				<h1 class="h3 text-center" id="welcome_text"><i class="fa fa-smile" aria-hidden="true"></i> WELCOME <?=$_SESSION['admin'];?></h1>
    				      				<div class='info_stats'>
    				      						<div class="table-responsive info_stats_content">
    				      						<div class='title'>Info. & Stats</div>
    				      							<?php
    				      								if (isset($_SESSION["fullname"])){ 
    				      									$fullname = $_SESSION["fullname"];
    				      									$username = $_SESSION["admin"];
    				      									$lastLogin = wordwrap($_SESSION["last_login"]);
    				      									// $num_contact = $_SESSION["number_of_contact"];
    				      									$block = "<table class = 'table' ><tbody> <tr><td> Full name: </td> <td>".$fullname." </td> </tr> <tr> <td>Username: </td> <td> ".$username." </td> </tr> <tr> <td>Last Login: </td> <td>".$lastLogin." </td> </tr> </tbody> </table> ";
    				      									echo $block;
    				      								} 
    				      								//echo "<a href = 'admin.php'> Want to register new admin? </a>";
    				      							?>
    				      						</div>
    				      				</div>	
    				      			</div>
    				      		</div>
    				      		<div class="col-sm-2">
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