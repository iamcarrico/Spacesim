<?php
function isLoggedIn() {
	if (isset($_SESSION['playerid'])) {
	    return true;
	}
	else {
	    return false;
	}
}


function youAre() {
	console("You have logged in as ". $_SESSION['username']."!");
	console("It is ". date('r'));
}

function landVerb($type, $tense = "present") {
	if ($tense == "present"){
		switch ($type) {
			case 0:
			case 2:
				return "land";
				break;
			
			case 1:
			case 3:
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
			case 3:
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
		
		case 3:
		return " ";
		break;
		//spobs that don't need a title
	}
}

//Debugger function
function console($msg) {
	echo '<script type="text/javascript">';
	echo "console.log(\"". $msg ."\");";
	//echo "$(\".msg\").text(\"". $msg ."\");";
	echo '</script>';
}

