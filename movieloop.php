<?php


function movieloop($link, $title, $line, $id) {

ob_start();
?>
	      	 <div class="row">
	      	 
	      	 	<div class="col-md-6 moviePic">
                    <img src="<?php echo $link ?>" class="img-responsive moviepics" alt="testtheimage" />
	      	 	</div>
	    	 <div class="col-md-6">
	      	      <h3><?php echo $title ?></h3>
                  <div class="line">
                  <p>The line: <?php echo $line . "%" ?></p>
                    <button type="button" id="overbutton<?php echo $id ?>" onclick="setOver(<?php echo $id ?>)" class="btn btn-secondary">Over</button>
                      <button type="button" id="underbutton<?php echo $id ?>" onclick="setUnder(<?php echo $id ?>)" class="btn btn-secondary">Under</button>
                   </div>
                   
	      	 </div>
	      	 </div>
	      	 <div class="row placebet">
		      	 <div class="col-md-12">
		      	 <center>
		
                   <form method="GET" action="placeBet.php">
	                   <input type="hidden" value="<?php echo $id ?>" name="movieid" id="movieid"></input><br>
	                   <input type="hidden" value="" name="ou" id="ou<?php echo $id ?>"></input>
	                   <input type="number" min="1" name="betAmt" id="betAmt"></input>
	                   <button type="submit" class="btn btn-success">Submit Bet</button>
                   </form>

		      	 </center>
		      	 </div>
	      	 </div>

<?php 
return ob_get_clean();

}

?>