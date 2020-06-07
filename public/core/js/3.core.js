/*
 *   view: inc/nav/admin/nav-top-admin.php, inc/nav/user/nav-top-user.php
 */
$(document).ready(function() {
        // When the user scrolls the page, execute myFunction
        window.onscroll = function() { navTopAdmin() };
        // Get the navbar
        var navbar = document.getElementById("nav_top");
        var navbar2 = document.getElementById("nav_top_page");
        // Get the offset position of the navbar
        var sticky = navbar.offsetTop;
        // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
        function navTopAdmin() {
            if (window.pageYOffset > sticky) {
                navbar.classList.add("sticky");
                if(navbar2.style.display === "block"){
                    navbar2.classList.add("sticky2");
                }
            } else {
                navbar.classList.remove("sticky");
                if(navbar2.style.display === "block"){
                    navbar2.classList.remove("sticky2");
                }
            }
        }
});

function show_page_menu(){
    var x = document.getElementById("nav_top_page");
    if (x.style.display === "none") {
        document.getElementById("pageMenu").innerHTML = "&darr;&nbsp;";
        x.style.display = "block";
    } else {
        document.getElementById("pageMenu").innerHTML = "&uarr;&nbsp;";
        x.style.display = "none";
    }
}
/**********************************************************************************************************************/
/*
 *   view: inc/nav/admin/nav-top-page.php
 */
function allowDrop(ev) {
    ev.preventDefault();    // change default state to allow drop event
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}
// Param: string, string
function drop(ev, server) {
    ev.preventDefault();
    var drag_id = ev.dataTransfer.getData("text"); // have only id from function drag
    //ev.target.appendChild(document.getElementById(drag_id));
    $.ajax({
        url: server['URLCURRENT'],
        data: 'ajax_drag_id=' +drag_id,
        type: 'post',
        error: drop_error(server),
        success: drop_success(server)
    });
}

function drop_error(server){
    //alert(server['URLCURRENT'] + ": error");
    // reload new view
    $("#body").load(location.href + " #body_reload");    // parent.load(child)
}
function drop_success(server){
    //alert(server['URLCURRENT'] + ": success");
    // reload new view
    $("#body").load(location.href + " #body_reload");    // parent.load(child)
}
/**********************************************************************************************************************/
/*
 *   view: costs/newEditDelete.php
 */
//Param assoc array
function costsDeleteRow(values) {
    if (confirm("Want to delete Record with id="+values['cost_id']+"?")) {
        // Logic to delete the item
        $.ajax({
            url: values['URLCURRENT'],
            data: 'cost_id=' +values['cost_id']+ '&year=' +values['year'],
            type: 'post',
            error: costsDeleteRow_error(values),
            success: costsDeleteRow_success(values)
        });
    }
}
function costsDeleteRow_error(values){
    // [alert info, alert success, alert warning, alert danger]
    var message = '<div class="alert danger" id="msg-flash">' +
        '<span class="closebtn" onclick="this.parentElement.style.display=\'none\'">&times;</span>' +
        'SUCCESS: Record with id =' +values['cost_id']+ ' was not deleted!' +
        '</div>';
    // Inserting the code block
    document.getElementById("message").innerHTML = message;
    setTimeout(function() {
        $('#message').fadeOut('fast');
        // reload new view
        $("#costsDeleteRow_success").load(location.href + " #wrapper");    // parent.load(child)
    }, 3000);
}
function costsDeleteRow_success(values){
    // [alert info, alert success, alert warning, alert danger]
    var message = '<div class="alert success" id="msg-flash">' +
        '<span class="closebtn" onclick="this.parentElement.style.display=\'none\'">&times;</span>' +
        'SUCCESS: Record with id =' +values['cost_id']+ ' was deleted!' +
        '</div>';
    // Inserting the code block
    document.getElementById("message").innerHTML = message;
    setTimeout(function() {
        $('#message').fadeOut('fast');
        // reload new view
        $("#costsDeleteRow_success").load(location.href + " #wrapper");    // parent.load(child)
    }, 3000);
}
/**********************************************************************************************************************/
/*
 *   view: admins/pages/newEditDelete.php
 */
// Auto generate link from given path
function pagesPathtoPagesLink(values) {
    var linkRoot = values['URLROOT'];
    var viewsRoot = values['VIEWSROOT'];
    var pagesPath = $("#pagesPath").val();
    pagesPath = pagesPath.replace(viewsRoot, '');  // replace 'C:\xampp\htdocs\bolkun\app\views' with ''
    pagesPath = pagesPath.replace(/\\/g, '\/');    // replace '\' with '/'
    pagesPath = pagesPath.replace('/index.php', '');
    pagesPath = pagesPath.replace('.php', '');
    $("#pagesLink").val(linkRoot + pagesPath);

    // searchable table
    var search = $('#pagesPath').val().toLowerCase();
    $("#tablePages tbody tr").filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(search) > -1)
    });
}

// On click copy path
function copyPath(that) {
    var inp = document.createElement('input');
    document.body.appendChild(inp);
    inp.value = that.textContent;
    inp.select();
    document.execCommand('copy', false);
    inp.remove();

    // copy to input path
    $("#pagesPath").val(that.textContent.trim());
    // copy next td to input link
    var link = $(that).closest('td').next('td').text().trim();
    $("#pagesLink").val(link);

    // searchable table
    var search = $('#pagesPath').val().toLowerCase();
    $("#tablePages tbody tr").filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(search) > -1)
    });
}

// Delete all or one page
function pagesDeletePage(values) {
    if (confirm("Want to delete Page with path="+values['sPage']+" ?")) {
        // Logic to delete the page
        $.ajax({
            url: values['URLCURRENT'],
            data: 'ajax_sPage=' +values['sPage'],
            type: 'post',
            error: pagesDeletePage_error(values),
            success: pagesDeletePage_success(values)
        });
    }
}
function pagesDeletePage_error(values){
    // [alert info, alert success, alert warning, alert danger]
    var message = '<div class="alert danger" id="msg-flash">' +
        '<span class="closebtn" onclick="this.parentElement.style.display=\'none\'">&times;</span>' +
        'Error: Page with path =' +values['sPage']+ ' was not deleted!' +
        '</div>';
    // Inserting the code block
    document.getElementById("message").innerHTML = message;
    setTimeout(function() {
        $('#message').fadeOut('fast');
        // reload new view
        $("#page_reload").load(location.href + " #page_start");    // parent.load(child)
    }, 3000);
}
function pagesDeletePage_success(values){
    // [alert info, alert success, alert warning, alert danger]
    var message = '<div class="alert success" id="msg-flash">' +
        '<span class="closebtn" onclick="this.parentElement.style.display=\'none\'">&times;</span>' +
        'SUCCESS: Page with path =' +values['sPage']+ ' was deleted!' +
        '</div>';
    // Inserting the code block
    document.getElementById("message").innerHTML = message;
    setTimeout(function() {
        $('#message').fadeOut('fast');
        // reload new view
        $("#page_reload").load(location.href + " #page_start");    // parent.load(child)
    }, 3000);
}
/**********************************************************************************************************************/
