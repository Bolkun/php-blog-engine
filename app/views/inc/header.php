<?php
    // check session
    if(isLoggedIn() === false){
        if((URLBASE != (URLROOT . "/users/login")) && (URLBASE != (URLROOT . "/users/register"))){
			redirect('users/login');
        }
    }
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo SITENAME; ?></title>
    <link rel="shortcut icon" href="<?php echo URLROOT; ?>/img/icon/logo.png" type="image/png">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/bootstrap3.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/jquery-ui-timepicker-addon.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
    <?php //fullcalender-3.9.0 ?>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/js/fullcalendar-3.9.0/fullcalendar.css">
</head>
<body>
    
