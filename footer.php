</body>
<script>
function shipyard() {
	$('.content').load("shipyard.php").fadeIn();
}

function reSidebar() {
	$('.sidebar').load("sidebar.php").fadeIn();
	//$('.headbar').load("headbar.php");
}

/*
function shipyard() {
	$('.content').load("shipyard.php").fadeIn();
}
*/

function jumpLink(destination) {
	$.ajax({
		type: "GET",
		url: "actions.php",
		data: {action: "jump", destination: destination}
	}).done(function(msg) {
		reSidebar();
		console.log(msg);
	})
}

function buyShip(id) {
	$.ajax({
		type: "GET",
		url: "actions.php",
		data: {action: "buyShip", destination: id}
	}).done(function(msg) {
		reSidebar();
		console.log(msg);
	})
}

function landLink(destination) {
	$.ajax({
		type: "GET",
		url: "actions.php",
		data: {action: "land", destination: destination}
	}).done(function(msg) {
		reSidebar();
		console.log(msg);
	})
}

function reFuel() {
	$.ajax({
		type: "GET",
		url: "actions.php",
		data: {action: "refuel"}
	}).done(function(msg) {
		reSidebar();
		console.log(msg);
		$(".msg").text(msg);
	})
}

function selfDestruct() {
	$.ajax({
		type: "GET",
		url: "actions.php",
		data: {action: "selfdestruct"}
	}).done(function(msg) {
		reSidebar();
		console.log(msg);
	})
}

function liftOff() {
	$.ajax({
		type: "GET",
		url: "actions.php",
		data: {action: "lift"}
	}).done(function(msg) {
		reSidebar();
		console.log(msg);
	})
}

</script>

</html>

