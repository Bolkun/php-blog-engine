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
        $data = [
            'title' => "Dashboard",
        ];
        $this->view('dashboards/index', $data);
    }
}