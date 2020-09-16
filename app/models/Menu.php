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
        $this->db->query('SELECT * FROM main_menu ORDER BY title ASC');

        $row = $this->db->resultSet();

        if (empty($row)) {
            return false;
        } else {
            return $row;
        }
    }

    public function searchMainMenu($data)
    {
        $this->db->query("SELECT * FROM main_menu WHERE title LIKE '%" . $data['search'] . "%' ORDER BY title ASC");

        $row = $this->db->resultSet();

        if (empty($row)) {
            return false;
        } else {
            return $row;
        }
    }

    public function insertNode($data)
    {
        $this->db->query('INSERT INTO main_menu (title, parent_id) VALUES (:title, :parent_id)');
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':parent_id', $data['parent_id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateTitle($data)
    {
        $this->db->query('UPDATE main_menu SET title = :title WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteBranch($aIds)
    {
        $ids = implode("','", $aIds);

        $this->db->query("DELETE FROM main_menu WHERE id IN ('".$ids."')");

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

}
