function setOver(x) {
	var movieid = x;
	document.getElementById("ou" + x).value = "over";
	var overButton = document.getElementById("overbutton" + x);
	var underButton = document.getElementById("underbutton" + x);
	underButton.className = "btn btn-secondary";
	overButton.className += " btn-primary";


}

function setUnder(x) {
	var movieid = x;
	document.getElementById("ou" + x).value = "under";
	var overButton = document.getElementById("overbutton" + x);
	var underButton = document.getElementById("underbutton" + x);
	overButton.className = "btn btn-secondary";
	underButton.className += " btn-primary";
}

function validateForm(x) {
	var ouInput = document.getElementById("ou" + x);
	if (ouInput.value == "null") {
		alert("You must click on the over or under button before submitting a bet!");
		return false;
	}

}

function myMoveFunction() {
	$('#goal').addClass('bounce');

}