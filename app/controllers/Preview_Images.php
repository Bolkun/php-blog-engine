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
        $data = [
            'preview_image_list' => [],
        ];

        $oData = $this->preview_imageModel->select();
        if ($oData) {
            for ($i = 0; $i < count($oData); $i++) {
                array_push($data['preview_image_list'], $oData[$i]->preview_image);
            }
        } else {
            die('Preview image list empty, load locally');
        }

        return $data;
    }

}