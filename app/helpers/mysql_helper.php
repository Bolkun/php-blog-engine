<?php

function select($SELECT, $FROM, $WHERE){
    $this->db->query('SELECT *, COUNT(*) AS rowCount FROM cost WHERE `year` = :year');
    /*
     SELECT * FROM cost WHERE `year` = 2020;
     */
    $this->db->bind(':year', $year);

    $row = $this->db->resultSet();

    return $row;
}

// SELECT
// SELECT DISTINCT Country FROM Customers; //Inside a table, a column often contains many duplicate values; and sometimes you only want to list the different (distinct) values.

// WHERE
//WHERE Country='Mexico';
/*
=	Equal
>	Greater than
<	Less than
>=	Greater than or equal
<=	Less than or equal
<>	Not equal. Note: In some versions of SQL this operator may be written as !=
BETWEEN	Between a certain range
LIKE	Search for a pattern
                   IN	To specify multiple possible values for a column
    */