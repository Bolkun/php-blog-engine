/**********************************************************************************************************************/
// view: 1-header
// view: 2-nav-top-user
// display user navigation bar and style gui
function displayDivs(id) {
    if(id['array'].length > 0) {
        if(id['array'][0] === 'collapse_login_menu') {
            document.getElementById(id['array'][0]).style.display = "block";
            document.getElementById('toggle_login_menu').style.color = "rgb(118, 185, 1)";  // green
            document.getElementById('toggle_login_menu').style.border = "1px solid rgb(118, 185, 1)";
        } else if(id['array'][0] === 'registration_form') {
            document.getElementById('collapse_login_menu').style.display = "block";
            document.getElementById('toggle_login_menu').style.color = "rgb(118, 185, 1)";  // green
            document.getElementById('toggle_login_menu').style.border = "1px solid rgb(118, 185, 1)";
            loginRegister('login_form', id['array'][0]);
        } else if(id['array'][0] === 'collapse_main_menu') {
            document.getElementById('collapse_main_menu').style.display = "block";
            document.getElementById('toggle_main_menu').style.color = "rgb(118, 185, 1)";  // green
            document.getElementById('toggle_main_menu').style.border = "1px solid rgb(118, 185, 1)";
        } else if(id['array'][0] === 'collapse_share_menu') {
            document.getElementById('collapse_share_menu').style.display = "block";
            document.getElementById('toggle_share_menu').style.color = "rgb(118, 185, 1)";  // green
            document.getElementById('toggle_share_menu').style.border = "1px solid rgb(118, 185, 1)";
        }
        // console.log(id['array']);
    }
}

// view: 2-nav-top-user
// change color and hide another opened navigation bar
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

// view: 2-nav-top-user
// hide and display login or register
var intervalId;
function loginRegister(hide, show) {
    document.getElementById(hide).style.display = "none";
    document.getElementById(show).style.display = "block";

    if (intervalId) {
        clearInterval(intervalId);
    }
    // "Blink effect" replace value by registration button
    var count = 0;
    var wordsArray = ["Register", "Send Verification Code"];
    intervalId = setInterval(function () {
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

    var registrationFormStyle = document.getElementById("registration_form").style.display;
    if(registrationFormStyle === "none"){
        // stop blink button
        clearInterval(intervalId);
    }
}

// view: 2-nav-top-user
// main menu drop down items
function mmDropDownItems() {
    var color = document.getElementById("mmDropDownItems").style.color;

    if (color === "white") {
        // All checkboxes checked
        $(".main_menu_checkbox").prop("checked", true);
        // rotate
        document.getElementById("mmDropDownItems").style.transform = "rotate(90deg)";
        // Set selected element to green
        document.getElementById("mmDropDownItems").style.color = "rgb(118, 185, 1)";
    } else {
        // All checkboxes unchecked
        $(".main_menu_checkbox").prop("checked", false);
        // rotate
        document.getElementById("mmDropDownItems").style.transform = "rotate(0deg)";
        // Set selected element to grey
        document.getElementById("mmDropDownItems").style.color = "white";
    }
}

/**********************************************************************************************************************/
// view: 3a-single-page-content
// show tooltips
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});

/**********************************************************************************************************************/

