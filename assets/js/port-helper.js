function redirect(url, interval) {
    setTimeout(function(){
        window.location = url;
    }, interval);
}

function increment (id){
    var value = ($(id).val() == '') ? 0 : parseInt($(id).val());
    var max   = $(id).attr('max')

    if (value < max){
        $(id).val(value+1);
    }
}


function decrement (id){
    var value = ($(id).val() == '') ? 0 : parseInt($(id).val());
    var min   = $(id).attr('min')

    if (value > 0){
        $(id).val(value-1);
    }

    if (value == min){
        $(id).val(min);
    }
}

function toTitleCase(str) {
    return str.replace(
        /\w\S*/g,
        function(txt) {
            return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
        }
    );
}