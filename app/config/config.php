<?php
// IMPORTANT*: rewrite .htaccess for production (RewriteBase /bolkun/public to /public)

/*** DB ***/
define('DB_HOST', 'localhost');
// User*
define('DB_USER', 'root');
// Pass*
define('DB_PASS', '');
// Name*
define('DB_NAME', '$bolkun_taskmanager');

/*** APP ***/
// App Root Folder (Hint: do not show to last files C:\xampp\htdocs\bolkun\app)
define('APPROOT', dirname(dirname(__FILE__)));
// Views Root Folder (Hint: C:\xampp\htdocs\bolkun\app\views)
define('VIEWSROOT', APPROOT . DIRECTORY_SEPARATOR . 'views');
// URL Root*
define('URLROOT', 'http://localhost/bolkun');
// URL Base
define('URLBASE', "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']);
// Site Name*
define('SITENAME', 'Bolkun');
// Start Page* (Hint: libraries/Core.php calls controllers/Users/index() and method calls login())
define('STARTPAGE', 'Users');
// App version*
define('APPVERSION', '1.0.2');

/*** GLOBALS ***/
$aPagesPaths = array();
$aPagesLinks = array();
// Actual page
$GLOBALS['sACTUAL_LINK'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
