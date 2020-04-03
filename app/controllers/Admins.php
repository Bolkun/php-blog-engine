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
    public function pages_newEditDelete()
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
                    // check if minimum folder and file specified
                    if(getArraySize($aPagesPathRelativeParts) < 2){
                        $pagesPath_err = "Required minimum " . VIEWSROOT . DIRECTORY_SEPARATOR . "[folder]" . DIRECTORY_SEPARATOR . "[file.php]";
                    } else {
                        for($i=0; $i<getArraySize($aPagesPathRelativeParts); $i++) {
                            if($i !== (getArraySize($aPagesPathRelativeParts) - 1)){
                                // check folders
                                if(! preg_match("/[a-z0-9_-]/", $aPagesPathRelativeParts[$i])){
                                    $pagesPath_err = "Folder don't match regex [a-z0-9_-]";
                                    break;
                                }
                            } else {
                                // last key of array must be a file.php
                                if(! preg_match("/[a-z0-9_-].php/", $aPagesPathRelativeParts[$i])){
                                    print $pagesPathRelative[$i];
                                    $pagesPath_err = "File don't match regex[a-z0-9_-].php";
                                    break;
                                }
                            }
                        }
                    }
                    // check if path already exists
                    foreach ($aPagesPaths as $path){
                        if($path === $pagesPath){
                            $pagesPath_err = "page already exists with $path";
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
                    // create new folders with file
                    $path = VIEWSROOT;
                    for($i=0; $i<getArraySize($aPagesPathRelativeParts); $i++) {
                        if($i !== (getArraySize($aPagesPathRelativeParts) - 1)){
                            $path .= DIRECTORY_SEPARATOR . $aPagesPathRelativeParts[$i];
                            if(! file_exists($path)){
                                mkdir($path, 0755);
                            }
                        } else {
                            $file = $aPagesPathRelativeParts[$i];
                        }
                    }
                    if(! file_exists($path . DIRECTORY_SEPARATOR . $file)){
                        touch($path . DIRECTORY_SEPARATOR . $file);
                    } else {
                        die('Could not create ' . $path . DIRECTORY_SEPARATOR . $file);
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
                $this->view('admins/pages/pages_newEditDelete', $data);
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
                $this->view('admins/pages/pages_newEditDelete', $data);
            }
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }
    /*****************************************************************************************************************/

}