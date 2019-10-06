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
                            <div id="" style="background: #eee8aa; margin: 0px 10px;">
                                <h4 class="text-center" style="padding: 10px; font-weight: bolder;">All Tracks(12 recently added)</h4>
                                <?php 
                                    $result = viewTracks();
                                    $sn = 0;
                                    if (isset($result['feedback'])) {
                                        if ($result['feedback'] == 1) {
                                            $block = "<table class='table table-striped table-sm table-responsive' style='width:100%; margin: 0 auto;'>
                                                    <thead class='thead-dark'>
                                                        <tr>
                                                          <th scope='col' style='color:#222222;'> File type </th>
                                                          <th scope='col'>Track</th>
                                                          <th scope='col'>Size</th>
                                                          <th scope='col'>Date Released</th>
                                                          <th scope='col'>Uploader</th>
                                                          <th scope='col'>Downloads</th>
                                                          <th scope='col'>Trend</th>
                                                          <th scope='col'>Week Best</th>
                                                          <th scope='col'></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class=''>";
                                            foreach($result['details'] as $row){
                                                /*$pic = $row['passport'];
                                                $fullname = $row['first_name']." ".$row['last_name'];
                                                if ($pic == ""){
                                                    $img = "<img src='../uploads/noImage.jpeg' class='passport' >";
                                                }else{
                                                    $img = "<img src='../uploads/passport/".$pic."' class='passport' style= 'vertical-align: baseline;' >";
                                                }*/
                                                $type = "";

                                                if ($row['type'] == 'Audio') {
                                                    $type = 'Audio >';
                                                }else{
                                                    $type = 'Video >';
                                                }
                                                $date_released = explode('-', $row['date_released']);
                                                $folder = $date_released[0]."_".$date_released[1];
                                                $del = $folder."/".$row['file_name'];
                                                $img = "<img src='../uploads/noImage.jpeg' class='passport' >";
                                                $sn++;
                                                $block .=  "<tr>
                                                    <td id='td' style='color:blue; font-size:0.8em;'>".$type."</td> 
                                                    <td id='td'>".$row['song_title']."_by_".$row['artiste_name']."</td> 
                                                    <td id='td'>".$row['size']."</td> 
                                                    <td id='td'>".$row['date_released']."</td>
                                                    <td id='td'>".$row['uploader']."</td>
                                                    <td id='td'>".$row['download_count']."</td>
                                                    <td id='td'>".$row['trend']."</td>
                                                    <td id='td'>".$row['week_best']."</td>
                                                    <td id='td'> 
                                                            <a href = '../uploads/media/".$folder."/".$row['file_name']."' title='Download Song' download> <i class='fa fa-download' aria-hidden='true'></i></a>
                                                            <a href = 'deleteSong.php?id=".$row['song_id']."&file=".$del."' title='Delete Song' onclick = 'return confirm(\"Are you sure you want to delete this song permanently?\")'> <i class='fa fa-trash fa-fw' aria-hidden='true'></i></a>
                                                            <a href = 'trend.php?id=".$row['song_id']."&trend=".$row['trend']."' title='Mark Trending'> <i class='fa fa-thumbs-up' aria-hidden='true'></i></a>
                                                            <a href = 'weekbest.php?id=".$row['song_id']."&wb=".$row['week_best']."' title='Week Best'> <i class='fa fa-trophy' aria-hidden='true'></i></a>
                                                        </td> 
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