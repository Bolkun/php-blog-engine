<?php

class Blogs extends Controller
{
    private $blogModel;

    public function __construct()
    {
        $this->blogModel = $this->model('Blog');
    }

    /*
     * All Pages ▼
     */
    public function index($observe_permissions)
    {
        // Init data
        $data = [
            'blog_id' => [],
            'created_by_user_id' => [],
            'last_edit_date' => [],
            'preview_image' => [],
            'category' => [],
            'title' => [],
            'rank' => [],
            'views' => [],
        ];

        $oData = $this->blogModel->start($observe_permissions);

        if ($oData) {
            for($i=0; $i<count($oData); $i++){
                array_push($data['blog_id'], $oData[$i]->blog_id);
                array_push($data['created_by_user_id'], $oData[$i]->created_by_user_id);
                array_push($data['last_edit_date'], $oData[$i]->last_edit_date);
                array_push($data['preview_image'], $oData[$i]->preview_image);
                array_push($data['category'], $oData[$i]->category);
                array_push($data['title'], $oData[$i]->title);
                array_push($data['rank'], $oData[$i]->rank);
                array_push($data['views'], $oData[$i]->views);
            }
        } else {
            $data = false;
        }

        return $data;
    }

    public function getRecord($blog_id, $observe_permissions)
    {
        // Init data
        $data = [
            'blog_id' => $blog_id,
            'content' => '',
        ];

        $oData = $this->blogModel->selectRecord($data, $observe_permissions);
        if ($oData) {
            // Decode from db
            $data['content'] = base64_decode($oData->content);
            // update views count
            $this->blogModel->updateViews($data);
        } else {
            die("Blog title not found");
        }

        return $data;
    }

    public function saveContent($blog_id)
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // Init data
            $data = [
                'blog_id' => trim($blog_id),
                'content' => base64_encode($_POST['blog_ta_tinymce']),
            ];

            if ($this->blogModel->updateContent($data)) {
                // OK
            } else {
                die("Could not save blog content");
            }

        } else {
            die("Not a post request for updating blog content");
        }
    }

    public function menu($observe_permissions)
    {
        $oData = $this->blogModel->selectMenuData($observe_permissions);

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
                $aDataSort['items'][$aData[$i]['blog_id']] = $aData[$i];
                // Creates list of all items with children
                $aDataSort['parents'][$aData[$i]['parent_id']][] = $aData[$i]['blog_id'];
            }

            // change branches that have no root node
            $aDataSort = $this->menu_changeBranchesWithNoRootNode($aDataSort);

            return $aDataSort;
        } else {
            return false;
        }
    }

    public function add()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'id' => '',
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
            if($this->blogModel->insert($data)){
                // OK
            } else {
                die("Error: Could not insert new blog page, due to server problems");
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
                'blog_id' => trim($_POST['ajax_mm_edit_title_id']),
                'title' => trim($_POST['ajax_mm_edit_title']),
            ];

            if(empty($data['blog_id'])){
                die("Error: blog_id cannot be empty");
            } else {
                // delete ""
                $data['blog_id'] = replaceString('&#34;', '', $data['blog_id']);
            }

            if(empty($data['title'])){
                die("Error: Title cannot be empty");
            } else {
                // delete ""
                $data['title'] = replaceString('&#34;', '', $data['title']);
            }

            if($this->blogModel->updateTitle($data)){
                // OK
            } else {
                die("Error: Could not update blog title, due to server problems");
            }
        } else {
            die("Error: Something went wrong during post request to edit title");
        }
    }

    public function deleteBranch($observe_permissions)
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $id = trim($_POST['ajax_sMainMenuID']);

            $oData = $this->blogModel->selectMenuData($observe_permissions);

            if($oData){
                // Convert object to array
                $aData = stdToArray($oData);
                // Get branch ids
                $branch_ids = getBranchIds($aData, $id);
                // Add root id
                array_push($branch_ids, $id);
                // delete branch
                if($this->blogModel->deleteBranch($branch_ids)){
                    // replace leaf with no root as a root

                } else {
                    die("Error: Something went wrong during deletion of blog pages");
                }
            } else {
                die("Error: Something went wrong during branch deletion 1");
            }
        } else {
            die("Error: Something went wrong during branch deletion 2");
        }
    }

    public function search_menu($observe_permissions)
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'search' => trim($_POST['search_main_menu']),
                'search_err' => '',
                'content' => '',
            ];

            // Make sure errors are empty
            if(empty($data['search_err'])){
                $oData = $this->blogModel->searchMenu($data, $observe_permissions);
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
                        $aDataSort['items'][$aData[$i]['blog_id']] = $aData[$i];
                        // Creates list of all items with children
                        $aDataSort['parents'][$aData[$i]['parent_id']][] = $aData[$i]['blog_id'];
                    }
                    // change branches that have no root node
                    $data['content'] = $this->menu_changeBranchesWithNoRootNode($aDataSort);
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
                'content' => '',
            ];

            return $data;
        }
    }

    // helpers
    public function menu_changeBranchesWithNoRootNode($aDataSort)
    {
        $data['mm'] = $aDataSort;
        // change branches that have no root node
        foreach ($data['mm']['items'] as $key => $value) {
            if ($data['mm']['items'][$key]['parent_id'] != 0 && !in_array($data['mm']['items'][$key]['parent_id'], array_column($data['mm']['items'], 'blog_id'))) {
                // set not found parents as root node
                $data['mm']['items'][$key]['parent_id'] = 0;

                // add not found parent ids to root group
                $data['mm']['parents'][0][] = $data['mm']['items'][$key]['blog_id'];
                // delete old group with no root
                foreach ($data['mm']['parents'] as $pk => $pv) {
                    foreach ($pv as $i => $v) {
                        if ($pk != 0 && $data['mm']['parents'][$pk][$i] == $data['mm']['items'][$key]['blog_id']) {
                            unset($data['mm']['parents'][$pk][$i]);
                        }
                    }
                    if (empty($data['mm']['parents'][$pk])) {
                        unset($data['mm']['parents'][$pk]);
                    }
                }
            }
        }

        return $data['mm'];
    }
    
}