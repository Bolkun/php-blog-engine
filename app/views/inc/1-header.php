<?php
/*
 * Cache control for development
 */
clearPageCache();
/*
 * Downtime control for development
 */
websiteIsDown(DOWNTIME);
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="keywords" content="<?php echo getKeywords($data['blog_title']); ?>">
    <meta name="description" content="Web application to store different kind of Information like news, films, blog, photography and more">
    <meta name="author" content="Serhiy Bolkun">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?php echo SITENAME; ?></title>
    <link rel="shortcut icon" href="<?php echo PUBLIC_CORE_IMG_UIURL . '/logo24x24.png'; ?>" type="image/png">
    <?php
    // Autoload Stylesheet
    autoload_stylesheet();
    // Autoload JavaScript
    autoload_javascript();
    if (isAdminLoggedIn() === true) {
        echo '<script src="' . PUBLIC_CORE_JSURL . '/ajax/ajax-admin.js' . '"></script>' . "\n";
    }
    ?>
</head>

<body onload='displayDivs(<?php echo jsonEncodeArray($data['display_div']); ?>)'>