<?php
  include "includes/header.php";
  include "includes/functions.php";
  include "includes/dbCon.php";
?>
			<div class="links shadow-effect-1">
				<a href="index.php">Homepage </a>>>
				<a href="gallary.php">Gallary</a>
			</div>
			<div class="row">
				<div class="col-sm-8" style="">
					<div style="background: #f5f5f5; margin-top: 15px; width: 100%; ">
						<div class="">
	                		<h5 style="padding: 10px; font-weight: bold; text-align:center; margin-top: 5px; border-bottom: 1px solid #bbb; font-size: 24px;"><i class="fa fa-image" aria-hidden="true"></i> Picture Gallary</h5>
	              		</div>
	              		<br>
		              	<div class="row">
		              	<?php
		              	    include 'includes/dbCon.php';
		              	    //define how many results you want per page
		              	    $results_per_page = 30;

		              	    // find out the number of results stored in database
		              	    $sql='SELECT * FROM `gallary`';
		              	    $eventResult = mysqli_query($conn, $sql);
		              	    $number_of_rows = mysqli_num_rows($eventResult);

		              	    // determine number of total pages available
		              	    $number_of_pages = ceil($number_of_rows/$results_per_page);

		              	    // determine which page number visitor is currently on
		              	    if (!isset($_GET['p'])) {
		              	      $pic = 1;
		              	    } else {
		              	      $pic = $_GET['p'];
		              	    }
		              	    // determine the sql LIMIT starting number for the results on the displaying page
		              	    $starting_point = ($pic-1)*$results_per_page;
		              	    $query = "select * from gallary order by `id` asc LIMIT ".$starting_point."," .$results_per_page;
		              	    $result=mysqli_query($conn, $query);
		              	    while($row=mysqli_fetch_array($result)){
		              	        ?>
		              	        <div class="col-sm-4" style=" box-sizing: border-box;">
		              	            <div style="width: 100%; text-align: center; background: #eee8aa; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
		              	                <figure>
		              	                    <img src="uploads/gallary/<?=$row['file']; ?>" height="250" width="100%" style= "border: 1px solid #bbb; border-radius: 5px; box-sizing: border-box; padding: 8px; background: #ffffff;">
		              	                    <figcaption style="padding: 10px;"><?php echo strtoupper($row['description']);?></figcaption>
		              	                    
		              	                </figure>
		              	            </div>
		              	        </div>
		              	        
		              	     <?php
		              	    }
		              		?>
		              	</div> 
	              	</div> 
	              	<div style="width: 100%; text-align: center; padding: 15px;">
	              		<?PHP
	              		if ($number_of_pages > 1) {
	              		  // previous and Next button
	              		  $prev = $pic-1;
	              		  $next = $pic+1;
	              		  if ($prev >=1) {
	              		    echo '<a href="gallary.php?p=' . $prev . '" class="page" style = "margin-right:4px;"> Prev </a> ';
	              		  }
	              		  // display the links to the pages
	              		  for ($r=1;$r<=$number_of_pages;$r++) {
	              		    $current = ($r == $pic? 'class="current"' : 'class="page"');
	              		    echo '<a href="gallary.php?p=' . $r . '" '. $current .' >' . $r . '</a> ';
	              		  }
	              		  if ($next < $number_of_pages) {
	              		     echo '<a href="gallary.php?p=' . $next . '" class="page" > Next </a> ';
	              		  }
	              		}
	              		?>
	              	</div> 
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