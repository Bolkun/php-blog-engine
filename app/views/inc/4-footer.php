<?php
    // Autoload JavaScript
    autoload_javascript();
    // check session
    if(isAdminLoggedIn() === true){
        echo '<script src="' . PUBLIC_CORE_JSURL . '/tinymce/1.tinymce.min.js' . '"></script>';
        echo '<script src="' . PUBLIC_CORE_JSURL . '/tinymce/2.init-tinymce.js' . '"></script>';
    }
?>
</body>
</html>