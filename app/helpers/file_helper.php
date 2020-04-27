<?php
/**
 * @goal   copy text from one file to another file
 * @param  string $path1, string $path2     @example C:\xampp\info.txt, C:\xampp\result\backlog.txt
 * @result two files with the same content
 */
function copyOneFileToAnother($path1, $path2){
    if (! copy($path1, $path2)) {
        die("Error copyOneFileToAnother(): file cannot be copied!");
    }
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
