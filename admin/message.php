<!doctype html>
<html lang="en">
<?php 
    include 'includes/admin_header.php';

    require ("includes/dbCon.php"); 
    // include 'includes/functions.php';
    error_reporting(0);

    session_start();
    if (!isset($_SESSION["admin"]) || !isset($_SESSION["fullname"])) {
        header("location: index.php");
    }
    include 'includes/menu.php';
?>
                        <div class="col-sm-9 contents-justify-center">
                            <div id="formDiv" style="background: #eee8aa; margin: 0px 15px; opacity: 0.8">
                                <h4 class="text-center" style="padding: 10px; font-weight: bolder; border-bottom: 3px dotted #d7af00;">COMPOSE MAIL</h4> 
                                <form method="POST" action="" id="contactForm">
                                    <div class="message">
                                    <?php 
                                        if (isset($_GET['name'])) {
                                            $sName = "CEO KBmp3.com (".$_GET['name'].")";
                                            $sEmail = "CEO@KBmp3.com";
                                            $to = $_GET['id'];
                                        }
                                        // funtion to handle mail sending
                                        function sendEmail($senderName, $senderEmail, $senderMessage){
                                            
                                            if ($senderName!='' && $senderEmail!='' && $senderMessage!='') {
                                                $subject="Submitted via KBmp3.com";
                                                $body="You have recieved a new message from ".$senderName." with email address ".$senderEmail." here is the message: ".$senderMessage;
                                                $headers="From:KBmp3.com \r\n";
                                                $headers .="Reply-To: No Reply \r\n";
                                                $message=wordwrap($body);

                                                $sent = mail($to, $subject, $message, $headers);
                                                if ($sent) {
                                                    echo "<p class='lead' style='color:green; margin-left:10px;font-weight:bolder;'>The email has been Sent successfully!</p>";
                                                }else{
                                                    echo "<p class='lead' style='color:red; margin-left:10px; font-weight:bolder;'>Error!!! Please try again later</p>";
                                                }
                                            }else{
                                                echo "<p class='lead' style='color:red; margin-left:10px; font-weight:bolder;'>All fields are required! </p>";
                                            }
                                        }
                                        //Handling contact form
                                        if (isset($_POST['submit'])) {
                                            $senderName=htmlentities($_POST['name']);
                                            $senderEmail=htmlentities($_POST['email']);
                                            $senderMessage=htmlentities($_POST['comment']);

                                            sendEmail($senderName, $senderEmail, $senderMessage);

                                            
                                        }
                                    ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label" for="name"> Your Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="<?=$sName?>" placeholder="Please Enter Your Name">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label" for="email"> Your Email</label>
                                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="<?=$sEmail?>" placeholder="Please Enter Your Email Address"><small id="emailHelp" class="form-text text-muted">I'll never share your email with anyone else.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="comment"> Comment</label>
                                        <textarea class="form-control" id="comment" name="comment" value="" rows="3"></textarea>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send</button>
                                </form>
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