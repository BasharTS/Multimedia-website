<!DOCTYPE html>
<html>
<head>
	<title>About</title>
	<!-- Add icon before title of the page -->
	<link rel="Shortcut icon" href="../bg/kbmp3_3.png">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    
    <!-- Dealing with whatsapp -->
    <!-- <meta property="og:title" content="Visit and download songs of your fevorite artiste" />
    <meta property="og:description" content="Music & entertainment home!!! Are you an artiste? Register and promote your songs easily with a single click." />
    <meta property="og:url" content="https://OABS.000webhostapp.com/index.php" />
    <meta property="og:image" content="https://OABS.000webhostapp.com/img/btsss.png" /> -->
    <!-- end of whatsapp -->

    <!-- Remove 000webhost banner -->
	    <style>img[alt="www.000webhost.com"]{display:none;}</style>
	<!-- end -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <!-- My css -->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/admin_style.css">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome-all.css">
	</head>
	<body>
		<div class="container-fluid" style="background: url('../bg/slide-1.jpg');">
			
			<div class="container">
				<header class="site-header">
					<div class="container">
						<a href="index.php" id="branding">
							<h2 style="color: #d7af00;">KBmp3</h2>
							<small class="site-description" style="color: #d7af00;">Music and Entertainment</small>
						</a> <!-- #branding -->
						
						<nav class="main-navigation">
						<button type="button" class="toggle-menu"><i class="fa fa-bars"></i></button>
							<ul class="menu">
								<li class="menu-item "><a href="index.php">Home</a></li>
								<li class="menu-item "><a href="about.php">About</a></li>
								<li class="menu-item "><a href="contact.php">Contact</a></li>
								<li class="menu-item "><a href="privacy.php">Privacy</a></li>
								<li class="menu-item current-menu-item"><a href="faq.php">FAQs</a></li>
							</ul> <!-- .menu -->
						</nav> <!-- .main-navigation -->
						<div class="mobile-menu">
						</div>
					</div>
				</header> <!-- .site-header -->
				<div class="container">
					<h1 class="text-center" style="padding: 20px; margin-bottom: 30px; color: #d7af00;"> <a id="about"> <i class="fa fa-question" aria-hidden="true"></i> FAQs </a> </h1>
					<div class="row">
						<p></p>
						<div class="col-sm-3">
						</div>
						<div class="col-sm-6" id="imgDiv">
							<ol>
								<li><a href="#q1" data-toggle="collapse" style="color: yellow;">Why bla bla bla?</a>

							    	<p id="q1" class="collapse-in" style="color: #d7af00;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							    	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							    	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							    	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
							    	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
							    	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
								</li>
								<li>
									<a href="#q2" data-toggle="collapse" style="color: yellow;">Why bla bla bla? <i class="fa fa-collapse" aria-hidden="true"></i></a>
							    	<p id="q2" class="collapse" style="color: #d7af00;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							    	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							    	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							    	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
							    	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
							    	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
								</li>
								<li>
									<a href="#q3" data-toggle="collapse" style="color: yellow;">Why bla bla bla? <i class="fa fa-collapse" aria-hidden="true"></i></a>
									<p id="q3" class="collapse" style="color: #d7af00;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
									quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
									consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
									cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
									proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>	
								</li>
							</ol>
						</div>
						<div class="col-sm-3"> 
						</div>
					</div>
					<?php 
						include "includes/footer.php";
					 ?>
				</div>
			</div>
			<!-- End of about me -->

			<script src="../assets/jquery-3.3.1.js"> </script>
			<script src="../assets/popper.js"> </script>
			<script type="text/javascript" src="../js/bootstrap.js"></script>
			<!-- <script type="text/javascript" src="../js/script.js"></script> -->
	</body>
</html>