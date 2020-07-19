<?php
    // check session
    if(isLoggedIn() === false){
        if((URLCURRENT != (URLROOT . "/users/login")) && (URLCURRENT != (URLROOT . "/users/register"))){
			redirect('users/login');
        }
    }
    /*
     * Cache control for development
     */
    clearPageCache();
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="x-ua-compatible" content="ie=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo SITENAME; ?></title>
    <link rel="shortcut icon" href="<?php echo PUBLIC_CORE_IMG_UIURL; ?>/logo24x24.png" type="image/png">
    <?php
        // Autoload Stylesheet
        autoload_stylesheet();
    ?>
</head>
<body>
<?php
    // check session
    if(isAdminLoggedIn() === true){
        require APPROOT . '/views/inc/nav/admin/nav-top-admin.php';
        require APPROOT . '/views/inc/nav/admin/nav-top-page.php';
        echo '<script src="' . PUBLIC_CORE_JSURL . '/tinymce/1.tinymce.min.js' . '"></script>';
        echo '<script src="' . PUBLIC_CORE_JSURL . '/tinymce/2.init-tinymce.js' . '"></script>';
    } elseif(isUserLoggedIn() === true) {
        require APPROOT . '/views/inc/nav/user/nav-top-user.php';
    }
?>
