$(document).ready(()=>{
    $(".rate").each(function () {
        var number = $(this).html();
        $(this).html('');
        number = parseFloat(number);
        var i = 0;
        var j = 0;
        var round  = Math.round(number);
        if (round > number){
            j = 1;
        }
        number = Math.floor(number)
        while (number > 0){
            $(this).append('<i class="material-icons star">star</i>');
            number--;
            i++;
        }
        while (j > 0){
            $(this).append('<i class="material-icons star">star_half</i>');
            i++;
            j--;
        }
        while (i < 5){
            $(this).append('<i class="material-icons star">star_border</i>');
            i++;
        }
    });
});