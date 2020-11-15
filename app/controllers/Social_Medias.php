<?php

class Social_Medias extends Controller
{
    private $social_mediaModel;
    private $social_imageModel;

    public function __construct()
    {
        $this->social_mediaModel = $this->model('Social_Media');
        $this->social_imageModel = $this->model('Social_Image');
    }

    /*
     * All Pages ▼
     */
    public function index()
    {
        // Init data
        $data = [
            'id' => [],
            'name' => [],
            'link' => [],
            'image' => [],
        ];

        $oData = $this->social_mediaModel->start();
        if ($oData) {
            for($i=0; $i<count($oData); $i++){
                array_push($data['id'], $oData[$i]->id);
                array_push($data['name'], $oData[$i]->name);
                array_push($data['link'], $oData[$i]->link);
                array_push($data['image'], $oData[$i]->image);
            }
        } else {
            $data = false;
        }

        return $data;
    }

    public function save()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // Init data
            $data = [
                'name' => trim($_POST['socialMedia_name']),
                'link' => trim($_POST['socialMedia_link']),
                'image' => '',
                // radio choice
                'radio_social_image' => trim($_POST['sm_radio_social_image']),
                'image_server' => trim($_POST['sm_social_image_server']),
                'image_local' => '',
                // errors
                'name_err' => '',
                'link_err' => '',
                'server_image_err' => '',
                'local_image_err' => '',
            ];

            // validating
            if(empty($data['name'])) {
                $data['name_err'] = 'Please enter name';
            }

            if(empty($data['link'])) {
                $data['link_err'] = 'Please enter link';
            } else {
                if (! filter_var($data['link'], FILTER_VALIDATE_URL)) {
                    $data['link_err'] = $data['link'] . ' is not a valid url.';
                }
            }

            if($data['radio_social_image'] === 'server'){
                if(empty($data['image_server'])) {
                    $data['server_image_err'] = 'Server image not selected';
                } else {
                    $data['image'] = $data['image_server'];
                }
            } elseif ($data['radio_social_image'] === 'local'){
                if(isset($_FILES['sm_image_local'])){
                    $data['image_local'] = basename( $_FILES["sm_image_local"]["name"]);
                    if(! empty($data['image_local'])) {
                        // validate upload file
                        $target_file = PUBLIC_CORE_IMG_SOCIALROOT . '/' . $data['image_local'];

                        // check if image file is actual image or fake image
                        $check = getimagesize($_FILES["sm_image_local"]["tmp_name"]);
                        if($check !== false) {
                            // check if file already exists
                            if (! file_exists($target_file)) {
                                // Check file size
                                if ($_FILES["sm_image_local"]["size"] <= 20971520) {
                                    // allow certain file formats
                                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "svg") {
                                        $data['local_image_err'] = "Only JPG, JPEG, PNG, GIF & SVG file extensions are allowed.";
                                    } else {
                                        // upload
                                        if(move_uploaded_file($_FILES["sm_image_local"]["tmp_name"], $target_file)) {
                                            $data['image'] = $data['image_local'];
                                            if($this->social_imageModel->insert($data)) {
                                                // OK
                                            } else {
                                                $data['local_image_err'] = "Could not insert social image in db";
                                            }
                                        } else {
                                            $data['local_image_err'] ="Could not upload social image file";
                                        }
                                    }
                                } else {
                                    $data['local_image_err'] = "File must be less than 20MB";
                                }
                            } else {
                                $data['local_image_err'] = "File with this name already exists";
                            }
                        } else {
                            $data['local_image_err'] = "File is not an image";
                        }
                    } else {
                        $data['local_image_err'] = 'Local image not selected';
                    }
                } else {
                    $data['local_image_err'] = '$_FILES social image is not set';
                }
            } else {
                $data['server_image_err'] = 'Server or local image must be selected';
                $data['local_image_err'] = 'Server or local image must be selected';
            }

            if(empty($data['name_err']) && empty($data['link_err']) && empty($data['server_image_err']) && empty($data['local_image_err'])){
                if($this->social_mediaModel->insertRecord($data)) {
                    // ok
                } else {
                    die("Could not update db for uploaded social image file");
                }
            }

            return $data;
        } else {
            die("Not a post request for adding social media link");
        }
    }

    public function delete(){
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $name = trim($_POST['ajax_sDeleteSocialMedia']);

            if($this->social_mediaModel->deleteBasedOnName($name)){
                // OK
            } else {
                die("Error: could not delete social media in db");
            }
        } else {
            die("Error: could not delete social media");
        }
    }
}