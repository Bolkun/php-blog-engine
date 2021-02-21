<?php

/**
 * @goal    convert array data to JSON readable string, usable for AJAX post requests
 * @param   array associative $array @example print_r ('id'=>1, 'created'=>'John'
 * @return  string                   @example print_r {"array":{"id":1,"created":"John"}}
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
 * @return  string  @example print_r {"URLROOT":"https:\/\/test.net\/bolkun"}
 */
function jsonEncodeURLRoot()
{
    // add url to array being posted to
    $aData['URLROOT'] = URLROOT;
    $sJSON = json_encode($aData);
    return $sJSON;
}

/**
 * @goal    convert object data to JSON readable string, usable for AJAX post requests
 * @param   string $sID, string $sTitle
 * @return  string
 */
function jsonEncodeMenu($id, $title)
{
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
 * @param   string $social_image
 * @return  string
 */
function jsonSelectedSocialImage($social_image)
{
    // add url to array being posted to
    $aData['URLROOT'] = URLROOT;
    $aData['PUBLIC_CORE_IMG_SOCIALURL'] = PUBLIC_CORE_IMG_SOCIALURL;
    $aData['DEFAULT_SOCIAL_IMAGE'] = DEFAULT_SOCIAL_IMAGE;
    $aData['social_image'] = $social_image;
    $sJSON = json_encode($aData);
    return $sJSON;
}

/**
 * @goal    convert object data to JSON readable string, usable for AJAX post requests
 * @param   string $preview_image
 * @return  string
 */
function jsonSelectedPreviewImage($preview_image)
{
    // add url to array being posted to
    $aData['URLROOT'] = URLROOT;
    $aData['PUBLIC_CORE_IMG_PREVIEWURL'] = PUBLIC_CORE_IMG_PREVIEWURL;
    $aData['DEFAULT_PREVIEW_IMAGE'] = DEFAULT_PREVIEW_IMAGE;
    $aData['preview_image'] = $preview_image;
    $sJSON = json_encode($aData);
    return $sJSON;
}

/**
 * @goal    convert object data to JSON readable string, usable for AJAX post requests
 * @param   string $id, string $name
 * @return  string
 */
function jsonEncodeDeleteSocialMedia($id, $name)
{
    // add url to array being posted to
    $aData['URLROOT'] = URLROOT;
    $aData['id'] = $id;
    $aData['name'] = $name;
    $sJSON = json_encode($aData);
    return $sJSON;
}
