$(function(){
    // $('#btn-update-select').click(function(){
    //  var keys = $("#crud-medication").yiiGridView("getSelectedRows");
    //  //console.log(keys.join());
    //  $.ajax({
    //      type: "post",
    //      url: "index.php?r=doctorworkbench/pcc-medication/update-med",
    //      data:{
    //          id:keys,
    //          value:{
    //              icode:$('#icode').val(),
    //              druguse:$('#druguse').val(),
    //              qty:$('#qty').val()
    //         }
    //      },
    //      dataType: "json",
    //      success: function (response) {
    //         $.pjax.reload({container: response.forceReload});
    //         $(response.forceReload).on('pjax:complete', function() {
    //             totalPrice($('#cid').val());
    //             $('#icode').val(null).trigger('change');
    //            $('#form-medication')[0].reset();
    //          })

    //      }
    //  });


    // });


    $('.select-on-check-all, .checkbox-row').click(function(){
        console.log();
    })

    $('.kv-row-checkbox').click(function(e){
        var keys = $("#crud-diagnosis").yiiGridView("getSelectedRows");
        if(keys.length > 1){
            swal('เลือกเพียง 1 รายการ');
            return false;
        }else{
            if (e.target.checked) {
                $('#btn_text').text('แก้ไข');
                $('#btn-save').removeClass('btn-success');
                $('#btn-save').addClass('btn-warning');
                $('#icon').removeClass('fas fa-plus');
                $('#icon').addClass('fas fa-edit');
            }else{
                $('#btn_text').text('เพิ่ม');
                $('#btn-save').addClass('btn-success');
                $('#btn-save').removeClass('btn-warning');
                $('#icon').addClass('fas fa-plus');
                $('#icon').removeClass('fas fa-edit');
    
            }
        }
       
        var id = $(this).attr('value');
        console.log(id);
       
       
//       $.ajax({
//        type: "post",
//        url: "index.php?r=doctorworkbench/pcc-medication/select-med",
//        data:{id:id},
//        dataType: "json",
//        success: function (response) {
//            console.log(JSON.stringify(response));
//            $('#icode').val(response).trigger('change');
//        }
//    });
    });
    
});
