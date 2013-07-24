<?php

session_start();

require_once('config.php');

//require_once('actions.php');

require('data.php');

function isAdmin($player) {
	$db = new ezSQL_mysql(DB_USER, DB_PASS, DB_NAME, DB_HOST);
	if ($db->get_var("SELECT role FROM ".TBL_PREFIX."user WHERE id = $player") == 'A') {
		return true;
	}
	else {
		return false;
	}
}

function transitCheck(){
	global $player;
	//console($player->eta."vs". time());
	if ($player->eta < time()) {
		return false;
		$db = new ezSQL_mysql(DB_USER, DB_PASS, DB_NAME, DB_HOST);
		$db->query("UPDATE ".TBL_PREFIX."users jumping = 0, attackable = 1 WHRE ID = $player->id");
	}
	else {
		return true;
	}
}

function jumping(){
	global $player;
	//console($player->eta."vs". time());
	if ($player->eta < time()) {
		return false;
		$db = new ezSQL_mysql(DB_USER, DB_PASS, DB_NAME, DB_HOST);
		$db->query("UPDATE ".TBL_PREFIX."users jumping=0, attackable=1 WHRE ID = $player->id");
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