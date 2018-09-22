$('#grid-view-data-table .table').DataTable();
var n = 0;
$('#btn_add_q').prop('disabled', true);
$('.chk_pt').click(function (e) {
    if (e.target.checked) {
        console.log(e.target.value);
        n = n + 1;
        console.log(n)
    }else{
        n=n-1;
    }
    if (n > 0) {
        $('#btn_add_q').prop('disabled', false);
    } else {
        $('#btn_add_q').prop('disabled', true);
    }
});