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
                        <div class="col-sm-9 contents-justify-center">
                            <div id="" style="background: #eee8aa; margin: 0px 15px;">
                                <h4 class="text-center" style="padding: 10px; font-weight: bolder;">All Artistes</h4>
                                <?php 
                                    $result = viewUsers();
                                    $sn = 0;
                                    if (isset($result['feedback'])) {
                                        if ($result['feedback'] == 1) {
                                            $block = "<table class='table table-striped table-sm table-responsive' style='width:100%; margin: 0 auto;'>
                                                    <thead class='thead-light'>
                                                        <tr>
                                                          <th scope='col'></th>
                                                          <th scope='col'>Full Name</th>
                                                          <th scope='col'>Username</th>
                                                          <th scope='col'>Email</th>
                                                          <th scope='col'>Suspension</th>
                                                          <th scope='col'>Last Login</th>
                                                          <th scope='col'>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class=''>";
                                            foreach($result['details'] as $row){
                                                $pic = $row['passport'];
                                                $fullname = $row['first_name']." ".$row['last_name'];
                                                if ($pic == ""){
                                                    $img = "<img src='../uploads/no-image.png' class='passport' >";
                                                }else{
                                                    $img = "<img src='../uploads/passport/".$pic."' class='passport' style= 'vertical-align: baseline;' >";
                                                }
                                                $sn++;
                                                $block .=  "<tr>
                                                    <td id='td'>".$img."</td> 
                                                    <td id='td'>".$fullname." </td> 
                                                    <td id='td'>".$row['username']."</td> 
                                                    <td id='td'>".$row['email_address']."</td> 
                                                    <td id='td'>".$row['suspension']."</td> 
                                                    <td id='td'>".$row['last_login']."</td> 
                                                    <td id='td'> 
                                                        <a href = 'editProfile.php?id=".$row['username']."' title='Edit account'> <i class='fa fa-edit fa-fw' aria-hidden='true'></i></a>
                                                        <a href = 'deleteAccount.php?id=".$row['username']."&pic=".$row['passport']."' title='Delete account' onclick = 'return confirm(\"Are you sure you want to delete this account permanently?\")'> <i class='fa fa-trash fa-fw' aria-hidden='true'></i></a>
                                                        <a href = 'suspend.php?id=".$row['username']."&suspend=".$row['suspension']."' title='Account suspension' onclick = 'return confirm(\"Are you sure you want to suspend/reinstate this account? NOTE!!! The user would not be able to log in when suspended\")'> <i class='fa fa-ban' aria-hidden='true'></i></a>
                                                        <a href = 'message.php?id=".$row['email_address']."&name=".$fullname."' title='Message'> <i class='fa fa-envelope fa-fw' aria-hidden='true'></i></a>
                                                    </td> 
                                                    </tr>";
                                            }
                                            $block .= "</tbody> </table>";
                                            echo $block;
                                        }else{
                                            echo $result['message'];
                                        }
                                    }
                                    
                                ?>  
                            </div>
                            <!-- <div class="row">
                                <div class="col-sm-1">
                                </div>
                                <div class="col-sm-10 ">
                                    
                                </div>
                                <div class="col-sm-1">
                                </div>
                            </div> -->
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