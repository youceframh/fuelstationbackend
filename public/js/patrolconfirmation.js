$(document).ready(function() {
    $('#moneyplace').change(()=>{
        var type =  $('#moneyplace').val();
        switch(type){
            case 'company':
                $('#receiptnumber').css('display','none');
                $('#receiptnumberofbank').css('display','none');
                break;
            case 'bank' :
           $('#receiptnumber').css('display','none');
           $('#receiptnumberofbank').css('display','flex');
           break;
           case 'supplier' :
           $('#receiptnumber').css('display','flex');
           $('#receiptnumberofbank').css('display','none');
           break;
        }
    });
})