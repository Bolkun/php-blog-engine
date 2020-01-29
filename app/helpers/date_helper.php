<?php
/**
 * @goal   convert mysql date to string datetime
 * @link   https://www.php.net/manual/ru/function.date.php
 * @param  string $sDate @example 2019-04-09 06:30:00
 * @return string       @example 09.04.2019 06:30:00
 */
function formatDateTime($sDate)
{
    $sDate = new DateTime($sDate);
    return $sDate->format("d.m.Y H:i:s");
}

/**
 * @goal   convert mysql date to string date
 * @link   https://www.php.net/manual/ru/function.date.php
 * @param  string $sDate @example 2019-04-09 06:30:00
 * @return string       @example 09.04.2019
 */
function formatDate($sDate)
{
    $sDate = new DateTime($sDate);
    return $sDate->format("d.m.Y");
}

/**
 * @goal   convert mysql date to string time
 * @link   https://www.php.net/manual/ru/function.date.php
 * @param  string $sDate @example 2019-04-09 06:30:00
 * @return string       @example 06:30:00
 */
function formatTime($sDate)
{
    $sDate = new DateTime($sDate);
    return $sDate->format("H:i:s");
}

/**
 * @goal   convert mysql date to string day number beginnend with zero
 * @link   https://www.php.net/manual/ru/function.date.php
 * @param  string $sDate @example 2019-04-09 06:30:00
 * @return string       @example 09
 */
function formatDay($sDate)
{
    $sDate = new DateTime($sDate);
    return $sDate->format("d");
}

/**
 * @goal   convert mysql date to string day of the week with 3 letters short
 * @link   https://www.php.net/manual/ru/function.date.php
 * @param  string $sDate @example 2019-04-09 06:30:00
 * @return string       @example Tus
 */
function formatDayNameShort($sDate)
{
    $sDate = new DateTime($sDate);
    return $sDate->format("D");
}

/**
 * @goal   convert mysql date to string day of the week full name
 * @link   https://www.php.net/manual/ru/function.date.php
 * @param  string $sDate @example 2019-04-09 06:30:00
 * @return string       @example Tuesday
 */
function formatDayNameLong($sDate)
{
    $sDate = new DateTime($sDate);
    return $sDate->format("l");
}

/**
 * @goal   convert mysql date to string week number of the year
 * @link   https://www.php.net/manual/ru/function.date.php
 * @param  string $sDate @example 2019-04-09 06:30:00
 * @return string       @example 15
 */
function formatWeekNumber($sDate)
{
    $sDate = new DateTime($sDate);
    return $sDate->format("W");
}

/**
 * @goal   convert mysql date to string month
 * @link   https://www.php.net/manual/ru/function.date.php
 * @param  string $sDate @example 2019-04-09 06:30:00
 * @return string       @example 04
 */
function formatMonth($sDate)
{
    $sDate = new DateTime($sDate);
    return $sDate->format("m");
}

/**
 * @goal   convert mysql date to string month full name
 * @link   https://www.php.net/manual/ru/function.date.php
 * @param  string $sDate @example 2019-04-09 06:30:00
 * @return string       @example April
 */
function formatMonthNameLong($sDate)
{
    $sDate = new DateTime($sDate);
    return $sDate->format("F");
}

/**
 * @goal   convert mysql date to string month name shorted to 3 letters
 * @link   https://www.php.net/manual/ru/function.date.php
 * @param  string $sDate @example 2019-04-09 06:30:00
 * @return string       @example Apr
 */
function formatMonthNameShort($sDate)
{
    $sDate = new DateTime($sDate);
    return $sDate->format("M");
}

/**
 * @goal   convert mysql date to string year
 * @link   https://www.php.net/manual/ru/function.date.php
 * @param  string $sDate @example 2019-04-09 06:30:00
 * @return string       @example 2019
 */
function formatYear($sDate)
{
    $sDate = new DateTime($sDate);
    return $sDate->format("Y");
}