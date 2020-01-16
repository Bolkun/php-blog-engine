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
        // Search POST
        if (!empty($_POST['submitSearch'])) {
            $current_year = date("Y");
            $last_year = date("Y") - 1;
            $costs_current_year = $this->costModel->selectCosts($current_year);
            $costs_last_year = $this->costModel->selectCosts($last_year);
            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // Init data
            $data = [
                //POST DATA DEFAULT
                'costsPrice' => trim($_POST['costsPrice']),
                'costsTitle' => trim($_POST['costsTitle']),
                'costsYear' => trim($_POST['costsYear']),
                'costsJanuary' => trim($_POST['costsJanuary']),
                'costsFebruary' => trim($_POST['costsFebruary']),
                'costsMarch' => trim($_POST['costsMarch']),
                'costsApril' => trim($_POST['costsApril']),
                'costsMay' => trim($_POST['costsMay']),
                'costsJune' => trim($_POST['costsJune']),
                'costsJuly' => trim($_POST['costsJuly']),
                'costsAugust' => trim($_POST['costsAugust']),
                'costsSeptember' => trim($_POST['costsSeptember']),
                'costsOctober' => trim($_POST['costsOctober']),
                'costsNovember' => trim($_POST['costsNovember']),
                'costsDecember' => trim($_POST['costsDecember']),
                //POST DATA ERROR DEFAULT
                'costsPrice_err' => '',
                'costsTitle_err' => '',
                'costsYear_err' => '',
                //OTHER
                'title' => "Abrechnungen",
                'current_year' => $current_year,
                'last_year' => $last_year,
                'costs_current_year' => $costs_current_year,
                'costs_last_year' => $costs_last_year,
            ];
            $data['current_year'] = $this->costModel->searchCosts($data);
            $this->view('costs/index', $data);
        }
        // New/Edit
        else if (!empty($_POST['submitNewEdit'])) {
            // Hier weiter!!!
        } else {
            $current_year = date("Y");
            $last_year = date("Y") - 1;
            $costs_current_year = $this->costModel->selectCosts($current_year);
            $costs_last_year = $this->costModel->selectCosts($last_year);
            $data = [
                //POST DATA DEFAULT
                'costsPrice' => '',
                'costsTitle' => '',
                'costsYear' => '',
                'costsJanuary' => '',
                'costsFebruary' => '',
                'costsMarch' => '',
                'costsApril' => '',
                'costsMay' => '',
                'costsJune' => '',
                'costsJuly' => '',
                'costsAugust' => '',
                'costsSeptember' => '',
                'costsOctober' => '',
                'costsNovember' => '',
                'costsDecember' => '',
                //POST DATA ERROR DEFAULT
                'costsPrice_err' => '',
                'costsTitle_err' => '',
                'costsYear_err' => '',
                //OTHER
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