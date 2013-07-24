</body>
<script>
function shipyard() {
	$('.content').load("shipyard.php").fadeIn();
}

function clearScreen() {
	$('.content').empty();
}

function deathScreen() {
	$('.content').empty();
	$('.sidebar').empty();
	
	$('.deathScreen').fadeIn(2000, function(){
	
	$('.deathScreen h1').text('5').fadeIn(500).fadeOut(500);
	$('.deathScreen h1').text('4').fadeIn(500).fadeOut(500);
	$('.deathScreen h1').text('3').fadeIn(500).fadeOut(500);
	$('.deathScreen h1').text('2').fadeIn(500).fadeOut(500);
	$('.deathScreen h1').text('1').fadeIn(500).fadeOut(500);
	$('.deathScreen h1').text('Goodbye').fadeIn(500);
	});
	window.setTimeout(function() {
		$('.sidebar').load("sidebar.php");
		$('.deathScreen').fadeOut(2000);
	}, 7000);
}

function jumpScreen(time) {
		$('.content').empty();
		$('.sidebar').empty();
		$('.jumpScreen').fadeIn(2000);
		
		window.setTimeout(function() {
		reSidebar();
		$('.jumpScreen').fadeOut(2000);
	}, time);
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
		//reSidebar();
		//clearScreen();
		jumpScreen(msg);
		console.log(msg);
	})
}

function buyShip(id) {
	$.ajax({
		type: "GET",
		url: "actions.php",
		data: {action: "buyShip", shipid: id}
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
		deathScreen();
		//setTimeout(reSidebar(), 8000);
		console.log(msg);
	})
}

function liftOff() {
	$.ajax({
		type: "GET",
		url: "actions.php",
		data: {action: "lift"}
	}).done(function(msg) {
		clearScreen();
		reSidebar();
		console.log(msg);
	})
}

</script>
<?php if ((isLoggedIn()) && (jumping())) { ?>
<script>jumpScreen(<?php echo ($player->eta - time()) * 1000; ?>); </script>
<?php } ?>
</html>

