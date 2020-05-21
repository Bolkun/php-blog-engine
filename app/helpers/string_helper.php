<?php
/**
 * @goal   get length of a string
 * @param  string  @example Hello World!
 * @return int     @example 12
 */
function getLengthOfString($string)
{
    return strlen($string);
}

/**
 * @goal   get counted words
 * @param  string  @example Hello World!
 * @return int     @example 2
 */
function getCountedWords($string)
{
    return str_word_count($string);
}

/**
 * @goal   get reverse string
 * @param  string  @example Hello World!
 * @return string  @example !dlroW olleH
 */
function getReverseString($string)
{
    return strrev($string);
}

/**
 * @goal   set first character of a string to uppercase
 * @param  string   @example hello world!
 * @return string   @example Hello world!
 */
function setFistCharUppercase($string)
{
    return ucfirst($string);
}

/**
 * @goal   set first character of a string to lowercase
 * @param  string   @example Hello world!
 * @return string   @example hello world!
 */
function setFistCharLowercase($string)
{
    return lcfirst($string);
}

/**
 * @goal   set first character of each word to uppercase
 * @param  string   @example hello world!
 * @return string   @example Hello World!
 */
function setFistCharForEachWordUppercase($string)
{
    return ucwords($string);
}

/**
 * @goal   set all characters to uppercase
 * @param  string   @example Hello WORLD!
 * @return string   @example HELLO WORLD!
 */
function setAllCharsUppercase($string)
{
    return strtoupper($string);
}

/**
 * @goal   set all characters to lowercase
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
function deleteCharsInStringBasedOnPosition($string, $iPosition)
{
    return substr_replace($string ,"", $iPosition);
}

/**
 * @goal   replace string match with another string
 * @param  string | array, string | array, string | array   @example World, User, Hello World!
 * @return string | array                                   @example Hello User!
 */
function replaceString($search, $replace, $text)
{
    return str_replace($search, $replace, $text);
}

/**
 * @goal   check if string match regex (https://www.regextester.com/)
 * @param  string, string   @example /^.*_helper.php$/, date_helper.php
 * @return bool             @example true
 */
function checkIfStringMatchRegex($regex, $string){
    if(preg_match($regex, $string)){
        return true;
    } else {
        return false;
    }
}