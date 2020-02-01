<?php

class Admins extends Controller
{
    public function __construct()
    {
        $this->pageModel = $this->model('Admin');
    }
    /*
     * All Pages ▼
     */
    public function devs()
    {
        // Only for Admin
        if(isAdminLoggedIn() === true){
            $data = [
                'title' => "Dev",
            ];
            $this->view('admins/devs/index', $data);
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }

    public function tests()
    {
        // Only for Admin
        if(isAdminLoggedIn() === true){
            $data = [
                'title' => "Tests",
            ];
            $this->view('admins/tests/index', $data);
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }

    public function date_helper()
    {
        // Only for Admin
        if(isAdminLoggedIn() === true){
            $this->view('admins/tests/helpers/date_helper');
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }
}