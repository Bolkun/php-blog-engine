<?php

class Menus extends Controller
{

    private $menuModel;
    private $blogModel;

    public function __construct()
    {
        $this->menuModel = $this->model('Menu');
        $this->blogModel = $this->model('Blog');
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

    public function addNode()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'mm_id' => '',
                'title' => trim($_POST['ajax_mm_add_child']),
                'parent_id' => trim($_POST['ajax_mm_add_child_parentId']),
            ];

            if(empty($data['title'])){
                die("Error: Title cannot be empty");
            } else {
                // delete ""
                $data['title'] = replaceString('&#34;', '', $data['title']);
            }

            if(empty($data['parent_id'])){
                die("Error: Parent id cannot be empty");
            } else {
                // delete ""
                $data['parent_id'] = replaceString('&#34;', '', $data['parent_id']);
            }

            // Make sure errors are empty
            $data['mm_id'] = $this->menuModel->insertNode($data);
            if($data['mm_id']){
                // create new blog page
                if($this->blogModel->insert($data)){
                    // OK
                } else {
                    die("Error: Could not insert blog page, due to server problems");
                }
            } else {
                die("Error: Could not insert node, due to server problems");
            }
        } else {
            die("Error: Something went wrong during post request to add new node");
        }
    }

    public function editTitle()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'id' => trim($_POST['ajax_mm_edit_title_id']),
                'title' => trim($_POST['ajax_mm_edit_title']),
            ];

            if(empty($data['id'])){
                die("Error: id cannot be empty");
            } else {
                // delete ""
                $data['id'] = replaceString('&#34;', '', $data['id']);
            }

            if(empty($data['title'])){
                die("Error: Title cannot be empty");
            } else {
                // delete ""
                $data['title'] = replaceString('&#34;', '', $data['title']);
            }

            // Make sure errors are empty
            $state = $this->menuModel->updateTitle($data);
            if($state){
                // OK
            } else {
                die("Error: Could not update title, due to server problems");
            }
        } else {
            die("Error: Something went wrong during post request to edit title");
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
                    $data['search_err'] = 'Nothing found';
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