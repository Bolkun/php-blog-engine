<?php

class Users extends Controller
{
    private $userModel;

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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['email_err'] = 'Invalid email format';
            } else if ($this->userModel->findUserByEmail($data['email'])) {
                $data['email_err'] = 'Email not allowed';
            }

            // Validate Firstname
            if (empty($data['firstname'])) {
                $data['firstname_err'] = 'Please enter firstname';
            } else if (!preg_match("/^[a-zA-Z ]*$/", $data['firstname'])) {
                $data['firstname_err'] = 'Only letters and white space allowed';
            }

            // Validate Surname
            if (empty($data['surname'])) {
                $data['surname_err'] = 'Please enter surname';
            } else if (!preg_match("/^[a-zA-Z ]*$/", $data['surname'])) {
                $data['surname_err'] = 'Only letters and white space allowed';
            }

            // Validate Password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be at least 6 characters';
            }

            // Validate Confirm Password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please confirm password';
            } else if ($data['password'] != $data['confirm_password']) {
                $data['confirm_password_err'] = 'Password do not match';
            }

            // Make sure errors are empty
            if (empty($data['email_err']) && empty($data['firstname_err']) && empty($data['surname_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                $data['ip'] = getUserIP();
                if ($this->userModel->findUserIPs($data['ip'])) {
                    // Hash Password
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                    // Generate verification code
                    $data['verification_code'] = mt_rand(100000, 999999);   // between 100,000 and 999,999

                    // Register User
                    if ($this->userModel->register($data)) {
                        // Send verification mail
                        $message = "Hallo " . $data['firstname'] . ' ' . $data['surname'] . "!\n\n" .
                            "A sign in attempt requires further verification because we did not recognize your device. To complete the sign in, enter the verification code on the unrecognized device.\n\n" .
                            "Verification code: " . $data['verification_code'] . "\n\n" .
                            "Thanks,\n" .
                            "The " . SITENAME . " Team";
                        $headers = 'From: noreply@company.com';

                        if (mail($data['email'], '[' . SITENAME . '] Please verify your device', $message, $headers)) {
                            // mail send
                        } else {
                            $data['confirm_password_err'] = 'Could not send mail, due to server problems';
                        }

                        $data['password'] = trim($_POST['password']);
                    } else {
                        $data['confirm_password_err'] = 'Could not register user, due to server problems';
                    }
                } else {
                    $data['confirm_password_err'] = 'Could not register user, to much registrations';
                }
            }

            return $data;
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'verification_code' => trim($_POST['verification_code']),
                'role' => '',
                'email_err' => '',
                'password_err' => '',
                'verification_code_err' => '',
            ];

            // Validate email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            } else if ($this->userModel->findUserByEmail($data['email'])) {
                // User found
                // Validate verification code
                if ($this->userModel->getUserAccountStatusByEmail($data['email'])->account_status === '0') {    // inactive
                    if ($data['verification_code'] === $this->userModel->getUserVerificationCodeByEmail($data['email'])->verification_code) {
                        $data['account_status'] = 1;
                        // make account active
                        if ($this->userModel->updateAccountStatus($data)) {
                            unset($data['account_status']);
                        } else {
                            $data['verification_code_err'] = 'Could not change account status, due to server problem';
                        }
                    } else {
                        $data['verification_code_err'] = 'Verification code incorrect';
                    }
                }
            } else {
                // User not found
                $data['password_err'] = 'Username or password incorrect';
            }

            // Validate password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            }

            // Check for role
            if ($this->userModel->getUserRoleByEmail($data['email']) === 'Admin') {
                $data['role'] = 'Admin';
            } else {
                $data['role'] = 'RegisteredUser';
            }

            // Make sure errors are empty
            if (empty($data['email_err']) && empty($data['password_err']) && empty($data['verification_code_err'])) {
                // Check password tries
                $passwordTries = $this->userModel->getPasswordTries($data)->password_tries;
                if ($passwordTries === '-1') {
                    $passwordTries = 1;
                }

                if ($passwordTries > '0') {
                    // Check if user logged in successfully
                    $loggedInUserData = $this->userModel->login($data['email'], $data['password']);
                    if ($loggedInUserData) {
                        // Update password tries if necessary
                        if ($loggedInUserData->password_tries !== '5') {
                            $data['password_tries'] = '5';
                            if ($this->userModel->updatePasswordTries($data)) {
                                // OK
                            } else {
                                $data['password_err'] = 'Could not reset password tries, due to server problems';
                            }
                        }
                        // Create Session
                        createUserSession($loggedInUserData);
                    } else {
                        // Password try -1
                        $data['password_tries'] = $passwordTries - 1;
                        if ($this->userModel->updatePasswordTries($data)) {
                            // OK
                        } else {
                            $data['password_err'] = 'Could not reset password tries, due to server problems';
                        }
                        // Password was incorrect
                        $data['password_err'] = 'Username or password incorrect';
                    }
                } else if ($passwordTries === '0') {
                    // deactivate email
                    $data['account_status'] = '0';
                    if ($this->userModel->updateAccountStatus($data)) {
                        unset($data['account_status']);
                    } else {
                        $data['verification_code_err'] = 'Could not change account status, due to server problem';
                    }
                    // Update verification code
                    $randomNumber = mt_rand(100000, 999999);
                    $verification_code = password_hash($randomNumber, PASSWORD_DEFAULT);
                    if ($this->userModel->updateVerificationCode($data, $verification_code)) {
                        // OK
                    } else {
                        $data['password_err'] = 'Could not update verification code, due to server problems';
                    }
                    // send new verification code
                    $message = "Hallo User!\n\n" .
                        "A sign in attempt requires further verification code because password try limit was reached.\n\n" .
                        "Verification code: " . $verification_code . "\n\n" .
                        "PS: Just copy and paste this long string!" . "\n\n" .
                        "Thanks,\n" .
                        "The " . SITENAME . " Team";
                    $headers = 'From: noreply@company.com';

                    if (mail($data['email'], '[' . SITENAME . '] Please verify your device', $message, $headers)) {
                        // mail send
                    } else {
                        $data['password_err'] = 'Could not send mail, due to server problems';
                    }
                    // set password tries -1
                    $data['password_tries'] = '-1';
                    if ($this->userModel->updatePasswordTries($data)) {
                        // OK
                    } else {
                        $data['password_err'] = 'Could not reset password tries, due to server problems';
                    }

                    $data['password_err'] = 'Email was blocked, check email for verification code';
                } else {
                    $data['password_err'] = 'Password try limit reached, check email for verification code';
                }

            }

            return $data;
        } else {
            // Init data
            $data = [
                'email' => '',
                'password' => '',
                'role' => '',
                'email_err' => '',
                'password_err' => ''
            ];

            return $data;
        }
    }

    public function settingsUserEmail()
    {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'email' => trim($_POST['email']),
                'email_err' => '',
            ];

            // Validate Email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter new email';
            } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['email_err'] = 'Invalid email format';
            } else if ($this->userModel->findUserByEmail($data['email'])) {
                // User exists with this email
                $data['email_err'] = 'This email not allowed';
            }

            // Make sure errors are empty
            if (empty($data['email_err'])) {
                // Generate verification code
                $data['email'] = $_SESSION['user_email'];
                $verification_code = mt_rand(100000, 999999);   // between 100,000 and 999,999
                // Update verification code
                if ($this->userModel->updateVerificationCode($data, $verification_code)) {
                    // Send verification mail
                    $data['email'] = trim($_POST['email']);
                    $message = "Hallo User!\n\n" .
                        "A sign in attempt requires further verification. To complete the sign in, enter the verification code on the next login session.\n\n" .
                        "Verification code: " . $verification_code . "\n\n" .
                        "Thanks,\n" .
                        "The " . SITENAME . " Team";
                    $headers = 'From: noreply@company.com';

                    if (mail($data['email'], '[' . SITENAME . '] Email settings were changed', $message, $headers)) {
                        // Change account status to inactive
                        $data['email'] = $_SESSION['user_email'];
                        $data['account_status'] = 0;
                        if ($this->userModel->updateAccountStatus($data)) {
                            // Change email and logout
                            $data['email'] = trim($_POST['email']);
                            if ($this->userModel->setEmail($data)) {
                                // logout
                                destroyUserSession();
                            } else {
                                $data['email_err'] = 'Could not change email, due to server problems';
                            }
                        } else {
                            $data['email_err'] = 'Could not change account status, due to server problems';
                        }
                    } else {
                        $data['email_err'] = 'Could not send mail, due to server problems';
                    }
                } else {
                    $data['email_err'] = 'Could not change mail, due to server problems';
                }
            }

            return $data;
        } else {
            // Init data
            $data = [
                'email' => '',
                'email_err' => '',
            ];

            return $data;
        }
    }

    public function settingsUserPassword()
    {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'old_password' => trim($_POST['old_password']),
                'new_password' => trim($_POST['new_password']),
                'new_password_confirm' => trim($_POST['new_password_confirm']),
                'old_password_err' => '',
                'new_password_err' => '',
                'new_password_confirm_err' => '',
            ];

            // Validate
            if (empty($data['old_password'])) {
                $data['old_password_err'] = 'Please enter old password';
            } else {
                // Check if old password match existing password
                $loggedInUserData = $this->userModel->login($_SESSION['user_email'], $data['old_password']);
                if ($loggedInUserData === false) {
                    $data['old_password_err'] = 'Old password incorrect';
                }
            }
            if (empty($data['new_password'])) {
                $data['new_password_err'] = 'Please enter new password';
            }
            if (empty($data['new_password_confirm'])) {
                $data['new_password_confirm_err'] = 'Please confirm new password';
            }

            if ($data['new_password'] !== $data['new_password_confirm']) {
                $data['new_password_err'] = 'New password mismatch confirm password';
            }

            // Make sure errors are empty
            if (empty($data['old_password_err']) && empty($data['new_password_err']) && empty($data['new_password_confirm_err'])) {
                // Hash new password
                $data['new_password'] = password_hash($data['new_password'], PASSWORD_DEFAULT);
                // Change password and logout
                $setPasswordStatus = $this->userModel->setPassword($data);

                if ($setPasswordStatus) {
                    // logout
                    destroyUserSession();
                } else {
                    // never be here!
                    header('HTTP/1.0 404 Not Found');
                    die('Something went wrong during password changing process, please try again later');
                }
            } else {
                // return errors
                return $data;
            }
        } else {
            // Init data
            $data = [
                'old_password' => '',
                'new_password' => '',
                'new_password_confirm' => '',
                'old_password_err' => '',
                'new_password_err' => '',
                'new_password_confirm_err' => '',
            ];

            return $data;
        }
    }

    public function settingsAdminChangeRole()
    {
        if (isAdminLoggedIn()) {
            $_SESSION['temp_user_role'] = 'RegisteredUser';
            $_SESSION['user_role'] = 'RegisteredUser';
        } elseif (isUserLoggedIn()) {
            if (isAdminLoggedInAsCoworker()) {
                $_SESSION['user_role'] = 'Admin';
                unset($_SESSION['temp_user_role']);
            }
        }
        redirect('');
    }

    public function logout()
    {
        destroyUserSession();
        redirect(strtolower(''));
    }

}