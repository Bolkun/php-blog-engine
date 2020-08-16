function displayDivs(id) {
    if(id['array'].length > 0) {
        if(id['array'][0] === 'collapse_login_menu') {
            document.getElementById(id['array'][0]).style.display = "block";
            document.getElementById('toggle_login_menu').style.color = "rgb(118, 185, 1)";  // green
            document.getElementById('toggle_login_menu').style.border = "1px solid rgb(118, 185, 1)";
        } else if(id['array'][0] === 'registration_form') {
            document.getElementById('collapse_login_menu').style.display = "block";
            loginRegister('login_form', id['array'][0]);
        }

        // console.log(id['array']);
    }
}