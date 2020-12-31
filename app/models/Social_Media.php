<?php

class Social_Media
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function start()
    {
        $this->db->query("SELECT * FROM social_media");

        $row = $this->db->resultSet();

        if (empty($row)) {
            return false;
        } else {
            return $row;
        }
    }

    public function insertRecord($data)
    {
        $this->db->query('INSERT INTO social_media (name, link, image) VALUES (:name, :link, :image)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':link', $data['link']);
        $this->db->bind(':image', $data['image']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function replaceImageMatchesWithDefaultImage($image)
    {
        $this->db->query('UPDATE social_media SET image = :default_social_image WHERE image = :image');
        $this->db->bind(':default_social_image', DEFAULT_SOCIAL_IMAGE);
        $this->db->bind(':image', $image);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteBasedOnId($id)
    {
        $this->db->query("DELETE FROM social_media WHERE id = :id");
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

}