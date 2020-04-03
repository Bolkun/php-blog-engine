<?php
/**
 * @goal   get array size
 * @param  array
 * @return integer
 */
function getArraySize($array)
{
    return count($array);
}

/**
 * @goal   get all keys of an array
 * @param  array|array associative, string|integer, bool
 * @return array
 */
function getArrayKeys($array, $search_value = NULL, $strict = false)
{
    if($search_value != NULL){
        // return keys of specific value
        return array_keys($array, $search_value, $strict);
    } else {
        return array_keys($array);
    }
}