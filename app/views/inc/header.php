<?php
    // check session
    if(isLoggedIn() === false){
        if((URLCURRENT != (URLROOT . "/users/login")) && (URLCURRENT != (URLROOT . "/users/register"))){
			redirect('users/login');
        }
    }
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="x-ua-compatible" content="ie=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo SITENAME; ?></title>
    <link rel="shortcut icon" href="<?php echo URLROOT; ?>/img/icon/logo.png" type="image/png">
    <?php
        /*
        * Autoload Stylesheet
        */
        $aStyles = getAllFilesInDir(CSSROOT);
        foreach ($aStyles as $file){
            if(preg_match("/^.*\.css$/", $file)){
                echo '<link rel="stylesheet" href="' . URLROOT . '/css/' . $file .'">';
            }
        }
        unset($aStyles);
    ?>
</head>
<body>
<?php
    // check session
    if(isAdminLoggedIn() === true){
        require APPROOT . '/views/inc/nav/admin/nav-top-admin.php';
        require APPROOT . '/views/inc/nav/admin/nav-top-page.php';
    } elseif(isMitarbeiterLoggedIn() === true) {
        require APPROOT . '/views/inc/nav/user/nav-top-user.php';
    }
?>

