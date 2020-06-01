<?php

class Admins extends Controller
{
    public function __construct()
    {
        $this->pageModel = $this->model('Admin');
    }
    /*
     * All Pages ▼
     */
    public function devs()
    {
        // Only for Admin
        if(isAdminLoggedIn() === true){
            $properties = [
                "Browser" => "Google Chrome",
                "PHP" => "v7.3.10 (This server use PHP v". phpversion() . ")",
                "Database" => "MySQL (PDO connection required)",
                "jQuery" => "v3.4.1",
                "Bootstrap" => "v4.4.1",
            ];

            $data = [
                'title' => "Development",
                'properties' => $properties,
            ];
            $this->view('admins/devs/index', $data);
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }

    public function phpinfo()
    {
        // Only for Admin
        if(isAdminLoggedIn() === true){
            $this->view('admins/devs/phpinfo');
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }
    /*****************************************************************************************************************/
    public function tests()
    {
        // Only for Admin
        if(isAdminLoggedIn() === true){
            $aHelpersFiles = getAllFilesInDir(APPROOT . DIRECTORY_SEPARATOR . 'helpers');
            $data = [
                'title' => "Tests",
                'aHelpersFiles' => $aHelpersFiles,
            ];
            $this->view('admins/tests/index', $data);
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }

    public function benchmark()
    {
        // Only for Admin
        if(isAdminLoggedIn() === true){
            $aEchoVsPrint = echo_vs_print();
            $aSingleVsDoubleQuotes = single_vs_double_quotes();
            $aIfVsSwitch = if_vs_switch();
            $aForVsWhileCounting = for_vs_while_counting();
            $aReadLoop = readAssocArray_foreach_vs_for();
            $aWriteLoop = writeAssocArray_for_vs_while();
            $aModifyLoop = modifyAssocArray_foreach_vs_for();

            $data = [
                'title' => "Performance Testing",
                'stringOutputs' => $aEchoVsPrint,
                'quotes' => $aSingleVsDoubleQuotes,
                'conditions' => $aIfVsSwitch,
                'countingLoops' => $aForVsWhileCounting,
                'readLoop' => $aReadLoop,
                'writeLoop' => $aWriteLoop,
                'modifyLoop' => $aModifyLoop,
            ];
            $this->view('admins/tests/benchmark', $data);
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }

    public function date_helper()
    {
        // Only for Admin
        if(isAdminLoggedIn() === true){
            $this->view('admins/tests/helpers/date_helper');
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }
    public function var_helper()
    {
        // Only for Admin
        if(isAdminLoggedIn() === true){
            $this->view('admins/tests/helpers/var_helper');
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }
    /*****************************************************************************************************************/
    public function users()
    {
        // Only for Admin
        if(isAdminLoggedIn() === true){
            $data = [
                'title' => "Users",
            ];
            $this->view('admins/users/index', $data);
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }

    public function add()
    {
        // Only for Admin
        if(isAdminLoggedIn() === true){
            $data = [
                'title' => "Neue Mitarbeiter erstellen",
            ];
            $this->view('admins/users/add', $data);
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }

    public function delete()
    {
        // Only for Admin
        if(isAdminLoggedIn() === true){
            $data = [
                'title' => "Mitarbeiter entfernen",
            ];
            $this->view('admins/users/delete', $data);
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }

    public function info()
    {
        // Only for Admin
        if(isAdminLoggedIn() === true){
            $data = [
                'title' => "Mitarbeiter persönliche Informationen",
            ];
            $this->view('admins/users/info', $data);
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }

    public function list()
    {
        // Only for Admin
        if(isAdminLoggedIn() === true){
            $data = [
                'title' => "Mitarbeiter Liste",
            ];
            $this->view('admins/users/list', $data);
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }
    /*****************************************************************************************************************/
    public function newEditDelete()
    {
        // Only for Admin
        if(isAdminLoggedIn() === true){
            $aPagesPaths = getPagesPaths();
            $aPagesLinks = getPagesLinks();
            $iCountPagesPaths = getArraySize($aPagesPaths);
            $iCountPagesLinks = getArraySize($aPagesLinks);
            if ($iCountPagesPaths !== $iCountPagesLinks) {
                die('Pages paths not match pages links!');
            } else {
                $iPagesCount = $iCountPagesPaths;
            }
            // POST
            if (!empty($_POST['submitNewPage'])) {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                // validate POST data
                if(!empty(trim($_POST['pagesPath']))){
                    $pagesPath = trim($_POST['pagesPath']);
                    $pagesPath_err = '';
                    if(strpos($pagesPath, VIEWSROOT . DIRECTORY_SEPARATOR) === false){
                        $pagesPath_err = "Views root " . VIEWSROOT . DIRECTORY_SEPARATOR . " not specified";
                    }
                    // remove views root
                    $pagesPathRelative = str_replace(VIEWSROOT . DIRECTORY_SEPARATOR, '', $pagesPath);
                    // make array of parts
                    $aPagesPathRelativeParts = explode(DIRECTORY_SEPARATOR, $pagesPathRelative);
                    // check if folder and file specified
                    if(getArraySize($aPagesPathRelativeParts) !== 2){
                        $pagesPath_err = "Required " . VIEWSROOT . DIRECTORY_SEPARATOR . "[folder]" . DIRECTORY_SEPARATOR . "[file.php]";
                    } else {
                        for($i=0; $i<getArraySize($aPagesPathRelativeParts); $i++) {
                            if($i !== (getArraySize($aPagesPathRelativeParts) - 1)){
                                // check folders
                                if(! preg_match("/[a-z0-9_-]/", $aPagesPathRelativeParts[$i])){
                                    $pagesPath_err = "Folder don't match regex [a-z0-9_-]";
                                    break;
                                }
                                // check reserved folders
                                if($aPagesPathRelativeParts[$i] === 'inc' || $aPagesPathRelativeParts[$i] === 'admins' ||
                                    $aPagesPathRelativeParts[$i] === 'users' || $aPagesPathRelativeParts[$i] === 'dashboards'){
                                    $pagesPath_err = "Folders like \"inc, admins, users, dashboards\" are reserved.";
                                    break;
                                }
                            } else {
                                // last key of array must be a file.php
                                if(! preg_match("/[a-z0-9_-].php/", $aPagesPathRelativeParts[$i])){
                                    print $pagesPathRelative[$i];
                                    $pagesPath_err = "File don't match regex[a-z0-9_-].php";
                                    break;
                                }
                                // NEEDS CONSTRUCT FILE.PHP CLASS LINK validation with regex
                            }
                        }
                    }
                    // check if path already exists
                    foreach ($aPagesPaths as $viewPath){
                        if($viewPath === $pagesPath){
                            $pagesPath_err = "Page already exists with $viewPath";
                            break;
                        }
                    }
                } else {
                    $pagesPath = '';
                    $pagesPath_err = 'Page path cannot be empty';
                }
                if(!empty(trim($_POST['pagesLink']))){
                    $pagesLink = trim($_POST['pagesLink']);
                    $pagesLink_err = '';
                } else {
                    $pagesLink = '';
                    $pagesLink_err = 'Page link cannot be empty';
                }
                // EVERYTHING OK
                if(empty($pagesPath_err) && empty($pagesLink_err)){
                    // 1. create new folder in dir 'views'
                    createViewsFolder($pagesPath);
                    // 2. create new file.php in a new folder
                    createViewsFile($pagesPath);
                    // 3. create new file Model.php in folder 'models'
                    createModelsFile($pagesPath);
                    // 4. create new file Controller.php in folder 'controllers' or add new function
                    createControllersFile($pagesPath);

                    flash('pages', "New page processed success!<br>link: <a href=\"$pagesLink\">$pagesLink</a>", "alert success");
                    // reload table
                    array_unshift($aPagesPaths, $pagesPath);    // add as first el. of an array
                    array_unshift($aPagesLinks, $pagesLink);    // add as first el. of an array
                    $iCountPagesPaths = getArraySize($aPagesPaths);
                    $iCountPagesLinks = getArraySize($aPagesLinks);
                    if ($iCountPagesPaths !== $iCountPagesLinks) {
                        die('Pages paths not match pages links after reloading table!');
                    } else {
                        $iPagesCount = $iCountPagesPaths;
                    }
                } else {
                    flash('pages', 'New page creation failed!', "alert danger");
                }
                // Init data
                $data = [
                    //POST DATA DEFAULT
                    'pagesPath' => $pagesPath,
                    'pagesLink' => $pagesLink,
                    //POST DATA ERROR DEFAULT
                    'pagesPath_err' => $pagesPath_err,
                    'pagesLink_err' => $pagesLink_err,
                    //OTHER
                    'title' => "New/Edit/Delete",
                    'aPagesPaths' => $aPagesPaths,
                    'aPagesLinks' => $aPagesLinks,
                    'iPagesCount' => $iPagesCount,
                ];
                $this->view('admins/pages/newEditDelete', $data);
            } elseif (!empty($_POST['ajax_sPage'])) {
                $sPage = $_POST['ajax_sPage'];
                // delete folder with all pages
                if(is_dir($sPage)){
                   deleteAllPages($sPage);
                }
                // delete only one page
                if(is_file($sPage)){
                    deleteOnePage($sPage);
                }
                // Init data
                $data = [
                    //POST DATA DEFAULT
                    'pagesPath' => '',
                    'pagesLink' => '',
                    //POST DATA ERROR DEFAULT
                    'pagesPath_err' => '',
                    'pagesLink_err' => '',
                    //OTHER
                    'title' => "New/Edit/Delete",
                    'aPagesPaths' => $aPagesPaths,
                    'aPagesLinks' => $aPagesLinks,
                    'iPagesCount' => $iPagesCount,
                ];
                $this->view('admins/pages/newEditDelete', $data);
            } else {
                // Init data
                $data = [
                    //POST DATA DEFAULT
                    'pagesPath' => '',
                    'pagesLink' => '',
                    //POST DATA ERROR DEFAULT
                    'pagesPath_err' => '',
                    'pagesLink_err' => '',
                    //OTHER
                    'title' => "New/Edit/Delete",
                    'aPagesPaths' => $aPagesPaths,
                    'aPagesLinks' => $aPagesLinks,
                    'iPagesCount' => $iPagesCount,
                ];
                $this->view('admins/pages/newEditDelete', $data);
            }
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }
    /*****************************************************************************************************************/

}