<?php

    session_start();

    // Flash message helper
    // EXAMPLE 1 - flash('register_success', 'You are now registered');
    // EXAMPLE 2 - flash('register_failed', 'You are not registered', 'alert alert-danger');
    // DISPLAY IN VIEW - echo flash('register_success');
    function flash($name = '', $message = '', $class = 'alert alert-success'){
        if(!empty($name)){
            if(!empty($message) && empty($_SESSION[$name])){
                if(!empty($_SESSION[$name])){
                    unset($_SESSION[$name]);
                }
                if(!empty($_SESSION[$name . '_class'])){
                    unset($_SESSION[$name . '_class']);
                }
                $_SESSION[$name] = $message;
                $_SESSION[$name . '_class'] = $class;
            } elseif(empty($message) && !empty($_SESSION[$name])){
                $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
                echo '<div class="' . $class . '" id="msg-flash">' . $_SESSION[$name] . '</div>';
                unset($_SESSION[$name]);
                unset($_SESSION[$name . '_class']);
            }
        }
    }

    function isLoggedIn()
    {
        if(isset($_SESSION['user_id']) && isset($_SESSION['user_email']) && isset($_SESSION['user_firstname']) && isset($_SESSION['user_surname']) && isset($_SESSION['user_role'])){
            return true;
        } else {
            return false;
        }
    }

    function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->user_id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_firstname'] = $user->firstname;
        $_SESSION['user_surname'] = $user->surname;
        $_SESSION['user_role'] = $user->role;
    }

    function isAdminLoggedIn()
    {
        if($_SESSION['user_role'] == 'Admin'){
            // Admin logt in
            return true;
        } else {
            return false;
        }
    }

    function isMitarbeiterLoggedIn()
    {
        if($_SESSION['user_role'] == 'Mitarbeiter'){
            // Mitarbeiter logt in
            return true;
        } else {
            return false;
        }
    }

    function destroyUserSession()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_firstname']);
        unset($_SESSION['user_surname']);
        unset($_SESSION['user_role']);
        session_destroy();
    }
