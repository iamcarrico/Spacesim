<?php 
require_once('functions.php');
?>

<!DOCTYPE html> 
<html>
<head>
<title></title>

<style>
/*
	.jumpeta {
		position: absolute;
		top: 0px;
		right: 0px;
		padding: 5px 10px;
	}
*/

.headbar {
	position: absolute;
	top: 0px;
	left: 0px;
	right: 0px;
	text-align: right;
}

.sidebar, .content {
	width: 50%;
	float: left;
}

.deathScreen {
	position: absolute;
	top: 0px;
	left: 0px;
	bottom: 0px;
	right: 0px;
	background: black;
	color: white;
	display: none;
	text-align: center;
}

.jumpScreen {
	position: absolute;
	top: 0px;
	left: 0px;
	bottom: 0px;
	right: 0px;
	background: blue;
	color: white;
	display: none;
	text-align: center;
}

.errorbox {
	color: white;
	background: red;
	padding: 10px;
	font-size: 20px;
	display: none;
	position: absolute;
	top: 25%;
	left: 25%;
	right: 25%;
}

.starline {
	background: white;
	position: absolute;
	width: 200px;
	height: 20px;
	right: 0px;
}

.msg {
	position: absolute;
	bottom: 0px;
	left: 0px;
	right: 0px;
	background: #ffffaa;
	color: black;
	padding: 10px 5px;
}
</style>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

</head>
<body>

<div class="errorbox"></div>

<?php 

if ((isset($_POST['user'])) && ($_POST['formaction'] == "login")) {
	
	$username = mysql_escape_string($_POST['user']);
	$password = mysql_escape_string(sha1($_POST['pass']));
	
	$db = new ezSQL_mysql(DB_USER, DB_PASS, DB_NAME, DB_HOST);

	$sql = "SELECT * FROM ".TBL_PREFIX."user WHERE name = '$username'";

	$user = $db->get_row($sql);
		if ($user->password == $password) {
			console("You are $user->name!", 0);
			$_SESSION['username'] = "$user->name";
			$_SESSION['playerid'] = "$user->id";
			$_SESSION['date'] = date(DATE_RFC822);
			console("You are now logged in as ". $_SESSION['username']);
			//console("Player ID: ".$_SESSION['playerid']);
			console($_POST['formaction']);
			?>
			<script type="text/javascript">
				$(document).ready(function() {
					reSidebar();
					loadContent("navigation");
					errorBox('You are now logged in');
				});
			</script> 
			<?php
		}

		else {
			console("Login failed. The username or password you provided did not match", 1);
			require_once('loginform.php');
		}
}

elseif ((isset($_POST['user'])) && ($_POST['formaction'] == "register")) {

	if ((sha1($_POST['pass'])) != (sha1($_POST['pass-again']))) {
		echo "The passwords you entered do not match.";
	}
	
	if (empty($_POST['email'])) {
		echo "You must enter an email address to register.";
	}

	$username = mysql_escape_string($_POST['user']);
	$password = mysql_escape_string(sha1($_POST['pass']));
	$passwordAgain = mysql_escape_string(sha1($_POST['pass-again']));
	$email = mysql_escape_string($_POST['email']);
	
	$db = new ezSQL_mysql(DB_USER, DB_PASS, DB_NAME, DB_HOST);

	if ($db->get_row("SELECT * FROM ".TBL_PREFIX."user WHERE name=$username")) {
		echo "That username already exists!";
	}

	else {
	
	$sql = "INSERT INTO ".TBL_PREFIX."user (name, email, password, location_syst, location_spob, landed, fuel, jumping, eta, role, registered, government, credits, ship, vessel, attackable) VALUES('$username', '$email', '$password', 1, 1, 1, 10, 0, NULL, 'P', NOW(), 1, 1000000, 1, 'Unnamed Vessel', 1)";
		
		if ($db->query($sql)) {
			//console("Player ID: ".$_SESSION['playerid']);
			console($_POST['formaction']);
			require_once('loginform.php');
			?>
			<script type="text/javascript">
				$(document).ready(function() {
					errorBox('Registration successful. Please login.');
				});
			</script> 
			
			<?php
		}
		
	}

}

elseif(!isLoggedIn()) {
	require_once('loginform.php');
	require_once('registerform.php');
}

else {
	youAre();
}

