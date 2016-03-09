<?php

function pendingbetstable($link, $title, $line, $id, $date, $score) {

	if($score == "") {
		$score = "No score yet.";
	} else {
		$score = $score + "%";
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
                  <p>Release Date: <?php echo $date ?></p>
                   </div>
                   
	      	 </div>

	      	 </div> <!--end row -->
	      	 </td>

	      	 <td>
	      	 <div class="row placebet">
		      	 <div class="col-md-12">
		      	 <center>
		
		      	 <h4>The Link <?php echo $line . "%" ?></h4>
		      	 <h4>Current RT Score: <?php echo $score ?>

		      	 </center>
		      	 </div>
	      	 </div>
	      	 </td>

	      	 </tr>

<?php 
return ob_get_clean();

}

function movielooptable($link, $title, $line, $id, $date) {

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
                  <p>Release Date: <?php echo $date ?></p>
                    <button type="button" id="overbutton<?php echo $id ?>" onclick="setOver(<?php echo $id ?>)" class="btn btn-secondary">Over</button>
                      <button type="button" id="underbutton<?php echo $id ?>" onclick="setUnder(<?php echo $id ?>)" class="btn btn-secondary">Under</button>
                   </div>
                   
	      	 </div>

	      	 </div> <!--end row -->
	      	 </td>

	      	 <td>
	      	 <div class="row placebet">
		      	 <div class="col-md-12">
		      	 <center>
		
                   <form method="GET" onsubmit="return validateForm(<?php echo $id ?>)" id="form <?php echo $id ?>" action="placeBet.php">
	                   <input type="hidden" value="<?php echo $id ?>" name="movieid" id="movieid"></input><br>
	                   <input type="hidden" value="null" name="ou" id="ou<?php echo $id ?>"></input>
	                   <input type="number" min="1" name="betAmt" id="betAmt" required></input>
	                   <button type="submit"  class="btn btn-success">Submit Bet</button>
                   </form>

		      	 </center>
		      	 </div>
	      	 </div>
	      	 </td>

	      	 </tr>

<?php 
return ob_get_clean();

}



?>