
$(function(){
    $('#uploadfile').click(function(){
        $('#uploadfileinput').click();
    });
    $('#uploadfileinput').change(function(){
        $('#submitprofilepic').removeAttr("disabled");
    })
})