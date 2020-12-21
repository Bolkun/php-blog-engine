// pagination navbar display always at a bottom of a page
window.onresize = function(event) {
    var x = $(window).height();
    if ($('body').height() > x) {
        // scrollable
        document.getElementById("pagination").style.position = "relative";
        document.getElementById("pagination").style.bottom = "0";
        document.getElementById("pagination").style.width = "100%";
    } else {
        document.getElementById("pagination").style.position = "absolute";
        document.getElementById("pagination").style.bottom = "0";
        document.getElementById("pagination").style.width = "100%";
    }
};
var x = $(window).height();
if ($('body').height() > x) {
    // scrollable
    document.getElementById("pagination").style.position = "relative";
    document.getElementById("pagination").style.bottom = "0";
    document.getElementById("pagination").style.width = "100%";
} else {
    document.getElementById("pagination").style.position = "absolute";
    document.getElementById("pagination").style.bottom = "0";
    document.getElementById("pagination").style.width = "100%";
}