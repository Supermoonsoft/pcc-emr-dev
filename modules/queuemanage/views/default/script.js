//ทำ datatable
$('#grid-view-data-table .table').DataTable();

// จัดคิว
var n = 0;
$('.chk_pt').click(function (e) {
    if (e.target.checked) {
        n = n + 1;
        console.log($(this).val(), Date.now());
    } else {
        n = n - 1;
    }
});
$('#form-add-q').submit(function (e) {
    let room = $('#room').val();

    if (n < 1 || room < 1) {
        swal("ดำเนินการไม่ถูกต้อง!");
        e.preventDefault();
    }
});


// แสดง Lab

$('.tr-vn').hover(function () {
    $(this).css("background-color", "skyblue");
    $('#lab-view').html($(this).data('cid'));
}, function () {
    $(this).css("background-color", "");
});

