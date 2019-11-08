$(document).ready(() => {
    var categorieSize = 4;
    var categorieOpen = false;
    var check1 = false;
    var check2 = false;
    var containerSize = 9.5;
    var marque = [];
    $('#reseach').bind('input', function() {
        if ($(this).val() != ""){
            $('#clear-icon').css("visibility", "visible");
            $('#clear-icon').removeClass("clear");
        } else {
            $('#clear-icon').addClass("clear");
            setTimeout(function () {
                $('#clear-icon').css("visibility", "hidden");
            },250);
        }
    });

    $('#clear-icon').click(function () {
        $('#reseach').val('');
        $('#clear-icon').addClass("clear");
        setTimeout(function () {
            $('#clear-icon').css("visibility", "hidden");
        },250);
    });

    $('#nav-bar-btn').click(function () {
        $('#nav-bar').toggleClass("nav");
        $('#nav-bar-comp').toggleClass("navcomp");
    });

    $('#nav-bar-comp').click(function (event) {
        $('#nav-bar').toggleClass("nav");
        $('#nav-bar-comp').toggleClass("navcomp");
    });

    $('#fermer').click(function (event) {
        $('#nav-bar').toggleClass("nav");
        $('#nav-bar-comp').toggleClass("navcomp");
    });

    $('#categories').click(function (event) {
        if (categorieOpen) {
            $(".under").css("display","none");
            $('#expand-icon').html('expand_more');
            categorieOpen = false;
        } else {
            $(".under").css("display","block");
            $('#expand-icon').html('expand_less');
            categorieOpen = true;
        }
    });

    $('#filtrer').click(function () {
        $('.filtre-container').toggleClass('open');
    });

    $(".check1").click(function () {
        if (check1){
            $('#prix').prop("value", "0");
            check1 = false;
        } else {
            $('#prix').prop("value", "1");
            check1 = true;
        }
        $( ".check2" ).prop( "checked", false );
        check2 = false;
    });

    $(".check2").click(function () {
        if (check2){
            $('#prix').prop("value", "0");
            check2 = false;
        } else {
            $('#prix').prop("value", "2");
            check2 = true;
        }
        $( ".check1" ).prop( "checked", false );
        check1 = false;
    });

    $('#select').change(function() {
        var val = $("#select option:selected").text();
        $('#c-text').html(val);
    });

    $('#select3').change(function() {
        var val = $("#select3 option:selected").text();
        $(".prix-total").html(1500*val + "€");
    });



    for (var i = 1; i < 14; i++){
        $('.container').append( '<div class=\"card\">\n <div class=\"img-container\">\n ' +
            '</div>\n<div class=\"description-container\">\n<p class=\"marque\">Nvidia<p/>\n  ' +
            '<p class=\"description\">Une description bouleversante, renversante et interessante de cette magnifique garte graphique rtx 2080.<p/>\n' +
            ' <p class="prix">1500 €<p/> <p><i class="add-icon material-icons buy-icon">add_shopping_cart</i></p> </div>\n </div>\n' );
    }

    var marque;
    var tabMarque
    getMarque().then(function (value) {
        marque = value;
        tabMarque = marque.split(' ');
        for (var i = 0; i < tabMarque.length - 1; i++){
            $('.filtre-container').append( '<div class="div-marque" id="marque'+i+'"><p>'+tabMarque[i]+'</p> <i class="material-icons open"> check </i></div>');
            containerSize += 1.9;
            $(".filtre-container").css('height', containerSize + "rem");
        }
        $('.div-marque').click(function () {
            jQuery(this).children("i").toggleClass('open');
            $(this).toggleClass('true');
            marque = [];
            $( ".true" ).each(function(index) {
                marque.push(jQuery(this).children("p").html());
            });
            $("#marque").val(marque);
        });
    });




    $('.buy-icon').click(function () {
        $("#buy").toggleClass('open');
        $('#buy-comp').toggleClass("navcomp");
    });

    $('#buy-comp').click(function () {
        $('#buy').toggleClass("open");
        $('#buy-comp').toggleClass("navcomp");
    });

    $('#clear-icon2').click(function () {
        $("#buy").toggleClass('open');
        $('#buy-comp').toggleClass("navcomp");
    });

});