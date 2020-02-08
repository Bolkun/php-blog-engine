/*
 *   view: costs
 */
//Param assoc array
function costsDeleteRow(values) {
    if (confirm("Want to delete Record with id="+values['cost_id']+"?")) {
        // Logic to delete the item
        $.ajax({
            url: values['URLBASE'],
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
/******************************************************************************************************/
