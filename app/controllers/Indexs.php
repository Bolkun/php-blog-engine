<?php

class Indexs extends Controller
{
    private $blogController;
    private $menuController;
    private $userController;

    public function __construct()
    {
        $this->blogController = $this->controller('Blogs');
        $this->menuController = $this->controller('Menus');
        $this->userController = $this->controller('Users');
    }

    /*
     * All Pages ▼
     */
    public function index($blog_title = 0)
    {
        // observe permissions
        $observe_permissions = getUserPermissions();
        
        // Init data
        $data = [
            // blog
            'blog_created_by_user_id' => [],
            'blog_last_edit_date' => [],
            'blog_preview_image' => [],
            'blog_category' => [],
            'blog_title' => $blog_title,    // string or array
            'blog_rank' => [],
            'blog_views' => [],
            'blog_content' => [],
            // main menu
            'mm' => (new Menus)->getMainMenu($observe_permissions),
            'mm_search' => '',
            'mm_edit_title' => '',
            'mm_add_child' => '',
            'mm_search_err' => '',
            'mm_edit_title_err' => '',
            'mm_add_child_err' => '',
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
            $blog->saveContent($blog_title);
            // reload blog content
            $blog_data = $blog->search($blog_title, $observe_permissions);
            $new_data = [
                'blog_content' => $blog_data['content'],
            ];
            $data = mergeAsocArrays($data, $new_data);
        }
        elseif (isset($_POST['submit_search_input'])) {
            $main_menu = new Menus();
            $main_menu_data = $main_menu->search($observe_permissions);
            $new_data = [
                // main menu
                'mm_search' => $main_menu_data['search'],
                'mm_search_err' => $main_menu_data['search_err'],
                'mm' => $main_menu_data['mm_content'],
                // other
                'display_div' => array('collapse_main_menu'),
            ];
            $data = mergeAsocArrays($data, $new_data);
        }
        elseif (isset($_POST['ajax_mm_add_child']) && isset($_POST['ajax_mm_add_child_parentId'])) {
            $main_menu = new Menus();
            $main_menu->addNode();
        } elseif (isset($_POST['ajax_mm_edit_title_id']) && isset($_POST['ajax_mm_edit_title'])) {
            $main_menu = new Menus();
            $main_menu->editTitle();
        } elseif (isset($_POST['ajax_sMainMenuID'])) {
            $main_menu = new Menus();
            $main_menu->deleteBranch();
        }
        elseif (isset($_POST['submitLogin'])) {
            $user = new Users();
            $user_data = $user->login();

            // reload data
            $observe_permissions = getUserPermissions();
            $data['mm'] = (new Menus)->getMainMenu($observe_permissions);

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

        if (is_string($blog_title) && $blog_title !== 'index') {
            // one page
            $blog = new Blogs();
            $blog_data = $blog->search($blog_title, $observe_permissions);
            $new_data = [
                'blog_content' => $blog_data['content'],
            ];
            $data = mergeAsocArrays($data, $new_data);
        }
        elseif (is_int($blog_title) || $blog_title === 'index') {
            // start page
            $blog = new Blogs();
            $blog_data = $blog->start($observe_permissions);
            if ($blog_data !== false) {
                $new_data = [
                    // blog index
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
            die('Page Not Found!');
        }

        $this->view('index/index', $data);
    } // end function

} // end class