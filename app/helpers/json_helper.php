<?php

//Param: object
function jsonEncode($oData){
    // convert object to associative array
    $aData = (array) $oData;
    $sJSON = json_encode($aData);
    return $sJSON;
}