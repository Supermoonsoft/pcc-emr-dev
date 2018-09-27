//ทำ datatable
$('#grid-view-data-table .table').DataTable();

// จัดคิว
var n = 0;
$('.chk_pt').click(function (e) {
    var pccvn = e.target.value;
    if (e.target.checked) {
        n = n + 1;
        $('#input'+pccvn+'').val(n); // นำตัวแปร n ไปแสดงในตาราง ตาม selector id
        $('#'+pccvn+'').html(n); // นำตัวแปร n ไปแสดงในตาราง ตาม selector id

    } else {
        n = n - 1;
        $('#input'+pccvn+'').val(''); // นำตัวแปร n ไปแสดงในตาราง ตาม selector id
        $('#'+pccvn+'').html(''); // นำตัวแปร n ไปแสดงในตาราง ตาม selector id
    }
});
$('#form-add-q').submit(function (e) {
    let room = $('#room').val();

    if (n < 1 || room < 1) {
        swal("คำสั่งไม่ถูกต้อง!");
        e.preventDefault();
    }
});


// แสดง Lab

$('.tr-vn').hover(function () {
    $(this).css("background-color", "skyblue");

}, function () {
    $(this).css("background-color", "");
});

$('.tr-vn').click(function () {
    $(this).css("background-color", "orange");
    $('#lab-view').html('Loading...');
    let cid = $(this).data('cid');
    let pcc_vn = $(this).data('pccvn');
    let uri = 'index.php?r=queuemanage/ajax/lab-view&cid=' + cid;
    $.get(uri, function (data) {
     //  $('#lab-view').html(JSON.stringify(data))
      // console.log(data);
      $('#lab-view').html(data);
    });

    
});

