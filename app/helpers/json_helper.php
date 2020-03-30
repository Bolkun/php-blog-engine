<?php
/**
 * @goal    convert object data to JSON readable string, usable for AJAX post requests
 * @param   object $oData @example print_r ([id] => 1 [created] => John ...)
 * @return  string        @example print_r {"id":"1","created":"John",...)
 */
function jsonEncode($oData = NULL){
    // convert object to associative array
    $aData = (array) $oData;
    // add url to array being posted to
    $aData['URLBASE'] = URLBASE;
    $aData['URLROOT'] = URLROOT;
    $aData['VIEWSROOT'] = VIEWSROOT;
    $sJSON = json_encode($aData);
    return $sJSON;
}