<?php
# get_defined_functions() : array

/**
 * @goal   check if function exists
 * @param  string   @example is_bool;
 * @return bool     @example true
 */
function checkIfFunctionExists($functionName){
    return function_exists($functionName);
}

