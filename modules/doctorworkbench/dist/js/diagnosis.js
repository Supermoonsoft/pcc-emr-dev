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
        var id = $(this).attr('value');
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
                $.ajax({
                    type: "post",
                    url: "index.php?r=doctorworkbench/pcc-diagnosis/get-diag",
                    data:{id:id},
                   dataType: "json",
                    success: function (response) {
                        console.log(JSON.stringify(response));
                        var cc = JSON.parse(response.cc);
                        $('#cc').val(cc);
                        $('#icd_code').val(response.icd_code).trigger('change');
                        $('#diag_type').val(response.diag_type).trigger('change');
                        $('#form-diagnosis').attr('action', $('#update').attr('action'));
                    }
                });


            }else{
                $('#btn_text').text('เพิ่ม');
                $('#btn-save').addClass('btn-success');
                $('#btn-save').removeClass('btn-warning');
                $('#icon').addClass('fas fa-plus');
                $('#icon').removeClass('fas fa-edit');
                $('#cc').val('');
                $('#form-diagnosis')[0].reset();
                $('#form-diagnosis').attr('action', $('#create').attr('action'));


    
            }
        }
       
        
        // console.log(id);
       
       

    });
    
});
