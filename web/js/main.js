cid = $('#cid_search');

cid.click(function () {
    cid.select()
});

$(function () {
    cid.select();
});

$('#btn-patient-exit').click(function (e) {
    $('#modal-patient-exit').removeClass('fade');
    var url = $(this).data('value');
    $('#modal-patient-exit')
            .modal('show')
            .find('#modal-patient-exit-content')
            .load(url);

});





