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

    public function updateContent($data)
    {
        $this->db->query('UPDATE blog SET content = :content WHERE blog_id = :blog_id');
        // Bind values
        $this->db->bind(':content', $data['content']);
        $this->db->bind(':blog_id', $data['blog_id']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

}