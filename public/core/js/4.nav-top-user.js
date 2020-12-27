// change color and hide another opened togglers
function changeNavTopUserColor(id, cid) {
    // just add one more id in array
    var icons_ids = ['home_menu', 'toggle_share_menu', 'toggle_login_menu', 'toggle_main_menu'];
    var collapse_ids = ['collapse_share_menu', 'collapse_login_menu', 'collapse_main_menu'];
    var icons_ids_length = icons_ids.length;
    var count = 0;
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

    // if all icons white make home icon green
    icons_ids.forEach(function(icon_id) {
        if (document.getElementById(icon_id).style.color === "white") {
            count++;
        }
    });
    if(count === icons_ids_length){
        document.getElementById(icons_ids[0]).style.color = "rgb(118, 185, 1)";  // green
        document.getElementById(icons_ids[0]).style.border = "1px solid rgb(118, 185, 1)";
    }

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

// hide and display login <=> register
function loginRegister(hide, show){
    document.getElementById(hide).style.display = "none";
    document.getElementById(show).style.display = "block";
    //var element = document.getElementById("collapse_login_menu");
    //element.classList.add("show");
}

// replace value by registration
$(function () {
    count = 0;
    wordsArray = ["Register", "Send Verification Code"];
    setInterval(function () {
        count++;
        $("#submit_register").fadeOut(1000, function () {
            document.registration_form.submitRegister.value = wordsArray[count % wordsArray.length];
            // $(this).text(wordsArray[count % wordsArray.length]).fadeIn(500);
        });
        $("#submit_register").fadeIn(2000, function () {
            document.registration_form.submitRegister.value = wordsArray[count % wordsArray.length];
            // $(this).text(wordsArray[count % wordsArray.length]).fadeIn(500);
        });
    }, 6000);
});