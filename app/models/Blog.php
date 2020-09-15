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
        $this->db->query("SELECT * FROM blog WHERE title = :title");

        // Bind values
        $this->db->bind(':title', $data['title']);

        $row = $this->db->single();

        if (empty($row)) {
            return false;
        } else {
            return $row;
        }
    }

    public function updateContent($data)
    {
        $this->db->query('UPDATE blog SET content = :content WHERE title = :title');
        // Bind values
        $this->db->bind(':content', $data['content']);
        $this->db->bind(':title', $data['title']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function insert($data)
    {
        $this->db->query('INSERT INTO blog (created_by_user_id, title) VALUES (:created_by_user_id, :title)');
        // Bind values
        $this->db->bind(':created_by_user_id', $_SESSION['user_id']);
        $this->db->bind(':title', $data['title']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

}