// view: 3b-all-page-content
// pagination nav bar display always at a bottom of a page
function setPaginationBottom(){
    var div = document.getElementById("pagination");
    if(div != null){
        // Check if body height is higher than window height :)
        if ($("html").height() > $(window).height()) {
            // scrollable
            document.getElementById("pagination").style.position = "relative";
        } else {
            // not scrollable
            document.getElementById("pagination").style.position = "absolute";
        }
    }
}

window.onresize = function() {
    setPaginationBottom();
};

// detect a fully-loaded page after clear a cache for STRG + F5
window.addEventListener("load", function(){
    setPaginationBottom();
});