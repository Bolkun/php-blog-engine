<?php

class Blog
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function search($data)
    {
        $this->db->query("SELECT * FROM blog WHERE blog_id = :id");

        // Bind values
        $this->db->bind(':id', $data['id']);

        $row = $this->db->single();

        if (empty($row)) {
            return false;
        } else {
            return $row;
        }
    }

}