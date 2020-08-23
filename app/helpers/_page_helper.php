<?php
/**
 * @goal   autoload all css files from core and custom dirs
 * @param
 * @result html     @example <link rel="stylesheet" href="http://localhost/bolkun/public/core/css/1.bootstrap.css">
 */
function autoload_stylesheet(){
    // core styles
    $aStyles = getAllFilesInDir(PUBLIC_CORE_CSSROOT);
    foreach ($aStyles as $file){
        if(preg_match("/^.*\.css$/", $file)){
            echo '<link rel="stylesheet" href="' . PUBLIC_CORE_CSSURL . '/' . $file .'">';
        }
    }
    unset($aStyles);

    // custom styles
    $aStyles = getAllFilesInDir(PUBLIC_CUSTOM_CSSROOT);
    foreach ($aStyles as $file){
        if(preg_match("/^.*\.css$/", $file)){
            echo '<link rel="stylesheet" href="' . PUBLIC_CUSTOM_CSSURL . '/' . $file .'">';
        }
    }
    unset($aStyles);
}

/**
 * @goal   autoload all js files from core and custom dirs
 * @param
 * @result html     @example <script src="http://localhost/bolkun/core/js/1.jquery-3.4.1.min.js"></script>
 */
function autoload_javascript(){
    // core js files
    $aJs = getAllFilesInDir(PUBLIC_CORE_JSROOT);
    foreach ($aJs as $file){
        if(preg_match("/^.*\.js$/", $file)){
            echo '<script src="' . PUBLIC_CORE_JSURL . '/' . $file .'"></script>';
        }
    }
    unset($aJs);

    //custom js files
    $aJs = getAllFilesInDir(PUBLIC_CUSTOM_JSROOT);
    foreach ($aJs as $file){
        if(preg_match("/^.*\.js$/", $file)){
            echo '<script src="' . PUBLIC_CORE_JSURL . '/' . $file .'"></script>';
        }
    }
    unset($aJs);
}

/**
 * @goal   get all pages paths based on a folder tree structure
 * @param
 * @return array
 */
function getPagesPaths(){
    // get list of views folders
    $aPagesDirs = getAllFilesInDir(VIEWSROOT);

    // hide reserved pages
    unset($aPagesDirs[array_search('inc', $aPagesDirs, true)]);
    unset($aPagesDirs[array_search('admins', $aPagesDirs, true)]);
    unset($aPagesDirs[array_search('index', $aPagesDirs, true)]);

    // reset keys from 0 to n
    $aPagesDirs = resetArrayKeys($aPagesDirs);

    // fill array with built absolute paths
    $aPagesPaths = array();

    foreach($aPagesDirs as $dir){
        if(is_dir(VIEWSROOT . DIRECTORY_SEPARATOR . $dir)){
            $aPagesFiles = getAllFilesInDir(VIEWSROOT . DIRECTORY_SEPARATOR . $dir);
            foreach($aPagesFiles as $file){
                array_push($aPagesPaths, VIEWSROOT . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $file);
            }
        }
    }

    return $aPagesPaths;
}

/**
 * @goal   get all pages links based on a folder tree structure
 * @param
 * @return array
 */
function getPagesLinks(){
    $aPagesPaths = getPagesPaths();
    $aPagesLinks = array();

    foreach($aPagesPaths as $path){
        if(is_file($path)){
            if(preg_match("/^.*\.php$/", $path)){
                // convert path to link
                $fileName = basename($path);
                // (1) replace "\" with "/"
                $link = str_replace('\\', '/', $path);
                // (2) delete everything before "views"
                $link = strstr($link, 'views');
                // (3) delete "views/"
                $link = preg_replace('/views/', '', $link);
                if($fileName != 'index.php'){
                    // (4) remove '.php'
                    $link = str_replace('.php', '', $link);
                } else {
                    $link = str_replace('/index.php', '', $link);
                }
                array_push($aPagesLinks, URLROOT . $link);
            }
        }
    }

    return $aPagesLinks;
}

/**
 * @goal   get view dir name of a page
 * @param  string $pathView      @example C:\xampp\htdocs\bolkun\app\views\examples\index.php or C:\xampp\htdocs\bolkun\app\views\examples\test.php
 * @return string                @example examples
 */
function getViewFolder($pathView){
    // remove views root
    $sPathViewDirNoViewRoot = str_replace(VIEWSROOT . DIRECTORY_SEPARATOR, '', $pathView);
    // make array of parts
    $aPathViewDirParts = explode(DIRECTORY_SEPARATOR, $sPathViewDirNoViewRoot);
    $viewFolder = $aPathViewDirParts[0];

    return $viewFolder;
}

/**
 * @goal   get page file name
 * @param  string $pathViewFile      @example C:\xampp\htdocs\bolkun\app\views\examples\index.php or C:\xampp\htdocs\bolkun\app\views\examples\test.php
 * @return string                    @example index.php or test.php
 */
function getViewFile($pathViewFile){
    if(! is_file($pathViewFile)){
        die("Error getPageFile(): param is not a file!");
    } else {
        // remove views root
        $sPathViewDirNoViewRoot = str_replace(VIEWSROOT . DIRECTORY_SEPARATOR, '', $pathViewFile);
        // make array of parts
        $aPathViewDirParts = explode(DIRECTORY_SEPARATOR, $sPathViewDirNoViewRoot);
        $pageFile = $aPathViewDirParts[1];
    }

    return $pageFile;
}

/**
 * @goal   get controller file name
 * @param  string $pathViewDir      @example C:\xampp\htdocs\bolkun\app\views\examples or C:\xampp\htdocs\bolkun\app\views\examples\test.php
 * @return string                   @example Examples.php
 */
function getControllerFile($pathViewDir){
    $viewFolder = getViewFolder($pathViewDir);

    $controllerFileNoExtension = setFistCharUppercase($viewFolder);
    $controllerFile = $controllerFileNoExtension . '.php';

    return $controllerFile;
}

/**
 * @goal   get model file name
 * @param  string $pathViewDir      @example C:\xampp\htdocs\bolkun\app\views\examples or C:\xampp\htdocs\bolkun\app\views\examples\test.php
 * @return string                   @example Example.php
 */
function getModelFile($pathViewDir){
    $viewFolder = getViewFolder($pathViewDir);

    $controllerFileNoExtension = setFistCharUppercase($viewFolder);
    $modelFileNoExtension = deleteCharsInStringBasedOnPosition($controllerFileNoExtension, -1);
    $modelFile = $modelFileNoExtension . '.php';

    return $modelFile;
}

/**
 * @goal   create new page directory in folder views
 * @param  string $pagePath     @example C:\xampp\htdocs\bolkun\app\views\examples or C:\xampp\htdocs\bolkun\app\views\examples\test.php
 * @result new dir              @example dir name 'examples'
 */
function createViewsFolder($pagePath){
    $pageFolderName = getViewFolder($pagePath);
    $pageFolderPath = VIEWSROOT . DIRECTORY_SEPARATOR . $pageFolderName;

    if(! file_exists($pageFolderPath)){
        mkdir($pageFolderPath, 0755);
    }
}

/**
 * @goal   create new php file for a new page
 * @param  string $pagePath     @example C:\xampp\htdocs\bolkun\app\views\examples\index.php or C:\xampp\htdocs\bolkun\app\views\examples\test.php
 * @result new php file         @wxample new file with name 'index.php' or 'test.php'
 */
function createViewsFile($pagePath){
    $pathIncView = VIEWSROOT . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'View.txt';

    if(! file_exists($pagePath)){
        // copy and replace vars from inc/Views.txt in a new View
        copyOneFileToAnother($pathIncView, $pagePath);
    } else {
        die('Could not create ' . $pagePath . '! File already exists.');
    }
}

/**
 * @goal   create new file Model.php in folder 'models'
 * @param  string $pagePath     @example C:\xampp\htdocs\bolkun\app\views\examples\index.php or C:\xampp\htdocs\bolkun\app\views\examples\test.php
 * @result new php file         @wxample new file with name 'Example.php'
 */
function createModelsFile($pagePath){
    $pageModelFile = getModelFile($pagePath);
    $pageModelPath = MODELSROOT . DIRECTORY_SEPARATOR . $pageModelFile;
    $pathIncModel = MODELSROOT . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'Model.txt';

    if(! file_exists($pageModelFile)){
        // copy from inc/Model.txt in a new 'Model.php'
        copyOneFileToAnother($pathIncModel, $pageModelPath);
        // replace vars in 'Model.php'
        $pageModelFileName = deleteCharsInStringBasedOnPosition($pageModelFile, -4);    # delete .php
        replaceAllMatchesInFileWithString($pageModelPath, array('[.:MODEL_CLASS:.]'), array($pageModelFileName));
    }
}

/**
 * @goal   create new file Controller.php in folder 'controllers'
 * @param  string $pagePath     @example C:\xampp\htdocs\bolkun\app\views\examples\index.php or C:\xampp\htdocs\bolkun\app\views\examples\test.php
 * @result new php file         @wxample new file with name 'Examples.php'
 */
function createControllersFile($pagePath){
    $pageControllerFile = getControllerFile($pagePath);
    $pageControllerPath = CONTROLLERSROOT . DIRECTORY_SEPARATOR . $pageControllerFile;
    $pathIncController = CONTROLLERSROOT . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'Controller.txt';

    $pageModelFile = getModelFile($pagePath);
    $pageViewFile = getViewFile($pagePath);

    if(! file_exists($pageControllerPath)){
        // copy from inc/Controller.txt in a new 'Controller.php'
        copyOneFileToAnother($pathIncController, $pageControllerPath);
    }

    // add new method to Controller.php
    # (1) save Function.txt to string
    $pathIncFunction = CONTROLLERSROOT . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'Function.txt';
    $sNewFunction = file_get_contents($pathIncFunction);
    # (2) replace /* [.:NEW_FUNCTION:.] */ in Controller.php with string
    replaceAllMatchesInFileWithString($pageControllerPath, array('/* [.:NEW_FUNCTION:.] */'), array($sNewFunction));
    # (3) replace vars in Controller.php
    $aControllerVars = array(
        '[.:CONTROLLER_CLASS:.]',
        '[.:MODEL_CLASS:.]',
        '[.:MODEL_CLASS_TO_LOWERCASE:.]',
        '[.:PAGE_NAME:.]',
        '[.:SHORT_PAGE_PATH:.]');
    $shortPagePath = getViewFolder($pagePath) . '/' . getViewFile($pagePath);
    $aControllerVarsReplace = array(
        deleteCharsInStringBasedOnPosition($pageControllerFile, -4),
        deleteCharsInStringBasedOnPosition($pageModelFile, -4),
        deleteCharsInStringBasedOnPosition(setFistCharLowercase($pageModelFile), -4),
        deleteCharsInStringBasedOnPosition($pageViewFile, -4),
        deleteCharsInStringBasedOnPosition($shortPagePath, -4));
    replaceAllMatchesInFileWithString($pageControllerPath, $aControllerVars, $aControllerVarsReplace);
}

/**
 * @goal   replace all matches in a file with another string, needed for page creation
 * @param  string $path, array $match, array $replace     @example C:\xampp\info.txt, change_this_a, with_this_b
 * @result modified file
 */
function replaceAllMatchesInFileWithString($path, $match, $replace){
    $sizeMatch = count($match);
    $sizeReplace = count($replace);
    if($sizeMatch !== $sizeReplace){
        die("Error replaceAllMatchesInFileWithString(): two arrays don't match the same size.");
    } else {
        // read the entire string
        $fileContent = file_get_contents($path);
        for($i=0; $i<$sizeMatch; $i++){
            // replace matches with a string
            $fileContent = str_replace($match[$i], $replace[$i], $fileContent);
        }
        // rewrite the entire file
        if (! file_put_contents($path, $fileContent)) {
            die("Error replaceAllMatchesInFileWithString(): couldn't rewrite the file");
        }
    }
}

/**
 * @goal   delete folder with all pages
 * @param  string $pathViewDir  @example C:\xampp\htdocs\bolkun\app\views\examples
 * @result deleted files
 */
function deleteAllPages($pathViewDir){
    // (1) delete View folder tree
    deleteFolderTreeRecursively($pathViewDir);
    // (2) delete Controller file
    $pathControllerFile = CONTROLLERSROOT . DIRECTORY_SEPARATOR . getControllerFile($pathViewDir);
    deleteFile($pathControllerFile);
    // (3) delete Modal file
    $pathModelFile = MODELSROOT . DIRECTORY_SEPARATOR . getModelFile($pathViewDir);
    deleteFile($pathModelFile);
    // (4) clear Database
}

/**
 * @goal   delete one page
 * @param  string $pathViewFile @example C:\xampp\htdocs\bolkun\app\views\examples\index.php
 * @result deleted files
 */
function deleteOnePage($pathViewFile){
    // (1) delete View file
    deleteFile($pathViewFile);
    // (2) delete Controller function
    $pathControllerFile = CONTROLLERSROOT . DIRECTORY_SEPARATOR . getControllerFile($pathViewFile);
    $viewFile = basename($pathViewFile);    # index.php
    $functionName = deleteCharsInStringBasedOnPosition($viewFile, -4); # index
    # Controller.php to string
    $sNewFunction = file_get_contents($pathControllerFile);
    # replace everything between two matches (inclusive matches)
    $start = 'public function ' . $functionName . '\(\)';
    $end = '} \/\* ' . $functionName . ' function end \*\/';
    $sNewFunction = preg_replace('/(' . $start. ')(.+?)(' . $end . '\s+)/s','', $sNewFunction);
    // rewrite a file
    file_put_contents($pathControllerFile, $sNewFunction);
    // (4) clear Database, NEEDS CONSTRUCT!*/
}

/**
 * @goal   get real ip address from a visitor, when they are also using a proxy
 * @result string
 */
function getUserIP(){
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
        $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client,FILTER_VALIDATE_IP)) {
        $ip = $client;
    } elseif(filter_var($forward,FILTER_VALIDATE_IP)) {
        $ip = $forward;
    } else {
        $ip = $remote;
    }

    return $ip;
}
