<?php

class Social_Images extends Controller
{
    private $social_imageModel;
    private $social_mediaModel;

    public function __construct()
    {
        $this->social_imageModel = $this->model('Social_Image');
        $this->social_mediaModel = $this->model('Social_Media');
    }

    /*
     * All Pages ▼
     */
    public function loadList()
    {
        $data = [
            'social_image_list' => [],
        ];

        $oData = $this->social_imageModel->select();
        if ($oData) {
            for ($i = 0; $i < count($oData); $i++) {
                array_push($data['social_image_list'], $oData[$i]->image);
            }
        } else {
            die('Social image list empty, please load DEFAULT_SOCIAL_IMAGE to db');
        }

        return $data['social_image_list'];
    }

    public function deleteSocialImage()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $image = trim($_POST['ajax_sDeleteSocialImage']);
            $file = PUBLIC_CORE_IMG_SOCIALROOT . '/' . $image;

            // delete file
            if (is_file($file)) {
                if (!unlink($file)) {
                    die("Could not delete social image file from server!");
                }
            }

            // delete from db
            $oData = $this->social_imageModel->delete($image);
            if ($oData) {
                // find all social media images with the same file name and update to default image
                if ($this->social_mediaModel->replaceImageMatchesWithDefaultImage($image)) {
                    // OK
                } else {
                    die("Error: Something went wrong during replacing social image");
                }
            } else {
                die("Error: Something went wrong during social image deletion in db social image");
            }
        } else {
            die("Error: Something went wrong during post request for social image deletion");
        }
    }

}