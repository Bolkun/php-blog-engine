<?php
/**
 * @goal   convert mysql date to string datetime
 * @link   https://www.php.net/manual/ru/function.date.php
 * @param  string $sDate @example 2019-04-09 06:30:00
 * @return string        @example 09.04.2019 06:30:00
 */
function benchmark_prepare()
{
    // preparation
    $i   = 0;
    $tmp = '';
    while($i < 10000) {
        $tmp = 'a';
        ++$i;
    }
    return array_fill(0, 100000, $tmp);
}

/**
 * @goal   get array size
 * @param  array
 * @return integer
 */
function getArraySize($array){
    return count($array);
}