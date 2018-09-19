$('body').on('beforeSubmit', '#form', function () {
    var form = $("#form");
    // return false if form still have some validation errors
    if (form.find('.has-error').length) {
         return false;
    }
    $.ajax({
         url: form.attr('action'),
         type: 'post',
         data: form.serialize(),
         success: function (response) {
              console.log('Success');
             $.pjax.reload({container: "#crud-datatable-pjax"});
            //  $('#icd_code').val(null).trigger('change');
            $("#form")[0].reset();
         }
    });
    return false;
});