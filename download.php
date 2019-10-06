<?php 
	require "includes/functions.php";
	$songDetails = '';
 ?>
 <!doctype html>
 <html lang="en">
   <head>
     <title>Music and Entertainment</title>
     <!-- Add icon before title of the page -->
     <link rel="Shortcut icon" href="bg/kbmp3_3.png">
     <!-- Required meta tags -->
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
     <?php 
      $link = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] ;
          if (isset($_GET['s']) && isset($_GET['t'])) {
              $id = $_GET['s'];
              $title = urldecode($_GET['t']);
              $real_id = encrypt_decrypt('decrypt', $id);
              $song = getSingleSong($real_id, $title);
              if ($song['feedback'] == 1) {
                $song = $song['details'];
                $url = $song['date_released'];
                $file = explode('-', $url);
                $folder = $file[0].'_'.$file[1];
                if ($song['type']=='Video') {
                  $path = 'uploads/media/'.$folder.'/'.$song["file_name"];
                }else{
                  $path = 'uploads/media/'.$folder.'/'.$song["thumbnail"];
                }
                $art = $song['song_title']."-".$song['artiste_name'];
                $des = $song['description'];
               // Dealing with whatsapp
                  $block = '<meta property="og:title" content="'.$art.'" />
                            <meta property="og:description" content="'.$des.'" />
                            <meta property="og:url" content="'.$link.'" />
                            <meta property="og:image" content="'.$path.'" />';
               // end of whatsapp
              }
          }
          echo $block;
         ?>
      <!-- Remove 000webhost banner -->
        <style>img[alt="www.000webhost.com"]{display:none;}</style>
      <!-- end -->

     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
     <!-- My css -->
     <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
     <link rel="stylesheet" type="text/css" href="css/style.css">
     <!-- fontawesome -->
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
     <link rel="stylesheet" href="fontawesome/css/fontawesome-all.css">
   </head>
   <body>
     <div class="container-fluid" style="padding: 0px; margin: 0px;">
       <div class="top-bar" >
         <div class="container">
             <a href="privacy.php">Privacy Notice</a>
             <a href="promote.php">Promote Music</a>
         </div>
       </div>
       <!-- Central container -->
       <div class="slogan">
         <div class="container">
           <h1 class="display-4" style="font-weight: bold; text-align:left; padding-left: 30px; text-shadow: 3px 3px 7px gold;">KBmp3</h1>
           <p class="lead" style="text-shadow: 0 0 3px #FF0000;">After silence, that which comes nearest to expressing the inexpressible is MUSIC</p>
         </div>
       </div>
       <div class="container" id = "container-style">
         
         <!-- Navigation e3f2fd -->
         <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #eee8aa; box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2), 0 3px 10px 0 rgba(0, 0, 0, 0.19);">
           <!-- <a class="navbar-brand" href="index.php">KBmp3</a> -->
           <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
           </button>

           <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <ul class="navbar-nav mr-auto">
               <li class="nav-item active">
                 <a class="nav-link" href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Home <span class="sr-only">(current)</span></a>
               </li>
               <li class="nav-item">
                 <a class="nav-link" href="posts.php"><i class="fa fa-newspaper" aria-hidden="true"></i> News</a>
               </li>
               <li class="nav-item">
                 <a class="nav-link" href="tutorials.php"><i class="fa fa-tasks" aria-hidden="true"></i> Tutorials</a>
               </li>
               <li class="nav-item">
                 <a class="nav-link" href="audio.php"><i class="fa fa-file-audio" aria-hidden="true"></i> Audio</a>
               </li>
               <li class="nav-item">
                 <a class="nav-link" href="video.php"><i class="fa fa-file-video" aria-hidden="true"></i> Video</a>
               </li>
               <li class="nav-item">
                 <a class="nav-link" href="gallary.php"><i class="fa fa-file-image" aria-hidden="true"></i> Gallary</a>
               </li>
               <li class="nav-item">
                 <a class="nav-link" href="funnyPost.php"><i class="fa fa-smile" aria-hidden="true"></i> Funny Posts</a>
               </li>
               <!-- <li class="nav-item dropdown">
                 <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i> Account </a>
                 <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                   <a class="dropdown-item" href="register.php"><i class="fa fa-user-plus" aria-hidden="true"></i> Register</a>
                   <a class="dropdown-item" href="login.php"><i class="fa fa-lock" aria-hidden="true"></i> Login</a>
               </li> -->
               <!-- <li class="nav-item">
                 <a class="nav-link" href="About.php"><i class="fa fa-book" aria-hidden="true"></i> About</a>
               </li>
               <li class="nav-item">
                 <a class="nav-link" href="contact.php"><i class="fa fa-address-card" aria-hidden="true"></i> Contact</a> -->
             </ul>
             <form class="form-inline my-2 my-lg-0" method="post" action="">
               <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="valueToSearch" id="valueToSearch">
               <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit" id="submit"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
             </form>
           </div>
         </nav>
 <!-- ////////////////////////////////////////////////////////////////////////////////////////////// -->
 <div class="container">
 	<div class="row">
    <div class="col-sm-3" ></div>
 		<div class="col-sm-6" style="padding: 10px 25px; box-sizing: border-box;">
        <?php
          var_dump($block);
          echo $path;
        ?>
      		<?php 
      		
      			if (isset($_GET['s']) && isset($_GET['t'])) {
      				$songId = $_GET['s'];
      				$title = urldecode($_GET['t']);
              $real_id = encrypt_decrypt('decrypt', $songId);
              // var_dump($real_id);
      				$song = getSingleSong($real_id, $title);
      				if ($song['feedback'] == 1) {
      					$songDetails = $song['details'];
                $url = $songDetails['date_released'];
                $file = explode('-', $url);
                $folder = $file[0].'_'.$file[1];
      					echo "<div class='title'>
      						  	<h5 style='font-weight: bold; text-align:center; color:white;'>Download ".$songDetails['song_title']." By ".$songDetails['artiste_name']."</h5>
      						  </div>";
      					if ($songDetails['type']=="Video") {
      						$filePath = 'uploads/media/'.$folder.'/'.$songDetails["file_name"];
      						if (!file_exists($filePath)) {
      							echo "<div class='error'>Sorry! File does not exist</div>";
      						}else{
      							echo '<video width="100%" height="200px" controls>
                                <source src="uploads/media/'.$folder.'/'.$songDetails["file_name"] .'"type="video/mp4">
                                <source src="movie.ogg" type="video/ogg"> Your browser does not support the video tag.
                                </video>';
                                $id = $songDetails['song_id'];
      							$count = $songDetails['download_count'];
      							$fileName = $songDetails['file_name'];
		      					echo "<div style= 'text-align:center;'> 
		      							<p>".$songDetails['description']."</p>
		      							<p>".$songDetails['type']." Track: ".$songDetails['song_title']."</p>
		      							<p>Artiste: ".$songDetails['artiste_name']."</p>
		      							<p>Size: ".$songDetails['size']."</p>
		      							<p>Date Released: ".$songDetails['date_released']."</p>
		      							<p>Downloaded: ".$songDetails['download_count']." times</p>
		      							<a href ='uploads/media/".$folder."/".$fileName."' class='downloadButton' id = 'downloadButton' download > <i class='fa fa-download' aria-hidden='true'></i> Download </a> </div>";
		      				}
      						
      					}else{
                  $filePath = 'uploads/media/'.$folder.'/'.$songDetails["file_name"];
      						$imgPath = 'uploads/media/'.$folder.'/'.$songDetails["thumbnail"];
      						if (!file_exists($filePath)) {
      							echo "<div class='error'>Sorry! File does not exist</div>";
      						}else{
      							$id = $songDetails['song_id'];
      							$count = $songDetails['download_count'];
      							$fileName = $songDetails['file_name'];
		      					echo "
                        <img src=".$imgPath." alt='No photo' height='330' width='100%' style='margin:0 auto; border-radius:10px;'>
                        <div style= 'text-align:center;'><br> 
		      							<p>".$songDetails['description']."</p>
		      							<p>".$songDetails['type']." Track: ".$songDetails['song_title']."</p>
		      							<p>Artiste: ".$songDetails['artiste_name']."</p>
		      							<p>Size: ".$songDetails['size']."</p>
		      							<p>Date Released: ".$songDetails['date_released']."</p>
		      							<p>Downloaded: ".$songDetails['download_count']." times</p>
		      							<a href ='uploads/media/".$folder.'/'.$fileName."' class='downloadButton' id = 'downloadButton' download > <i class='fa fa-download' aria-hidden='true'></i> Download </a></div>";
		      				}
      					}
      				}else{
      					$block = "
      						<div class='title2'>
      						  <h5 style='font-weight: bold; text-align:center;'>Download... .</h5>
      						</div>" . $song['message'];
      					echo "$block";
      				}
      			}
      		 ?>
      		 <!-- <script type="text/javascript">
      		 	document.getElementById("downloadButton").addEventListener("click", function() {
					var click = 1;
					download($id, $count, $click); ?>
					console.log($click);
				});
      		 </script> -->
      		 <div class="shareGroup">
      		 	<!-- <ul> --> 
              <?php
                // echo $link;
              ?>
      		 		<p>Share on: 
	      		 		<iframe src="https://www.facebook.com/plugins/share_button.php?href=<?=$link;?>&layout=button&size=large&mobile_iframe=true&width=73&height=35&appId" width="73" height="35" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media" value="share"></iframe>
	      		 		
                <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-size="large" data-text="Hey! Please download and listen to my hot new track." data-url="<?=$link;?>" data-via="BtMedia" data-hashtags="Music" data-related="MtMedia" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

	      		 		<a href="whatsapp://send?text=<?=$link;?>" data-text="Hey! Download and listen to my new hot track" data-action="share/whatsapp/share" class="t"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>
	      		 	</p>
      		 	<!-- </ul> -->
      		 </div>
      		 <br>
      		 <?php 
      		 	if (isset($_GET['id']) && isset($_GET['title']) && $songDetails['type']=="Video") {
      		 		$songId = $_GET['id'];
      				$title = urldecode($_GET['title']);
      		 		echo '<a href="index.php" id="link">Homepage</a> >
 						       <a href="video.php" id="link">Video</a> >
 						       <a href="download.php?id='.$songId.'&title='.$folder.'/'.urlencode($title).'" id="link">'.$songDetails['song_title']." By ".$songDetails['artiste_name'].'</a>';
      			}elseif(isset($_GET['id']) && isset($_GET['title']) && $songDetails['type']=="Audio"){ 
      				echo '<a href="index.php" id="link">Homepage</a> >
 						<a href="audio.php" id="link">Audio</a> >
 						<a href="download.php?id='.$songDetails["song_id"].'&title='.$folder.'/'.urlencode($songDetails["song_title"]).'" id="link">'.$songDetails['song_title']." By ".$songDetails['artiste_name'].'</a>'; 		
 				}
 			?>
    	</div>
      <div class="col-sm-3" ></div>
    	<!-- <div class="col-sm-6" style="padding: 45px 25px 0px 25px; box-sizing: border-box; opacity: 0.7;">
     		<img src="bg/5.jpg" height="500px" width="90%">
    	</div> -->
 	</div>
 </div>
</div>
<?php 
	include "includes/footer.php";
 ?>
</div>
</body>
</html>