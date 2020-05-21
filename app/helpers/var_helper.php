<?php
# print_r() : string
# get_defined_vars() : array
# get_defined_constants() : array
# is_array() : bool
# is_bool() : bool
# is_float() : bool
# is_int() : bool
# is_long() : bool
# is_null() : bool
# is_numeric() : bool
# is_object() : bool
# is_string() : bool
# is_infinite() : bool
# is_nan() : bool

/**
 * @goal   get data type of a variable
 * @param  mixed     @example Hello
 * @return string    @example string
 */
function getVarType($var){
    return gettype($var);
}

/**
 * @goal   set data type of a variable
 * @param  mixed, string    @example 5bar, int
 * @return bool             @example true (var is now 5)
 */
function setVarType($var, $type){
    // Hint: types can be "bool", "int", "float", "string", "array", "object", "null"
    return settype($var, $type);
}

/**
 * @goal   print data type of a variable
 * @param  mixed                    @example 5985
 * @result prints [type](value)     @example int(5985)
 */
function printVarType($var){
    var_dump($var);
}