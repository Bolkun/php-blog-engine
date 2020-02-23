<?php
// IMPORTANT! rewrite .htaccess for production (RewriteBase /bolkun/public to /public)
// DB Params
define('DB_HOST', 'localhost');
define('DB_USER', 'root');                      // user
define('DB_PASS', '');                          // pass
define('DB_NAME', '$bolkun_taskmanager');       // name

// App Root Folder
define('APPROOT', dirname(dirname(__FILE__))); // do not show to last files
// URL Root
define('URLROOT', 'http://localhost/bolkun');
// URL Base
define('URLBASE', "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']);
// Site Name
define('SITENAME', 'Bolkun');
// Start Page (libraries/Core.php controllers/Users/index())
define('STARTPAGE', 'Users');
// App version
define('APPVERSION', '1.0.2');
// Pages list
$aPAGES_location = array();
$aPAGES_links = array();

// Automation echo CONTROLLERS['dashboards'];
/*define('CONTROLLERS', array(
    "calenders"=>"Calenders",
    "costs"=>"Costs",
    "dashboards"=>"Dashboards",
    "documents"=>"Documents",
    "tasks"=>"Tasks",
    "tests"=>"Tests",
    "users"=>"Users",
));
define('MODELS', array(
    "calender"=>"Calender",
    "cost"=>"Cost",
    "dashboard"=>"Dashboard",
    "document"=>"Document",
    "task"=>"Task",
    "test"=>"Test",
    "user"=>"User",
));*/