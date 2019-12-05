$(document).ready(()=>{
    var  bool1 = false;
    var bool2 = true;
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

    var val = $("#stock").val();
    val = parseFloat(val);
    if (val > 20){
        for (var i = 0; i < 21; i++){
            $("#select6").append(new Option(i, i));
        }
    } else {
        for (var i = 0; i < (val + 1); i++){
            $("#select6").append(new Option(i, i));
        }
    }

    $("#onglet1").click(function () {
        if (bool1) {
            $(".commentaire-container").toggleClass("open");
            $(".write-commentaire").toggleClass("open");
            $("#onglet1").css('z-index', '1');
            $("#onglet2").css('z-index', '-1');
            bool1 = false;
            bool2 = true;
        }

    });

    $("#onglet2").click(function () {
        if (bool2){
            $(".commentaire-container").toggleClass("open");
            $(".write-commentaire").toggleClass("open");
            $("#onglet2").css('z-index', '1');
            $("#onglet1").css('z-index', '-1');
            bool1 = true;
            bool2 = false;
        }

    });

    var url = $("#url").val();
    $(".image-container").css('background-image','url('+url+')');

});