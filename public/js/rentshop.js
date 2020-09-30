$(document).ready(function() {
    $('#companyrentsection').css("display","none");
    $('#idcardtypeform').css("display","none");
    $('#rentshoptype').change(function(){
        var rentshoptype = $('#rentshoptype').val();
        switch(rentshoptype){
            case 'COMPANY':
                var node = document.getElementById('idcardtype');
                node.querySelectorAll('*').forEach(n => n.remove());
                document.getElementById('emptyoption')?document.getElementById('emptyoption').remove():console.log('');
                $('#idcardtype').append('<option value="" id="emptyoption"></option>');
                $('#idcardtype').append('<option value="COMMERCIAL">تجارية</option>');
                $('#idcardtype').append('<option value="NATIONAL">وطنية</option>');
                $('#idcardtypeform').css("display","flex");
                $('#companyrentsection').css("display","block");
            break;
            case 'INDIVIDUAL':
                var node = document.getElementById('idcardtype');
                node.querySelectorAll('*').forEach(n => n.remove());
                document.getElementById('emptyoption')?document.getElementById('emptyoption').remove():console.log('');
                $('#idcardtype').append('<option value="" id="emptyoption"></option>');
                $('#idcardtype').append('<option value="ID CARD">بطاقة تعريف</option>');
                $('#idcardtype').append('<option value="PASSPORT">جواز سفر</option>');
                $('#idcardtype').append('<option value="DRIVING LICENSE">رخصة قيادة</option>');
                $('#idcardtypeform').css("display","flex");
                $('#companyrentsection').css("display","none");
            break;
        }
    });

    $('#idcardtype').change(function(){
        var idcardtype = $('#idcardtype').val();
        switch(idcardtype){
            case 'ID CARD':
                document.getElementById('emptyoption')?document.getElementById('emptyoption').remove():console.log('');
                $("#dynamicnameofidcard").text('رقم بطاقة التعريف')
            break;
            case 'PASSPORT':
                document.getElementById('emptyoption')?document.getElementById('emptyoption').remove():console.log('');
                $("#dynamicnameofidcard").text('رقم جواز السفر')
            break;
            case 'DRIVING LICENSE':
                document.getElementById('emptyoption')?document.getElementById('emptyoption').remove():console.log('');
                $("#dynamicnameofidcard").text('رقم رخصة السياقة')
            break;
            case 'COMMERCIAL':
                document.getElementById('emptyoption')?document.getElementById('emptyoption').remove():console.log('');
                $("#dynamicnameofidcard").text('رقم بطاقة التعريف')
            break;
            case 'NATIONAL':
                document.getElementById('emptyoption')?document.getElementById('emptyoption').remove():console.log('');
                $("#dynamicnameofidcard").text('رقم بطاقة التعريف')
            break;
        }
    });

});