<?php

/**
 * @goal   get all files in directory, except . and ..
 * @param  string $pathDir   @example C:\xampp\htdocs\bolkun\app\views\examples
 * @return array $aFiles
 */
function getAllFilesInDir($pathDir)
{
    if (!is_dir($pathDir)) {
        die("getAllFilesInDir(): param is not a directory! $pathDir");
    }
    $aFiles = scandir($pathDir);
    // filtering dots out of the array
    $aFiles = array_diff($aFiles, array('.', '..'));
    // reset keys from 0 to n
    $aFilesModify = resetArrayKeys($aFiles);
    return $aFilesModify;
}

/**
 * @goal   deletes (recursively) all files in directory and folder itself
 * @param  string $pathDir   @example C:\xampp\htdocs\bolkun\app\views\examples
 * @result deletes folder tree and folder itself
 */
function deleteFolderTreeRecursively($pathDir)
{
    if (is_dir($pathDir)) {
        $files = glob($pathDir . DIRECTORY_SEPARATOR . '*');
        foreach ($files as $file) {
            is_dir($file) ? deleteFolderTreeRecursively($file) : unlink($file);
        }
        rmdir($pathDir);
        return;
    }
}
