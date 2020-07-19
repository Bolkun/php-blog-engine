<?php

class Dashboards extends Controller
{
    public function __construct()
    {
        $this->dashboardModel = $this->model('Dashboard');
    }
    /*
     * All Pages ▼
     */
    public function index()
    {
        // POST
        if (!empty($_POST['submitTinyMCEContent'])) {
            // validate textarea
            if(!empty($_POST['textarea_tinymce'])){
                $textareaTinyMCE = trim($_POST['textarea_tinymce']);
            } else {
                $textareaTinyMCE = '';
            }
            // Init data
            $data = [
                'textareaTinyMCE' => $textareaTinyMCE,
            ];
            $this->view('dashboards/index', $data);
        } else {
            // Init data
            $data = [
                'textareaTinyMCE' => '',
            ];
            $this->view('dashboards/index', $data);
        }
    }
}