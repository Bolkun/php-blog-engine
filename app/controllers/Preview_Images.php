<?php

class Preview_Images extends Controller
{
    private $preview_imageModel;
    private $blogModel;

    public function __construct()
    {
        $this->preview_imageModel = $this->model('Preview_Image');
        $this->blogModel = $this->model('Blog');
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
            die('Preview image list empty, please load DEFAULT_PREVIEW_IMAGE to db');
        }

        return $data;
    }

    public function deletePreviewImage()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $preview_image = trim($_POST['ajax_sDeletePreviewImage']);
            $file = PUBLIC_CORE_IMG_PREVIEWROOT . '/' . $preview_image;

            // delete file
            if (is_file($file)) {
                if (!unlink($file)) {
                    die("Could not delete preview image file from server!");
                }
            }

            // delete from db
            $oData = $this->preview_imageModel->deletePreviewImage($preview_image);

            if ($oData) {
                // find all blog preview images with file and update with default image
                if ($this->blogModel->replacePreviewImageWithDefaultImage($preview_image)) {
                    // OK
                } else {
                    die("Error: Something went wrong during replacing preview image in blog");
                }
            } else {
                die("Error: Something went wrong during preview image deletion in db preview image");
            }
        } else {
            die("Error: Something went wrong during post request for preview image deletion");
        }
    }
}
