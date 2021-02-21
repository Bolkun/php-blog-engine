<?php

/**
 * @goal   check if string contains a specific word
 * @param  string, string   @example How are you?, are
 * @return bool             @example true
 */
function checkIfStringHasWord($string, $word)
{
    if (strpos($string, $word)) {
        return true;
    } else {
        return false;
    }
}
