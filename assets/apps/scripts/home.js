var FORM = $('#reservationShip'),
    PORTORIGIN = $('#portOrigin'),
    PORTDEST = $('#portDest'),
    HOURS = $('#hours'),
    HOURSRETURN = $('#hours-return'),
    TSERVICE = $('#service'),
    TVEHICLE = $('#vehicleType'),
    VEHICLE = $('#vehicle_class'),
    DATEORIGIN = $('#dateOrigin'),
    DATERETURN = $('#dateReturn'),
    LOADING = $('#loading'),
    SPECIAL = $('#special'),
    SHIPCLASS = $('#ship_class'),
    INTERMODA = $('#intermoda'),
    adult = $('#dewasa'),
    child = $('#anak'),
    infant = $('#bayi'),
    PASSENGER_INFO = $('#passenger-info'),
    btnSearch = $('#btnSearch'),
    LOADING2 = $('#loading2'),
    LOADINGHOURSRETURN = $('#loading-hours-return'),
    max_capacity = 0,
    total = $('#dewasa').val() + $('#anak').val(),
    max_cal_adult = 0,
    max_cal_child = 0;
    // BASE_URL = "https://tiket.indonesiaferry.co.id";

$(document).ready(function(){

    var height_box = $(".schedule-box").height();
        $('.search-schedule-content').height(height_box-50);
 
    PORTORIGIN.select2();
    PORTDEST.select2();
    VEHICLE.select2();
    SHIPCLASS.select2();  

    // $.ajax({
    //     url     : BASE_URL+'schedule/getInit', 
    //     type    : 'GET',
    //     dataType: 'json',

    //     beforeSend: function(){
    //         $('#loading-form').show();
    //         $('#formSearch').hide()
    //     },

    //     success: function(json) {
    //         if(json.code == 1){
    //             PORTORIGIN.select2({
    //                 data: json.origin
    //             });

    //             TSERVICE.select2({
    //                 data: json.service    
    //             });
    //             $('#service_txt').val($("#service option:selected").text());

    //             SHIPCLASS.select2({
    //                 data: json.ship_class
    //             });
    //             $('#ship_class_txt').val($("#ship_class option:selected").text());                
                
    //             max_capacity  = json.config.max_booking_passanger;
    //             if ($('#service option:selected').val() == 1){
    //             max = max_capacity;
    //             }else{
    //                 max = $('#vehicle_class option:selected').data('capacity');            
    //             }

    //             max_cal_adult  = max - $('#anak').val()
    //             max_cal_child  = max - $('#dewasa').val();
    //             $("#adult").trigger("touchspin.updatesettings", {max: max_cal_adult});               
    //             $("#child").trigger("touchspin.updatesettings", {max: max_cal_child});
    //             $("#infant").trigger("touchspin.updatesettings", {max: max});
                
    //             // set date go live 17 April 2019
    //             var startdatelive = (json.config.min_booking_date > date_now()) ? '2019-05-17 00:00:00' : json.config.min_booking_date;

    //             var from = DATEORIGIN.datepicker({
    //                 changeMonth : false,
    //                 changeYear  : false,    
    //                 numberOfMonths: 1,        
    //                 minDate     : formatDateLocale(startdatelive, 'ddd, D MMM YYYY'),
    //                 maxDate     : formatDateLocale(json.config.max_booking_date, 'ddd, D MMM YYYY'),
    //                 dateFormat  :'D, dd M yy',
    //                 autoclose   : true,
    //                 onSelect: function(dateText) {
    //                     $(this).valid();
    //                     var depart_date = $.datepicker.formatDate('yy-mm-dd', $(this).datepicker('getDate'));
    //                     $('#depart_date').val(depart_date);
    //                     if(depart_date > $('#return_date').val()){
    //                         $('#depart_date').val(depart_date);
    //                         $('#return_date').val(depart_date);
    //                         DATERETURN.val(formatDateLocale($(this).datepicker('getDate'), 'ddd, D MMM YYYY'));
    //                     }
    //                     getHoursDeparture(PORTORIGIN.val(),PORTDEST.val(), depart_date);
    //                     to.datepicker( "option", "minDate", dateText );
                        
    //                 },
    //                 beforeShowDay: function(date) {
    //                     if(date.getDay() == 0) {
    //                         return [true, "weekend", ''];
    //                     } else {
    //                         return [true, '', ''];
    //                     }
                        
    //                 }
    //             });

    //             var to = DATERETURN.datepicker({
    //                 changeMonth : false,
    //                 changeYear  : false,    
    //                 numberOfMonths: 1,    
    //                 minDate     : formatDateLocale(json.config.min_booking_date, 'ddd, D MMM YYYY'),
    //                 maxDate     : formatDateLocale(json.config.max_booking_date, 'ddd, D MMM YYYY'),     
    //                 dateFormat  :'D, dd M yy',
    //                 autoclose   : true,
    //                 onSelect: function(dateText) {
    //                     $(this).valid();
    //                     var return_date = $.datepicker.formatDate('yy-mm-dd', $(this).datepicker('getDate'));
    //                     $('#return_date').val(return_date);
    //                     getHoursReturn(PORTDEST.val(),PORTORIGIN.val(), return_date);
    //                 },
    //                 beforeShowDay: function(date) {
    //                     if(date.getDay() == 0) {
    //                         return [true, "weekend", ''];
    //                     } else {
    //                         return [true, '', ''];
    //                     }
                        
    //                 }
    //             });
    //         }
    //     },

    //     error: function() {
    //         console.log('Silahkan Hubungi Administrator')
    //     },

    //     complete: function(){
    //         $('#loading-form').hide()
    //         // $('#loading-form').html('')
    //         $('#formSearch').show()
    //     },
    // });

    // PORTORIGIN.on('select2:select', function (e) {
    //     $.ajax({
    //         url     : BASE_URL+'schedule/getSchedule',
    //         data    : {origin : $(this).val()},
    //         type    : 'POST',
    //         dataType: 'json',

    //         beforeSend: function(){
    //             $('#loading-destination').show()
    //             $('#container-dest').hide()
    //             PORTDEST.next(".select2-container").hide()
    //         },

    //         success: function(json) {
    //             PORTDEST.html('')
    //             if(json.code == 1){
    //                 PORTDEST.select2({
    //                     data: json.port_destination
    //                 });

    //             $('#origin-name').val(titleCase($("#portOrigin option:selected").text()));
    //             }
    //         },

    //         error: function() {
    //             console.log('Silahkan Hubungi Administrator')
    //         },

    //         complete: function(){
    //             $('#loading-destination').hide()
    //             $('#container-dest').show()
    //             PORTDEST.next(".select2-container").show()
    //         },
    //     });
    // });

    // PORTORIGIN.on('select2:select', function (e) {
    //     clearScheduleTime();
    // })

    // PORTDEST.on('select2:select', function (e) {
    //     $('#destination-name').val(titleCase($("#portDest option:selected").text()));
    //     clearScheduleTime();
    // })

    $('.select2').on('select2:select', function (e) {
    	$(this).valid()
    });

    HOURS.select2();
    HOURS.on('select2:select', function (e) {
        var depart_time = $(this).val().split("-");
        $('#depart_time_start').val(depart_time[0]);        
        $('#depart_time_end').val(depart_time[1]);
    });

    HOURSRETURN.select2();
    HOURSRETURN.on('select2:select', function (e) {
        var depart_time = $(this).val().split("-");
        $('#depart_time_start_back').val(depart_time[0]);        
        $('#depart_time_end_back').val(depart_time[1]);
    });

    TSERVICE.select2({
        minimumResultsForSearch: -1        
    })

    $('#service_txt').val($("#service option:selected").text());
    TSERVICE.on('select2:select', function (e) {
        $('#service_txt').val($("#service option:selected").text());
    });

    
    VEHICLE.on('select2:select', function (e) {
        $('#vehicle_txt').val($("#vehicle_class option:selected").text());
    });

    SHIPCLASS.on('select2:select', function (e) {
        $('#ship_class_txt').val($("#ship_class option:selected").text());
    });

    TSERVICE.on('select2:select', function (e){
        val = this.value;
        if(val == 1){
            valPassenger()
            VEHICLE.prop("disabled", true); 
            VEHICLE.removeAttr('name'); 
            $('#vehicle_txt').removeAttr('name');   
            $('#input-type-vehicle').toggleClass('inp-disable', true);  
            // getInit(); 
        }

        if(val == 2){
            VEHICLE.prop("disabled", false); 
            VEHICLE.attr('name', 'vehicle_type');
            $('#vehicle_txt').attr('name', 'vehicle_txt');
            $('#input-type-vehicle').toggleClass('inp-disable', false);
            // getVehicleType()

            VEHICLE.change(function(){
                // valPassenger()

                max             = $('option:selected', this).data('capacity');
                max_cal_adult   = max - $('#anak').val()
                max_cal_child  = max - $('#dewasa').val();

            })
        }
    });

    $('#portOrigin').on('select2:select', function (e) {
        var data = e.params.data.id;
        if (data == 99) {
            redirect('https://tiket2.indonesiaferry.co.id');
        }
    });


    /* FORM VALIDATION */
    FORM.validate({		
        lang : 'id',
        errorElement : 'span',
        rules: {
            dewasa: {
                min: 1
            },
            anak: {
                min: 0
            },
            bayi: {
                min: 0
            },
        },

        errorPlacement: function(error, element) {
            if (element.parent('.input-group').length) {
                error.appendTo( element.parent().parent() );
            }

            else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                error.appendTo( element.parent());
            }

            else {
                error.insertAfter(element);
            }
        },

        submitHandler: function(form) {
            data = getFormData($(form));
            if(data.origin == data.destination){
                $('.modal-body').html(
                    '<div style="padding: 10px"> \
                        <h4 class="text-center">Pelabuhan asal dan Pelabuhan tujuan tidak boleh sama</h4>\
                    </div>'
                );
                $('#modal-small').modal();
                return false;
            }

            btnSearch.button('loading');

            setTimeout(function(){
                btnSearch.button('reset');
                form.submit();    
            },1000)
            
        }
    });
})

function getInit(){
    $.ajax({
        url     : BASE_URL+'schedule/getInit', 
        type    : 'GET',
        dataType: 'json',

        beforeSend: function(){},

        success: function(json) {
            if ($('#service option:selected').val() == 1){
                max = max_capacity;
            }else{
                max = $('#vehicle_class option:selected').data('capacity');            
            }

            max_cal_adult  = max - $('#anak').val()
            max_cal_child  = max - $('#dewasa').val();
            $("#adult").trigger("touchspin.updatesettings", {max: max_cal_adult});               
            $("#child").trigger("touchspin.updatesettings", {max: max_cal_child});
            $("#infant").trigger("touchspin.updatesettings", {max: max});

           
        },

        error: function() {
            console.log('Silahkan Hubungi Administrator')
        },

        complete: function(){},
    });
}

$('#cbx').change(function(){
    if (this.checked) {
    //    getHoursReturn(PORTDEST.val(),PORTORIGIN.val(), DATERETURN.val());
    }
});

function getHoursDeparture(origin, destination, depart_date){
    $.ajax({
        url     : BASE_URL+'schedule/getHours',
        data    : {
            origin: origin,
            destination: destination,
            depart_date: depart_date,
            ship_class: 1
        },
        type    : 'POST',
        dataType: 'json',

        beforeSend: function(){
            LOADING.show()
            $('#container-hours').hide()
            HOURS.next(".select2-container").hide()
        },

        success: function(json) {
            HOURS.html('')
            if(json.code == 1){
                HOURS.select2({
                    data: json.times
                })
            }
        },

        error: function() {
            console.log('Silahkan Hubungi Administrator');
        },

        complete: function(){
            LOADING.hide()
            $('#container-hours').show()
            HOURS.next(".select2-container").show()
        }
    });
}

function getHoursReturn(origin, destination, return_date){
    $.ajax({
        url     : BASE_URL+'schedule/getHours',
        data    : {
            origin: origin,
            destination: destination,
            depart_date: return_date,
            ship_class: 1
        },
        type    : 'POST',
        dataType: 'json',

        beforeSend: function(){
            LOADINGHOURSRETURN.show()
            $('#container-hours-return').hide()
            HOURSRETURN.next(".select2-container").hide()
        },

        success: function(json) {
            HOURSRETURN.html('')
            if(json.code == 1){
                HOURSRETURN.select2({
                    data: json.times
                })
            }
        },

        error: function() {
            console.log('Silahkan Hubungi Administrator');
        },

        complete: function(){
            LOADINGHOURSRETURN.hide()
            $('#container-hours-return').show()
            HOURSRETURN.next(".select2-container").show()
        }
    });
}

function getVehicleType(){
    $.ajax({
        url     : BASE_URL+'schedule/getVehicle',
        type    : 'GET',
        dataType: 'json',

        beforeSend: function(){
            LOADING2.show()
            TVEHICLE.hide()
        },

        success: function(json) {
            if(json.code == 1){
                VEHICLE.select2(
                    { 
                        data: json.data,
                        templateSelection: function (data, container) {
                            // Add custom attributes to the <option> tag for the selected option
                            $(data.element).attr('data-capacity', data.capacity);
                            $(data.element).attr('data-desc', data.description);
                            return data.text;
                        },
                        templateResult: function (data) {
                            return '<div class="my-semi-bold">'+data.text+'</div><div><small>'+data.description+'</small></div>';
                        }, 
                        escapeMarkup: function (m) {
                            return m;
                        }
                    }
                );
            }
        },

        error: function() {
            console.log('Silahkan Hubungi Administrator');
        },

        complete: function(data){
            LOADING2.hide()
            TVEHICLE.show()
        }
    });
}

function valPassenger(){
    $('#dewasa').val(1);
    $('#anak').val(0);
    $('#bayi').val(0);
    PASSENGER_INFO.val('1 Dewasa');

    $popover.on('shown.bs.popover', function() { 
        $('#adult').val($('#dewasa').val());
        $('#child').val($('#anak').val());
        $('#infant').val($('#bayi').val());
    });
}

function clearScheduleTime() {
    DATEORIGIN.val('');
    HOURS.val('').trigger('change');
    HOURS.html('');
    $('#depart_date').val('');
    $('#depart_time_start').val('');
    $('#depart_time_end').val('');
    $('#return_date').val('');
    $('#depart_time_start_back').val('');
    $('#depart_time_end_back');

    DATERETURN.val('');
    HOURSRETURN.val('').trigger('change');
    HOURSRETURN.html('');
}
