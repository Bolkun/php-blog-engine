<?php

class Tests extends Controller
{
    public function __construct()
    {
        //$this->pageModel = $this->model('Calender');
        //$this->userModel = $this->model('User');
    }

    public function index()
    {
        $data = [
            'title' => "Tests",
        ];
        $this->view('tests/index', $data);
    }

    public function date_helper() { $this->view('tests/helpers/date_helper'); }

}