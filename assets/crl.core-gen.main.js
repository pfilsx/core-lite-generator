var table_name = $('[data-attribute=table_name]');
var model_name = $('[data-attribute=model_name]');

$('#table_name').on('change', function(){
   var obj = $(this);
   var infoBlock = $('.info-block');
   if (obj.val().trim().length < 1){
       infoBlock.find('input').prop('disabled', true);
       table_name.val('');
       model_name.val('');
       return;
   }
   var tableName = obj.val().trim();
   table_name.val(tableName).blur();
    var modelClass = '';
    $.each(tableName.split('_'), function() {
        if(this.length>0)
            modelClass+=this.substring(0,1).toUpperCase()+this.substring(1);
    });
    model_name.val(modelClass).blur();
    infoBlock.find('input').prop('disabled', false);
});

model_name.on('blur', function(){
    if ($(this).val().trim().length > 0){
        $('input[type=submit]').prop('disabled', false);
    } else {
        $('input[type=submit]').prop('disabled', true);
    }
});
