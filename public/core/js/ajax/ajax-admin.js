/**********************************************************************************************************************/
// view: 3-nav-top-user (social media)
// radio choice for local or server div
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

// social media switcher view and edit mode
function displaySocialMediaContent() {
    var social_media_content = document.getElementById("social_media_data").style.display;
    if (social_media_content === "none") {
        document.getElementById("social_media_data").style.display = "block";
        document.getElementById("edit_social_media_content").style.display = "none";
        // change icon color
        document.getElementById("edit_social_media_icon").style.color = "white";
    } else {
        document.getElementById("social_media_data").style.display = "none";
        document.getElementById("edit_social_media_content").style.display = "block";
        // change icon color
        document.getElementById("edit_social_media_icon").style.color = "rgb(118, 185, 1)";
    }
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

// delete social media
function ajax_deleteSocialMedia(values) {
    if (confirm("Want to delete social media " + values['name']+  " with id=" + values['id'] + " from server?")) {
        //console.log(values['name'] + ' ' + values['id']);
        $.ajax({
            url: values['URLROOT'] + "/index/ajax_deleteSocialMedia",
            type: "POST",
            data: { ajax_sDeleteSocialMediaID: values['id'] },
            success: function (result) {
                // [alert info, alert success, alert warning, alert danger]
                var message = '<div class="alert success" id="msg-flash">' +
                '<span class="closebtn" onclick="this.parentElement.style.display=\'none\'">&times;</span>' +
                values['name'] + ' with id=' + values['id'] + ' was deleted!' +
                '</div>';
                // Inserting the code block
                document.getElementById("message_sm").innerHTML = message;
                setTimeout(function () {
                    $('#message_sm').fadeOut('fast');
                    // reload new view
                    $("#share_menu_load").load(location.href + " #share_menu_content");    // parent.load(child)
                }, 3000);
                
            },
            error: function (result) {
                // [alert info, alert success, alert warning, alert danger]
                var message = '<div class="alert danger" id="msg-flash">' +
                '<span class="closebtn" onclick="this.parentElement.style.display=\'none\'">&times;</span>' +
                'Could not delete ' + values['name'] + ' with id=' + values['id'] + '!' +
                '</div>';
                // Inserting the code block
                document.getElementById("message_sm").innerHTML = message;
                setTimeout(function () {
                    $('#message_sm').fadeOut('fast');
                    // reload new view
                    $("#share_menu_load").load(location.href + " #share_menu_content");    // parent.load(child)
                }, 3000);
                console.log("Error by ajax_deleteSocialMedia(): " + result);
            }
        });
    }
}

// delete social image
function ajax_deleteSocialImage(values) {
    if (confirm("Want to delete Social Image " + values['social_image'] + " from server?")) {
        //console.log(values['social_image']);
        $.ajax({
            url: values['URLROOT'] + "/index/ajax_deleteSocialImage",
            type: "POST",
            data: { ajax_sDeleteSocialImage: values['social_image'] },
            success: function (result) {
                // [alert info, alert success, alert warning, alert danger]
                var message = '<div class="alert success" id="msg-flash">' +
                '<span class="closebtn" onclick="this.parentElement.style.display=\'none\'">&times;</span>' +
                'Success: Social image ' + values['social_image'] + ' was deleted!' +
                '</div>';
                // Inserting the code block
                document.getElementById("message").innerHTML = message;

                setTimeout(function () {
                    $('#message').fadeOut('fast');
                    // replace content of #blog_preview_images_list_modal_body with <div> 
                    $('#sm_social_images_list_modal_body').html($(result).html());

                    // check gui
                    var selectedSocialImageURL = document.getElementById("selectedServerSocialImage").src;
                    var parts = selectedSocialImageURL.split('/');
                    var lastSegment = parts.pop() || parts.pop();  // handle potential trailing slash
                    if (values['social_image'] === lastSegment) {
                        document.getElementById("selectedServerSocialImage").src = values['PUBLIC_CORE_IMG_SOCIALURL'] + '/' + values['DEFAULT_SOCIAL_IMAGE'];
                        document.getElementById("sm_social_image_server").value = values['DEFAULT_SOCIAL_IMAGE'];
                    }
                }, 3000);
            },
            error: function (result) {
                // [alert info, alert success, alert warning, alert danger]
                var message = '<div class="alert danger" id="msg-flash">' +
                '<span class="closebtn" onclick="this.parentElement.style.display=\'none\'">&times;</span>' +
                'Error: Could not delete social image =' + values['social_image'] + '!' +
                '</div>';
                // Inserting the code block
                document.getElementById("message").innerHTML = message;
                setTimeout(function () {
                    $('#message').fadeOut('fast');
                    // replace content of #blog_preview_images_list_modal_body with <div> 
                    $('#sm_social_images_list_modal_body').html($(result).html());
                }, 3000);
                console.log("Error by ajax_deleteSocialImage(): " + result);
            }
        });
    }
}

// load social images
function ajax_loadSocialImageList(values) {
    //console.log(values);
    $.ajax({
        url: values['URLROOT'] + "/index/ajax_loadSocialImageList",
        type: "POST",
        data: { ajax_sLoadSocialImageList: "please" },
        success: function (result) {
            // replace content of #blog_preview_images_list_modal_body with <div> 
            $('#sm_social_images_list_modal_body').html($(result).html());
        },
        error: function (result) {
            console.log("Error by ajax_loadSocialImageList(): " + result);
        }
    });
}

/**********************************************************************************************************************/
// view: 3-nav-top-user (main menu)
// style main menu add node gui
function mmAddChild(values) {
    var id = values['blog_id'];
    var title = values['title'];
    var current_item_id = "mmAddChild" + id;
    var color = document.getElementById(current_item_id).style.color;

    if (color === "grey") {
        document.getElementById("mm_search_form").style.display = "none";
        document.getElementById("mm_edit_title_form").style.display = "none";
        document.getElementById("mm_delete_branch_form").style.display = "none";
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
        // Change all delete class elements to grey
        var delete_classes = document.getElementsByClassName("mm_delete_branch_icon");
        for (var i = 0, len = delete_classes.length; i < len; i++) {
            if (delete_classes[i].style["color"] != "grey") {
                delete_classes[i].style["color"] = "grey";
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
        document.getElementById("mm_delete_branch_form").style.display = "none";
        // Set selected element to green
        document.getElementById(current_item_id).style.color = "grey";
        // Focus on search input
        document.getElementById("search_main_menu").focus();
        document.getElementById("search_main_menu").select();
    }
    // set parent id input
    document.getElementById('mm_add_child_parentId').value = id;
}

// style main menu title gui
function mmEditTitle(values) {
    var id = values['blog_id'];
    var title = values['title'];
    var current_item_id = "mmEditTitle" + id;
    var color = document.getElementById(current_item_id).style.color;

    if (color == "grey") {
        document.getElementById("mm_search_form").style.display = "none";
        document.getElementById("mm_edit_title_form").style.display = "block";
        document.getElementById("mm_add_child_form").style.display = "none";
        document.getElementById("mm_delete_branch_form").style.display = "none";
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
        // Change all delete class elements to grey
        var delete_classes = document.getElementsByClassName("mm_delete_branch_icon");
        for (var i = 0, len = delete_classes.length; i < len; i++) {
            if (delete_classes[i].style["color"] != "grey") {
                delete_classes[i].style["color"] = "grey";
            }
        }
        // Set selected element to green
        document.getElementById(current_item_id).style.color = "rgb(118, 185, 1)";
        // Change placeholder
        document.getElementById("mm_edit_title").placeholder = "Edit title \"" + title + "\"";
        document.getElementById("mm_edit_title").value = title;
        document.getElementById("mm_edit_title").focus();
    } else {
        // green, than roll back
        document.getElementById("mm_search_form").style.display = "block";
        document.getElementById("mm_edit_title_form").style.display = "none";
        document.getElementById("mm_add_child_form").style.display = "none";
        document.getElementById("mm_delete_branch_form").style.display = "none";
        // Set selected element to green
        document.getElementById(current_item_id).style.color = "grey";
        // Focus on search input
        document.getElementById("search_main_menu").focus();
        document.getElementById("search_main_menu").select();
    }
    // set parent id input
    document.getElementById('mm_edit_title_id').value = id;
}

// style main menu delete node gui
function mmDeleteBranch(values) {
    var id = values['blog_id'];
    var title = values['title'];
    var current_item_id = "mmDeleteBranch" + id;
    var color = document.getElementById(current_item_id).style.color;

    if (color == "grey") {
        document.getElementById("mm_search_form").style.display = "none";
        document.getElementById("mm_edit_title_form").style.display = "none";
        document.getElementById("mm_add_child_form").style.display = "none";
        document.getElementById("mm_delete_branch_form").style.display = "block";
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
        // Change all delete class elements to grey
        var delete_classes = document.getElementsByClassName("mm_delete_branch_icon");
        for (var i = 0, len = delete_classes.length; i < len; i++) {
            if (delete_classes[i].style["color"] != "grey") {
                delete_classes[i].style["color"] = "grey";
            }
        }
        // Set selected element to green
        document.getElementById(current_item_id).style.color = "rgb(118, 185, 1)";
        // Change placeholder
        document.getElementById("mm_delete_branch_title").value = "Delete branch \"" + title + "\" with id \"" + id + "\"";
    } else {
        // green, than roll back
        document.getElementById("mm_search_form").style.display = "block";
        document.getElementById("mm_edit_title_form").style.display = "none";
        document.getElementById("mm_add_child_form").style.display = "none";
        document.getElementById("mm_delete_branch_form").style.display = "none";
        // Set selected element to green
        document.getElementById(current_item_id).style.color = "grey";
        // Focus on search input
        document.getElementById("search_main_menu").focus();
        document.getElementById("search_main_menu").select();
    }
    // set parent id input
    document.getElementById('mm_delete_branch_id').value = id;
}

/**********************************************************************************************************************/
// view: 3a-single-page-content (blog content)
// radio choice switcher local or server div
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
        //console.log(values['preview_image']);
        $.ajax({
            url: values['URLROOT'] + "/index/ajax_deletePreviewImage",
            type: "POST",
            data: { ajax_sDeletePreviewImage: values['preview_image'] },
            success: function (result) {
                // [alert info, alert success, alert warning, alert danger]
                var message = '<div class="alert success" id="msg-flash">' +
                '<span class="closebtn" onclick="this.parentElement.style.display=\'none\'">&times;</span>' +
                'Success: Preview image ' + values['preview_image'] + ' was deleted!' +
                '</div>';
                // Inserting the code block
                document.getElementById("preview_images_message").innerHTML = message;

                setTimeout(function () {
                    $('#preview_images_message').fadeOut('fast');
                    // replace content of #blog_preview_images_list_modal_body with <div> 
                    $('#blog_preview_images_list_modal_body').html($(result).html());       
                    // check gui
                    var selectedPreviewImageURL = document.getElementById("selectedServerPreviewImage").src;
                    var parts = selectedPreviewImageURL.split('/');
                    var lastSegment = parts.pop() || parts.pop();  // handle potential trailing slash
                    if (values['preview_image'] === lastSegment) {
                        document.getElementById("selectedServerPreviewImage").src = values['PUBLIC_CORE_IMG_PREVIEWURL'] + '/' + values['DEFAULT_PREVIEW_IMAGE'];
                        document.getElementById("blog_preview_image_server").value = values['DEFAULT_PREVIEW_IMAGE'];
                    }
                }, 3000);
            },
            error: function (result) {
                // [alert info, alert success, alert warning, alert danger]
                var message = '<div class="alert danger" id="msg-flash">' +
                '<span class="closebtn" onclick="this.parentElement.style.display=\'none\'">&times;</span>' +
                'Error: Could not delete preview image=' + values['preview_image'] + '!' +
                '</div>';
                // replace content of #blog_preview_images_list_modal_body with <div> 
                $('#blog_preview_images_list_modal_body').html($(result).html());
                // Inserting the code block
                document.getElementById("preview_images_message").innerHTML = message;
                setTimeout(function () {
                    $('#preview_images_message').fadeOut('fast');
                }, 3000);
                console.log("Error by ajax_deletePreviewImage(): " + result);
            }
        });
    }
}

// load preview images
function ajax_loadPreviewImageList(values) {
    //console.log(values);
    $.ajax({
        url: values['URLROOT'] + "/index/ajax_loadPreviewImageList",
        type: "POST",
        data: { ajax_sLoadPreviewImageList: "please" },
        success: function (result) {
            // replace content of #blog_preview_images_list_modal_body with <div> 
            $('#blog_preview_images_list_modal_body').html($(result).html());
        },
        error: function (result) {
            console.log("Error by ajax_loadPreviewImageList(): " + result);
        }
    });
}

/**********************************************************************************************************************/
// view: 3-nav-top-admin (navigation)
// view: 3a-single-page-content (blog content)
// blog content switcher view and edit mode
function ajax_loadBlogPage(values) {
    var user_content = document.getElementById("tinymce_data").style.display;
    //console.log(values);
    if (user_content === "none") {
        $.ajax({
            url: values['URLROOT'] + "/index/ajax_loadBlogPage",
            type: "POST",
            data: { ajax_sDisplayBlogContentID: values['blog_id'] },
            success: function (result) {
                // replace content of #tinymce_data with <div>
                $('#tinymce_data').html($(result).html());
            },
            error: function (result) {
                console.log("Error by ajax_loadBlogPage(): " + result);
            }
        });
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

/**********************************************************************************************************************/
// view: 3-nav-top-user (social media)
// view: 3a-single-page-content (blog content)
// on image select display file name as button name
$(".custom-file-input").on("change", function () {
    var fileName = $(this).val().split("\\").pop();
    if (fileName) {
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    }
});

/**********************************************************************************************************************/
