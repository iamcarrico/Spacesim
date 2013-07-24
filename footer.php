<?php if (isLoggedIn()){ ?>
<a href='#' class="reset" onClick="loadContent('navigation'); reSidebar()">Reload sidebar</a>
<?php } ?>

<!-- <div class="msg"></div> -->

</body>
<script>

function starField() {
	function getRandomArbitrary(min, max) {
		return Math.random() * (max - min) + min;
	}
	var i = 0;
	
	while (i <= 20) {
	$(".jumpScreen").append("<div class='starline'></div>");
	var top = Math.random() * (95 - 5) + 5;
	$(".starline").css("top", top +"%");
	console.log(i);
	i++;
	}
}

function shipyard() {
	$('.content').load("shipyard.php").fadeIn();
}

function loadContent(page) {
	$('.content').empty();
	$('.content').load(page + ".php").fadeIn();
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
		$('.deathScreen').fadeOut(2000);
		reSidebar();
		loadContent('navigation');
	}, 7000);
}

function jumpScreen(time) {
		$('.content').empty();
		$('.sidebar').empty();
		$('.jumpScreen').fadeIn(2000);
		starField();
		window.setTimeout(function() {
		$('.jumpScreen').fadeOut(2000);
		reSidebar();
		loadContent('navigation');
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
		loadContent('shipyard');
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
		loadContent('navigation');
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
		loadContent('navigation');
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
		reSidebar();
		loadContent('navigation');
		console.log(msg);
	})
}

function errorBox(msg) {
	$('.errorBox').text(msg);
	$('.errorBox').fadeIn(500);
	window.setTimeout(function() {
		$('.errorBox').fadeOut(500);
	}, 2000);
}

</script>
<?php if ((isLoggedIn()) && (jumping())) { ?>
<script>jumpScreen(<?php echo ($player->eta - time()) * 1000; ?>); </script>
<?php } ?>
</html>

