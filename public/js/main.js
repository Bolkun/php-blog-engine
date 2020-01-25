/*
 *   view: costs
 */
//Param assoc array
function costsDeleteRow(values) {
    if (confirm("Want to delete Record with id="+values['cost_id']+"?")) {
        //Logic to delete the item
        $.ajax({
            url: values['URLBASE'],
            data: 'cost_id=' +values['cost_id']+ '&year=' +values['year'],
            type: 'post',
            error: costsDeleteRow_error,
            success: costsDeleteRow_success
        });
    }
}
function costsDeleteRow_error(){
    alert("ERROR: Record was not deleted!");
}
function costsDeleteRow_success(){
    $("#costsDeleteRow_success").load(location.href + " #wrapper" );    //parent.load(child)
    alert("SUCCESS: Record was deleted!");
}
/*
 *
 */
