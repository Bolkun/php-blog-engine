<?php
# basename ( string $path [, string $suffix ] ) : string    // get file name from given path

/**
 * @goal   copy text from one file to another file
 * @param  string $pathFile1, string $pathFile2     @example C:\xampp\info.txt, C:\xampp\result\backlog.txt
 * @result two files with the same content
 */
function copyOneFileToAnother($pathFile1, $pathFile2){
    if (! copy($pathFile1, $pathFile2)) {
        die("Error copyOneFileToAnother(): file cannot be copied!");
    }
}

/**
 * @goal   delete file
 * @param  string $pathFile     @example C:\xampp\htdocs\bolkun\app\controllers\Examples.php
 * @result deleted file
 */
function deleteFile($pathFile){
    if (! unlink($pathFile)) {
        die("Error deleteFile(): file cannot be deleted!");
    }
}

/**
 * @goal   deletes (recursively) all files in directory and folder itself
 * @param  string $pathDir     @example C:\xampp\htdocs\bolkun\app\views\examples
 * @result deletes folder tree and folder itself
 */
function deleteFolderTreeRecursively($pathDir){
    $files = glob($pathDir . DIRECTORY_SEPARATOR . '*');
    foreach ($files as $file) {
        is_dir($file) ? deleteFolderTreeRecursively($file) : unlink($file);
    }
    rmdir($pathDir);
    return;
}

/**
 * @goal   get all files in directory, except . and ..
 * @param  string $pathDir     @example C:\xampp\htdocs\bolkun\app\views\examples
 * @return array $aFiles
 */
function getAllFilesInDir($pathDir){
    if(! is_dir($pathDir)){
        die("getAllFilesInDir(): param is not a directory!");
    }
    $aFiles = scandir($pathDir);
    // filtering dots out of the array
    $aFiles = array_diff($aFiles, array('.', '..'));
    // reset keys from 0 to n
    $aFilesModify = resetArrayKeys($aFiles);
    return $aFilesModify;
}

