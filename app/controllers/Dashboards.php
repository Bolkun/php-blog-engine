<?php

class Dashboards extends Controller
{
    public function __construct()
    {
        $this->dashboardModel = $this->model('Dashboard');
        $this->userController = $this->controller('Users');
    }
    /*
     * All Pages ▼
     */
    public function index()
    {
        // POST
        if (isset($_POST['submitLogin'])) {
            $user = new Users();
            $user_data = $user->login();
            $data = [
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
                'log_email' => $user_data['email'],
                'log_password' => $user_data['password'],
                'log_role' => $user_data['role'],
                'log_email_err' => $user_data['email_err'],
                'log_password_err' => $user_data['password_err'],
                // other
                'display_div' => array('collapse_login_menu'),
            ];
            $this->view('dashboards/index', $data);
        } elseif (isset($_POST['submitRegister'])){
            $user = new Users();
            $user_data = $user->register();
            $data = [
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
                // login
                'log_email' => '',
                'log_password' => '',
                'log_role' => '',
                'log_email_err' => '',
                'log_password_err' => '',
                // other
                'display_div' => array('registration_form'),
            ];
            $this->view('dashboards/index', $data);
        } else {
            // Init data
            $data = [
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
                'log_role' => '',
                'log_email_err' => '',
                'log_password_err' => '',
                // other
                'display_div' => array(),
            ];
            $this->view('dashboards/index', $data);
        }
    }
}