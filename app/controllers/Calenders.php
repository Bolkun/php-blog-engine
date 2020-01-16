<?php

class Calenders extends Controller
{
    public function __construct()
    {
        $this->pageModel = $this->model('Calender');
        $this->userModel = $this->model('User');
    }
    /*
     * All Pages ▼
     */
    public function index()
    {
        $data = [
            'title' => "Kalender",
        ];
        $this->view('calenders/index', $data);
    }

    public function restore()
    {
        $data = [
            'title' => "Kalender zurücksetzen",
        ];
        $this->view('calenders/restore', $data);
    }
}