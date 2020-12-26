<?php
/**
 * @goal   autoload all css files from core and custom dirs
 * @param
 * @result html     @example <link rel="stylesheet" href="http://localhost/bolkun/public/core/css/1.bootstrap.css">
 */
function autoload_stylesheet()
{
    // core css files
    $aStyles = getAllFilesInDir(PUBLIC_CORE_CSSROOT);
    foreach ($aStyles as $file) {
        if (preg_match("/^.*\.css$/", $file)) {
            echo '<link rel="stylesheet" href="' . PUBLIC_CORE_CSSURL . '/' . $file . '">' . "\n    ";
        }
    }
    unset($aStyles);
}

/**
 * @goal   autoload all js files from core and custom dirs
 * @param
 * @result html     @example <script src="http://localhost/bolkun/core/js/1.jquery-3.4.1.min.js"></script>
 */
function autoload_javascript()
{
    // core js files
    $aJs = getAllFilesInDir(PUBLIC_CORE_JSROOT);
    foreach ($aJs as $file) {
        if (preg_match("/^.*\.js$/", $file)) {
            echo '<script src="' . PUBLIC_CORE_JSURL . '/' . $file . '"></script>' . "\n";
        }
    }
    unset($aJs);
}

/**
 * @goal   get real ip address from a visitor, when they are also using a proxy
 * @result string
 */
function getUserIP()
{
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
        $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote = $_SERVER['REMOTE_ADDR'];

    if (filter_var($client, FILTER_VALIDATE_IP)) {
        $ip = $client;
    } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
        $ip = $forward;
    } else {
        $ip = $remote;
    }

    return $ip;
}

/**
 * @goal   convert array of objects to array of arrays
 * @param  array of objects $array
 * @return array of arrays
 */
function stdToArray($array)
{
    $reaged = (array)$array;
    foreach ($reaged as $key => &$field) {
        if (is_object($field)) $field = stdToArray($field);
    }
    return $reaged;
}

/**
 * @goal   create dynamic tree view
 * @param  int $parent , array (prepared) $menu
 * @return string html
 */
function createTreeView($parent, $menu)
{
    $html = "";
    if (isset($menu['parents'][$parent])) {
        $html .= "<ol class='tree'>";
        foreach ($menu['parents'][$parent] as $itemId) {
            // check permission color
            if (isset($_SESSION['user_role'])) {
                if (isset($menu['items'][$itemId]['observe_permissions'])) {
                    if ($menu['items'][$itemId]['observe_permissions'] === $_SESSION['user_email']) {
                        $permission_color = '#ff7f50';
                    } else if ($menu['items'][$itemId]['observe_permissions'] === 'Admins') {
                        $permission_color = '#f1f227';
                    } else if ($menu['items'][$itemId]['observe_permissions'] === 'RegisteredUsers') {
                        $permission_color = '#98fb98';
                    } else {
                        $permission_color = 'white';
                    }
                } else {
                    $permission_color = 'white';
                }
            }

            if (!isset($menu['parents'][$itemId])) {
                // node with no children
                if (isAdminLoggedIn()) {
                    $html .= "<li><label for='subfolder2'>
                    <i style='color: grey;' id='mmAddChild" . $menu['items'][$itemId]['blog_id'] . "' onclick='mmAddChild(" . jsonEncodeMenu(NULL, $menu['items'][$itemId]['blog_id'], $menu['items'][$itemId]['title']) . ")' class='fa fa-plus mm_add_child_icon' aria-hidden='true'></i>
                    <i style='color: grey;' id='mmEditTitle" . $menu['items'][$itemId]['blog_id'] . "' onclick='mmEditTitle(" . jsonEncodeMenu(NULL, $menu['items'][$itemId]['blog_id'], $menu['items'][$itemId]['title']) . ")' class='fa fa-pencil mm_edit_title_icon' aria-hidden='true'></i>
                    <a class='main_menu_link' style='color: " . $permission_color . ";' href='" . URLROOT . '/index/' . $menu['items'][$itemId]['blog_id'] . "'>" . $menu['items'][$itemId]['title'] . "</a>
                    <img class='delete_main_menu_el' src='" . PUBLIC_CORE_IMG_UIURL . "/delete_white12x12.png' onclick='ajax_menuDeleteTree(" . jsonEncodeMenu(NULL, $menu['items'][$itemId]['blog_id'], $menu['items'][$itemId]['title']) . ")'></label>
                    <input class='main_menu_checkbox' type='checkbox' name='subfolder2'/></li>";
                } else {
                    $html .= "<li><label for='subfolder2'>
                    <a class='main_menu_link' href='" . URLROOT . '/index/' . $menu['items'][$itemId]['blog_id'] . "'>" . $menu['items'][$itemId]['title'] . "</a></label> 
                    <input class='main_menu_checkbox' type='checkbox' name='subfolder2'/></li>";
                }
            }
            if (isset($menu['parents'][$itemId])) {
                // node with children
                if (isAdminLoggedIn()) {
                    $html .= "<li><label for='subfolder2'>
                    <i style='color: grey;' id='mmAddChild" . $menu['items'][$itemId]['blog_id'] . "' onclick='mmAddChild(" . jsonEncodeMenu(NULL, $menu['items'][$itemId]['blog_id'], $menu['items'][$itemId]['title']) . ")' class='fa fa-plus mm_add_child_icon' aria-hidden='true'></i>
                    <i style='color: grey;' id='mmEditTitle" . $menu['items'][$itemId]['blog_id'] . "' onclick='mmEditTitle(" . jsonEncodeMenu(NULL, $menu['items'][$itemId]['blog_id'], $menu['items'][$itemId]['title']) . ")' class='fa fa-pencil mm_edit_title_icon' aria-hidden='true'></i>
                    <a class='main_menu_link' style='color: " . $permission_color . ";' href='" . URLROOT . '/index/' . $menu['items'][$itemId]['blog_id'] . "'>" . $menu['items'][$itemId]['title'] . "</a>
                    <img class='delete_main_menu_el' src='" . PUBLIC_CORE_IMG_UIURL . "/delete_white12x12.png' onclick='ajax_menuDeleteTree(" . jsonEncodeMenu(NULL, $menu['items'][$itemId]['blog_id'], $menu['items'][$itemId]['title']) . ")'></label>
                    <input class='main_menu_checkbox' type='checkbox' name='subfolder2'/>";
                    $html .= createTreeView($itemId, $menu);
                    $html .= "</li>";
                } else {
                    $html .= "<li><label for='subfolder2'>
                    <a class='main_menu_link' href='" . URLROOT . '/index/' . $menu['items'][$itemId]['blog_id'] . "'>" . $menu['items'][$itemId]['title'] . "</a></label>
                    <input class='main_menu_checkbox' type='checkbox' name='subfolder2'/>";
                    $html .= createTreeView($itemId, $menu);
                    $html .= "</li>";
                }

                // for displaying mmDropDown All items
                $GLOBALS['HAS_CHILDREN_MM_DROP_DOWN'] = "true";
            }
        }
        $html .= "</ol>";
    }
    return $html;
}

/**
 * @goal   get all ids of a certain branch without root id
 * @param  array $elements , string $parentId
 * @return array
 */
function getBranchIds(array $elements, $parentId)
{
    $branch = array();

    foreach ($elements as $element) {
        if ($element['parent_id'] == $parentId) {
            $children = getBranchIds($elements, $element['blog_id']);
            if ($children) {
                foreach ($children as $child) {
                    array_push($branch, $child);
                }
            }
            array_push($branch, $element['blog_id']);
        }
    }

    return $branch;
}

/**
 * @goal   get keywords from title of a page blog or just website name
 * @param  string $blog_title
 * @return string
 */
function getKeywords($blog_title)
{
    $keywords = '';

    if (preg_match("#^" . URLROOT . '/index/' . "[0-9]+$#", URLCURRENT)) {
        $aKeywords = explode(" ", $blog_title);
        $aKeywordsSize = count($aKeywords);
        for ($i = 0; $i < $aKeywordsSize; $i++) {
            $keywords .= $aKeywords[$i] . ', ';
        }
        $keywords .= $blog_title;
    } else {
        $keywords = SITENAME;
    }

    return $keywords;
}