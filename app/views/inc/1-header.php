<?php
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
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?php echo SITENAME; ?></title>
    <link rel="shortcut icon" href="<?php echo PUBLIC_CORE_IMG_UIURL . '/logo24x24.png'; ?>" type="image/png">
    <?php
    // Autoload Stylesheet
    autoload_stylesheet();

    // Autoload JavaScript
    autoload_javascript();
    // check session
    if (isAdminLoggedIn() === true) {
        echo '<script src="' . PUBLIC_CORE_JSURL . '/tinymce/1.tinymce.min.js' . '"></script>' . "\n";
        echo '<script src="' . PUBLIC_CORE_JSURL . '/tinymce/2.init-tinymce.js' . '"></script>' . "\n";
    }
    ?>
</head>
<body onload='displayDivs(<?php echo jsonEncodeArray($data['display_div']); ?>)'>