<!DOCTYPE html>
<html>
<head>
	<title>Privacy - KBmp3</title>
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
								<li class="menu-item"><a href="contact.php">Contact</a></li>
								<li class="menu-item current-menu-item"><a href="privacy.php">Privacy</a></li>
								<li class="menu-item"><a href="faq.php">FAQs</a></li>
							</ul> <!-- .menu -->
						</nav> <!-- .main-navigation -->
						<div class="mobile-menu">
						</div>
					</div>
				</header> <!-- .site-header -->

				<h2 class="text-center" style="padding: 15px; color: #d7af00; "> <a id="about"> <i class="fa fa-users" aria-hidden="true"></i> PRIVACY POLICY </a> </h2>
				<div class="row">
				<p></p>
				<div class="col-sm-2">
				</div>
				<div class="col-sm-8" id="imgDiv">
					<h5 style="color: #d7af00;"> <?php $d = Date("06-08-2018"); 
						echo "Last modified on <span style='color: yellow; font-weight: bolder;'>" .$d."</span>"; ?> </h5>
			    	<p class="" style="color: #d7af00;">Thanks for using KBmp3. This page informs you of our policies regarding the collection, use and disclosure of Personal Information we receive from users of the Site. </br>
					
					<strong>Information Collection And Use</strong><br>
					While using our Site, we may ask you to provide us with certain personally identifiable information
					that can be used to contact or identify you. Personally identifiable information may include, but is not limited to your name ("Personal Information"). <br> We use your Personal Information only for providing and improving the site. By using the site, you agree to the collection and use of Imformation in accordance with this policy. <br>
					<strong>Communications</strong><br>
					We may use your Personal Information to contact you with newsletters, marketing or promotional materials. <br>
					<strong>Cookies</strong> <br>
					Cookies are files with small amount of data, which may include an anonymous unique identifier.
					Cookies are sent to your browser from a web site and stored on your computer's hard drive.
					Like many sites, we use "cookies" to collect information. You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent. However, if you do not accept cookies, you may not be able to use some portions of our site. <br>
					<strong>Security</strong> <br>
					The security of your Personal Information is important to us, but remember that no method of
					transmission over the Internet, or method of electronic storage, is 100% secure. While we strive to
					use commercially acceptable means to protect your Personal Information, we cannot guarantee its
					absolute security. <br>
					<strong>Changes To This Privacy Policy</strong> <br>
					This Privacy Policy is effective as of (06-08-2018) and will remain in effect except with respect to any changes in its provisions in the future, which will be in effect immediately after being posted on this page. We reserve the right to update or change our Privacy Policy at any time and you should check this Privacy Policy periodically. Your continued use of the Service after we post any modifications to the Privacy Policy on this page will constitute your acknowledgment of the modifications and your consent to abide and be bound by the modified Privacy Policy. If we make any material changes to this Privacy Policy, we will notify you either through the email address you have provided us, or by placing a prominent notice on our website. <br>
					</p> </br>
					<p class="" style="color: yellow;">If you have any questions about this Privacy Policy, please <a href="contact.php">contact us.</a></p>
				</div>
				<div class="col-sm-2"> 
				</div>
			</div>
			<?php 
				include "includes/footer.php";
			 ?>
		</div>
	</div>

	<script src="assets/jquery-3.3.1.js"> </script>
	<script src="assets/popper.js"> </script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<!-- <script type="text/javascript" src="js/script.js"></script> -->
</body>


</html>