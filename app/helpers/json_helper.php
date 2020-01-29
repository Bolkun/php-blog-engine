<?php
/**
 * @goal    convert object data to JSON readable string
 * @param   object $oData @example print_r ([id] => 1 [created] => John ...)
 * @return  string        @example print_r {"id":"1","created":"John",...)
 */
function jsonEncode($oData){
    // convert object to associative array
    $aData = (array) $oData;
    // add url to array being posted to
    $aData['URLBASE'] = URLBASE;
    $sJSON = json_encode($aData);
    return $sJSON;
}