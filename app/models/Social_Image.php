<?php

class Social_Image
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function select()
    {
        $this->db->query("SELECT * FROM social_image ORDER BY creation_date DESC");

        $row = $this->db->resultSet();

        if (empty($row)) {
            return false;
        } else {
            return $row;
        }
    }

    public function insert($data)
    {
        $this->db->query('INSERT INTO social_image (created_by_user_id, image) VALUES (:created_by_user_id, :image)');
        $this->db->bind(':created_by_user_id', $_SESSION['user_id']);
        $this->db->bind(':image', $data['image']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($image)
    {
        $this->db->query("DELETE FROM social_image WHERE image = :image");
        $this->db->bind(':image', $image);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

}