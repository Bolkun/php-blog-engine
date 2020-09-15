<?php

class Blogs extends Controller
{
    public function __construct()
    {
        $this->blogModel = $this->model('Blog');
    }

    /*
     * All Pages ▼
     */
    public function search($id)
    {
        // Init data
        $data = [
            'id' => trim($id),
            'content' => '',
            'id_err' => '',
        ];

        if(! checkIfStringMatchRegex("/^[0-9]+$/", $data['id'])){
            $data['id_err'] = "Is not an id";
            //die("Is not an id");
        }

        // Make sure errors are empty
        if (empty($data['id_err'])) {
            $oData = $this->blogModel->search($data);
            if ($oData) {
                $data['content'] = $oData->content;
            } else {
                $data['id_err'] = '404 not found';
                //die("404 not found");
            }
        }

        return $data;
    }

    public function saveContent($id)
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'blog_id' => trim($id),
                'content' => $_POST['blog_ta_tinymce'],
            ];

            $oData = $this->blogModel->updateContent($data);
            if ($oData) {
                return true;
            } else {
                return false;
            }

        } else {
            die("Not a post request for updating blog content");
        }
    }
}