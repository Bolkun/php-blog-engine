<?php

class Costs extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->costModel = $this->model('Cost');
    }
    /*
     * All Pages ▼
     */
    public function index()
    {
        // Check for POST
        if (!empty($_POST['submitSearch'])) {
            echo "Search";
        }else if (!empty($_POST['submitNewEdit'])) {
            // Hier weiter!!!
        } else {
            $current_year = date("Y");
            $last_year = date("Y") - 1;
            $costs_current_year = $this->costModel->getCosts($current_year);
            $costs_last_year = $this->costModel->getCosts($last_year);
            $data = [
                'title' => "Abrechnungen",
                'current_year' => $current_year,
                'last_year' => $last_year,
                'costs_current_year' => $costs_current_year,
                'costs_last_year' => $costs_last_year,
            ];
            $this->view('costs/index', $data);
        }
    }
}