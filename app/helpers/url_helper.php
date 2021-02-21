<?php

/**
 * @goal   simple page redirection
 * @param  string $page @example users/login
 * @result              @example http://localhost/bolkun/users/login
 */
function redirect($page)
{
    header('location: ' . URLROOT . '/' . $page);
}
