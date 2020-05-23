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
// App Root Folder (absolute path)
define('APPROOT', dirname(dirname(__FILE__)));
// Controllers Root Folder
define('CONTROLLERSROOT', APPROOT . DIRECTORY_SEPARATOR . 'controllers');
// Models Root Folder
define('MODELSROOT', APPROOT . DIRECTORY_SEPARATOR . 'models');
// Views Root Folder
define('VIEWSROOT', APPROOT . DIRECTORY_SEPARATOR . 'views');

/*** PUBLIC ***/
// Public Root Folder (absolute path)
define('PUBLICROOT', dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'public');
// Css Root Folder
define('CSSROOT', PUBLICROOT . DIRECTORY_SEPARATOR . 'css');
// Download Root Folder
define('DOWNLOADROOT', PUBLICROOT . DIRECTORY_SEPARATOR . 'download');
// Font Root Folder
define('FONTROOT', PUBLICROOT . DIRECTORY_SEPARATOR . 'font');
// Img Root Folder
define('IMGROOT', PUBLICROOT . DIRECTORY_SEPARATOR . 'img');
// Js Root Folder
define('JSROOT', PUBLICROOT . DIRECTORY_SEPARATOR . 'js');
// Video Root Folder
define('VIDEOROOT', PUBLICROOT . DIRECTORY_SEPARATOR . 'video');

/*** URL ***/
// URL Root*
define('URLROOT', 'http://localhost/bolkun');
// URL Base (actual page)
define('URLCURRENT', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
// Site Name*
define('SITENAME', 'Bolkun');
// Start Page* (Hint: libraries/Core.php calls controllers/Users/index() and method calls login())
define('STARTPAGE', 'Users');
// App version*
define('APPVERSION', '1.0.2');

/*** GLOBALS ***/
$aPagesPaths = array();
$aPagesLinks = array();
