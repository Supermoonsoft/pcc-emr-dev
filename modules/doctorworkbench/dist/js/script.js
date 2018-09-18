$('#icd_code').on('select2:select', function (e) {
    dataForm();
    });
$("#form").submit(function(event) {
    event.preventDefault();
    dataForm();

});
function dataForm(){
    var form = $("#form");
    var data = form.serialize();
                var url = form.attr('action');
                $.ajax({
                    url: url,
                    type: 'post',
                    dataType: 'json',
                    data: data
                })
                .done(function(response) {
                    $.pjax.reload({container: "#crud-datatable-pjax"});
                    console.log(response);
                })
                .fail(function() {
                    console.log("error");
                    $.pjax.reload({container: "#crud-datatable-pjax"});
});
}