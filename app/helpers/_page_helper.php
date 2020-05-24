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
 * @param  string $path @example C:\xampp\htdocs\bolkun\app\views
 * @return array
 */
function getPagesPaths($path){
    global $aPagesPaths;
    $aFolderFiles = scandir($path);

    unset($aFolderFiles[array_search('.',  $aFolderFiles, true)]);
    unset($aFolderFiles[array_search('..', $aFolderFiles, true)]);
    unset($aFolderFiles[array_search('inc', $aFolderFiles, true)]);
    unset($aFolderFiles[array_search('admins', $aFolderFiles, true)]);
    unset($aFolderFiles[array_search('users', $aFolderFiles, true)]);
    unset($aFolderFiles[array_search('dashboards', $aFolderFiles, true)]);

    if(count($aFolderFiles) < 1) return;
    foreach($aFolderFiles as $value){
        if(is_dir($path . DIRECTORY_SEPARATOR . $value)){
            // look for files and dirs deeper
            getPagesPaths($path . DIRECTORY_SEPARATOR . $value);
        }
        if(is_file($path . DIRECTORY_SEPARATOR . $value)){
            array_push($aPagesPaths, $path . DIRECTORY_SEPARATOR . $value);
        }
    }

    return $aPagesPaths;
}

/**
 * @goal   get all pages links based on a folder tree structure
 * @param  string $path @example C:\xampp\htdocs\bolkun\app\views
 * @return array
 */
function getPagesLinks($path){
    global $aPagesLinks;
    $aFolderFiles = scandir($path);

    unset($aFolderFiles[array_search('.',  $aFolderFiles, true)]);
    unset($aFolderFiles[array_search('..', $aFolderFiles, true)]);
    unset($aFolderFiles[array_search('inc', $aFolderFiles, true)]);
    unset($aFolderFiles[array_search('admins', $aFolderFiles, true)]);
    unset($aFolderFiles[array_search('users', $aFolderFiles, true)]);
    unset($aFolderFiles[array_search('dashboards', $aFolderFiles, true)]);

    if(count($aFolderFiles) < 1) return;
    foreach($aFolderFiles as $value){
        if(is_dir($path . DIRECTORY_SEPARATOR . $value)){
            getPagesLinks($path . DIRECTORY_SEPARATOR . $value);
        } else {
            // convert $path to link
            // (1) replace "\" with "/"
            $link = str_replace('\\', '/', $path);
            // (2) delete everything before "views"
            $link = strstr($link, 'views');
            // (3) delete "views/"
            $link = preg_replace('/views/', '', $link);
            if($value != 'index.php'){
                // (4) add file.php
                $link = $link . '/' . $value;
                // (5) remove '.php'
                $link = str_replace('.php', '', $link);
            }
            array_push($aPagesLinks, URLROOT . $link);
        }
    }

    return $aPagesLinks;
}

/**
 * @goal   get view dir name of a page
 * @param  string $pathView      @example C:\xampp\htdocs\bolkun\app\views\examples or C:\xampp\htdocs\bolkun\app\views\examples\test.php
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
 * @param  string $pathViewFile      @example C:\xampp\htdocs\bolkun\app\views\examples\test.php
 * @return string                    @example test.php
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
function deleteFolderWithAllPages($pathViewDir){
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
