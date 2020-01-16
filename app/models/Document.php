<?php

class Document
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function addDocument($data)
    {
        $this->db->query('INSERT INTO document (task_id, task_child_id, uploaded_by_user_id, type, name, saved_path) 
                                            VALUES (:task_id, :task_child_id, :uploaded_by_user_id, :type, :name, :saved_path)');
        // Bind values
        $this->db->bind(':task_id', $data['task_id']);
        $this->db->bind(':task_child_id', $data['task_child_id']);
        $this->db->bind(':uploaded_by_user_id', $data['uploaded_by_user_id']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':saved_path', $data['saved_path']);

        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
}