$(function(){
    $('#crud-medication').click(function(){
        var keys = $("#crud-medication").yiiGridView("getSelectedRows");
//     console.log(keys.join());


    });
    $('.select-on-check-all, .checkbox-row').click(function(){
        console.log();
    })
    $('.kv-row-checkbox').click(function(){
        var id = $(this).attr('value');
      $.ajax({
       type: "post",
       url: "index.php?r=doctorworkbench/pcc-medication/select-med",
       data:{id:id},
       dataType: "json",
       success: function (response) {
           console.log(JSON.stringify(response));
           $('#icode').val(response).trigger('change');
       }
   });
    });
    
});
