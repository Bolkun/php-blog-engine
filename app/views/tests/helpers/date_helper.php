<?php

echo "------------------------------------------------------------------------------------------------------------<br>";
echo 'Date tests<br>';
echo "------------------------------------------------------------------------------------------------------------<br>";
$formatDateTime = formatDateTime('2019-04-09 06:30:00');
if(gettype($formatDateTime) === 'string'){
    echo 'OK      check return type string, \'2019-04-09 06:30:00\'<br>';
} else {
    echo 'FAILED: check return type string, \'2019-04-09 06:30:00\' expected string. Got ' . gettype($formatDateTime) . '<br>';
}
if($formatDateTime === '09.04.2019 06:30:00'){
    echo 'OK      check return value \'09.04.2019 06:30:00\'<br>';
} else {
    echo 'FAILED: check return value \'09.04.2019 06:30:00\'. Got ' . $formatDateTime . '<br>';
}
echo "------------------------------------------------------------------------------------------------------------<br>";
$formatDate = formatDate('2019-04-09 06:30:00');
if($formatDate === '09.04.2019'){
    echo 'OK      check return value \'09.04.2019\'<br>';
} else {
    echo 'FAILED: check return value \'09.04.2019\'. Got ' . $formatDate . '<br>';
}
echo "------------------------------------------------------------------------------------------------------------<br>";
$formatTime = formatTime('2019-04-09 06:30:00');
if($formatTime === '06:30:00'){
    echo 'OK      check return value \'06:30:00\'<br>';
} else {
    echo 'FAILED: check return value \'06:30:00\'. Got ' . $formatTime . '<br>';
}
echo "------------------------------------------------------------------------------------------------------------<br>";
$formatDay = formatDay('2019-04-09 06:30:00');
if($formatDay === '09'){
    echo 'OK      check return value \'09\'<br>';
} else {
    echo 'FAILED: check return value \'09\'. Got ' . $formatDay . '<br>';
}
echo "------------------------------------------------------------------------------------------------------------<br>";
$formatDayNameShort = formatDayNameShort('2019-04-09 06:30:00');
if($formatDayNameShort === 'Tue'){
    echo 'OK      check return value \'Tue\'<br>';
} else {
    echo 'FAILED: check return value \'Tue\'. Got ' . $formatDayNameShort . '<br>';
}
echo "------------------------------------------------------------------------------------------------------------<br>";
$formatDayNameLong = formatDayNameLong('2019-04-09 06:30:00');
if($formatDayNameLong === 'Tuesday'){
    echo 'OK      check return value \'Tuesday\'<br>';
} else {
    echo 'FAILED: check return value \'Tuesday\'. Got ' . $formatDayNameLong . '<br>';
}
echo "------------------------------------------------------------------------------------------------------------<br>";
$formatWeekNumber = formatWeekNumber('2019-04-09 06:30:00');
if($formatWeekNumber === '15'){
    echo 'OK      check return value \'15\'<br>';
} else {
    echo 'FAILED: check return value \'15\'. Got ' . $formatWeekNumber . '<br>';
}
echo "------------------------------------------------------------------------------------------------------------<br>";
$formatMonth = formatMonth('2019-04-09 06:30:00');
if($formatMonth === '04'){
    echo 'OK      check return value \'04\'<br>';
} else {
    echo 'FAILED: check return value \'04\'. Got ' . $formatMonth . '<br>';
}
echo "------------------------------------------------------------------------------------------------------------<br>";
$formatMonthNameLong = formatMonthNameLong('2019-04-09 06:30:00');
if($formatMonthNameLong === 'April'){
    echo 'OK      check return value \'April\'<br>';
} else {
    echo 'FAILED: check return value \'April\'. Got ' . $formatMonth . '<br>';
}
echo "------------------------------------------------------------------------------------------------------------<br>";
$formatMonthNameShort = formatMonthNameShort('2019-04-09 06:30:00');
if($formatMonthNameShort === 'Apr'){
    echo 'OK      check return value \'Apr\'<br>';
} else {
    echo 'FAILED: check return value \'Apr\'. Got ' . $formatMonthNameShort . '<br>';
}
echo "------------------------------------------------------------------------------------------------------------<br>";
$formatYear = formatYear('2019-04-09 06:30:00');
if($formatYear === '2019'){
    echo 'OK      check return value \'2019\'<br>';
} else {
    echo 'FAILED: check return value \'2019\'. Got ' . $formatYear . '<br>';
}
echo "------------------------------------------------------------------------------------------------------------<br>";
