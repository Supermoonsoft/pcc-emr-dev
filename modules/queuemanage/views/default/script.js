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
    $('#lab-view').html('Loading...');
    let cid = $(this).data('cid');
    let uri = 'index.php?r=queuemanage/ajax/lab&cid=' + cid;
    $.get(uri, function (resp) {
        var data = [{
                "id": 1,
                "first_name": "Alli",
                "last_name": "Cassey",
                "email": "acassey0@list-manage.com",
                "gender": "Female",
                "ip_address": "129.82.128.62"
            }, {
                "id": 2,
                "first_name": "Clyde",
                "last_name": "Bromage",
                "email": "cbromage1@bbb.org",
                "gender": "Male",
                "ip_address": "232.45.125.179"
            }, {
                "id": 3,
                "first_name": "Janeczka",
                "last_name": "Trett",
                "email": "jtrett2@vistaprint.com",
                "gender": "Female",
                "ip_address": "149.4.116.82"
            }];
        $('#lab-view').createTable(data);
        console.log(resp[1].data[0])
    });

}, function () {
    $(this).css("background-color", "");
});

