<?php

session_start();
require_once('config.php');

function isLoggedIn() {
	if (isset($_SESSION['playerid'])) {
	    return true;
	}
	else {
	    return false;
	}
}

function youAre() {
	console("You are logged in as ". $_SESSION['username']."!");
	console("It is ". date('r'));
}



require_once('actions.php');

function isAdmin($player) {
	$db = new ezSQL_mysql(DB_USER, DB_PASS, DB_NAME, DB_HOST);
	if ($db->get_var("SELECT role FROM ".TBL_PREFIX."user WHERE id = $player") == 'A') {
		return true;
	}
	else {
		return false;
	}
}

function landVerb($type, $tense = "present") {
	if ($tense == "present"){
		switch ($type) {
			case 0:
			case 2:
				return "land";
				break;
			
			case 1:
				return "dock";
				break;
			}
		}
	if ($tense == "past"){
		switch ($type) {
			case 0:
			case 2:
				return "landed on";
				break;
			
			case 1:
				return "docked at";
				break;
			}
		}
	}

function spobTitle($type) {
	switch ($type) {
		case 0:
			return "Planet ";
			break;
		
		case 1:
			return "Station ";
			break;

		case 2:
			return "Moon ";
			break;
	}
}


function transitCheck(){
	global $player;
	//console($player->eta."vs". time());
	if ($player->eta < time()) {
		return false;
	}
	else {
		return true;
	}
}

function transitTime() {
	global $player;
	//echo date('r', $player->eta);
	echo date('r', time() + ($player->eta - time()));
	//console("Current: ". date('r') ." | ETA: ".date('r', $dbeta));
}

function formRegister($username = "", $email ="") {
	if (empty($_SESSION['username'])) {
		include('inc/form-register.php');
	}
}

function formLogin($username = "") {
	if (empty($_SESSION['username'])) {
		include('inc/form-login.php');
	}
}

function pageTitle($title = "Index") {
	echo '<div class="page-header">';
    echo "<h1>$title</h1>";
	echo '</div>';
}
function homeButton() {
	echo '<a href="index.php" class="btn btn-large btn-primary">Home</a>';
}

function isLanded() {
	global $player;
	//console("Player is: ".$player->landed);
	if ($player->landed == 1) {
		return true;
	}
	else {
		return false;
	}
}

/*
function gameOptions($opt) {
	switch $opt {
		case 'name':
		$sql = "SELECT "
	}
}
*/

include('data.php');
//echo "data reloaded at ". date('r');


/*
function logger($e) {
	$db = new ezSQL_mysql(DB_USER, DB_PASS, DB_NAME, DB_HOST);
	$sql = "INSERT INTO ".TBL_PREFIX."events (what, who, where, when) VALUES ($e, ".$player->id.", ".$player->location_syst.", NOW())";
	if ($db->query($sql)) {
		echo "Event logged ($e, ".$player->id.", ".$player->location_syst.", ".date('r');
	}
	else {
		echo "Logger failed to log ($e, ".$player->id.", ".$player->location_syst.", ".date('r');
	}
}
*/