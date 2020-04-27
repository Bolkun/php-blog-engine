<?php
/**
 * @goal   get all pages paths based on a folder tree structure
 * @param  string $path @example C:\xampp\htdocs\bolkun\app\views
 * @return array
 */
function getPagesPaths($path){
    global $aPagesPaths;
    $aFolderFiles = scandir($path);

    unset($aFolderFiles[array_search('.',  $aFolderFiles, true)]);
    unset($aFolderFiles[array_search('..', $aFolderFiles, true)]);
    unset($aFolderFiles[array_search('inc', $aFolderFiles, true)]);
    unset($aFolderFiles[array_search('admins', $aFolderFiles, true)]);
    unset($aFolderFiles[array_search('users', $aFolderFiles, true)]);
    unset($aFolderFiles[array_search('dashboards', $aFolderFiles, true)]);

    if(count($aFolderFiles) < 1) return;
    foreach($aFolderFiles as $value){
        if(is_dir($path . DIRECTORY_SEPARATOR . $value)){
            // look for files and dirs deeper
            getPagesPaths($path . DIRECTORY_SEPARATOR . $value);
        }
        if(is_file($path . DIRECTORY_SEPARATOR . $value)){
            array_push($aPagesPaths, $path . DIRECTORY_SEPARATOR . $value);
        }
    }

    return $aPagesPaths;
}

/**
 * @goal   get all pages links based on a folder tree structure
 * @param  string $path @example C:\xampp\htdocs\bolkun\app\views
 * @return array
 */
function getPagesLinks($path){
    global $aPagesLinks;
    $aFolderFiles = scandir($path);

    unset($aFolderFiles[array_search('.',  $aFolderFiles, true)]);
    unset($aFolderFiles[array_search('..', $aFolderFiles, true)]);
    unset($aFolderFiles[array_search('inc', $aFolderFiles, true)]);
    unset($aFolderFiles[array_search('admins', $aFolderFiles, true)]);
    unset($aFolderFiles[array_search('users', $aFolderFiles, true)]);
    unset($aFolderFiles[array_search('dashboards', $aFolderFiles, true)]);

    if(count($aFolderFiles) < 1) return;
    foreach($aFolderFiles as $value){
        if(is_dir($path . DIRECTORY_SEPARATOR . $value)){
            getPagesLinks($path . DIRECTORY_SEPARATOR . $value);
        } else {
            // convert $path to link
            // (1) replace "\" with "/"
            $link = str_replace('\\', '/', $path);
            // (2) delete everything before "views"
            $link = strstr($link, 'views');
            // (3) delete "views/"
            $link = preg_replace('/views/', '', $link);
            if($value != 'index.php'){
                // (4) add file.php
                $link = $link . '/' . $value;
                // (5) remove '.php'
                $link = str_replace('.php', '', $link);
            }
            array_push($aPagesLinks, URLROOT . $link);
        }
    }

    return $aPagesLinks;
}

