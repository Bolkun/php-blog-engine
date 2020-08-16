// change color and hide another opened togglers
function changeNavTopUserColor(id, cid) {
    // just add one more id in array
    var icons_ids = ['toggle_bell_menu', 'toggle_login_menu', 'toggle_main_menu'];
    var collapse_ids = ['collapse_bell_menu', 'collapse_login_menu', 'collapse_main_menu'];
    var getColor = document.getElementById(id).style.color;
    var getDisplay = document.getElementById(cid).style.display;

    // change color
    icons_ids.forEach(function(icon_id) {
        if (id === icon_id && (getColor === "white" || getColor === "")) {
            document.getElementById(icon_id).style.color = "rgb(118, 185, 1)";  // green
            document.getElementById(icon_id).style.border = "1px solid rgb(118, 185, 1)";
        } else if (id === icon_id && getColor === "rgb(118, 185, 1)") {
            document.getElementById(icon_id).style.color = "white";
            document.getElementById(icon_id).style.border = "1px solid white";
        } else {
            document.getElementById(icon_id).style.color = "white";
            document.getElementById(icon_id).style.border = "1px solid white";
        }
    });

    collapse_ids.forEach(function(collapse_id) {
        // change display
        if(cid === collapse_id && (getDisplay === "none" || getDisplay === "")){
            document.getElementById(cid).style.display = "block";
        } else if(cid === collapse_id && getDisplay === "block"){
            document.getElementById(cid).style.display = "none";
        } else {
            document.getElementById(collapse_id).style.display = "none";
        }
    });
}