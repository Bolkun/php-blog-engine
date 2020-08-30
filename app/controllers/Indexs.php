<?php

class Indexs extends Controller
{
    public function __construct()
    {
        $this->menuController = $this->controller('Menus');
        $this->userController = $this->controller('Users');
    }
    /*
     * All Pages ▼
     */
    public function index()
    {
        // Init data
        $default_data = [
            // main menu
            'main_menu' => (new Menus)->getMainMenu(),
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
        if (isset($_POST['submitLogin'])) {
            $user = new Users();
            $user_data = $user->login();
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
            $data = mergeAsocArrays($default_data, $new_data);
            $this->view('index/index', $data);
        }
        elseif (isset($_POST['submitRegister'])){
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
            if(empty($new_data['reg_firstname_err']) && empty($new_data['reg_surname_err']) && empty($new_data['reg_email_err'])
                && empty($new_data['reg_password_err']) && empty($new_data['reg_confirm_password_err'])){
                $new_data['display_div'] = array('collapse_login_menu');
            }

            $data = mergeAsocArrays($default_data, $new_data);
            $this->view('index/index', $data);
        }
        elseif (isset($_POST['submitUserEmail'])){
            $user = new Users();
            $user_data = $user->settingsUserEmail();
            $new_data = [
                // setting email
                'set_email' => $user_data['email'],
                'set_email_err' => $user_data['email_err'],
                // other
                'display_div' => array('collapse_login_menu'),
            ];
            $data = mergeAsocArrays($default_data, $new_data);
            $this->view('index/index', $data);
        }
        elseif (isset($_POST['submitUserPassword'])){
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
            $data = mergeAsocArrays($default_data, $new_data);
            $this->view('index/index', $data);
        }
        else {
            $this->view('index/index', $default_data);
        }
        // index end
    }

}