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
        $this->db->query('SELECT * FROM main_menu ORDER BY title');

        $row = $this->db->resultSet();

        if (empty($row)) {
            return false;
        } else {
            return $row;
        }
    }

    public function deleteBranch($aIds)
    {
        $ids = implode("','", $aIds);

        $this->db->query("DELETE FROM main_menu WHERE id IN ('".$ids."')");

        // Execute delete
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

}
