<?php

class Menu
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function selectMainMenuData()
    {
        $this->db->query('SELECT * FROM main_menu');

        $row = $this->db->resultSet();

        if (empty($row)) {
            return false;
        } else {
            return $row;
        }
    }

}
