$(document).ready(function() {
    $('#rentsection').css("display","none");
    $('#renttype').change(function(){
        var renttype = $('#renttype').val();
        switch(renttype){
            case 'BUY':
                $('#rentsection').css("display","none");
            break;
            case 'RENT':
                $('#rentsection').css("display","block");
            break;
            case 'EMPTY':
                $('#rentsection').css("display","none");
            break;
        }
    });

});