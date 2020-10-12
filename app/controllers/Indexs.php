<?php

class Indexs extends Controller
{
    private $blogController;
    private $userController;

    public function __construct()
    {
        $this->blogController = $this->controller('Blogs');
        $this->userController = $this->controller('Users');
    }

    /*
     * All Pages ▼
     */
    public function index($url_param = 0)
    {
        // Init data
        $observe_permissions = getUserPermissions();
        $data = [
            'url_param' => $url_param,
            // blog
            'blog_id' => [],
            'blog_created_by_user_id' => [],
            'blog_last_edit_date' => [],
            'blog_preview_image' => [],
            'blog_category' => [],
            'blog_title' => [],
            'blog_rank' => [],
            'blog_views' => [],
            'blog_content' => [],
            'blog_mm' => (new Blogs)->menu($observe_permissions),
            'blog_mm_search' => '',
            'blog_mm_edit_title' => '',
            'blog_mm_add_child' => '',
            'blog_mm_search_err' => '',
            'blog_mm_edit_title_err' => '',
            'blog_mm_add_child_err' => '',
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

        // POST
        if (isset($_POST['submit_blog_ta_tinymce'])) {
            $blog = new Blogs();
            $blog->saveContent($url_param);
            // reload blog content
            $blog_data = $blog->getAll($url_param, $observe_permissions);
            $new_data = [
                'blog_content' => $blog_data['content'],
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
        elseif (isset($_POST['ajax_mm_add_child']) && isset($_POST['ajax_mm_add_child_parentId'])) {
            $blog = new Blogs();
            $blog->add();
        }
        elseif (isset($_POST['ajax_mm_edit_title_id']) && isset($_POST['ajax_mm_edit_title'])) {
            $blog = new Blogs();
            $blog->editTitle();
        }
        elseif (isset($_POST['ajax_sMainMenuID'])) {
            $blog = new Blogs();
            $blog->deleteBranch($observe_permissions);
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

        if (is_numeric($url_param) && $url_param != '0') {
            // one page
            $blog = new Blogs();
            $blog_data = $blog->getRecord($url_param, $observe_permissions);
            $new_data = [
                'blog_content' => $blog_data['content'],
            ];
            $data = mergeAsocArrays($data, $new_data);
        }
        elseif ($url_param == '0' || $url_param === 'index') {
            // start page
            $blog = new Blogs();
            $blog_data = $blog->index($observe_permissions);
            if ($blog_data !== false) {
                $new_data = [
                    // blog index
                    'blog_id' => $blog_data['blog_id'],
                    'blog_created_by_user_id' => $blog_data['created_by_user_id'],
                    'blog_last_edit_date' => $blog_data['last_edit_date'],
                    'blog_preview_image' => $blog_data['preview_image'],
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
    } // end function

} // end class