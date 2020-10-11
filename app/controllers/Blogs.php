<?php

class Blogs extends Controller
{
    private $blogModel;

    public function __construct()
    {
        $this->blogModel = $this->model('Blog');
    }

    /*
     * All Pages ▼
     */
    public function start($observe_permissions)
    {
        // Init data
        $data = [
            'created_by_user_id' => [],
            'last_edit_date' => [],
            'preview_image' => [],
            'category' => [],
            'title' => [],
            'rank' => [],
            'views' => [],
        ];

        $oData = $this->blogModel->start($observe_permissions);
        if ($oData) {
            for($i=0; $i<count($oData); $i++){
                array_push($data['created_by_user_id'], $oData[$i]->created_by_user_id);
                array_push($data['last_edit_date'], $oData[$i]->last_edit_date);
                array_push($data['preview_image'], $oData[$i]->preview_image);
                array_push($data['category'], $oData[$i]->category);
                array_push($data['title'], $oData[$i]->title);
                array_push($data['rank'], $oData[$i]->rank);
                array_push($data['views'], $oData[$i]->views);
            }
        } else {
            $data = false;
        }

        return $data;
    }

    public function search($blog_id, $observe_permissions)
    {
        // Init data
        $data = [
            'blog_id' => $blog_id,
            'content' => '',
        ];

        $oData = $this->blogModel->search($data, $observe_permissions);
        if ($oData) {
            // Decode from db
            $data['content'] = base64_decode($oData->content);
        } else {
            die("Blog title not found");
        }

        return $data;
    }

    public function saveContent($blog_id)
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // Init data
            $data = [
                'blog_id' => trim($blog_id),
                'content' => base64_encode($_POST['blog_ta_tinymce']),
            ];

            if ($this->blogModel->updateContent($data)) {
                // OK
            } else {
                die("Could not save blog content");
            }

        } else {
            die("Not a post request for updating blog content");
        }
    }

}