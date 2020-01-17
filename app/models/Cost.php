<?php

class Cost
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function selectCosts($year)
    {
        $this->db->query('SELECT * FROM cost WHERE `year` = :year');
        /*
        SELECT * FROM cost WHERE `year` = 2020;
         */
        $this->db->bind(':year', $year);

        $row = $this->db->resultSet();

        if(!empty($row)){
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

    public function searchCosts($data)
    {
        $where = 'WHERE';
        if(empty($data['costsPrice']) && empty($data['costsTitle']) && empty($data['costsYear'])){
            $where = "";
        }
        if(!empty($data['costsPrice'])) $where .= " price = :price";

        $this->db->query('SELECT *, COUNT(*) AS rowCount FROM cost ' . $where);
        /*
         SELECT *, COUNT(*) AS rowCount FROM cost WHERE price = 232;
         */
        if(!empty($data['costsPrice'])) $this->db->bind(':price', $data['costsPrice']);

        $row = $this->db->resultSet();

        return $row;
    }

    public function insertCosts($data)
    {
        $this->db->query('INSERT INTO cost (created_by_user_id, category, `type`, price, title, repeated, `year`, january, february, march, april, may, june, july, august, september, october, november, december) 
                               VALUES (:created_by_user_id, :category, :type, :price, :title, :status, :repeated, :year, :january, :february, :march, :april, :may, :june, :july, :august, :september, :october, :november, :december)');
        /*
         INSERT INTO cost (created_by_user_id, category, `type`, price, title, repeated, year, january)
         VALUES (1, 'household', 2, 232, 'Miete', 1, 2020, 1);
        INSERT INTO cost (created_by_user_id, category, `type`, price, title, repeated, year, january)
         VALUES (1, 'household', 2, 16, 'Strom', 1, 2020, 1);
         */
        // Bind values
        $this->db->bind(':created_by_user_id', $data['created_by_user_id']);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':repeated', $data['repeated']);
        $this->db->bind(':year', $data['year']);
        $this->db->bind(':january', $data['january']);
        $this->db->bind(':february', $data['february']);
        $this->db->bind(':march', $data['march']);
        $this->db->bind(':april', $data['april']);
        $this->db->bind(':may', $data['may']);
        $this->db->bind(':june', $data['june']);
        $this->db->bind(':july', $data['july']);
        $this->db->bind(':august', $data['august']);
        $this->db->bind(':september', $data['september']);
        $this->db->bind(':october', $data['october']);
        $this->db->bind(':november', $data['november']);
        $this->db->bind(':december', $data['december']);

        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
}