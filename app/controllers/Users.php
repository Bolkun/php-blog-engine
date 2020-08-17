<?php

class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    /*
     * All Pages ▼
     */
	public function register()
    {
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
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
                    flash('register_success', 'You are registered and can log in', 'alert success');
                    redirect(strtolower(STARTPAGE));
                } else {
                    die('Something went wrong');
                }
            } else {
                // Return errors
                return $data;
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

            return $data;
        }
    }

    public function login()
    {
        // Check for POST
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
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
                    redirect(strtolower(STARTPAGE));
                } else {
                    $data['password_err'] = 'Password incorrect';
                    return $data;
                }
            } else {
                // return errors
                return $data;
            }
        } else {
            // Init data
            if(isLoggedIn() === true){
                redirect(strtolower(STARTPAGE));
            } else {
                $data = [
                    'email' => '',
                    'password' => '',
                    'role' => '',
                    'email_err' => '',
                    'password_err' => ''
                ];

                // Load view
                return $data;
            }
        }
    }

    public function settingsUserEmail()
    {

    }

    public function settingsUserPassword()
    {

    }

    public function settingsAdminChangeRole()
    {
	    if(isAdminLoggedIn()){
            $_SESSION['temp_user_role'] = 'Mitarbeiter';
            $_SESSION['user_role'] = 'Mitarbeiter';
        } elseif(isUserLoggedIn()){
            if(isAdminLoggedInAsCoworker()){
                $_SESSION['user_role'] = 'Admin';
                unset($_SESSION['temp_user_role']);
            }
        }
        redirect(strtolower(STARTPAGE));
    }

    public function logout()
    {
        destroyUserSession();
        redirect(strtolower(STARTPAGE));
    }
}