<?php

/**
 * @goal   reset array keys from 0 to n
 * @param  array|array associative  @example array('Peter'=>35, 'Ben'=>37, 'Joe'=>43)
 * @return array                    @example array([0]=>35, [1]=>37, [2]=>43)
 */
function resetArrayKeys($array)
{
    $start = 0;
    $aNew = array();

    foreach ($array as $key => $val) {
        $aNew[$start] = $val;
        $start++;
    }

    return $aNew;
}

/**
 * @goal   merge two associative arrays in one, where values of the first array will be replaced by the second array
 * @param  array associative, array associative  @example array('Peter'=>35, 'Ben'=>37), array('Peter'=>6)
 * @return array associative                     @example array('Peter'=>6, 'Ben'=>37)
 */
function mergeAsocArrays($aArray1, $aArray2)
{
    foreach ($aArray1 as $key1 => $val1) {
        foreach ($aArray2 as $key2 => $val2) {
            if ($key2 === $key1) {
                $aArray1[$key1] = $val2;
            }
        }
    }

    return $aArray1;
}
