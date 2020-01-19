/*
 *   view: costs
 */
//Param assoc array
function costsDeleteRow(values) {
    // url: '../app/ajax/costs.php',
    // url: '../app/controllers/Costs.php',
    $.ajax({
        type: 'POST',
        data: 'cost_id=' + values['cost_id'],
        url: '../app/ajax/costs.php',
        error: costsDeleteRow_error,
        success: costsDeleteRow_success
    });
    //$('#wrapper').load(document.URL + ' #wrapper');
    //location.reload();
}
function costsDeleteRow_error(){
    alert("ERROR: Record was not deleted!");
}
function costsDeleteRow_success(){
    alert("SUCCESS: Record was deleted!");
}
//