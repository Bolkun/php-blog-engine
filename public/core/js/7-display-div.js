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