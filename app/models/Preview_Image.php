<?php

class Preview_Image
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function select()
    {
        $this->db->query("SELECT * FROM preview_image ORDER BY creation_date DESC");

        $row = $this->db->resultSet();

        if (empty($row)) {
            return false;
        } else {
            return $row;
        }
    }

    public function insertPreviewImage($data)
    {
        $this->db->query('INSERT INTO preview_image (created_by_user_id, preview_image) VALUES (:created_by_user_id, :preview_image)');
        $this->db->bind(':created_by_user_id', $_SESSION['user_id']);
        $this->db->bind(':preview_image', $data['preview_image']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deletePreviewImage($preview_image)
    {
        $this->db->query("DELETE FROM preview_image WHERE preview_image = :preview_image");
        $this->db->bind(':preview_image', $preview_image);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

}