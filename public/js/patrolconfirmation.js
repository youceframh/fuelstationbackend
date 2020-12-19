$(document).ready(function() {
    $('#moneyplace').change(()=>{
        var type =  $('#moneyplace').val();
        switch(type){
            case 'company':
                $('#receiptnumber').css('display','none');
                $('#impotence').css('display','flex');
                break;
            case 'bank' :
           $('#receiptnumber').css('display','none');
           $('#impotence').css('display','flex');
           break;
           case 'supplier' :
           $('#receiptnumber').css('display','flex');
           $('#impotence').css('display','flex');
           break;
        }
    });
})