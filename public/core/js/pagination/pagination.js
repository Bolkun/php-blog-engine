/*
 * pagination navigation display always at a bottom of a page
 */
function setPaginationBottom(){
    // Check if body height is higher than window height :)
    if ($("html").height() > $(window).height()) {
        // scrollable
        document.getElementById("pagination").style.position = "relative";
    } else {
        document.getElementById("pagination").style.position = "absolute";
    }
}

window.onresize = function() {
    setPaginationBottom();
};

// detect a fully-loaded page for STRG + F5
window.addEventListener("load", function(){
    setPaginationBottom();
});