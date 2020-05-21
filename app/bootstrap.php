<?php
// Load Config
require_once 'config/config.php';

// Load Helpers
$aHelpers = scandir(APPROOT . DIRECTORY_SEPARATOR . 'helpers');
# filtering dots out of the array
$aHelpers = array_diff($aHelpers, array('.', '..'));
# load helper files
foreach ($aHelpers as $helper){
    require_once 'helpers' . DIRECTORY_SEPARATOR . $helper;
}

// Autoload Core Libraries
spl_autoload_register(function($className){
    require_once 'libraries/' . $className . '.php';
});
