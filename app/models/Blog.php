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
          WHERE observe_permissions IN ('" . $sObserve_permissions . "') ORDER BY last_edit_date DESC LIMIT :max_blog_divs");
        $this->db->bind(':max_blog_divs', MAX_BLOG_DIVS);

        $row = $this->db->resultSet();

        if (empty($row)) {
            return false;
        } else {
            return $row;
        }
    }

    public function getRecordsBasedOnPaginationBlock($blogIdsNeeded, $observe_permissions)
    {
        $sBlogIdsNeeded = implode("','", $blogIdsNeeded);
        $sObserve_permissions = implode("','", $observe_permissions);

        $this->db->query("SELECT blog_id, created_by_user_id, last_edit_date, preview_image, observe_permissions, category, title, rank, views FROM blog 
          WHERE observe_permissions IN ('" . $sObserve_permissions . "') AND blog_id IN ('" . $sBlogIdsNeeded . "') ORDER BY last_edit_date DESC LIMIT :max_blog_divs");
        $this->db->bind(':max_blog_divs', MAX_BLOG_DIVS);

        $row = $this->db->resultSet();

        if (empty($row)) {
            return false;
        } else {
            return $row;
        }
    }

    public function pagination($observe_permissions)
    {
        $sObserve_permissions = implode("','", $observe_permissions);

        $this->db->query("SELECT blog_id FROM blog WHERE observe_permissions IN ('" . $sObserve_permissions . "') ORDER BY last_edit_date DESC");

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

        $this->db->query("SELECT * FROM blog WHERE observe_permissions IN ('" . $sObserve_permissions . "') AND blog_id = :blog_id");
        $this->db->bind(':blog_id', $data['blog_id']);

        $row = $this->db->single();

        if (empty($row)) {
            return false;
        } else {
            return $row;
        }
    }

    public function updateRecord($data)
    {
        $this->db->query('UPDATE blog SET last_edit_date = CURRENT_TIMESTAMP, preview_image = :preview_image, 
          observe_permissions = :observe_permissions, category = :category, title = :title, rank = :rank, content = :content 
          WHERE blog_id = :blog_id');
        $this->db->bind(':blog_id', $data['blog_id']);
        $this->db->bind(':preview_image', $data['preview_image']);
        $this->db->bind(':observe_permissions', $data['observe_permissions']);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':rank', $data['rank']);
        $this->db->bind(':content', $data['content']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateViewsBasedOnVisitorIP($data)
    {
        $max = 1000000000;
        $this->db->query('UPDATE blog SET views = views + 1, views_ip = :views_ip WHERE blog_id = :blog_id AND views != :max');
        $this->db->bind(':views_ip', $data['views_ip']);
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
        $this->db->query('INSERT INTO blog (created_by_user_id, observe_permissions, title, content, parent_id) VALUES (:created_by_user_id, :observe_permissions, :title, :content, :parent_id)');
        $this->db->bind(':created_by_user_id', $_SESSION['user_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':observe_permissions', $_SESSION['user_email']);
        $this->db->bind(':content', $data['content']);
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

        $this->db->query("DELETE FROM blog WHERE blog_id IN ('" . $blog_ids . "')");

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function selectMenuData($observe_permissions)
    {
        $sObserve_permissions = implode("','", $observe_permissions);

        $this->db->query("SELECT blog_id, observe_permissions, title, parent_id FROM blog 
          WHERE observe_permissions IN ('" . $sObserve_permissions . "') ORDER BY title ASC");

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

        $this->db->query("SELECT blog_id, observe_permissions, title, parent_id FROM blog 
          WHERE observe_permissions IN ('" . $sObserve_permissions . "') AND title LIKE '%" . $data['search'] . "%' ORDER BY title ASC");

        $row = $this->db->resultSet();

        if (empty($row)) {
            return false;
        } else {
            return $row;
        }
    }

    public function replacePreviewImageWithDefaultImage($preview_image)
    {
        $this->db->query('UPDATE blog SET preview_image = :default_preview_image WHERE preview_image = :preview_image');
        $this->db->bind(':default_preview_image', DEFAULT_PREVIEW_IMAGE);
        $this->db->bind(':preview_image', $preview_image);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
