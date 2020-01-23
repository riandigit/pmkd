// GETTING CONFIG PARAMS
// var BASE_URL = $('#baseUrl').val();
// var WEEKDAYS = JSON.parse($('#weekDays').val());
// var MONTHS = JSON.parse($('#months').val());
// var PORT = $('#dataPort').val();

// Config Select2
$('b[role="presentation"]').hide();
$('.select2-arrow').append('<i class="fa fa-angle-down"></i>');
$(".select2").select2({
    // minimumResultsForSearch: -1
});

//DR| ADD DYNAMIC LANGUAGE
var LANG = $('#lang').val();


$('body').on('hidden.bs.modal', '.modal', function () {
    $(this).removeData('bs.modal');
});

if ($(window).width() < 732 ){
    $('.my-history-container').slideToggle();
}

// change case title case
function titleCase(str) {
    str = str.toLowerCase().split(' ');
    for (var i = 0; i < str.length; i++) {
        str[i] = str[i].charAt(0).toUpperCase() + str[i].slice(1); 
    }
    return str.join(' ');
}

// close modal fullscreen
$('.close').on('click', function () { 
    $('.modal-full').addClass('slide-out-right-xs').removeClass('slide-in-right-xs');
    setTimeout(function(){
        $('.modal-full-screen').modal('hide');
    },500)          
});
$('.modal-full-screen').on('show.bs.modal', function () {    
    $('.modal-full').addClass('slide-in-right-xs').removeClass('slide-out-right-xs');        
});



function numberOnly(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
    return true;
}