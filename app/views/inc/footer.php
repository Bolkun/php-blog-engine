    <?php
    /*
    * Autoload JavaScript
    */
    $aJs = getAllFilesInDir(JSROOT);
    foreach ($aJs as $file){
        if(preg_match("/^.*\.js$/", $file)){
            echo '<script src="' . URLROOT . '/js/' . $file .'"></script>';
        }
    }
    unset($aJs);
    ?>
</body>
</html>