<?php

/**
 * @goal   simple page redirection
 * @param  string $sPage @example users/login
 * @result               @example http://localhost/bolkun/users/login
 */
function redirect($sPage){
    header('location: ' . URLROOT . '/' . $sPage);
}