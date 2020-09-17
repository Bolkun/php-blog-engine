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
        $this->db->query('UPDATE blog SET last_edit_date = CURRENT_TIMESTAMP, content = :content WHERE title = :title');
        $this->db->bind(':content', $data['content']);
        $this->db->bind(':title', $data['title']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateTitle($data)
    {
        $this->db->query('UPDATE blog SET last_edit_date = CURRENT_TIMESTAMP, title = :title WHERE mm_id = :mm_id');
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':mm_id', $data['mm_id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function insert($data)
    {
        $this->db->query('INSERT INTO blog (created_by_user_id, title, mm_id) VALUES (:created_by_user_id, :title, :mm_id)');
        $this->db->bind(':created_by_user_id', $_SESSION['user_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':mm_id', $data['mm_id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


}