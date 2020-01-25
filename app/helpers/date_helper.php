<?php
// Check more https://www.php.net/manual/ru/function.date.php
/*
 * Params: (MySQL String) Example: 2019-04-09 06:30:00
 * Return: (String) Example: 09.04.2019 06:30:00
 */
function formatDateTime($date)
{
    $date = new DateTime($date);
    return $date->format("d.m.Y H:i:s");
}

/*
 * Params: (MySQL) Example: 2019-04-09 06:30:00
 * Return: (String) Example: 09.04.2019
 */
function formatDate($date)
{
    $date = new DateTime($date);
    return $date->format("d.m.Y");
}

/*
 * Params: (MySQL) Example: 2019-04-09 06:30:00
 * Return: (String) Example: 06:30:00
 */
function formatTime($date)
{
    $date = new DateTime($date);
    return $date->format("H:i:s");
}

/*
 * Params: (MySQL String) Example: 2019-04-09 06:30:00
 * Return: (String) Example: 09
 */
function formatDay($date)
{
    $date = new DateTime($date);
    return $date->format("d");
}

/*
 * Params: (MySQL String) Example: 2019-04-09 06:30:00
 * Return: (String) Example: Tus
 */
function formatDayNameShort($date)
{
    $date = new DateTime($date);
    return $date->format("D");
}

/*
 * Params: (MySQL String) Example: 2019-04-09 06:30:00
 * Return: (String) Example: Tuesday
 */
function formatDayNameLong($date)
{
    $date = new DateTime($date);
    return $date->format("l");
}

/*
 * Params: (MySQL String) Example: 2019-04-09 06:30:00
 * Return: (String) Example: 15
 */
function formatWeekNumber($date)
{
    $date = new DateTime($date);
    return $date->format("W");
}

/*
 * Params: (MySQL String) Example: 2019-04-09 06:30:00
 * Return: (String) Example: 04
 */
function formatMonth($date)
{
    $date = new DateTime($date);
    return $date->format("m");
}

/*
 * Params: (MySQL String) Example: 2019-04-09 06:30:00
 * Return: (String) Example: April
 */
function formatMonthNameLong($date)
{
    $date = new DateTime($date);
    return $date->format("F");
}

/*
 * Params: (MySQL String) Example: 2019-04-09 06:30:00
 * Return: (String) Example: Apr
 */
function formatMonthNameShort($date)
{
    $date = new DateTime($date);
    return $date->format("M");
}

/*
 * Params: (MySQL String) Example: 2019-04-09 06:30:00
 * Return: (String) Example: 2019
 */
function formatYear($date)
{
    $date = new DateTime($date);
    return $date->format("Y");
}