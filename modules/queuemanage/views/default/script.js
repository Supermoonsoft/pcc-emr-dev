$('#grid-view-data-table .table').DataTable();
var n = 0;
$('#btn_add_q').prop('disabled', true);
var room;
$('#room').change(function(){
    room =  $(this).val();
});
$('.chk_pt').click(function (e) {
    
    if (e.target.checked ) {
       
        n = n + 1;
        console.log(n , room)
        
    }else{
        n=n-1;
        console.log(n)
    }
    if (n > 0 ) {
        $('#btn_add_q').prop('disabled', false);
    } else {
        $('#btn_add_q').prop('disabled', true);
    }
});