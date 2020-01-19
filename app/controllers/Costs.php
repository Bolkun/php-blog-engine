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

    public function search()
    {
        // Search POST
        if (!empty($_POST['submitSearch'])) {
            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // validate search year
            if(!empty(trim($_POST['costsYear']))){
                $search_year = trim($_POST['costsYear']);
            } else {
                $search_year = '';
            }
            // edit posted data
            foreach ($_POST as $key => $value) {
                $key = htmlspecialchars($key);
                // do not add empty array elements and submit button element value
                if(($value != '') && $key != 'submitSearch'){
                    $post_data[$key] = htmlspecialchars($value);
                }
            }
            // nothing posted set empty array
            if(!isset($post_data)) { $post_data = array(); }
            $costs_search = $this->costModel->searchCosts($post_data);
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
                'search_year' => $search_year,
                'costs_search' => $costs_search,
            ];
            $this->view('costs/search', $data);
        } else {
            $search_year = date("Y");
            // default search data
            $post_data['costsYear'] = $search_year;
            $costs_search = $this->costModel->searchCosts($post_data);
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
                'search_year' => $search_year,
                'costs_search' => $costs_search,
            ];
            $this->view('costs/search', $data);
        }
    }

    public function new_edit_delete()
    {
        // Search POST
        if (!empty($_POST['submitNewUpdate'])) {
            $post_data = array();
            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // validation all input fields
            if(!empty($_POST['costsPrice'])){
                $costsPrice_err = '';
                $post_data['price'] = trim($_POST['costsPrice']);
            } else {
                $costsPrice_err = 'Price can\'t be NULL';
            }
            if(!empty($_POST['costsTitle'])){
                $costsTitle_err = '';
                $post_data['title'] = trim($_POST['costsTitle']);
            } else {
                $costsTitle_err = 'Title can\'t be NULL';
            }
            if(!empty($_POST['costsYear'])){
                $costsYear_err = '';
                $post_data['year'] = trim($_POST['costsYear']);
                //for table output
                $search_year = trim($_POST['costsYear']);
            } else {
                //for table output
                $search_year = '';
                $costsYear_err = 'Year can\'t be NULL';
            }
            if(!empty($_POST['costsMonth'])){
                $costsMonth_err = '';
                $post_data['MONTH'] = trim($_POST['costsMonth']);
            } else {
                $costsMonth_err = 'Month can\'t be NULL';
            }
            if(!empty($_POST['costsStatus'])){
                $costsStatus_err = '';
                $post_data['STATUS'] = trim($_POST['costsStatus']);
            } else {
                $costsStatus_err = 'Status can\'t be NULL';
            }

            // EVERYTHING OK
            if(empty($costsPrice_err) && empty($costsTitle_err) && empty($costsYear_err) && empty($costsMonth_err) && empty($costsStatus_err)){
                // generate new value
                $change_MONTH_value = substr_replace($_POST['costsMonth'], '', 0, 3);
                $new_MONTH_value = strtolower($change_MONTH_value);
                $post_data['MONTH'] = $new_MONTH_value;
                //print_r($post_data);
                //insert or update costs
                if($this->costModel->editCosts($post_data)){
                    flash('costs_success', 'New record insert success!');
                } else {
                    flash('costs_failed', 'New record insert failed!');
                }

            }

            $costs_search = $this->costModel->selectCosts($search_year);
            // Init data
            $data = [
                //POST DATA DEFAULT
                'costsPrice' => trim($_POST['costsPrice']),
                'costsTitle' => trim($_POST['costsTitle']),
                'costsYear' => trim($_POST['costsYear']),
                'costsMonth' => trim($_POST['costsMonth']),
                'costsStatus' => trim($_POST['costsStatus']),
                //POST DATA ERROR DEFAULT
                'costsPrice_err' => $costsPrice_err,
                'costsTitle_err' => $costsTitle_err,
                'costsYear_err' => $costsYear_err,
                'costsMonth_err' => $costsMonth_err,
                'costsStatus_err' => $costsStatus_err,
                //OTHER
                'title' => "Abrechnungen",
                'search_year' => $search_year,
                'costs_search' => $costs_search,
            ];
            $this->view('costs/new_edit_delete', $data);
        } else {
            print_r($_POST);
            if (!empty($_POST['cost_id'])) {
                echo "posted";
                $data['const_id'] = $_POST['cost_id'];

                //$oDb = new Db();
                //$oDb->updateItemStatus($iIT_ID);

                //delete record
                if($this->costModel->deleteCosts($data)){
                    flash('costs_success', "SUCCESS: Record with id = " . $data['const_id'] ." was deleted!");
                } else {
                    flash('costs_failed', "FAILED: Record with id = " . $data['const_id'] ." was not deleted!");
                }
            }
            $search_year = date("Y");
            // default search data
            $post_data['costsYear'] = $search_year;
            $costs_search = $this->costModel->searchCosts($post_data);
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
                'costsMonth_err' => '',
                'costsStatus_err' => '',
                //OTHER
                'title' => "Abrechnungen",
                'search_year' => $search_year,
                'costs_search' => $costs_search,
            ];
            $this->view('costs/new_edit_delete', $data);
        }
    }
}