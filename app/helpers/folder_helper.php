<?php
/**
 * @goal   get all directories and files in a tree
 * @param  string $path @example C:\xampp\htdocs\bolkun\app/views
 * @result html
 */
function admin_listFolderFiles($path){
    global $aPAGES_location, $aPAGES_links;
    $aFolderFiles = scandir($path);

    unset($aFolderFiles[array_search('.',  $aFolderFiles, true)]);
    unset($aFolderFiles[array_search('..', $aFolderFiles, true)]);
    unset($aFolderFiles[array_search('inc', $aFolderFiles, true)]);

    // prevent empty ordered elements
    if(count($aFolderFiles) < 1) return;

    echo '<ul class=\"list-group\">';
        foreach($aFolderFiles as $value){
            echo "<li class=\"list-group-item\">";
                if(is_dir($path . DIRECTORY_SEPARATOR . $value)){
                    admin_listFolderFiles($path . DIRECTORY_SEPARATOR . $value);
                    echo $value;
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
                    array_push($aPAGES_links, URLROOT . $link);
                    array_push($aPAGES_location, $path . DIRECTORY_SEPARATOR . $value);
                    ?>
                    <a class="nav-link" href="<?php echo URLROOT . $link; ?>"><?php echo $value; ?></a>
                    <?php
                }
            echo '</li>';
        }
    echo '</ul>';
}