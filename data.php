<?php 
$db = new ezSQL_mysql(DB_USER, DB_PASS, DB_NAME, DB_HOST);

function load_systems() {
	global $db;
	$sql = "SELECT * FROM ".TBL_PREFIX."syst";//debug_msg($sql);
	$systems = $db->get_results($sql);
	return $systems;
}
function load_govts() {
	global $db;
	$sql = "SELECT * FROM ".TBL_PREFIX."govts ORDER BY type ASC";//debug_msg($sql);
	$governments = $db->get_results($sql);
	return $governments;
}

function load_player($user) {
	global $db;
	$sql = "SELECT * FROM ".TBL_PREFIX."user WHERE ID = $user";//debug_msg($sql);
	$player = $db->get_row($sql);
	return $player;
}

function load_pilots($system, $player) {
	global $db;
	$sql = "SELECT id, name, government, vessel, ship 
	FROM ".TBL_PREFIX."user 
	WHERE location_syst = $system 
	AND id != $player";
	$pilots = $db->get_results($sql);
	return $pilots;
}

function load_spobs($syst) {
	global $db;
	$sql = "SELECT * FROM ".TBL_PREFIX."spob";//debug_msg($sql);
	$spobs = $db->get_results($sql);
	return $spobs;
}

function loadShips() {
	global $db;
	$sql = "SELECT * FROM ".TBL_PREFIX."ships";//debug_msg($sql);
	$ships = $db->get_results($sql);
	return $ships;
}

/*
function load_spob($user) {
	global $db;
	$sql = "SELECT * FROM ".TBL_PREFIX."spob WHERE parent = $user";//debug_msg($sql);
	$spob = $db->get_row($sql);
	return $spob;
}
*/	

function load_connections($syst) {
	global $db;
	$sql = "SELECT destination FROM ".TBL_PREFIX."jumplanes WHERE source = $syst";//debug_msg($sql);
	$jumps = $db->get_col($sql, 0);
	return $jumps;
}	

function load_news() {
	global $db;
	$sql = "SELECT * FROM ".TBL_PREFIX."news ORDER BY date DESC";//debug_msg($sql);
	$news = $db->get_results($sql);
	return $news;
}

function loadOptions() {
	global $db;
	$sql = "SELECT * FROM ".TBL_PREFIX."options";
	$options = $db->get_results($sql);
	return $options;
}	

function maxFuel() {
	$maxFuel = 10;
	return $maxFuel;
	//Temporary placeholder until we can pull $maxFuel from ssim_ships
}

if (!isLoggedIn()) {
	console('Player ID not found. Skipping render');
	//formLogin();
	}
else {
	$player = load_player($_SESSION['playerid']);
	$systems = load_systems();
	$governments = load_govts();
	$spobs = load_spobs($player->location_syst);
	$jumps = load_connections($player->location_syst);
	$pilots = load_pilots($player->location_syst, $player->id);
	$options = loadOptions();
	$ships = loadShips();
	$fuelprice = $options[1]->value;
	$maxFuel = maxFuel();
} ?>