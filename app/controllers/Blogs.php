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
    public function search($title)
    {
        // Init data
        $data = [
            'title' => trim($title),
            'content' => '',
        ];

        $oData = $this->blogModel->search($data);
        if ($oData) {
            // Decode from db
            $data['content'] = base64_decode($oData->content);
        } else {
            die("Blog title not found");
        }

        return $data;
    }

    public function saveContent($title)
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // Init data
            $data = [
                'title' => trim($title),
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