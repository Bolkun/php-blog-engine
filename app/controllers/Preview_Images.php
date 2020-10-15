<?php

class Preview_Images extends Controller
{
    private $preview_imageModel;

    public function __construct()
    {
        $this->preview_imageModel = $this->model('Preview_Image');
    }

    /*
     * All Pages ▼
     */
    public function loadList()
    {
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'request' => trim($_POST['ajax_sListAllPreviewImages']),
                'preview_image_list' => [],
            ];

            if($data['request'] === 'all'){
                $oData = $this->preview_imageModel->select();
                if ($oData) {
                    $data['preview_image_list'] = $oData->preview_image;
                } else {
                    $data['preview_image_list'][-1] = 'Preview image list empty';
                }
            } else {
                die("Not valid post request for Preview image list");
            }

            return $data;
        } else {
            die("POST request failed by loading preview images list");
        }
    }

}