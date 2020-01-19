<?php

// Load Ajax
//require_once 'ajax/costs.php';

class AjaxCosts extends Controller
{
    public function __construct()
    {
        //$this->userModel = $this->model('User');
        $this->costModel = $this->model('Cost');
    }

    function costsDeleteRow()
    {
        if (isset($_POST['cost_id'])) {
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
        } else {
            //die("Something went wrong!");
        }
    }
}
if (isset($_POST['cost_id'])) {
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
} else {
    //die("Something went wrong!");
    echo "not posted";
}
echo "file";
$ajaxCosts = new AjaxCosts();
$ajaxCosts->costsDeleteRow();
//unset($ajaxCosts);