<?php
# get_declared_classes : array

/**
 * @goal   get class name
 * @param  object           @example $oBox = new Box();
 * @return string | false   @example Box
 */
function getClassName($object){
    return get_class($object);
}

/**
 * @goal   check if function exists in class
 * @param  object | string, string   @example Costs, search
 * @return bool                      @example true
 */
function checkIfFunctionExistsInClass($object, $methodName){
    return method_exists($object, $methodName);
}