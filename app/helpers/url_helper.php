<?php

/**
 * @goal   simple page redirection
 * @param  string $sPaga @example users/login
 * @result               @example http://localhost/bolkun/users/login
 */
function redirect($sPage){
    header('location: ' . URLROOT . '/' . $sPage);
}