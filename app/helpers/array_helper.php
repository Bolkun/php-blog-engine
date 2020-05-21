<?php
/**
 * @goal   get array size
 * @param  array|array associative  @example array('Peter'=>35, 'Ben'=>37, 'Joe'=>43)
 * @return integer                  @example 3
 */
function getArraySize($array)
{
    return count($array);
}

/**
 * @goal   get all keys of an array
 * @param  array|array associative, string|integer, bool    @example array('Peter'=>35, 'Ben'=>37, 'Joe'=>43)
 * @return array                                            @example array([0] => 'Peter', [1] => 'Ben', [2] => 'Joe')
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

/**
 * @goal   get all values of an array
 * @param  array|array associative  @example array('Peter'=>35, 'Ben'=>37, 'Joe'=>43)
 * @return array                    @example array([0] => '35', [1] => '37', [2] => '43')
 */
function getArrayValues($array)
{
    return array_values($array);
}

/**
 * @goal   reset array keys from 0 to n
 * @param  array|array associative  @example array('Peter'=>35, 'Ben'=>37, 'Joe'=>43)
 * @return array                    @example array([0] => '35', [1] => '37', [2] => '43')
 */
function resetArrayKeys($array){
    $start = 0;
    $aNew = array();
    foreach ($array as $key => $val){
        $aNew[$start] = $val;
        $start++;
    }
    return $aNew;
}
