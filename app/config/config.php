<?php
// IMPORTANT*: rewrite .htaccess for production (RewriteBase /bolkun/public to /public)

/*** DB ***/
# host*
define('DB_HOST', 'localhost');
# user*
define('DB_USER', 'root');
# pass*
define('DB_PASS', '');
# name*
define('DB_NAME', 'bolkun');

/*** PROJECT ***/
# site name*
define('SITENAME', 'Bolkun');
# app version*
define('APPVERSION', '1.0.0');
# clear page cache*
define('CLEARPAGECACHE', true);
# preview image name
define('DEFAULT_PREVIEW_IMAGE', 'default_preview_image-min.png');
# social image name
define('DEFAULT_SOCIAL_IMAGE', 'default_social_image-min.png');

/*** APP ***/
# app folder (absolute path)
define('APPROOT', dirname(dirname(__FILE__)));
# controllers folder
define('CONTROLLERSROOT', APPROOT . DIRECTORY_SEPARATOR . 'controllers');
# models folder
define('MODELSROOT', APPROOT . DIRECTORY_SEPARATOR . 'models');
# views Folder
define('VIEWSROOT', APPROOT . DIRECTORY_SEPARATOR . 'views');

/*** PUBLIC ***/
# public folder (absolute path)
define('PUBLICROOT', dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'public');
    /*** CORE ***/
    define('PUBLIC_COREROOT', PUBLICROOT . DIRECTORY_SEPARATOR . 'core');
        # css folder
        define('PUBLIC_CORE_CSSROOT', PUBLIC_COREROOT . DIRECTORY_SEPARATOR . 'css');
        # document folder
        define('PUBLIC_CORE_DOCUMENTROOT', PUBLIC_COREROOT . DIRECTORY_SEPARATOR . 'document');
        # download folder
        define('PUBLIC_CORE_DOWNLOADROOT', PUBLIC_COREROOT . DIRECTORY_SEPARATOR . 'download');
        # font folder
        define('PUBLIC_CORE_FONTROOT', PUBLIC_COREROOT . DIRECTORY_SEPARATOR . 'font');
        # img folder
        define('PUBLIC_CORE_IMGROOT', PUBLIC_COREROOT . DIRECTORY_SEPARATOR . 'img');
            # dev folder
            define('PUBLIC_CORE_IMG_DEVROOT', PUBLIC_CORE_IMGROOT . DIRECTORY_SEPARATOR . 'dev');
            # preview folder
            define('PUBLIC_CORE_IMG_PREVIEWROOT', PUBLIC_CORE_IMGROOT . DIRECTORY_SEPARATOR . 'preview');
            # social media folder
            define('PUBLIC_CORE_IMG_SOCIALROOT', PUBLIC_CORE_IMGROOT . DIRECTORY_SEPARATOR . 'social');
            # ui folder
            define('PUBLIC_CORE_IMG_UIROOT', PUBLIC_CORE_IMGROOT . DIRECTORY_SEPARATOR . 'ui');
        # js folder
        define('PUBLIC_CORE_JSROOT', PUBLIC_COREROOT . DIRECTORY_SEPARATOR . 'js');
        # music folder
        define('PUBLIC_CORE_MUSICROOT', PUBLIC_COREROOT . DIRECTORY_SEPARATOR . 'music');
        # object folder
        define('PUBLIC_CORE_OBJECTROOT', PUBLIC_COREROOT . DIRECTORY_SEPARATOR . 'object');
        # video folder
        define('PUBLIC_CORE_VIDEOROOT', PUBLIC_COREROOT . DIRECTORY_SEPARATOR . 'video');

/*** URL ***/
# url root* redirects to STARTPAGE
define('URLROOT', 'http://localhost/bolkun');
# url of current page
define('URLCURRENT', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
# start page* ( Hint: libraries/Core.php calls controllers/Dashboards and method always index() )
define('STARTPAGE', 'Indexs');

/*** PUBLIC ***/
# public url
define('PUBLICURL', URLROOT . '/public');
    /*** CORE ***/
    define('PUBLIC_COREURL', PUBLICURL . '/core');
        # css folder
        define('PUBLIC_CORE_CSSURL', PUBLIC_COREURL . '/css');
        # document folder
        define('PUBLIC_CORE_DOCUMENTURL', PUBLIC_COREURL . '/document');
        # download folder
        define('PUBLIC_CORE_DOWNLOADURL', PUBLIC_COREURL . '/download');
        # font folder
        define('PUBLIC_CORE_FONTURL', PUBLIC_COREURL . '/font');
        # img folder
        define('PUBLIC_CORE_IMGURL', PUBLIC_COREURL . '/img');
            # dev folder
            define('PUBLIC_CORE_IMG_DEVURL', PUBLIC_CORE_IMGURL . '/dev');
            # preview folder
            define('PUBLIC_CORE_IMG_PREVIEWURL', PUBLIC_CORE_IMGURL . '/preview');
            # social folder
            define('PUBLIC_CORE_IMG_SOCIALURL', PUBLIC_CORE_IMGURL . '/social');
            # ui folder
            define('PUBLIC_CORE_IMG_UIURL', PUBLIC_CORE_IMGURL . '/ui');
        # js folder
        define('PUBLIC_CORE_JSURL', PUBLIC_COREURL . '/js');
        # music folder
        define('PUBLIC_CORE_MUSICURL', PUBLIC_COREURL . '/music');
        # object folder
        define('PUBLIC_CORE_OBJECTURL', PUBLIC_COREURL . '/object');
        # video folder
        define('PUBLIC_CORE_VIDEOURL', PUBLIC_COREURL . '/video');

/*** OTHER ***/
