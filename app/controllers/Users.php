<?php

class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        $this->login();
    }
    /*
     * All Pages ▼
     */
	public function register()
    {
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Process form

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'firstname' => trim($_POST['firstname']),
                'surname' => trim($_POST['surname']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'firstname_err' => '',
                'surname_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // Validate Email
            if(empty($data['email'])){
                $data['email_err'] = 'Please enter email';
            } else {
                // Check email
                if($this->userModel->findUserByEmail($data['email'])){
                    $data['email_err'] = 'Email is already taken';
                }
            }

            // Validate Firstname
            if(empty($data['firstname'])){
                $data['firstname_err'] = 'Please enter firstname';
            }

            // Validate Surname
            if(empty($data['surname'])){
                $data['surname_err'] = 'Please enter surname';
            }

            // Validate Password
            if(empty($data['password'])){
                $data['password_err'] = 'Please enter password';
            } elseif(strlen($data['password']) < 6){
                $data['password_err'] = 'Password must be at least 6 characters';
            }

            // Validate Confirm Password
            if(empty($data['confirm_password'])){
                $data['confirm_password_err'] = 'Please confirm password';
            } else {
                if($data['password'] != $data['confirm_password']){
                    $data['confirm_password_err'] = 'Password do not match';
                }
            }
            
            // Make sure errors are empty
            if(empty($data['email_err']) && empty($data['firstname_err']) && empty($data['surname_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
                // Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Register User
                if($this->userModel->register($data)){
                    flash('register_success', 'You are registered and can log in');
                    redirect('users/login');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('users/register', $data);
            }
        } else {
            // Init data
            $data = [
                'firstname' => '',
                'surname' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'firstname_err' => '',
                'surname_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // Load view
            $this->view('users/register', $data);
        }
    }

    public function login()
    {
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'role' => '',
                'email_err' => '',
                'password_err' => '',
            ];

            // Validate Email
            if(empty($data['email'])){
                $data['email_err'] = 'Please enter email';
            }

            // Validate Password
            if(empty($data['password'])){
                $data['password_err'] = 'Please enter password';
            }

            // Check for user/email
            if($this->userModel->findUserByEmail($data['email'])){
                // User found
            } else {
                // User not found
                $data['email_err'] = 'No user found';
            }

            // Check for user/role
            if($this->userModel->getUserRoleByEmail($data['email']) == 'Admin'){
                $data['role'] = 'Admin';
            } else {
                $data['role'] = 'Mitarbeiter';
            }

            // Make sure errors are empty
            if(empty($data['email_err']) && empty($data['password_err'])){
                // Validated
                // Check and set logged in user
                $loggedInUserData = $this->userModel->login($data['email'], $data['password']);

                if($loggedInUserData){
                    // Create Session
                    createUserSession($loggedInUserData);
                    redirect('dashboards/');
                } else {
                    $data['password_err'] = 'Password incorrect';
                    $this->view('users/login', $data);
                }
            } else {
                // Load view with errors
                $this->view('users/login', $data);
            }
        } else {
            // Init data
            if(isLoggedIn() === true){
                redirect('dashboards/');
            } else {
                $data = [
                    'email' => '',
                    'password' => '',
                    'role' => '',
                    'email_err' => '',
                    'password_err' => ''
                ];

                // Load view
                $this->view('users/login', $data);
            }
        }
    }

    public function logout()
    {
        destroyUserSession();
        redirect('/users/login');
    }

    public function settings()
    {
        $data = [
            'title' => "Einstellungen",
        ];
        $this->view('users/settings', $data);
    }
}