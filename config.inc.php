<?php
ob_start();
error_reporting(0);
date_default_timezone_set("Asia/Kolkata");
// db_config.php
define('ROOT_DIR', dirname(__FILE__));
define('ROOT_URL', substr($_SERVER['PHP_SELF'], 0, - (strlen($_SERVER['SCRIPT_FILENAME']) - strlen(ROOT_DIR))));

$db_host = 'localhost';
$db_user = 'shub_tktfinder';
$db_password = 'tktfinder@123!'; 
$db_name = 'shub_ticketfinders'; 

?> 
