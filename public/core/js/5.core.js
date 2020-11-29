/*
 *   view: inc/2-nav-top-user.php
 */
// Delete main menu item
function ajax_menuDeleteTree(values) {

    if (confirm("Want to delete Menu Item with title=" + values['title'] + " ?")) {
        // Logic to delete the page
        $.ajax({
            url: values['URLCURRENT'],
            data: 'ajax_sMainMenuID=' + values['blog_id'],
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
        $("#load_blog_box").load(location.href + " #load_blog_divs");    // parent.load(child)
    }, 3000);
}

// Style main menu title gui
function mmEditTitle(values) {
    var id = values['blog_id'];
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

// Style main menu node gui
function mmAddChild(values) {
    var id = values['blog_id'];
    var title = values['title'];
    var current_item_id = "mmAddChild" + id;
    var color = document.getElementById(current_item_id).style.color;

    if (color === "grey") {
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

// Add main menu node
function ajax_mmAddChild(values) {
    var formdata = $("#mmAddChildForm").serializeArray();
    var title = formdata[0]['value'];
    title = JSON.stringify(title);
    var parent_id = formdata[1]['value'];
    parent_id = JSON.stringify(parent_id);

    //console.log(title + ' ' + title);

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
        $("#load_blog_box").load(location.href + " #load_blog_divs");    // parent.load(child)
    }, 3000);
}

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
        $("#load_blog_box").load(location.href + " #load_blog_divs");    // parent.load(child)
    }, 3000);
}

// Drop down items
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

// Social Media
function displaySMServerSocialImageDiv() {
    // radio choice
    document.getElementById("sm_social_image_server_div").style.display = "block";
    document.getElementById("sm_social_image_local_div").style.display = "none";
    document.getElementById("selectedServerSocialImageDiv").style.display = "block";
    document.getElementById("selectedLocalSocialImageDiv").style.display = "none";
}

function displaySMLocalSocialImageDiv() {
    // radio choice
    document.getElementById("sm_social_image_server_div").style.display = "none";
    document.getElementById("sm_social_image_local_div").style.display = "block";
    document.getElementById("selectedServerSocialImageDiv").style.display = "none";
    document.getElementById("selectedLocalSocialImageDiv").style.display = "block";
}

// server social image
function selectedSocialImage(values) {
    var social_image = values['social_image'];
    var PUBLIC_CORE_IMG_SOCIALURL = values['PUBLIC_CORE_IMG_SOCIALURL'];
    document.getElementById('close_sm_social_images_list').click();
    document.getElementById("sm_social_image_server").value = social_image;
    document.getElementById("selectedServerSocialImage").src = PUBLIC_CORE_IMG_SOCIALURL + '/' + social_image;
}

// local social image
function selectedUploadSocialImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#selectedLocalSocialImage')
                .attr('src', e.target.result);
        };

        //document.getElementById("selectedLocalSocialImage").classList.add("article_main_img");

        reader.readAsDataURL(input.files[0]);
    }
}

// delete social image
function ajax_deleteSocialImage(values) {
    if (confirm("Want to delete Social Image " + values['social_image'] + " from server?")) {
        // Logic to delete the page
        $.ajax({
            url: values['URLCURRENT'],
            data: 'ajax_sDeleteSocialImage=' + values['social_image'],
            type: 'post',
            error: deleteSocialImage_error(values),
            success: deleteSocialImage_success(values)
        });
    }
}

function deleteSocialImage_error(values) {
    // [alert info, alert success, alert warning, alert danger]
    var message = '<div class="alert danger" id="msg-flash">' +
        '<span class="closebtn" onclick="this.parentElement.style.display=\'none\'">&times;</span>' +
        'Error: Could not delete social image =' + values['social_image'] + '!' +
        '</div>';
    // Inserting the code block
    document.getElementById("message").innerHTML = message;
    setTimeout(function () {
        $('#message').fadeOut('fast');
        // reload new view
        $("#sm_social_images_list_load").load(location.href + " #sm_social_images_list_load_content");    // parent.load(child)
    }, 3000);
}

function deleteSocialImage_success(values) {
    // [alert info, alert success, alert warning, alert danger]
    var message = '<div class="alert success" id="msg-flash">' +
        '<span class="closebtn" onclick="this.parentElement.style.display=\'none\'">&times;</span>' +
        'Success: Social image ' + values['social_image'] + ' was deleted!' +
        '</div>';
    // Inserting the code block
    document.getElementById("message").innerHTML = message;

    setTimeout(function () {
        $('#message').fadeOut('fast');
        // reload new view
        $("#sm_social_images_list_load").load(location.href + " #sm_social_images_list_load_content");    // parent.load(child)

        // check gui
        var selectedSocialImageURL = document.getElementById("selectedServerSocialImage").src;
        var parts = selectedSocialImageURL.split('/');
        var lastSegment = parts.pop() || parts.pop();  // handle potential trailing slash
        if (values['social_image'] === lastSegment) {
            document.getElementById("selectedServerSocialImage").src = values['PUBLIC_CORE_IMG_SOCIALURL'] + '/' + values['DEFAULT_SOCIAL_IMAGE'];
            document.getElementById("sm_social_image_server").value = values['DEFAULT_SOCIAL_IMAGE'];
        }
    }, 3000);
}

// delete social media
function ajax_deleteSocialMedia(values) {
    if (confirm("Want to delete social media " + values['name'] + " from server?")) {
        // Logic to delete the page
        $.ajax({
            url: values['URLCURRENT'],
            data: 'ajax_sDeleteSocialMedia=' + values['name'],
            type: 'post',
            error: deleteSocialMedia_error(values),
            success: deleteSocialMedia_success(values)
        });
    }
}

function deleteSocialMedia_error(values) {
    // [alert info, alert success, alert warning, alert danger]
    var message = '<div class="alert danger" id="msg-flash">' +
        '<span class="closebtn" onclick="this.parentElement.style.display=\'none\'">&times;</span>' +
        'Could not delete ' + values['name'] + '!' +
        '</div>';
    // Inserting the code block
    document.getElementById("message_sm").innerHTML = message;
    setTimeout(function () {
        $('#message_sm').fadeOut('fast');
        // reload new view
        $("#share_menu_load").load(location.href + " #share_menu_content");    // parent.load(child)
    }, 3000);
}

function deleteSocialMedia_success(values) {
    // [alert info, alert success, alert warning, alert danger]
    var message = '<div class="alert success" id="msg-flash">' +
        '<span class="closebtn" onclick="this.parentElement.style.display=\'none\'">&times;</span>' +
        '' + values['name'] + ' was deleted!' +
        '</div>';
    // Inserting the code block
    document.getElementById("message_sm").innerHTML = message;
    setTimeout(function () {
        $('#message_sm').fadeOut('fast');
        // reload new view
        $("#share_menu_load").load(location.href + " #share_menu_content");    // parent.load(child)
    }, 3000);
}

/*
 *   view: inc/3-nav-top-admin.php
 */
// read and write mode for blog content
function displayBlogContent() {
    var user_content = document.getElementById("tinymce_data").style.display;
    if(user_content === "none"){
        document.getElementById("tinymce_data").style.display = "block";
        document.getElementById("blog_form").style.display = "none";
        // change icon color
        document.getElementById("edit_content").style.color = "white";
    } else {
        document.getElementById("tinymce_data").style.display = "none";
        document.getElementById("blog_form").style.display = "block";
        // change icon color
        document.getElementById("edit_content").style.color = "rgb(118, 185, 1)";
    }
}

/*
 *   view: index/index.php
 */
// file input
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function () {
    var fileName = $(this).val().split("\\").pop();
    if (fileName) {
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    }
});

// radio choice
function displayBlogServerPreviewImageDiv() {
    document.getElementById("blog_preview_image_server_div").style.display = "block";
    document.getElementById("blog_preview_image_local_div").style.display = "none";
    document.getElementById("selectedServerPreviewImageDiv").style.display = "block";
    document.getElementById("selectedLocalPreviewImageDiv").style.display = "none";
}

function displayBlogLocalPreviewImageDiv() {
    document.getElementById("blog_preview_image_server_div").style.display = "none";
    document.getElementById("blog_preview_image_local_div").style.display = "block";
    document.getElementById("selectedServerPreviewImageDiv").style.display = "none";
    document.getElementById("selectedLocalPreviewImageDiv").style.display = "block";
}

// server preview image
function selectedPreviewImage(values) {
    var preview_image = values['preview_image'];
    var PUBLIC_CORE_IMG_PREVIEWURL = values['PUBLIC_CORE_IMG_PREVIEWURL'];
    document.getElementById('close_blog_preview_images_list').click();
    document.getElementById("blog_preview_image_server").value = preview_image;
    document.getElementById("selectedServerPreviewImage").src = PUBLIC_CORE_IMG_PREVIEWURL + '/' + preview_image;
}

// local preview image
function selectedUploadPreviewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#selectedLocalPreviewImage')
                .attr('src', e.target.result);
        };

        document.getElementById("selectedLocalPreviewImage").classList.add("article_main_img");

        reader.readAsDataURL(input.files[0]);
    }
}

// delete preview image
function ajax_deletePreviewImage(values) {
    if (confirm("Want to delete Preview Image " + values['preview_image'] + " from server?")) {
        // Logic to delete the page
        $.ajax({
            url: values['URLCURRENT'],
            data: 'ajax_sDeletePreviewImage=' + values['preview_image'],
            type: 'post',
            error: deletePreviewImage_error(values),
            success: deletePreviewImage_success(values)
        });
    }
}

function deletePreviewImage_error(values) {
    // [alert info, alert success, alert warning, alert danger]
    var message = '<div class="alert danger" id="msg-flash">' +
        '<span class="closebtn" onclick="this.parentElement.style.display=\'none\'">&times;</span>' +
        'Error: Could not delete preview image =' + values['preview_image'] + '!' +
        '</div>';
    // Inserting the code block
    document.getElementById("message").innerHTML = message;
    setTimeout(function () {
        $('#message').fadeOut('fast');
        // reload new view
        $("#blog_preview_images_list_load").load(location.href + " #blog_preview_images_list_load_content");    // parent.load(child)
    }, 3000);
}

function deletePreviewImage_success(values) {
    // [alert info, alert success, alert warning, alert danger]
    var message = '<div class="alert success" id="msg-flash">' +
        '<span class="closebtn" onclick="this.parentElement.style.display=\'none\'">&times;</span>' +
        'Success: Preview image ' + values['preview_image'] + ' was deleted!' +
        '</div>';
    // Inserting the code block
    document.getElementById("message").innerHTML = message;

    setTimeout(function () {
        $('#message').fadeOut('fast');
        // reload new view
        $("#blog_preview_images_list_load").load(location.href + " #blog_preview_images_list_load_content");    // parent.load(child)

        // check gui
        var selectedPreviewImageURL = document.getElementById("selectedServerPreviewImage").src;
        var parts = selectedPreviewImageURL.split('/');
        var lastSegment = parts.pop() || parts.pop();  // handle potential trailing slash
        if (values['preview_image'] === lastSegment) {
            document.getElementById("selectedServerPreviewImage").src = values['PUBLIC_CORE_IMG_PREVIEWURL'] + '/' + values['DEFAULT_PREVIEW_IMAGE'];
            document.getElementById("blog_preview_image_server").value = values['DEFAULT_PREVIEW_IMAGE'];
        }
    }, 3000);
}

// Zoom image on click
$('.zoom').css({cursor: 'pointer'}).on('click', function () {
    var img = $(this);
    var bigImg = $('<img />').css({
        'position': 'fixed',
        'top': '50%',
        'left': '50%',
        'transform': 'translate(-50%, -50%)',
        'max-width': '100%',
        'max-height': '100%',
        'display': 'inline'
    });
    bigImg.attr({
        src: img.attr('src'),
        alt: img.attr('alt'),
        title: img.attr('title')
    });
    var over = $('<div />').text(' ').css({
        'height': '100%',
        'width': '100%',
        'background': 'rgba(0,0,0,.82)',
        'position': 'fixed',
        'top': 0,
        'left': 0,
        'right': 0,
        'bottom': 0,
        'opacity': 0.0,
        'cursor': 'pointer',
        'z-index': 9999,
        'text-align': 'center'
    }).append(bigImg).bind('click', function () {
        $(this).fadeOut(300, function () {
            $(this).remove();
        });
    }).insertAfter(this).animate({
        'opacity': 1
    }, 300);
});