<?php
/**
 * @goal    convert object data to JSON readable string and adds 3 extra key value pairs, usable for AJAX post requests
 * @param   object $oData @example print_r ([id] => 1 [created] => John ...)
 * @return  string        @example print_r {"URLCURRENT":"...","URLROOT":"...","VIEWSROOT":"...","id":"1","created":"John" ...)
 */
function jsonEncode($oData = NULL){
    // convert object to associative array
    $aData = (array) $oData;
    // add url to array being posted to
    $aData['URLCURRENT'] = URLCURRENT;
    $aData['URLROOT'] = URLROOT;
    $aData['VIEWSROOT'] = VIEWSROOT;
    $sJSON = json_encode($aData);
    return $sJSON;
}

/**
 * @goal    convert object data to JSON readable string and adds 4 extra key value pairs, usable for AJAX post requests
 * @param   object $oData, string sPage @example print_r ([id] => 1 [created] => John ...)
 * @return  string                      @example print_r {"URLCURRENT":"...","URLROOT":"...","VIEWSROOT":"...","id":"1","created":"John" ...)
 */
function jsonEncodePage($oData = NULL, $sPage){
    // convert object to associative array
    $aData = (array) $oData;
    // add url to array being posted to
    $aData['sPage'] = $sPage;   // path
    $aData['URLCURRENT'] = URLCURRENT;
    $aData['URLROOT'] = URLROOT;
    $aData['VIEWSROOT'] = VIEWSROOT;
    $sJSON = json_encode($aData);
    return $sJSON;
}

function jsonEncodeString($string){
    $oData = NULL;
    // convert object to associative array
    $aData = (array) $oData;
    $aData['string'] = $string;
    $sJSON = json_encode($aData);
    return $sJSON;
}

function jsonEncodeArray($array){
    $oData = NULL;
    // convert object to associative array
    $aData = (array) $oData;
    $aData['array'] = $array;
    $sJSON = json_encode($aData);
    return $sJSON;
}

function jsonEncodeMenu($oData = NULL, $sID, $sTitle){
    // convert object to associative array
    $aData = (array) $oData;
    // add url to array being posted to
    $aData['blog_id'] = $sID;
    $aData['title'] = $sTitle;
    $aData['URLCURRENT'] = URLCURRENT;
    $aData['URLROOT'] = URLROOT;
    $aData['VIEWSROOT'] = VIEWSROOT;
    $sJSON = json_encode($aData);
    return $sJSON;
}

function jsonEncodeMenuAddChild($oData = NULL){
    // convert object to associative array
    $aData = (array) $oData;
    // add url to array being posted to
    $aData['URLCURRENT'] = URLCURRENT;
    $sJSON = json_encode($aData);
    return $sJSON;
}

function jsonEncodeMenuEditTitle($oData = NULL){
    // convert object to associative array
    $aData = (array) $oData;
    // add url to array being posted to
    $aData['URLCURRENT'] = URLCURRENT;
    $sJSON = json_encode($aData);
    return $sJSON;
}

function jsonSelectedPreviewImage($oData = NULL, $preview_image){
    // convert object to associative array
    $aData = (array) $oData;
    // add url to array being posted to
    $aData['URLCURRENT'] = URLCURRENT;
    $aData['PUBLIC_CORE_IMG_PREVIEWURL'] = PUBLIC_CORE_IMG_PREVIEWURL;
    $aData['DEFAULT_PREVIEW_IMAGE'] = DEFAULT_PREVIEW_IMAGE;
    $aData['preview_image'] = $preview_image;
    $sJSON = json_encode($aData);
    return $sJSON;
}

function jsonSelectedSocialImage($oData = NULL, $social_image){
    // convert object to associative array
    $aData = (array) $oData;
    // add url to array being posted to
    $aData['URLCURRENT'] = URLCURRENT;
    $aData['PUBLIC_CORE_IMG_SOCIALURL'] = PUBLIC_CORE_IMG_SOCIALURL;
    $aData['DEFAULT_SOCIAL_IMAGE'] = DEFAULT_SOCIAL_IMAGE;
    $aData['social_image'] = $social_image;
    $sJSON = json_encode($aData);
    return $sJSON;
}

function jsonEncodeDeleteSocialMedia($oData = NULL, $name){
    // convert object to associative array
    $aData = (array) $oData;
    // add url to array being posted to
    $aData['URLCURRENT'] = URLCURRENT;
    $aData['name'] = $name;
    $sJSON = json_encode($aData);
    return $sJSON;
}
