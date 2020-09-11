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
    if (confirm("Want to delete Page with path=" + values['sPage'] + " ?")) {
        // Logic to delete the page
        $.ajax({
            url: values['URLCURRENT'],
            data: 'ajax_sPage=' + values['sPage'],
            type: 'post',
            error: pagesDeletePage_error(values),
            success: pagesDeletePage_success(values)
        });
    }
}

function pagesDeletePage_error(values) {
    // [alert info, alert success, alert warning, alert danger]
    var message = '<div class="alert danger" id="msg-flash">' +
        '<span class="closebtn" onclick="this.parentElement.style.display=\'none\'">&times;</span>' +
        'Error: Page with path =' + values['sPage'] + ' was not deleted!' +
        '</div>';
    // Inserting the code block
    document.getElementById("message").innerHTML = message;
    setTimeout(function () {
        $('#message').fadeOut('fast');
        // reload new view
        $("#page_reload").load(location.href + " #page_start");    // parent.load(child)
    }, 3000);
}

function pagesDeletePage_success(values) {
    // [alert info, alert success, alert warning, alert danger]
    var message = '<div class="alert success" id="msg-flash">' +
        '<span class="closebtn" onclick="this.parentElement.style.display=\'none\'">&times;</span>' +
        'SUCCESS: Page with path =' + values['sPage'] + ' was deleted!' +
        '</div>';
    // Inserting the code block
    document.getElementById("message").innerHTML = message;
    setTimeout(function () {
        $('#message').fadeOut('fast');
        // reload new view
        $("#page_reload").load(location.href + " #page_start");    // parent.load(child)
    }, 3000);
}

/**********************************************************************************************************************/

/*
 *   view: inc/3-nav-top-admin.php
 */
// Delete main menu item
function ajax_menuDeleteTree(values) {

    if (confirm("Want to delete Menu Item with title=" + values['title'] + " ?")) {
        // Logic to delete the page
        $.ajax({
            url: values['URLCURRENT'],
            data: 'ajax_sMainMenuID=' + values['id'],
            type: 'post',
            error: menuDeleteTree_error(values),
            success: menuDeleteTree_success(values)
        });
    }
}

function menuDeleteTree_error(values) {
    // [alert info, alert success, alert warning, alert danger]
    var message = '<div class="alert danger" id="msg-flash">' +
        '<span class="closebtn" onclick="this.parentElement.style.display=\'none\'">&times;</span>' +
        'Menu with title=' + values['title'] + ' was not deleted!' +
        '</div>';
    // Inserting the code block
    document.getElementById("main_menu_message").innerHTML = message;
    setTimeout(function () {
        $('#main_menu_message').fadeOut('fast');
        // reload new view
        $("#collapse_main_menu").load(location.href + " #mm_load");    // parent.load(child)
    }, 3000);
}

function menuDeleteTree_success(values) {
    // [alert info, alert success, alert warning, alert danger]
    var message = '<div class="alert success" id="msg-flash">' +
        '<span class="closebtn" onclick="this.parentElement.style.display=\'none\'">&times;</span>' +
        'Menu with title=' + values['title'] + ' was deleted!' +
        '</div>';
    // Inserting the code block
    document.getElementById("main_menu_message").innerHTML = message;
    setTimeout(function () {
        $('#main_menu_message').fadeOut('fast');
        // reload new view
        $("#collapse_main_menu").load(location.href + " #mm_load");    // parent.load(child)
    }, 3000);
}

/**********************************************************************************************************************/

// Style main menu title gui
function mmEditTitle(values) {
    var id = values['id'];
    var title = values['title'];
    var current_item_id = "mmEditTitle" + id;
    var color = document.getElementById(current_item_id).style.color;

    if (color == "grey") {
        document.getElementById("mm_search_form").style.display = "none";
        document.getElementById("mm_edit_title_form").style.display = "block";
        document.getElementById("mm_add_child_form").style.display = "none";
        // Change all edit class elements to grey
        var edit_classes = document.getElementsByClassName("mm_edit_title_icon");
        for (var i = 0, len = edit_classes.length; i < len; i++) {
            if (edit_classes[i].style["color"] != "grey") {
                edit_classes[i].style["color"] = "grey";
            }
        }
        // Change all add class elements to grey
        var add_classes = document.getElementsByClassName("mm_add_child_icon");
        for (var i = 0, len = add_classes.length; i < len; i++) {
            if (add_classes[i].style["color"] != "grey") {
                add_classes[i].style["color"] = "grey";
            }
        }
        // Set selected element to green
        document.getElementById(current_item_id).style.color = "rgb(118, 185, 1)";
        // Change placeholder
        document.getElementById("mm_edit_title").placeholder = "Edit title \"" + title + "\"";
        document.getElementById("mm_edit_title").focus();
        document.getElementById("mm_edit_title").select();
    } else {
        // green, than roll back
        document.getElementById("mm_search_form").style.display = "block";
        document.getElementById("mm_edit_title_form").style.display = "none";
        document.getElementById("mm_add_child_form").style.display = "none";
        // Set selected element to green
        document.getElementById(current_item_id).style.color = "grey";
        // Focus on search input
        document.getElementById("search_main_menu").focus();
        document.getElementById("search_main_menu").select();
    }
    // set parent id input
    document.getElementById('mm_edit_title_id').value = id;
}

/**********************************************************************************************************************/

// Style main menu node gui
function mmAddChild(values) {
    var id = values['id'];
    var title = values['title'];
    var current_item_id = "mmAddChild" + id;
    var color = document.getElementById(current_item_id).style.color;

    if (color == "grey") {
        document.getElementById("mm_search_form").style.display = "none";
        document.getElementById("mm_edit_title_form").style.display = "none";
        document.getElementById("mm_add_child_form").style.display = "block";
        // Change all edit class elements to grey
        var edit_classes = document.getElementsByClassName("mm_edit_title_icon");
        for (var i = 0, len = edit_classes.length; i < len; i++) {
            if (edit_classes[i].style["color"] != "grey") {
                edit_classes[i].style["color"] = "grey";
            }
        }
        // Change all add class elements to grey
        var add_classes = document.getElementsByClassName("mm_add_child_icon");
        for (var i = 0, len = add_classes.length; i < len; i++) {
            if (add_classes[i].style["color"] != "grey") {
                add_classes[i].style["color"] = "grey";
            }
        }
        // Set selected element to green
        document.getElementById(current_item_id).style.color = "rgb(118, 185, 1)";
        // Change placeholder and focus on input
        if (id == '0') {
            document.getElementById("mm_add_child").placeholder = "Add root";
            document.getElementById("mm_add_child").focus();
            document.getElementById("mm_add_child").select();
        } else {
            document.getElementById("mm_add_child").placeholder = "Add child to \"" + title + "\"";
            document.getElementById("mm_add_child").focus();
            document.getElementById("mm_add_child").select();
        }
    } else {
        // green, than roll back
        document.getElementById("mm_search_form").style.display = "block";
        document.getElementById("mm_edit_title_form").style.display = "none";
        document.getElementById("mm_add_child_form").style.display = "none";
        // Set selected element to green
        document.getElementById(current_item_id).style.color = "grey";
        // Focus on search input
        document.getElementById("search_main_menu").focus();
        document.getElementById("search_main_menu").select();
    }
    // set parent id input
    document.getElementById('mm_add_child_parentId').value = id;
}

/**********************************************************************************************************************/

// Add main menu node
function ajax_mmAddChild(values) {
    var formdata = $("#mmAddChildForm").serializeArray();
    var title = formdata[0]['value'];
    title = JSON.stringify(title);
    var parent_id = formdata[1]['value'];
    parent_id = JSON.stringify(parent_id);

    if (title !== "\"\"") {
        $.ajax({
            url: values['URLCURRENT'],
            data: 'ajax_mm_add_child=' + title + '&ajax_mm_add_child_parentId=' + parent_id,  // var="value"&var2="value2"
            type: 'post',
            error: mmAddChild_error(title, parent_id),
            success: mmAddChild_success(title, parent_id)
        });
    } else {
        mmAddEmptyChild_error(title, parent_id);
    }
}

function mmAddEmptyChild_error(title, parent_id) {
    // [alert info, alert success, alert warning, alert danger]
    var message = '<div class="alert danger" id="msg-flash">' +
        '<span class="closebtn" onclick="this.parentElement.style.display=\'none\'">&times;</span>' +
        'Title=' + title + ' of parent_id=' + parent_id + ' cannot be empty!' +
        '</div>';
    // Inserting the code block
    document.getElementById("main_menu_message").innerHTML = message;
    setTimeout(function () {
        $('#main_menu_message').fadeOut('fast');
        // reload new view
        $("#mm_load_box").load(location.href + " #mm_load_trees");    // parent.load(child)
    }, 3000);
}

function mmAddChild_error(title, parent_id) {
    // [alert info, alert success, alert warning, alert danger]
    var message = '<div class="alert danger" id="msg-flash">' +
        '<span class="closebtn" onclick="this.parentElement.style.display=\'none\'">&times;</span>' +
        'Add title=' + title + ' to parent_id=' + parent_id + ' failed!' +
        '</div>';
    // Inserting the code block
    document.getElementById("main_menu_message").innerHTML = message;
    setTimeout(function () {
        $('#main_menu_message').fadeOut('fast');
        // reload new view
        $("#mm_load_box").load(location.href + " #mm_load_trees");    // parent.load(child)
    }, 3000);
}

function mmAddChild_success(title, parent_id) {
    // [alert info, alert success, alert warning, alert danger]
    var message = '<div class="alert success" id="msg-flash">' +
        '<span class="closebtn" onclick="this.parentElement.style.display=\'none\'">&times;</span>' +
        'Added title=' + title + ' to parent_id=' + parent_id +
        '</div>';
    // Inserting the code block
    document.getElementById("main_menu_message").innerHTML = message;
    setTimeout(function () {
        $('#main_menu_message').fadeOut('fast');
        // reload new view
        $("#mm_load_box").load(location.href + " #mm_load_trees");    // parent.load(child)
    }, 3000);
}

/**********************************************************************************************************************/

// Edit main menu title
function ajax_mmEditTitle(values) {
    var formdata = $("#mmEditTitleForm").serializeArray();
    var id = formdata[0]['value'];
    id = JSON.stringify(id);
    var title = formdata[1]['value'];
    title = JSON.stringify(title);

    //console.log(id+' '+title);
    if (title !== "\"\"") {
        $.ajax({
            url: values['URLCURRENT'],
            data: 'ajax_mm_edit_title_id=' + id + '&ajax_mm_edit_title=' + title,  // var="value"&var2="value2"
            type: 'post',
            error: mmEditTitle_error(title, id),
            success: mmEditTitle_success(title, id)
        });
    } else {
        mmEmptyTitle_error(title, id);
    }
}

function mmEmptyTitle_error(title, id) {
    // [alert info, alert success, alert warning, alert danger]
    var message = '<div class="alert danger" id="msg-flash">' +
        '<span class="closebtn" onclick="this.parentElement.style.display=\'none\'">&times;</span>' +
        'Title=' + title + ' with id=' + id + ' cannot be empty!' +
        '</div>';
    // Inserting the code block
    document.getElementById("main_menu_message").innerHTML = message;
    setTimeout(function () {
        $('#main_menu_message').fadeOut('fast');
        // reload new view
        $("#mm_load_box").load(location.href + " #mm_load_trees");    // parent.load(child)
    }, 3000);
}

function mmEditTitle_error(title, id) {
    // [alert info, alert success, alert warning, alert danger]
    var message = '<div class="alert danger" id="msg-flash">' +
        '<span class="closebtn" onclick="this.parentElement.style.display=\'none\'">&times;</span>' +
        'Edit title=' + title + ' with id=' + id + ' failed!' +
        '</div>';
    // Inserting the code block
    document.getElementById("main_menu_message").innerHTML = message;
    setTimeout(function () {
        $('#main_menu_message').fadeOut('fast');
        // reload new view
        $("#mm_load_box").load(location.href + " #mm_load_trees");    // parent.load(child)
    }, 3000);
}

function mmEditTitle_success(title, id) {
    // [alert info, alert success, alert warning, alert danger]
    var message = '<div class="alert success" id="msg-flash">' +
        '<span class="closebtn" onclick="this.parentElement.style.display=\'none\'">&times;</span>' +
        'Edit title=' + title + ' with id=' + id +
        '</div>';
    // Inserting the code block
    document.getElementById("main_menu_message").innerHTML = message;
    setTimeout(function () {
        $('#main_menu_message').fadeOut('fast');
        // reload new view
        $("#mm_load_box").load(location.href + " #mm_load_trees");    // parent.load(child)
    }, 3000);
}

/**********************************************************************************************************************/