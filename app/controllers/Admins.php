<?php
// Load tests
require_once APPROOT . '/tests/benchmark.php';

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
            $data = [
                'title' => "Tests",
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
            $aPagesPaths = getPagesPaths(APPROOT . DIRECTORY_SEPARATOR . 'views');
            $aPagesLinks = getPagesLinks(APPROOT . DIRECTORY_SEPARATOR . 'views');
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
                            $pagesPath_err = "page already exists with $viewPath";
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
                    // 1. create new folder tree in folder 'views'
                    $viewPath = VIEWSROOT;
                    for($i=0; $i<getArraySize($aPagesPathRelativeParts); $i++) {
                        if($i !== (getArraySize($aPagesPathRelativeParts) - 1)){
                            $viewPath .= DIRECTORY_SEPARATOR . $aPagesPathRelativeParts[$i];
                            if(! file_exists($viewPath)){
                                mkdir($viewPath, 0755);
                            }
                        } else {
                            // last element is file.php
                            $viewFile = $aPagesPathRelativeParts[$i];
                        }
                    }
                    // 2. create new file.php in a new folder
                    if(! file_exists($viewPath . DIRECTORY_SEPARATOR . $viewFile)){
                        touch($viewPath . DIRECTORY_SEPARATOR . $viewFile);
                        // 2.1 copy and replace vars from inc/Model.txt in a new Model
                        copyOneFileToAnother(VIEWSROOT . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'View.txt', $viewPath . DIRECTORY_SEPARATOR . $viewFile);
                    } else {
                        die('Could not create ' . $viewPath . DIRECTORY_SEPARATOR . $viewFile);
                    }
                    // 3. create new file Model.php in folder 'models'
                    $modelPath = MODELSROOT;
                    $modelFile = getFirstDirAfterURLROOT($pagesLink);
                    $modelFile = setFistCharUppercase($modelFile);
                    $modelFileName = deleteCharsInStringBasedOnPosition($modelFile, -1);
                    $modelFile = $modelFileName . '.php';
                    if(! file_exists($modelPath . DIRECTORY_SEPARATOR . $modelFile)){
                        touch($modelPath . DIRECTORY_SEPARATOR . $modelFile);
                        // 3.1 copy and replace vars from inc/Model.txt in a new Model
                        copyOneFileToAnother($modelPath . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'Model.txt', $modelPath . DIRECTORY_SEPARATOR . $modelFile);
                        replaceAllMatchesInFileWithString($modelPath . DIRECTORY_SEPARATOR . $modelFile, array('[.:MODEL_CLASS:.]'), array($modelFileName));
                    }
                    // 4. create new file Controller.php in folder 'controllers'
                    $controllerPath = CONTROLLERSROOT;
                    $controllerFile = getFirstDirAfterURLROOT($pagesLink);
                    $controllerFileName = setFistCharUppercase($controllerFile);
                    $controllerFile = $controllerFileName . '.php';
                    if(! file_exists($controllerPath . DIRECTORY_SEPARATOR . $controllerFile)){
                        touch($controllerPath . DIRECTORY_SEPARATOR . $controllerFile);
                        // 4.1 copy and replace vars from inc/Controller.txt in a new Controller
                        copyOneFileToAnother($controllerPath . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'Controller.txt', $controllerPath . DIRECTORY_SEPARATOR . $controllerFile);
                        $aControllerVars = array('[.:CONTROLLER_CLASS:.]', '[.:MODEL_CLASS:.]', '[.:MODEL_CLASS_TO_LOWERCASE:.]', '[.:PAGE_NAME:.]', '[.:PAGE_PATH:.]');
                        // (1)
                        $pages_path = str_replace(VIEWSROOT . DIRECTORY_SEPARATOR, '', $pagesPath);
                        // (2)
                        $pages_path = str_replace('\\', '/', $pages_path);
                        $aControllerVarsReplace = array($controllerFileName, $modelFileName, setFistCharLowercase($modelFileName), deleteCharsInStringBasedOnPosition($viewFile, -4), deleteCharsInStringBasedOnPosition($pages_path, -4));
                        replaceAllMatchesInFileWithString($controllerPath . DIRECTORY_SEPARATOR . $controllerFile, $aControllerVars, $aControllerVarsReplace);
                    } else {
                        // add new method to Controller.php

                    }

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
                   deleteFolderWithAllPages($sPage);
                }
                // delete only one page
                if(is_file($sPage)){

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