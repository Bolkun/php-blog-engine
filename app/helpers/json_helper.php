<?php
/**
 * @goal    convert array data to JSON readable string, usable for AJAX post requests
 * @param   array $array @example print_r ([id] => 1 [created] => John ...)
 * @return  string         @example print_r {"id":"1","created":"John" ...)
 */
function jsonEncodeArray($array)
{
    $oData = NULL;
    // convert object to associative array
    $aData = (array)$oData;
    $aData['array'] = $array;
    $sJSON = json_encode($aData);
    return $sJSON;
}

/**
 * @goal    convert object data to JSON readable string, usable for AJAX post requests
 * @param   object $oData, string $sID, string $sTitle
 * @return  string
 */
function jsonEncodeMenu($oData = NULL, $id, $title)
{
    // convert object to associative array
    $aData = (array)$oData;
    // add url to array being posted to
    $aData['blog_id'] = $id;
    $aData['title'] = $title;
    $aData['URLCURRENT'] = URLCURRENT;
    $aData['URLROOT'] = URLROOT;
    $aData['VIEWSROOT'] = VIEWSROOT;
    $sJSON = json_encode($aData);
    return $sJSON;
}

/**
 * @goal    convert object data to JSON readable string, usable for AJAX post requests
 * @param   object $oData
 * @return  string
 */
function jsonEncodeMenuAddChild($oData = NULL)
{
    // convert object to associative array
    $aData = (array)$oData;
    // add url to array being posted to
    $aData['URLCURRENT'] = URLCURRENT;
    $sJSON = json_encode($aData);
    return $sJSON;
}

/**
 * @goal    convert object data to JSON readable string, usable for AJAX post requests
 * @param   object $oData
 * @return  string
 */
function jsonEncodeMenuEditTitle($oData = NULL)
{
    // convert object to associative array
    $aData = (array)$oData;
    // add url to array being posted to
    $aData['URLCURRENT'] = URLCURRENT;
    $sJSON = json_encode($aData);
    return $sJSON;
}

/**
 * @goal    convert object data to JSON readable string, usable for AJAX post requests
 * @param   object $oData, string $preview_image
 * @return  string
 */
function jsonSelectedPreviewImage($oData = NULL, $preview_image)
{
    // convert object to associative array
    $aData = (array)$oData;
    // add url to array being posted to
    $aData['URLCURRENT'] = URLCURRENT;
    $aData['PUBLIC_CORE_IMG_PREVIEWURL'] = PUBLIC_CORE_IMG_PREVIEWURL;
    $aData['DEFAULT_PREVIEW_IMAGE'] = DEFAULT_PREVIEW_IMAGE;
    $aData['preview_image'] = $preview_image;
    $sJSON = json_encode($aData);
    return $sJSON;
}

/**
 * @goal    convert object data to JSON readable string, usable for AJAX post requests
 * @param   object $oData, string $social_image
 * @return  string
 */
function jsonSelectedSocialImage($oData = NULL, $social_image)
{
    // convert object to associative array
    $aData = (array)$oData;
    // add url to array being posted to
    $aData['URLCURRENT'] = URLCURRENT;
    $aData['PUBLIC_CORE_IMG_SOCIALURL'] = PUBLIC_CORE_IMG_SOCIALURL;
    $aData['DEFAULT_SOCIAL_IMAGE'] = DEFAULT_SOCIAL_IMAGE;
    $aData['social_image'] = $social_image;
    $sJSON = json_encode($aData);
    return $sJSON;
}

/**
 * @goal    convert object data to JSON readable string, usable for AJAX post requests
 * @param   object $oData, string $id, string $name
 * @return  string
 */
function jsonEncodeDeleteSocialMedia($oData = NULL, $id, $name)
{
    // convert object to associative array
    $aData = (array)$oData;
    // add url to array being posted to
    $aData['URLCURRENT'] = URLCURRENT;
    $aData['id'] = $id;
    $aData['name'] = $name;
    $sJSON = json_encode($aData);
    return $sJSON;
}

/**
 * @goal    convert object data to JSON readable string, usable for AJAX post requests
 * @param   int $pagination_block
 * @return  string
 */
function jsonPagination($oData = NULL, $pagination_block)
{
    // convert object to associative array
    $aData = (array)$oData;
    // add url to array being posted to
    $aData['URLCURRENT'] = URLCURRENT;
    // block to load
    $aData['pagination_block'] = $pagination_block;
    $sJSON = json_encode($aData);
    return $sJSON;
}
