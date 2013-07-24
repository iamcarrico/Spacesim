<?php 

require_once('functions.php');

$spob = load_spob($player->location_spob);

echo "<h1>Welcome to ".$spob->bar."!</h1>";
echo "<p>".$spob->bardesc."</p>";

echo "<a href='#' onClick='loadContent(\"navigation\")'>Leave</a>";