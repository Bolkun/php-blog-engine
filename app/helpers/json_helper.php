<?php

//Param: object
function jsonEncode($oData){
    // convert object to associative array
    $aData = (array) $oData;
    // add url being posted to
    $aData['URLBASE'] = URLBASE;
    $sJSON = json_encode($aData);
    return $sJSON;
}