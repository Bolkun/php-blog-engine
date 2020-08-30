<?php

class Menus extends Controller
{
    public function __construct()
    {
        $this->menuModel = $this->model('Menu');
    }

    /*
     * All Pages ▼
     */
    public function getMainMenu()
    {
        $oData = $this->menuModel->selectMainMenuData();
        if($oData){
            // Convert object to array
            $aData = stdToArray($oData);
            // sort data items
            $aDataSort = array(
                'items' => array(),
                'parents' => array()
            );
            for($i=0; $i<count($aData); $i++){
                // Create current menus item id into array
                $aDataSort['items'][$aData[$i]['id']] = $aData[$i];
                // Creates list of all items with children
                $aDataSort['parents'][$aData[$i]['parent_id']][] = $aData[$i]['id'];
            }
            return $aDataSort;
        } else {
            return false;
        }
    }
}