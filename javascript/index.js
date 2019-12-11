$(document).ready(() => {
    var categorieSize = 4;
    var categorieOpen = false;
    var check1 = false;
    var check2 = false;
    var containerSize = 9.5;
    var marque = [];
    var resultSize = 0;
    var nbcard = 0;
    var currentPrice = 0;
    var toolsopen = false;

    $('#reseach').bind('input', function() {
        $(".result").children().remove();
        resultSize = 0;
        $(".result").css('height', "0rem");
        $(".result").css('display', "none");
        if ($(this).val() != ""){
            $('#clear-icon').css("visibility", "visible");
            $('#clear-icon').removeClass("clear");
        } else {
            $('#clear-icon').addClass("clear");
            setTimeout(function () {
                $('#clear-icon').css("visibility", "hidden");
            },250);
        }

        if ($(this).val().length >= 2) {
            getResult($(this).val()).then(function (value) {
                var produit = value;
                var tabProduit = produit.split('£');
                if (window.location.href.includes('routeur')) {
                    for (var i = 0; i < tabProduit.length - 1; i++){
                        $('.result').append( '<form  method="post" action="../controller/routeur.php">' +
                            '<button type="submit" class="result-bar"><p>' + tabProduit[i] + '</p>' +
                            '</button><input type="hidden" name="id_produit" value="' + tabProduit[i+1] + '">' +
                            '<input type="hidden" name="action" value="infoVueProduit"> </form>');
                        resultSize += 2;
                        $(".result").css('display', "block");
                        $(".result").css('height', resultSize + "rem");
                        $('.result').width($('#reseach').width());
                        $('.result').offset($('#reseach').offset());
                        $('.result').css("top", "67px");
                        if( i + 1 < tabProduit.length - 1){
                            i++;
                        }
                    }
                } else {
                    for (var i = 0; i < tabProduit.length - 1; i++){
                        $('.result').append( '<form  method="post" action="./php/controller/routeur.php">' +
                            '<button type="submit" class="result-bar"><p>' + tabProduit[i] + '</p>' +
                            '</button><input type="hidden" name="id_produit" value="' + tabProduit[i+1] + '">' +
                            '<input type="hidden" name="action" value="infoVueProduit"> </form>');
                        resultSize += 2;
                        $(".result").css('display', "block");
                        $(".result").css('height', resultSize + "rem");
                        $('.result').width($('#reseach').width());
                        $('.result').offset($('#reseach').offset());
                        $('.result').css("top", "67px");
                        if( i + 1 < tabProduit.length - 1){
                            i++;
                        }
                    }
                }

            });
        }
    });

    $('#clear-icon').click(function () {
        $('#reseach').val('');
        $('#clear-icon').addClass("clear");
        setTimeout(function () {
            $('#clear-icon').css("visibility", "hidden");
        },250);
        resultSize = 0;
        $(".result").css('height', "0rem");
        $(".result").css('display', "none");
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
            $('#prix').prop("value", "");
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
            $('#prix').prop("value", "");
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

    $('#select5').click(function() {
        var val = $("#select5").val();
        $("#cat").css('display','none');
        if (val == "Processeur"){
            $('.pro').toggleClass('open');
        } else if (val == "CarteMere"){
            $('.cm').toggleClass('open');
        } else if (val == "Memoire"){
            $('.mm').toggleClass('open');
        } else if (val == "CarteGraphique"){
            $('.cg').toggleClass('open');
        } else if (val == "DisqueDur"){
            $('.dd').toggleClass('open');
        } else if (val == "SSD"){
            $('.ssd').toggleClass('open');
        } else if (val == "Alimentation"){
            $('.alimentation').toggleClass('open');
        }
    });

    $('#select3').change(function() {
        var val = $("#select3 option:selected").text();
        $(".prix-total").html(currentPrice*val + "€");
    });

    getCardInfo().then(function (value) {
        if(!window.location.href.includes('routeur')){
            var produit = value;
            var tabProduit = produit.split('£');
            for (var i = 0; i < tabProduit.length - 1; i++){
                nbcard++;
                $('.container').append( '<div class="card"> <form  class="card-form"  method="POST" action="php/controller/routeur.php"> <button id="card'+nbcard+'" type="submit" class="img-container">' +
                    '<input type="hidden" name="id_produit" value="' + tabProduit[i] + '"><input type="hidden" name="action" value="infoVueProduit"' + tabProduit[i] + '"></button></form> <div class="description-container"><p class="marque">' + tabProduit[i+2] + '<p/>' +
                    '<p class="description">' + tabProduit[i+1] + '<p/>' +
                    '<p class="prix">' + tabProduit[i+3] + ',00 €<p/><div class="rond"><p><input class="id" type="hidden" name="id_produit" value="' + tabProduit[i] + '"><i class="add-icon material-icons buy-icon">add_shopping_cart</i></p></div></div></div>');
                var el = "#card" + nbcard;
                $(el).css('background-image',"url(" +tabProduit[i+4]+")");

                if( i + 5 < tabProduit.length - 1){
                    i = i+4;
                } else {
                    break;
                }
            }
            $('.buy-icon').click(function () {
                $(".img2-container").css('background-image',"");
                $("#buy").toggleClass('open');
                $('#buy-comp').toggleClass("navcomp");
                var id = $(this).siblings(".id").val();
                getAchatInfo(id).then(function (value) {
                    var produit = value;
                    var tabProduit = produit.split('£');
                    $(".img2-container").css('background-image',"url(" +tabProduit[3]+")");
                    $(".produit").html(tabProduit[0]);
                    $(".disponibilite").html('en stock ('+tabProduit[1]+' disponible)');
                    currentPrice = tabProduit[2];
                    $(".prix-total").html(tabProduit[2]+'€');
                    $("#id_produit").val(id);
                    var j = parseInt(tabProduit[1], 10);
                    if (j - 5 < 0 ){
                        j -= 5;
                        var l = 5;
                        for(j; j <= -1;j++){
                            var el = '#select3 option[value=\''+l+'\']';
                            $(el).css("display","none");
                            l--;
                        }
                    } else {
                        $('#select3 option').css("display","block")
                    }
                });
            });
        }
    });

    $('.buy-icon').click(function () {
        $(".img2-container").css('background-image',"");
        $("#buy").toggleClass('open');
        $('#buy-comp').toggleClass("navcomp");
        var id = $(this).siblings(".id").val();
        getAchatInfo(id).then(function (value) {
            var produit = value;

            var tabProduit = produit.split('£');
            console.log(tabProduit);
            $(".img2-container").css('background-image',"url(" +tabProduit[3]+")");
            $(".produit").html(tabProduit[0]);
            $(".disponibilite").html('en stock ('+tabProduit[1]+' disponible)');
            currentPrice = tabProduit[2];
            $(".prix-total").html(tabProduit[2]+'€');
            $("#id_produit").val(id);
            var j = parseInt(tabProduit[1], 10);
            if (j - 5 < 0 ){
                j -= 5;
                var l = 5;
                for(j; j <= -1;j++){
                    var el = '#select3 option[value=\''+l+'\']';
                    $(el).css("display","none");
                    l--;
                }
            } else {
                $('#select3 option').css("display","block")
            }
        });
    });

    $("#revenir").click(function () {
        window.location = "../../index.php";
    });

    getMarque().then(function (value) {
        var marque = value;
        var tabMarque = marque.split('£');
        for (var i = 0; i < tabMarque.length - 1; i++){
            $('.filtre-container').append( '<div class="div-marque" id="marque'+i+'"><p>'+tabMarque[i]+'</p> <i class="material-icons open"> check </i></div>');
            containerSize += 1.9;
            if (containerSize > 30){
                $(".filtre-container").css('height', "30rem");
            } else {
                $(".filtre-container").css('height', containerSize + "rem");
            }
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


    $('#buy-comp').click(function () {
        $('#buy').toggleClass("open");
        $('#buy-comp').toggleClass("navcomp");
    });

    $('#clear-icon2').click(function () {
        $("#buy").toggleClass('open');
        $('#buy-comp').toggleClass("navcomp");
    });

    $("#moncompte").click(function () {
        window.location = "./php/view/connection.php";
        if(window.location.href.includes('routeur')){
            window.location = "../view/connection.php";
        }
    });

    if(window.location.href.includes('Recherche') || window.location.href.includes('recherche') ){
        $(".card").each(function () {
            var url = $(this).children(".card-form").children(".url").val();
            $(this).children(".card-form").children(".img-container").css('background-image',"url(" +url+")");
        })
    };

    $('#tools').click(function(){
        if (toolsopen){
            $('#tools1').css('display','none');
            toolsopen = false;
        } else {
            $('#tools1').css('display','block');
            toolsopen = true;
        }
    });

    $('#tools1').click(function(){
        $(".ajout-container").toggleClass('open');
        $(".cache-ajout").toggleClass('open');
    });

    $('.cache-ajout').click(function(){
        $(".ajout-container").toggleClass('open');
        $(".cache-ajout").toggleClass('open');
    });



});