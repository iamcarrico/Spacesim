<h1>Shipyard</h1>
<?php 

require_once('functions.php');

foreach ($ships as $ship) {
	echo "<h2>$ship->name</h2>";
	echo "<p>$ship->desc</p>";
	echo "<strong>Cargo</strong> $ship->cargobay<br>";
	echo "<strong>Fuel</strong> $ship->fueltank<br>";
	echo "<strong>Price</strong> $ship->cost";
	if ($player->ship != $ship->id) {
		echo " <strong><a href='#' onclick='buyShip($ship->id)'>Buy</a></strong>";
	}
	else {
		echo "<span style='color: green'>You are currently flying this ship.</span>";
	}
}

//print_r($ships);