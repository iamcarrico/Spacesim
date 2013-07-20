<?php
date_default_timezone_set('UTC');

//Database access credentials
define('DB_NAME', 'REPLACE ME');
define('DB_USER', 'REPLACE ME');
define('DB_PASS', 'REPLACE ME');
define('DB_HOST', 'localhost');


//Database table prefix
define('TBL_PREFIX', 'ssim_');

//Debug flag
define('SSIM_DEBUG', 'true');

//MySQL database class
require_once('inc/ez_sql_core.php');
require_once('inc/ez_sql_mysql.php');

//Game Settings
define('GAME_NAME', 'Space Sim');

//Debugger function
function console($msg) {
	echo '<script type="text/javascript">';
	echo "console.log(\"". $msg ."\");";
	echo '</script>';
}