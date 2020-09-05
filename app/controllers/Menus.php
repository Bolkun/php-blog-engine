<?php

class Menus extends Controller
{
    public function __construct()
    {
        $this->menuModel = $this->model('Menu');
    }

    /*
     * All Pages ▼
     */
    public function getMainMenu()
    {
        $oData = $this->menuModel->selectMainMenuData();
        if($oData){
            // Convert object to array
            $aData = stdToArray($oData);
            // sort data items
            $aDataSort = array(
                'items' => array(),
                'parents' => array()
            );
            for($i=0; $i<count($aData); $i++){
                // Create current menus item id into array
                $aDataSort['items'][$aData[$i]['id']] = $aData[$i];
                // Creates list of all items with children
                $aDataSort['parents'][$aData[$i]['parent_id']][] = $aData[$i]['id'];
            }

            return $aDataSort;
        } else {
            return false;
        }
    }

    public function deleteBranch()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $id = trim($_POST['ajax_sMainMenuID']);
            $oData = $this->menuModel->selectMainMenuData();

            if($oData){
                // Convert object to array
                $aData = stdToArray($oData);
                // Get branch ids
                $branch_ids = getBranchIds($aData, $id);
                // Add root id
                array_push($branch_ids, $id);
                // delete branch
                if($this->menuModel->deleteBranch($branch_ids)){
                    return true;
                }else {
                    die("Error: Something went wrong during branch deletion 1");
                }
            } else {
                die("Error: Something went wrong during branch deletion 2");
            }
        } else {
            die("Error: Something went wrong during branch deletion 3");
        }
    }

    public function search()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'search' => trim($_POST['search_main_menu']),
                'search_err' => '',
                'mm_content' => '',
            ];

            // Make sure errors are empty
            if(empty($data['search_err'])){
                $oData = $this->menuModel->searchMainMenu($data);
                if($oData){
                    // Convert object to array
                    $aData = stdToArray($oData);
                    // sort data items
                    $aDataSort = array(
                        'items' => array(),
                        'parents' => array()
                    );
                    for($i=0; $i<count($aData); $i++){
                        // Create current menus item id into array
                        $aDataSort['items'][$aData[$i]['id']] = $aData[$i];
                        // Creates list of all items with children
                        $aDataSort['parents'][$aData[$i]['parent_id']][] = $aData[$i]['id'];
                    }
                    $data['mm_content'] = $aDataSort;
                } else {
                    $data['search_err'] = 'Could not search, due to server problems';
                }
            }

            return $data;
        } else {
            // Init data
            $data = [
                'search' => '',
                'search_err' => '',
                'mm_content' => '',
            ];

            return $data;
        }
    }
}