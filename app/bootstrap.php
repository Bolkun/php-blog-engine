<?php
/*
 * Autoload Config
 */
$aConfigs = scandir(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'config');
// deleting . and .. dirs out of the array
$aConfigs = array_diff($aConfigs, array('.', '..'));
// load config files
foreach ($aConfigs as $config) {
    if (preg_match("/^.*\.php$/", $config)) {
        require_once 'config' . DIRECTORY_SEPARATOR . $config;
    }
}
unset($aConfigs);

/*
 * Autoload Helpers
 */
$aHelpers = scandir(APPROOT . DIRECTORY_SEPARATOR . 'helpers');
// deleting . and .. dirs out of the array
$aHelpers = array_diff($aHelpers, array('.', '..'));
// load helper files
foreach ($aHelpers as $helper) {
    if (preg_match("/^.*_helper\.php$/", $helper)) {
        require_once 'helpers' . DIRECTORY_SEPARATOR . $helper;
    }
}
unset($aHelpers);

/*
 * Autoload Core Libraries
 */
spl_autoload_register(function ($className) {
    require_once 'libraries/' . $className . '.php';
});
