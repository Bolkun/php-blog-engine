<?php

class Cost
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    //Param: string
    public function selectCosts($year)
    {
        $this->db->query('SELECT * FROM cost WHERE `year` = :year');
        /*
        SELECT * FROM cost WHERE `year` = 2020;
         */
        $this->db->bind(':year', $year);

        $row = $this->db->resultSet();

        if (!empty($row)) {
            // add new key value to object in array[0]
            $row[0]->rowCount = $this->db->rowCount();
        } else {
            // NULL, than build default array of object and
            // add new key value to object in array[0]
            $row = array();
            $row[0] = new \stdClass();
            $row[0]->rowCount = 0;
        }

        return $row;
    }

    //Param: associative array
    public function searchCosts($data)
    {
        if (empty($data)) {
            // no data, than select all
            $sWhere = "";
        } else {
            // than select all with where condition
            $sWhere = 'WHERE ';
            foreach ($data as $key => $value) {
                // overwrite keys as table names and fill value
                $change_key = str_replace("costs", "", $key);
                $new_key = strtolower($change_key);
                $data[$new_key] = $value;
                // delete old keys
                unset($data[$key]);
            }
            // conditions for each array element
            if (array_key_exists("price", $data)) {
                $data['price'] = "price = '" . $data['price'] . "'";
            }
            if (array_key_exists("title", $data)) {
                $data['title'] = "title LIKE '%" . $data['title'] . "%'";
            }
            if (array_key_exists("year", $data)) {
                $data['year'] = "year = '" . $data['year'] . "'";
            }
            if (array_key_exists("january", $data)) {
                $data['january'] = "january = '" . $data['january'] . "'";
            }
            if (array_key_exists("february", $data)) {
                $data['february'] = "february = '" . $data['february'] . "'";
            }
            if (array_key_exists("march", $data)) {
                $data['march'] = "march = '" . $data['march'] . "'";
            }
            if (array_key_exists("april", $data)) {
                $data['april'] = "april = '" . $data['april'] . "'";
            }
            if (array_key_exists("may", $data)) {
                $data['may'] = "may = '" . $data['may'] . "'";
            }
            if (array_key_exists("june", $data)) {
                $data['june'] = "june = '" . $data['june'] . "'";
            }
            if (array_key_exists("july", $data)) {
                $data['july'] = "july = '" . $data['july'] . "'";
            }
            if (array_key_exists("august", $data)) {
                $data['august'] = "august = '" . $data['august'] . "'";
            }
            if (array_key_exists("september", $data)) {
                $data['september'] = "september = '" . $data['september'] . "'";
            }
            if (array_key_exists("october", $data)) {
                $data['october'] = "october = '" . $data['october'] . "'";
            }
            if (array_key_exists("november", $data)) {
                $data['november'] = "november = '" . $data['november'] . "'";
            }
            if (array_key_exists("december", $data)) {
                $data['december'] = "december = '" . $data['december'] . "'";
            }
            //pack all to string
            $sWhere .= implode(' AND ', $data);
        }

        $this->db->query('SELECT * FROM cost ' . $sWhere);
        /*
         SELECT * FROM cost WHERE title LIKE '%mie%';
         */
        $row = $this->db->resultSet();

        if (!empty($row)) {
            // add new key value to object in array[0]
            $row[0]->rowCount = $this->db->rowCount();
        } else {
            // NULL, than build default array of object and
            // add new key value to object in array[0]
            $row = array();
            $row[0] = new \stdClass();
            $row[0]->rowCount = 0;
        }

        return $row;
    }

    //Param: associative array
    public function editCosts($data)
    {
        //Array ( [price] => 232 [title] => Miete [year] => 2020 [MONTH] => january [STATUS] => paid )
        $data['category'] = "household";
        $data['type'] = "2";
        $data['repeated'] = "1";

        // check if [MONTH] not NULL
        $this->db->query("SELECT * FROM cost WHERE created_by_user_id = '". $_SESSION['user_id'] ."' AND category = '". $data['category'] ."' 
        AND `type` = '". $data['type'] ."' AND price = '". $data['price'] ."' AND title = '". $data['title'] ."' AND repeated = '". $data['repeated'] ."'
         AND `year` = '". $data['year'] ."' AND " . $data['MONTH'] ." != ''");
        /*
         * SELECT * FROM cost WHERE created_by_user_id = "1" AND category = "household" AND `type` = "2" AND price = "232" AND title = "Miete" AND repeated = "1" AND year = "2020" AND january = "paid";
         * SELECT * FROM cost WHERE created_by_user_id = "1" AND category = "household" AND `type` = "2" AND price = "232" AND title = "Miete" AND repeated = "1" AND year = "2020" AND january != '';
         */
        $row = $this->db->resultSet();

        //is null, than insert
        //not null, than update
        if (empty($row)) {
            $this->db->query("INSERT INTO cost (created_by_user_id, category, `type`, price, title, repeated, `year`, " . $data['MONTH'] . ")
                               VALUES (:created_by_user_id, :category, :type, :price, :title, :repeated, :year, :" . $data['MONTH'] . ")");
            // Bind values
            $this->db->bind(':created_by_user_id', $_SESSION['user_id']);
            $this->db->bind(':category', $data['category']);
            $this->db->bind(':type', $data['type']);
            $this->db->bind(':price', $data['price']);
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':repeated', $data['repeated']);
            $this->db->bind(':year', $data['year']);
            $this->db->bind(":".$data['MONTH'], $data['STATUS']);
        } else {
            $this->db->query("UPDATE cost SET created_by_user_id = :created_by_user_id, category = :category, 
                                                   `type` = :type, price = :price, title = :title, repeated = :repeated,
                                                    `year` = :year, " . $data['MONTH'] . " = :" . $data['MONTH'] . " WHERE cost_id = " . $row[0]->cost_id);
            // Bind values
            $this->db->bind(':created_by_user_id', $_SESSION['user_id']);
            $this->db->bind(':category', $data['category']);
            $this->db->bind(':type', $data['type']);
            $this->db->bind(':price', $data['price']);
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':repeated', $data['repeated']);
            $this->db->bind(':year', $data['year']);
            $this->db->bind(":".$data['MONTH'], $data['STATUS']);
        }
        // Execute insert or update
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //Param: associative array
    public function deleteCosts($data){
        $this->db->query("DELETE FROM cost WHERE cost_id = :cost_id");
        // Bind values
        $this->db->bind(':cost_id', $data['cost_id']);
        // Execute delete
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}