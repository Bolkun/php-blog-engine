<?php
/**
 * @goal   simple page redirection
 * @param  string $page @example users/login
 * @result              @example http://localhost/bolkun/users/login
 */
function redirect($page){
    header('location: ' . URLROOT . '/' . $page);
}

/**
 * @goal   get first directory after URLROOT from link
 * @param  string $link @example http://localhost/bolkun/users/login
 * @return string       @example users
 */
function getFirstDirAfterURLROOT($link){
    // delete URLROOT
    $link = str_replace(URLROOT . '/', '', $link);
    // grep folder (everything till first forward slash)
    preg_match('/^([^\/]+)/', $link, $dir);     // returns array

    return $dir[0];
}
