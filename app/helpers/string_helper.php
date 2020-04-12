<?php
/**
 * @goal   convert the first character of a string to uppercase
 * @param  string   @example hello world!
 * @return string   @example Hello world!
 */
function setFistCharUppercase($string)
{
    return ucfirst($string);
}

/**
 * @goal   convert the first character of a string to lowercase
 * @param  string   @example Hello world!
 * @return string   @example hello world!
 */
function setFistCharLowercase($string)
{
    return lcfirst($string);
}

/**
 * @goal   convert the first character of each word to uppercase
 * @param  string   @example hello world!
 * @return string   @example Hello World!
 */
function setFistCharAllWordsUppercase($string)
{
    return ucwords($string);
}

/**
 * @goal   convert all characters to uppercase
 * @param  string   @example Hello WORLD!
 * @return string   @example HELLO WORLD!
 */
function setAllCharsUppercase($string)
{
    return strtoupper($string);
}

/**
 * @goal   convert all characters to lowercase
 * @param  string   @example Hello WORLD!
 * @return string   @example hello world!
 */
function setAllCharsLowercase($string)
{
    return strtolower($string);
}

/**
 * @goal   delete chars of a string based on it's position
 * @param  string, int  @example Hello World!, -1
 * @return string       @example Hello World
 */
function deleteCharsInStringBasedOnPosition($string, $position)
{
    return substr_replace($string ,"", $position);
}