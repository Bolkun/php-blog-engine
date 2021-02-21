<?php

session_start();

/**
 * @goal   display flash messages in view with echo flash('name');
 * @param  string $name, string $message, string $class @example flash('register', 'You are now registered', '[alert info, alert success, alert warning, alert danger]');
 * @result html
 */
function flash($name = '', $message = '', $class = 'alert alert-success')
{
    if (!empty($name)) {
        if (!empty($message) && empty($_SESSION[$name])) {
            if (!empty($_SESSION[$name])) {
                unset($_SESSION[$name]);
            }
            if (!empty($_SESSION[$name . '_class'])) {
                unset($_SESSION[$name . '_class']);
            }
            $_SESSION[$name] = $message;
            $_SESSION[$name . '_class'] = $class;
        } elseif (empty($message) && !empty($_SESSION[$name])) {
            $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
            echo '<div class="' . $class . '" id="msg-flash">';
            echo '<span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>';
            echo $_SESSION[$name];
            echo '</div>';
?>
            <!--<script>
                setTimeout(function() {
                    $('#msg-flash').fadeOut('fast');
                }, 3000); // after 3 sec hide
            </script>-->
<?php
            unset($_SESSION[$name]);
            unset($_SESSION[$name . '_class']);
        }
    }
}

/**
 * @goal   check if user logged in
 * @return bool
 */
function isLoggedIn()
{
    if (
        isset($_SESSION['user_id']) &&
        isset($_SESSION['user_email']) &&
        isset($_SESSION['user_firstname']) &&
        isset($_SESSION['user_surname']) &&
        isset($_SESSION['user_role'])
    ) {
        return true;
    } else {
        return false;
    }
}

/**
 * @goal   create session for specific user
 * @param  object $user
 */
function createUserSession($user)
{
    $_SESSION['user_id'] = $user->user_id;
    $_SESSION['user_email'] = $user->email;
    $_SESSION['user_firstname'] = $user->firstname;
    $_SESSION['user_surname'] = $user->surname;
    $_SESSION['user_role'] = $user->role;
}

/**
 * @goal   check if admin logged in
 * @return bool
 */
function isAdminLoggedIn()
{
    if (isset($_SESSION['user_role'])) {
        if ($_SESSION['user_role'] === 'Admin') {
            // Admin logged in
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

/**
 * @goal   check if registered user logged in
 * @return bool
 */
function isUserLoggedIn()
{
    if (isset($_SESSION['user_role'])) {
        if ($_SESSION['user_role'] === 'RegisteredUser') {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

/**
 * @goal   get user permissions to view a content
 * @return array
 */
function getUserPermissions()
{
    if (isset($_SESSION['user_role'])) {
        if ($_SESSION['user_role'] === 'Admin') {
            $I = $_SESSION['user_email'];
            $observe_permissions = [$I, 'Admins', 'RegisteredUsers', 'All'];
        } else if ($_SESSION['user_role'] === 'RegisteredUser') {
            $observe_permissions = ['RegisteredUsers', 'All'];
        } else {
            $observe_permissions = ['All'];
        }
    } else {
        $observe_permissions = ['All'];
    }

    return $observe_permissions;
}

/**
 * @goal destroy session for specific user
 */
function destroyUserSession()
{
    unset($_SESSION['user_id']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_firstname']);
    unset($_SESSION['user_surname']);
    unset($_SESSION['user_role']);
    session_destroy();
}
