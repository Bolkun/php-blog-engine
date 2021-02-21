<?php

class Indexs extends Controller
{
    private $blogController;
    private $userController;
    private $preview_imageController;
    private $social_mediaController;
    private $social_imageController;

    private $observe_permissions;

    public function __construct()
    {
        $this->blogController = $this->controller('Blogs');
        $this->userController = $this->controller('Users');
        $this->preview_imageController = $this->controller('Preview_Images');
        $this->social_mediaController = $this->controller('Social_Medias');
        $this->social_imageController = $this->controller('Social_Images');

        $this->observe_permissions = $this->getObservePermissions();
    }

    private function getObservePermissions()
    {
        return getUserPermissions();
    }

    private function getData($url_param)
    {
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
            'social_image_list' => [],
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
            'pagination' => (new Blogs)->pagination($this->observe_permissions),
            // blog mm
            'blog_mm' => (new Blogs)->menu($this->observe_permissions),
            'blog_mm_search' => '',
            'blog_mm_edit_title' => '',
            'blog_mm_add_child' => '',
            'blog_mm_delete_branch' => '',
            'blog_mm_search_err' => '',
            'blog_mm_edit_title_err' => '',
            'blog_mm_add_child_err' => '',
            'blog_mm_delete_branch_err' => '',
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

    private function post($url_param, $data)
    {
        if (isset($_POST['submit_blog_ta_tinymce'])) {
            $blog = new Blogs();
            $blog_data = $blog->saveBlogPage($url_param, $this->observe_permissions);
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
        } elseif (isset($_POST['submitLogin'])) {
            $user = new Users();
            $user_data = $user->login();

            // reload data
            $this->observe_permissions = getUserPermissions();
            $data['blog_mm'] = (new Blogs)->menu($this->observe_permissions);

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
                'pagination' => (new Blogs)->pagination($this->observe_permissions),
                // other
                'display_div' => array('collapse_login_menu'),
            ];
            $data = mergeAsocArrays($data, $new_data);
        } elseif (isset($_POST['submitRegister'])) {
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
            if (
                empty($new_data['reg_firstname_err']) && empty($new_data['reg_surname_err']) && empty($new_data['reg_email_err'])
                && empty($new_data['reg_password_err']) && empty($new_data['reg_confirm_password_err'])
            ) {
                $new_data['display_div'] = array('collapse_login_menu');
            }

            $data = mergeAsocArrays($data, $new_data);
        } elseif (isset($_POST['submitUserEmail'])) {
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
        } elseif (isset($_POST['submitUserPassword'])) {
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
        } elseif (isset($_POST['submitSocialMedia'])) {
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
        } elseif (isset($_POST['submit_search_input'])) {
            $blog = new Blogs();
            $blog_data = $blog->search_menu($this->observe_permissions);
            $new_data = [
                // main menu
                'blog_mm_search' => $blog_data['search'],
                'blog_mm_search_err' => $blog_data['search_err'],
                'blog_mm' => $blog_data['content'],
                // other
                'display_div' => array('collapse_main_menu'),
            ];
            $data = mergeAsocArrays($data, $new_data);
        } elseif (isset($_POST['submit_add_child_input'])) {
            $blog = new Blogs();
            $blog_data = $blog->add();
            $new_data = [
                // blog_mm
                'blog_mm' => (new Blogs)->menu($this->observe_permissions),
                'blog_mm_add_child_err' => $blog_data['mm_add_child_err'],
                // other
                'display_div' => array('collapse_main_menu', 'mm_add_child_form', $blog_data['parent_id']),
            ];
            $data = mergeAsocArrays($data, $new_data);
        } elseif (isset($_POST['submit_edit_title_input'])) {
            $blog = new Blogs();
            $blog_data = $blog->editTitle();
            $new_data = [
                // blog_mm
                'blog_mm' => (new Blogs)->menu($this->observe_permissions),
                'blog_mm_edit_title_err' => $blog_data['mm_edit_title_err'],
                // other
                'display_div' => array('collapse_main_menu', 'mm_edit_title_form', $blog_data['blog_id']),
            ];
            $data = mergeAsocArrays($data, $new_data);
        } elseif (isset($_POST['submit_delete_branch_input'])) {
            $blog = new Blogs();
            $blog_data = $blog->deleteBranch($this->observe_permissions);
            $new_data = [
                // blog_mm
                'blog_mm' => (new Blogs)->menu($this->observe_permissions),
                'blog_mm_delete_branch_err' => $blog_data['mm_delete_branch_err'],
                // other
                'display_div' => array('collapse_main_menu', 'mm_delete_branch_form'),
            ];
            $data = mergeAsocArrays($data, $new_data);
        }

        return $data;
    }

    /*
     * All Pages ▼
     */
    public function index($url_param = 0)
    {
        // Init
        $data = $this->getData($url_param);
        // POST
        $data = $this->post($url_param, $data);

        // Pages
        if ($url_param !== 0) {
            // one page
            $blog = new Blogs();
            $blog_data = $blog->getRecord($url_param, $this->observe_permissions);
            $new_data = [
                'blog_created_by_user_id' => $blog_data['created_by_user_id'],
                'blog_last_edit_date' => $blog_data['last_edit_date'],
                'blog_preview_image' => $blog_data['preview_image'],
                'blog_observe_permissions' => $blog_data['observe_permissions'],
                'blog_category' => $blog_data['category'],
                'blog_id' => $blog_data['blog_id'],
                'blog_title' => $blog_data['title'],
                'blog_rank' => $blog_data['rank'],
                'blog_content' => $blog_data['content'],
            ];
            $data = mergeAsocArrays($data, $new_data);
        } elseif ($url_param === 0) {
            // all pages
            $blog = new Blogs();
            $blog_data = $blog->index($this->observe_permissions);

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
        } else {
            die('Blog Page Not Found!');
        }

        $this->view('index/index', $data);
    }

    public function page($url_param = 0)
    {
        if ($url_param !== 0) {
            // Init
            $data = $this->getData($url_param);
            // POST
            $data = $this->post($url_param, $data);

            $blog = new Blogs();
            $blog_data = $blog->getRecordsBasedOnPaginationBlock($url_param, $data['pagination'], $this->observe_permissions);
            if ($blog_data) {
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
                die('Page Not Exist!');
            }
        } else {
            die('Page Not Found!');
        }
    }

    /******************************************************************************************************************/
    public function phpinfo()
    {
        if (isAdminLoggedIn() === true) {
            $this->view('index/devs/phpinfo');
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }

    public function php($url_param = 0)
    {
        if (isAdminLoggedIn() === true) {
            // Init
            $data = $this->getData($url_param);
            // POST
            $data = $this->post($url_param, $data);

            $this->view('index/devs/php', $data);
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }
    /******************************************************************************************************************/

    public function benchmark($url_param = 0)
    {
        if (isAdminLoggedIn() === true) {
            // Init
            $data = $this->getData($url_param);
            // POST
            $data = $this->post($url_param, $data);

            $data['title'] = "Performance Testing";

            $this->view('index/tests/benchmark', $data);
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }

    /******************************************************************************************************************/

    public function ajax_deleteSocialMedia()
    {
        if (isset($_POST['ajax_sDeleteSocialMediaID'])) {
            $sm = new Social_Medias();
            $sm->delete();
        }
    }

    public function ajax_deleteSocialImage()
    {
        if (isset($_POST['ajax_sDeleteSocialImage'])) {
            // delete social image
            $social_image = new Social_Images();
            $social_image->deleteSocialImage();
            // load social image list
            $data = [
                'social_image_list' => (new Social_Images)->loadList(),
            ];
            $this->view('index/ajax/ajax_loadSocialImageList', $data);
        }
    }

    public function ajax_deletePreviewImage()
    {
        if (isset($_POST['ajax_sDeletePreviewImage'])) {
            // delete preview image
            $preview_image = new Preview_Images();
            $preview_image->deletePreviewImage();
            // load preview image list
            $preview_image_data = $preview_image->loadList();
            $data = [
                'preview_image_list' => $preview_image_data['preview_image_list'],
            ];
            $this->view('index/ajax/ajax_loadPreviewImageList', $data);
        }
    }

    public function ajax_loadBlogPage()
    {
        if (isset($_POST['ajax_sDisplayBlogContentID'])) {
            $blog = new Blogs();
            $blog_id = trim($_POST['ajax_sDisplayBlogContentID']);
            $blog_data = $blog->getRecord($blog_id, $this->observe_permissions);
            $data = [
                'blog_content' => $blog_data['content'],
            ];
            $this->view('index/ajax/ajax_loadBlogPage', $data);
        }
    }

    public function ajax_loadPreviewImageList()
    {
        if (isset($_POST['ajax_sLoadPreviewImageList'])) {
            $preview_image = new Preview_Images();
            $preview_image_data = $preview_image->loadList();
            $data = [
                'preview_image_list' => $preview_image_data['preview_image_list'],
            ];
            $this->view('index/ajax/ajax_loadPreviewImageList', $data);
        }
    }

    public function ajax_loadSocialImageList()
    {
        if (isset($_POST['ajax_sLoadSocialImageList'])) {
            $data = [
                'social_image_list' => (new Social_Images)->loadList(),
            ];
            $this->view('index/ajax/ajax_loadSocialImageList', $data);
        }
    }

    /******************************************************************************************************************/
}
