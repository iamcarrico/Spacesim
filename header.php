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
</style>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

</head>
<body>


<?php 

if ((isset($_POST['user'])) && (isset($_POST['user']))) {
	
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
			console("Player ID: ".$_SESSION['playerid']);?>
			<script type="text/javascript">
				$(document).ready(function() {
					reSidebar();
				});
			</script> 
			<?php
		}

		else {
			console("Login failed. The username or password you provided did not match", 1);
			require_once('loginform.php');
		}
} 

elseif(!isLoggedIn()) {
	require_once('loginform.php');
}

else {
	youAre();
}

