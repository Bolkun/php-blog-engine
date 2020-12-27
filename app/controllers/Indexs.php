<?php

class Indexs extends Controller
{
    private $blogController;
    private $userController;
    private $preview_imageController;
    private $social_mediaController;
    private $social_imageController;

    public function __construct()
    {
        $this->blogController = $this->controller('Blogs');
        $this->userController = $this->controller('Users');
        $this->preview_imageController = $this->controller('Preview_Images');
        $this->social_mediaController = $this->controller('Social_Medias');
        $this->social_imageController = $this->controller('Social_Images');
    }

    private function getObservePermissions()
    {
        return getUserPermissions();
    }

    private function getData($url_param)
    {
        $observe_permissions = $this->getObservePermissions();
        return [
            'url_param' => $url_param,
            // social media
            'sm' => (new Social_Medias)->index(),
            'sm_add_name' => '',
            'sm_add_link' => '',
            'sm_add_image' => '',
            'sm_add_name_err' => '',
            'sm_add_link_err' => '',
            'sm_add_image_server_err' => '',
            'sm_add_image_local_err' => '',
            // social image
            'social_image_list' => (new Social_Images)->loadList(),
            // blog
            'blog_id' => [],
            'blog_created_by_user_id' => [],
            'blog_last_edit_date' => [],
            'blog_preview_image' => [],
            'blog_observe_permissions' => [],
            'blog_category' => [],
            'blog_title' => [],
            'blog_rank' => [],
            'blog_views' => [],
            'blog_content' => [],
            'blog_preview_image_err' => '',
            'blog_category_err' => '',
            'blog_title_err' => '',
            // pagination
            'pagination' => (new Blogs)->pagination($observe_permissions),
            // blog mm
            'blog_mm' => (new Blogs)->menu($observe_permissions),
            'blog_mm_search' => '',
            'blog_mm_edit_title' => '',
            'blog_mm_add_child' => '',
            'blog_mm_search_err' => '',
            'blog_mm_edit_title_err' => '',
            'blog_mm_add_child_err' => '',
            // preview image
            'preview_image_list' => [],
            // register
            'reg_firstname' => '',
            'reg_surname' => '',
            'reg_email' => '',
            'reg_password' => '',
            'reg_confirm_password' => '',
            'reg_firstname_err' => '',
            'reg_surname_err' => '',
            'reg_email_err' => '',
            'reg_password_err' => '',
            'reg_confirm_password_err' => '',
            // login
            'log_email' => '',
            'log_password' => '',
            'log_verification_code' => '',
            'log_role' => '',
            'log_email_err' => '',
            'log_password_err' => '',
            'log_verification_code_err' => '',
            // setting email
            'set_email' => '',
            'set_email_err' => '',
            // setting password
            'set_old_password' => '',
            'set_new_password' => '',
            'set_new_password_confirm' => '',
            'set_old_password_err' => '',
            'set_new_password_err' => '',
            'set_new_password_confirm_err' => '',
            // other
            'display_div' => array(),
        ];
    }

    private function post($url_param, $observe_permissions, $data)
    {
        if (isset($_POST['submit_blog_ta_tinymce'])) {
            $blog = new Blogs();
            $blog_data = $blog->saveBlogPage($url_param, $observe_permissions);
            $new_data = [
                'blog_created_by_user_id' => $blog_data['created_by_user_id'],
                'blog_last_edit_date' => date("Y-m-d H:i:s", time()),
                'blog_preview_image' => $blog_data['preview_image'],
                'blog_observe_permissions' => $blog_data['observe_permissions'],
                'blog_category' => $blog_data['category'],
                'blog_title' => $blog_data['title'],
                'blog_rank' => $blog_data['rank'],
                'blog_content' => $blog_data['content'],
                // errors
                'blog_preview_image_err' => $blog_data['preview_image_err'],
                'blog_category_err' => $blog_data['category_err'],
                'blog_title_err' => $blog_data['title_err'],
            ];
            $data = mergeAsocArrays($data, $new_data);
        }
        elseif (isset($_POST['submit_search_input'])) {
            $blog = new Blogs();
            $blog_data = $blog->search_menu($observe_permissions);
            $new_data = [
                // main menu
                'blog_mm_search' => $blog_data['search'],
                'blog_mm_search_err' => $blog_data['search_err'],
                'blog_mm' => $blog_data['content'],
                // other
                'display_div' => array('collapse_main_menu'),
            ];
            $data = mergeAsocArrays($data, $new_data);
        }
        elseif (isset($_POST['submitLogin'])) {
            $user = new Users();
            $user_data = $user->login();

            // reload data
            $observe_permissions = getUserPermissions();
            $data['blog_mm'] = (new Blogs)->menu($observe_permissions);

            $new_data = [
                // login
                'log_email' => $user_data['email'],
                'log_password' => $user_data['password'],
                'log_verification_code' => $user_data['verification_code'],
                'log_role' => $user_data['role'],
                'log_email_err' => $user_data['email_err'],
                'log_password_err' => $user_data['password_err'],
                'log_verification_code_err' => $user_data['verification_code_err'],
                // pagination
                'pagination' => (new Blogs)->pagination($observe_permissions),
                // other
                'display_div' => array('collapse_login_menu'),
            ];
            $data = mergeAsocArrays($data, $new_data);
        }
        elseif (isset($_POST['submitRegister'])) {
            $user = new Users();
            $user_data = $user->register();
            $new_data = [
                // register
                'reg_firstname' => $user_data['firstname'],
                'reg_surname' => $user_data['surname'],
                'reg_email' => $user_data['email'],
                'reg_password' => $user_data['password'],
                'reg_confirm_password' => $user_data['confirm_password'],
                'reg_firstname_err' => $user_data['firstname_err'],
                'reg_surname_err' => $user_data['surname_err'],
                'reg_email_err' => $user_data['email_err'],
                'reg_password_err' => $user_data['password_err'],
                'reg_confirm_password_err' => $user_data['confirm_password_err'],
                // other
                'display_div' => array('registration_form'),  // display errors
            ];

            // display login
            if (empty($new_data['reg_firstname_err']) && empty($new_data['reg_surname_err']) && empty($new_data['reg_email_err'])
                && empty($new_data['reg_password_err']) && empty($new_data['reg_confirm_password_err'])) {
                $new_data['display_div'] = array('collapse_login_menu');
            }

            $data = mergeAsocArrays($data, $new_data);
        }
        elseif (isset($_POST['submitUserEmail'])) {
            $user = new Users();
            $user_data = $user->settingsUserEmail();
            $new_data = [
                // setting email
                'set_email' => $user_data['email'],
                'set_email_err' => $user_data['email_err'],
                // other
                'display_div' => array('collapse_login_menu'),
            ];
            $data = mergeAsocArrays($data, $new_data);
        }
        elseif (isset($_POST['submitUserPassword'])) {
            $user = new Users();
            $user_data = $user->settingsUserPassword();
            $new_data = [
                // setting password
                'set_old_password' => $user_data['old_password'],
                'set_new_password' => $user_data['new_password'],
                'set_new_password_confirm' => $user_data['new_password_confirm'],
                'set_old_password_err' => $user_data['old_password_err'],
                'set_new_password_err' => $user_data['new_password_err'],
                'set_new_password_confirm_err' => $user_data['new_password_confirm_err'],
                // other
                'display_div' => array('collapse_login_menu'),
            ];
            $data = mergeAsocArrays($data, $new_data);
        }
        elseif (isset($_POST['submitSocialMedia'])) {
            $sm = new Social_Medias();
            $sm_data = $sm->save();
            $new_data = [
                'sm' => (new Social_Medias)->index(),
                'sm_add_name' => $sm_data['name'],
                'sm_add_link' => $sm_data['link'],
                'sm_add_image' => $sm_data['image'],
                'sm_add_name_err' => $sm_data['name_err'],
                'sm_add_link_err' => $sm_data['link_err'],
                'sm_add_image_server_err' => $sm_data['server_image_err'],
                'sm_add_image_local_err' => $sm_data['local_image_err'],
                // social image
                'social_image_list' => (new Social_Images)->loadList(),
                // other
                'display_div' => array('collapse_share_menu'),
            ];

            $data = mergeAsocArrays($data, $new_data);
        }
        elseif (isset($_POST['ajax_mm_add_child']) && isset($_POST['ajax_mm_add_child_parentId'])) {
            $blog = new Blogs();
            $blog->add();
        }
        elseif (isset($_POST['ajax_mm_edit_title_id']) && isset($_POST['ajax_mm_edit_title'])) {
            $blog = new Blogs();
            $blog->editTitle();
        }
        elseif (isset($_POST['ajax_mm_delete_branch_id'])) {
            $blog = new Blogs();
            $blog->deleteBranch($observe_permissions);
        }
        elseif (isset($_POST['ajax_sDeletePreviewImage'])) {
            $preview_image = new Preview_Images();
            $preview_image->deletePreviewImage();
        }
        elseif (isset($_POST['ajax_sDeleteSocialImage'])) {
            $social_image = new Social_Images();
            $social_image->deleteSocialImage();
        }
        elseif (isset($_POST['ajax_sDeleteSocialMedia'])) {
            $sm = new Social_Medias();
            $sm->delete();
        }

        return $data;
    }

    /*
     * All Pages ▼
     */
    public function index($url_param = 0)
    {
        // Init
        $observe_permissions = $this->getObservePermissions();
        $data = $this->getData($url_param);
        // POST
        $data = $this->post($url_param, $observe_permissions, $data);

        // Pages
        if ($url_param !== 0) {
            // one page
            $blog = new Blogs();
            $blog_data = $blog->getRecord($url_param, $observe_permissions);
            $new_data = [
                'blog_created_by_user_id' => $blog_data['created_by_user_id'],
                'blog_last_edit_date' => $blog_data['last_edit_date'],
                'blog_preview_image' => $blog_data['preview_image'],
                'blog_observe_permissions' => $blog_data['observe_permissions'],
                'blog_category' => $blog_data['category'],
                'blog_title' => $blog_data['title'],
                'blog_rank' => $blog_data['rank'],
                'blog_content' => $blog_data['content'],
            ];

            // load all preview images
            if(isAdminLoggedIn() === true) {
                $preview_image = new Preview_Images();
                $preview_image_data = $preview_image->loadList();
                $new_data['preview_image_list'] = $preview_image_data['preview_image_list'];
            }

            $data = mergeAsocArrays($data, $new_data);
        }
        elseif ($url_param === 0) {
            // all pages
            $blog = new Blogs();
            $blog_data = $blog->index($observe_permissions);

            if ($blog_data !== false) {
                $new_data = [
                    // blog index
                    'blog_id' => $blog_data['blog_id'],
                    'blog_created_by_user_id' => $blog_data['created_by_user_id'],
                    'blog_last_edit_date' => $blog_data['last_edit_date'],
                    'blog_preview_image' => $blog_data['preview_image'],
                    'blog_observe_permissions' => $blog_data['observe_permissions'],
                    'blog_category' => $blog_data['category'],
                    'blog_title' => $blog_data['title'],
                    'blog_rank' => $blog_data['rank'],
                    'blog_views' => $blog_data['views'],
                ];
                $data = mergeAsocArrays($data, $new_data);
            }
        }
        else {
            die('Blog Page Not Found!');
        }

        $this->view('index/index', $data);
    }

    public function page($url_param = 0)
    {
        if ($url_param !== 0) {
            // Init
            $observe_permissions = $this->getObservePermissions();
            $data = $this->getData($url_param);
            // POST
            $data = $this->post($url_param, $observe_permissions, $data);

            $blog = new Blogs();
            $blog_data = $blog->getRecordsBasedOnPaginationBlock($url_param, $data['pagination'], $observe_permissions);
            $new_data = [
                // blog index
                'blog_id' => $blog_data['blog_id'],
                'blog_created_by_user_id' => $blog_data['created_by_user_id'],
                'blog_last_edit_date' => $blog_data['last_edit_date'],
                'blog_preview_image' => $blog_data['preview_image'],
                'blog_observe_permissions' => $blog_data['observe_permissions'],
                'blog_category' => $blog_data['category'],
                'blog_title' => $blog_data['title'],
                'blog_rank' => $blog_data['rank'],
                'blog_views' => $blog_data['views'],
            ];
            $data = mergeAsocArrays($data, $new_data);

            $this->view('index/page', $data);
        } else {
            die('Page Not Found!');
        }
    }

    public function devs()
    {
        if (isAdminLoggedIn() === true) {
            // Init
            $observe_permissions = $this->getObservePermissions();
            $data = $this->getData(NULL);
            // POST
            $data = $this->post(NULL, $observe_permissions, $data);

            $properties = [
                "Browser" => "Google Chrome",
                "PHP" => "v7.3.10 (This server use PHP v" . phpversion() . ")",
                "Database" => "MySQL (PDO connection required)",
                "jQuery" => "v3.4.1",
                "Bootstrap" => "v4.5.2",
                "Tinymce" => "v5.4.1",
            ];
            $data['title'] = "Development";
            $data['properties'] = $properties;

            $this->view('index/devs/index', $data);
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }

    public function phpinfo()
    {
        if (isAdminLoggedIn() === true) {
            $this->view('index/devs/phpinfo');
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }

    /******************************************************************************************************************/
    public function tests()
    {
        if (isAdminLoggedIn() === true) {
            // Init
            $observe_permissions = $this->getObservePermissions();
            $data = $this->getData(NULL);
            // POST
            $data = $this->post(NULL, $observe_permissions, $data);

            $aHelpersFiles = getAllFilesInDir(APPROOT . DIRECTORY_SEPARATOR . 'helpers');

            $data['title'] = "Tests";
            $data['aHelpersFiles'] = $aHelpersFiles;

            $this->view('index/tests/index', $data);
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }

    public function benchmark()
    {
        if (isAdminLoggedIn() === true) {
            $aEchoVsPrint = echo_vs_print();
            $aSingleVsDoubleQuotes = single_vs_double_quotes();
            $aIfVsSwitch = if_vs_switch();
            $aForVsWhileCounting = for_vs_while_counting();
            $aReadLoop = readAssocArray_foreach_vs_for();
            $aWriteLoop = writeAssocArray_for_vs_while();
            $aModifyLoop = modifyAssocArray_foreach_vs_for();

            $data['title'] = "Performance Testing";
            $data['stringOutputs'] = $aEchoVsPrint;
            $data['quotes'] = $aSingleVsDoubleQuotes;
            $data['conditions'] = $aIfVsSwitch;
            $data['countingLoops'] = $aForVsWhileCounting;
            $data['readLoop'] = $aReadLoop;
            $data['writeLoop'] = $aWriteLoop;
            $data['modifyLoop'] = $aModifyLoop;

            $this->view('index/tests/benchmark', $data);
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }

    public function date_helper()
    {
        if (isAdminLoggedIn() === true) {
            $this->view('index/tests/helpers/date_helper');
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }

    public function var_helper()
    {
        if (isAdminLoggedIn() === true) {
            $this->view('index/tests/helpers/var_helper');
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }
    /******************************************************************************************************************/

} // end class