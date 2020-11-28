<?php
/**
 * @goal   clear page cache for development mode and disable warnings
 * @result on new page reload changes are visible
 */
function clearPageCache()
{
    if (CLEARPAGECACHE === true) {
        // Skip warning messages
        error_reporting(E_ERROR | E_PARSE);

        header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

        // Report all PHP errors
        error_reporting(-1);
    }

}
