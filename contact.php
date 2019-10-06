<?php
  include "includes/functions.php";
  include "includes/header2.php";
?>
	<div class="container">
		<div class="row">
			<div class="col-sm-2">
			</div>
			<div class="col-sm-8" id="formDiv">
				<h2 class="text-center" style="padding: 10px; color: #000; margin-top: 20px;"><a id="contact"><i class="fa fa-handshake" aria-hidden="true"></i> Get In Touch</a></h2>
				<p style="padding: 0px 15px;">

					<br>
		    		For <span style="font-weight: bolder;">Music/Video/Comedy Promotion</span> or <span style="font-weight: bolder;">Advert Placement</span> enquiries, <br> please <span style="font-weight: bolder;">call  08068775432</span> or <span style="font-weight: bolder;">whatsApp 08180435865</span> 
		    		<br>
		    		Email Address - <span style="font-weight: bolder;">bashartukurshehu@gmail.com</span> 
		    	 	<br><br> Or <span style="color: green; font-weight: bold;">fill in the form  below
		    	</p>
		    	<div style="width: 90%; margin: 0 auto;">
		    		<form method="POST" action="contact.php" id="contactForm" style="margin-bottom: 50px;">
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
		    		</form>
		    	</div>
			</div>
			<div class="col-sm-2">
			</div>
		</div>
	</div>
<?php 
  include "includes/footer2.php";
?>