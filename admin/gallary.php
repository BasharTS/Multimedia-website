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
                                <h4 class="text-center" style="padding: 10px; font-weight: bolder;">Image Gallary</h4>
                                <form method="POST" action="" enctype="multipart/form-data" id="contactForm" >
                                    <?php
                                        if (isset($_POST['submit'])) {
                                            $description = mysqli_real_escape_string($conn,htmlentities($_POST['description']));
                                            if ($description == '') {
                                                $description = "No caption";
                                            }
                                            $path = '../uploads/gallary/';
                                            if (!file_exists($path)) {
                                                mkdir($path);
                                            }
                                            // var_dump($_FILES['images']);
                                            if (sizeof($_FILES['images']['name']) > 0) {
                                                foreach ($_FILES['images']['name'] as $key => $name){
                                                
                                                $newFilename = time() . "_" . $name;
                                                move_uploaded_file($_FILES['images']['tmp_name'][$key], $path.$newFilename);
                                                
                                                mysqli_query($conn,"insert into gallary (`file`, `description`) values ('$newFilename', '$description')");
                                                }
                                                header('location:gallary.php');
                                            }else{
                                                echo "<div class = 'error'>Please select atleast 1 image!";
                                            }
                                            
                                        }
                                        
                                    ?>
                                   <div class="form-group">
                                       <label class="col-form-label" for="images">Upload images</label>
                                       <input type="file" class="form-control" name="images[]" id="images" placeholder="Please select" multiple>
                                   </div>
                                   <div class="form-group">
                                       <label for="description"> Content Description</label>
                                       <textarea class="form-control" id="description" name="description" rows="4" placeholder="Image description"></textarea>
                                   </div>
                                   <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-paper-plane" aria-hidden="true"></i> Add to gallary</button>
                                </form>  
                                <h4 style="padding: 20px; margin-top: 20px; "><i class="fa fa-image" aria-hidden="true"></i> Gallary</h4> 
                                <div class="row" style="margin: 0 auto;">
                                <?php
                                    include 'includes/dbCon.php';
                                    $query=mysqli_query($conn,"select * from gallary order by `id` asc");
                                    while($row=mysqli_fetch_array($query)){
                                        ?>
                                        <div class="col-sm-4" style=" box-sizing: border-box;">
                                            <div style="width: 100%; text-align: center; background: #f5f5f5; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                <figure>
                                                    <img src="../uploads/gallary/<?=$row['file']; ?>" height="250" width="100%" style= "border: 1px solid #bbb; border-radius: 5px; box-sizing: border-box; padding: 8px;">
                                                    <figcaption><?php echo strtoupper($row['description']);?></figcaption>
                                                    <a href="delete_image.php?id=<?=$row['id']?>&img=<?=$row['file']?>" style='text-decoration: none; padding: 15px;'><i class="fa fa-trash fa-fw" aria-hidden="true"></i> Delete</a>
                                                </figure>
                                            </div>
                                        </div>
                                        
                                        <?php
                                    }
                                
                                ?>   
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