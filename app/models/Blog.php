<?php

class Blog
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function start($observe_permissions)
    {
        $sObserve_permissions = implode("','", $observe_permissions);

        $this->db->query("SELECT blog_id, created_by_user_id, last_edit_date, preview_image, observe_permissions, category, title, rank, views FROM blog 
          WHERE observe_permissions IN ('".$sObserve_permissions."') ORDER BY last_edit_date DESC LIMIT 10");

        $row = $this->db->resultSet();

        if (empty($row)) {
            return false;
        } else {
            return $row;
        }
    }

    public function selectRecord($data, $observe_permissions)
    {
        $sObserve_permissions = implode("','", $observe_permissions);

        $this->db->query("SELECT * FROM blog WHERE observe_permissions IN ('".$sObserve_permissions."') AND blog_id = :blog_id");
        $this->db->bind(':blog_id', $data['blog_id']);

        $row = $this->db->single();

        if (empty($row)) {
            return false;
        } else {
            return $row;
        }
    }

    public function updateContent($data)
    {
        $this->db->query('UPDATE blog SET last_edit_date = CURRENT_TIMESTAMP, content = :content WHERE blog_id = :blog_id');
        $this->db->bind(':content', $data['content']);
        $this->db->bind(':blog_id', $data['blog_id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateViews($data)
    {
        $max = 1000000000;
        $this->db->query('UPDATE blog SET views = views + 1 WHERE blog_id = :blog_id AND views != :max');
        $this->db->bind(':blog_id', $data['blog_id']);
        $this->db->bind(':max', $max);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateTitle($data)
    {
        $this->db->query('UPDATE blog SET last_edit_date = CURRENT_TIMESTAMP, title = :title WHERE blog_id = :blog_id');
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':blog_id', $data['blog_id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function insert($data)
    {
        $this->db->query('INSERT INTO blog (created_by_user_id, observe_permissions, title, parent_id) VALUES (:created_by_user_id, :observe_permissions, :title, :parent_id)');
        $this->db->bind(':created_by_user_id', $_SESSION['user_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':observe_permissions', $_SESSION['user_email']);
        $this->db->bind(':parent_id', $data['parent_id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteBranch($aIds)
    {
        $blog_ids = implode("','", $aIds);

        $this->db->query("DELETE FROM blog WHERE blog_id IN ('".$blog_ids."')");

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function selectMenuData($observe_permissions)
    {
        $sObserve_permissions = implode("','", $observe_permissions);

        $this->db->query("SELECT blog_id, observe_permissions, title, parent_id FROM blog WHERE observe_permissions IN ('".$sObserve_permissions."') ORDER BY title ASC");

        $row = $this->db->resultSet();

        if (empty($row)) {
            return false;
        } else {
            return $row;
        }
    }

    public function searchMenu($data, $observe_permissions)
    {
        $sObserve_permissions = implode("','", $observe_permissions);

        $this->db->query("SELECT blog_id, title, parent_id FROM blog 
          WHERE observe_permissions IN ('".$sObserve_permissions."') AND title LIKE '%" . $data['search'] . "%' ORDER BY title ASC");

        $row = $this->db->resultSet();

        if (empty($row)) {
            return false;
        } else {
            return $row;
        }
    }

}