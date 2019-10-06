<!DOCTYPE html>
<html>
<head>
	<?php 
	require "includes/functions.php";
	error_reporting(0);
	?>
	<title>Contact - KBmp3</title>
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
							<li class="menu-item"><a href="index.php">Home</a></li>
							<li class="menu-item "><a href="about.php">About</a></li>
							<li class="menu-item current-menu-item"><a href="contact.php">Contact</a></li>
							<li class="menu-item"><a href="privacy.php">Privacy</a></li>
							<li class="menu-item"><a href="faq.php">FAQs</a></li>
						</ul> <!-- .menu -->
					</nav> <!-- .main-navigation -->
					<div class="mobile-menu">
					</div>
				</div>
			</header> <!-- .site-header -->

			<!-- Contact me container -->
			<div class="container" >
				<div class="container" >
					<div class="row">
						<div class="col-sm-2">
						</div>
						<div class="col-sm-8" id="formDiv">
							<h2 class="text-center" style="padding: 10px; color: #d7af00;"><a id="contact"><i class="fa fa-handshake" aria-hidden="true"></i> Get In Touch</a></h2>
					    	<form method="POST" action="contact.php" id="contactForm">
					    		<div class="message">
					    		<?php 

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
					    	    	<input type="text" class="form-control" id="name" name="name" placeholder="Please Enter Your Name">
					    	    </div>
					    	    <div class="form-group">
					    	    	<label class="col-form-label" for="email"> Your Email</label>
					    	    	<input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Please Enter Your Email Address"><small id="emailHelp" class="form-text text-muted">I'll never share your email with anyone else.</small>
					    	    </div>
					    	    <div class="form-group">
					    	        <label for="comment"> Comment</label>
					    	        <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
					    	    </div>
					    	    <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send</button>

					    	    <p class="lead" style="margin-left: 10px; margin-top: 25px; color: #d7af00; font-size: 25px; font-weight: bold;"> Social media links <i class="fa fa-hand-point-down" aria-hidden="true"></i> </p>

					    	    <div class="wrapper justify-content-center" >
				    	    		<ul>
				    	    			<li>
				    	    				<a href="https://www.facebook.com/bashartukurshehu" class="f"><i class="fab fa-facebook" aria-hidden="true" ></i></a>
				    	    			</li>
				    	    			<li>
				    	    				<iframe src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fbashartukurshehu.000webhostapp.com%2F&layout=button&size=large&mobile_iframe=true&width=73&height=35&appId" width="73" height="35" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media" value="share"></iframe>
				    	    			</li>
				    	    			<li>
				    	    				<a href="https://twitter.com/BasharTs?ref_src=twsrc%5Etfw" class="twitter-follow-button" data-size="large" data-via="BasharTs" data-hashtags="WebDeveloper" data-show-screen-name="false" data-show-count="false">Follow <!--@BasharTs--></a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
				    	    			</li>
				    	    			<li> 
				    	    				<a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-size="large" data-text="Hey! Please take a look at my awesome portfolio website." data-url="https://bashartukurshehu.000webhostapp.com" data-via="BasharTs" data-hashtags="WebDeveloper" data-related="BasharTs" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
				    	    			</li>
				    	    			<li>
			    	    					<a href="https://Github.com/BasharTs" target="_blank"> <i class="fab fa-github"></i> </a>
			    	    				</li>
				    	    			<li>
				    	    				<a href="whatsapp://send?text=http://bashartukurshehu.000webhostapp.com/index.php" data-text="Music and entertainment!" data-action="share/whatsapp/share" class="t"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>
				    	    			</li>
				    	    		</ul>
				    	    	</div>
			    	    		<div class="wrapper justify-content-center">
			    	    			<ul>
			    	    				
			    	    			</ul>
					    	    </div>
					    	</form>
						</div>
						<div class="col-sm-2"> </div>
					</div>
				<!-- </div> -->
			</div>
		<script src="assets/jquery-3.3.1.js"> </script>
		<script src="assets/popper.js"> </script>
		<script type="text/javascript" src="script/bootstrap.js"></script>
		<script type="text/javascript" src="script/script.js"></script>
		</body>
		<?php 
			include "includes/footer.php";
		 ?>
</html>