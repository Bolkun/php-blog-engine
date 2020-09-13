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
}