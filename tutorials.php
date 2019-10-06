<?php
  include "includes/header.php";
  include "includes/functions.php";
  include "includes/dbCon.php";
?>
			<div class="links shadow-effect-1">
				<a href="index.php">Homepage </a>>>
				<a href="tutorials.php">Tutorials</a>
			</div>
			<div class="row">
				<div class="col-sm-8" style="">
					<div style="background: #f5f5f5; margin-top: 15px; width: 100%; ">
						<h5 style="padding: 10px; font-weight: bold; text-align:center; margin-top: 5px; border-bottom: 1px solid #bbb; font-size: 24px;"><i class="fa fa-tasks" aria-hidden="true"></i> Tutorials</h5>
	              	</div>
	              	 <ul>
	              	 	<li>
	              	 		<a href="tutorials/whatsapp-tips-and-tricks">Whatsapp tips and tricks</a>
	              	 	</li>
	              	 </ul>
	            </div>
				<div class="col-sm-4">
					<div style="background: #cccccc; border: 1px solid lightblue; border-style: outset;; margin-top: 15px; height: 300px; width: 100%; box-sizing: border-box; text-align: center; color: maroon;">
						<div class="" style="background: yellow;">
	                		<h5 style="padding: 10px; font-weight: bold; text-align:center; margin-top: 0px; border-bottom: 1px solid blue;"><i class='fa fa-info-circle' aria-hidden='true'></i>     Advertisement</h5>
	              		</div>
	              		... * ...
					</div>
					<?php 
						include 'includes/sidebar.php';
					 ?>
				</div>
			</div>
		</div>

		<?php 
		  include "includes/footer.php";
		?>

	</div>
</body>
</html>