<?php


function betstable($link, $title, $line, $score, $amt, $status, $ou) {


if(empty($score)) {
	$score = "N/A";
}

ob_start();
?>
			<tr class="spaceUnder">
				<td>
	      	 <div class="row">
	      	 	<div class="col-md-6 moviePic">
                    <img src="<?php echo $link ?>" class="img-responsive moviepics" alt="testtheimage" />
	      	 	</div>

	    	 <div class="col-md-6 moviedescrip">

	      	      <h3><?php echo $title ?></h3>
                  <div class="line">
                  <p>The line: <?php echo $line . "%" ?></p>
                  </div> <br>
                  <p>Current Bet Status: <?php echo $status ?> </p><br>

                 <p>Current Critic Score: <?php echo $score ?> </p>
                   
	      	 </div>

	      	 </div> <!--end row -->
	      	 </td>

	      	 <td>
	      	 <div class="row placebet">
		      	 <div class="col-md-12">
		      	 <center>
		
		      	 	 <p> You bet: $<?php echo $amt ?></p><br>
		      	 	  <p> You took: The <?php echo $ou ?></p>

		      	 </center>
		      	 </div>
	      	 </div>
	      	 </td>

	      	 </tr>

<?php 
return ob_get_clean();

}

?>