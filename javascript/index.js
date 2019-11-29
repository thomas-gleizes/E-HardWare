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
                var tabProduit = produit.split(',');
                for (var i = 0; i < tabProduit.length - 1; i++){
                    $('.result').append( '<form  method="get" action="PHP/view/Participant/preLobby.php"><button type="submit" class="result-bar"><p>' + tabProduit[i] + '</p></button><input type="hidden" name="id_produit" value="' + tabProduit[i+1] + '"> </form>');
                    resultSize += 2;
                    $(".result").css('display', "block");
                    $(".result").css('height', resultSize + "rem");
                    $('.result').width($('#reseach').width());
                    $('.result').offset($('#reseach').offset());
                    $('.result').css("top", 31.5 + $('.result').offset().top) + "px";
                    if( i + 1 < tabProduit.length - 1){
                        i++;
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
        console.log(val);
        if (val == "Processeur"){
            $(".ajout-container").append('<form method="post" action="../controller/routeur.php">' +
                '<h3> Processeur <h3>' +
                '<input type="hidden" class="ajout-input" name="action" value="ajoutProduit" required>' +
                '<input type="hidden" class="ajout-input" name="categorie" value="Processeur" required>' +
                '<input type="text" class="ajout-input" placeholder="Nom du produit" name="nom" required>' +
                '<input type="text" class="ajout-input" placeholder="Marque du produit" name="nomMarque" required>' +
                '<input type="number" min="0" step="any" class="ajout-input" placeholder="Prix du produit" name="prix" required>' +
                '<input type="number" min="0" class="ajout-input" placeholder="Quantité de stock" name="stock" required>' +
                '<input type="url" class="ajout-input" placeholder="Url de l\'image du produit" name="Url" required>' +
                '<input type="number" min="0" class="ajout-input" placeholder="Nombre de coeur" name="nbCoeur" required>' +
                '<input type="number" min="0" class="ajout-input" placeholder="Nombre de threads" name="nbThreads" required>' +
                '<input type="text" class="ajout-input" placeholder="Socket" name="socket" required>' +
                '<input type="number" min="0" step="any" class="ajout-input" placeholder="Frequence CPU" name="frequence" required>' +
                '<input type="number" min="0" step="any" class="ajout-input" placeholder="Boost CPU" name="boost" required>' +
                '<input type="number" min="0" class="ajout-input" placeholder="Cache" name="cache" required>' +
                '<button id="ok" type="submit"><p>Ajout</p></button> </form>')
        } else if (val == "CarteMere"){
            $(".ajout-container").append('<form method="post" action="../controller/routeur.php">' +
                '<h3> Carte Mère <h3>' +
                '<input type="hidden" class="ajout-input" name="action" value="ajoutProduit" required>' +
                '<input type="hidden" class="ajout-input" name="categorie" value="CarteMere" required>' +
                '<input type="text" class="ajout-input" placeholder="Nom du produit" name="nom" required>' +
                '<input type="text" class="ajout-input" placeholder="Marque du produit" name="nomMarque" required>' +
                '<input type="number" min="0" step="any" class="ajout-input" placeholder="Prix du produit" name="prix" required>' +
                '<input type="number" min="0" class="ajout-input" placeholder="Quantité de stock" name="stock" required>' +
                '<input type="url" class="ajout-input" placeholder="Url de l\'image du produit" name="Url" required>' +
                '<input type="text" class="ajout-input" placeholder="Chipset" name="chipset" required>' +
                '<input type="text" class="ajout-input" placeholder="Socket" name="socket" required>' +
                '<input type="text" class="ajout-input" placeholder="Format" name="format" required>' +
                '<button id="ok" type="submit"><p>Ajout</p></button> </form>')
        } else if (val == "Memoire"){
            $(".ajout-container").append('<form method="post" action="../controller/routeur.php">' +
                '<input type="hidden" class="ajout-input" name="action" value="ajoutProduit" required>' +
                '<input type="hidden" class="ajout-input" name="categorie" value="Memoire" required>' +
                '<input type="text" class="ajout-input" placeholder="Nom du produit" name="nom" required>' +
                '<input type="text" class="ajout-input" placeholder="Marque du produit" name="nomMarque" required>' +
                '<input type="number" min="0" step="any"" class="ajout-input" placeholder="Prix du produit" name="prix" required>' +
                '<input type="number" min="0" class="ajout-input" placeholder="Quantité de stock" name="stock" required>' +
                '<input type="url" class="ajout-input" placeholder="Url de l\'image du produit" name="Url" required>' +
                '<input type="text" class="ajout-input" placeholder="Type de RAM" name="typ" required>' +
                '<input type="number" min="0" class="ajout-input" placeholder="Capacite RAM" name="capacite" required>' +
                '<input type="number" min="0" class="ajout-input" placeholder="Frequence RAM" name="frequence" required>' +
                '<input type="number" min="0" class="ajout-input" placeholder="CAS" name="CAS" required>' +
                '<input type="number" min="0" max = "8" class="ajout-input" placeholder="Nombre de barrrette" name="nbBarrette" required>  ' +
                '<button id="ok" type="submit"><p>Ajout</p></button> </form>')
        } else if (val == "CarteGraphique"){
            $(".ajout-container").append('<form method="post" action="../controller/routeur.php">' +
                '<h3> Carte Graphique <h3>' +
                '<input type="hidden" class="ajout-input" name="action" value="ajoutProduit" required>' +
                '<input type="hidden" class="ajout-input" name="categorie" value="CarteGraphique" required>' +
                '<input type="text" class="ajout-input" placeholder="Nom du produit" name="nom" required>' +
                '<input type="text" class="ajout-input" placeholder="Marque du produit" name="nomMarque" required>' +
                '<input type="number" min="0" step="any" class="ajout-input" placeholder="Prix du produit" name="prix" required>' +
                '<input type="number" min="0" class="ajout-input" placeholder="Quantité de stock" name="stock" required>' +
                '<input type="url" class="ajout-input" placeholder="Url de l\'image du produit" name="Url" required>' +
                '<input type="text" class="ajout-input" placeholder="Chipset Graphique" name="chipset" required>' +
                '<input type="number" min="0" class="ajout-input" placeholder="Mémoire vidéo" name="memoire" required>' +
                '<input type="text" class="ajout-input" placeholder="Architecture" name="architecture" required>' +
                '<input type="text" class="ajout-input" placeholder="Bus" name="bus" required>' +
                '<button id="ok" type="submit"><p>Ajout</p></button> </form>')
        } else if (val == "DisqueDur"){
            $(".ajout-container").append('<form method="post" action="../controller/routeur.php">' +
                '<h3> Disque Dur <h3>' +
                '<input type="hidden" class="ajout-input" name="action" value="ajoutProduit" required>' +
                '<input type="hidden" class="ajout-input" name="categorie" value="DisqueDur" required>' +
                '<input type="text" class="ajout-input" placeholder="Nom du produit" name="nom" required>' +
                '<input type="text" class="ajout-input" placeholder="Marque du produit" name="nomMarque" required>' +
                '<input type="number" min="0" step="any" class="ajout-input" placeholder="Prix du produit" name="prix" required>' +
                '<input type="number" min="0" class="ajout-input" placeholder="Quantité de stock" name="stock" required>' +
                '<input type="url" class="ajout-input" placeholder="Url de l\'image du produit" name="Url" required>' +
                '<input type="number" min="0" class="ajout-input" placeholder="Capacite HDD" name="capacite" required>' +
                '<input type="text" class="ajout-input" placeholder="Interface" name="interface" required>' +
                '<input type="number" min="0" class="ajout-input" placeholder="Vitesse de rotation" name="vitesseRotation" required>' +
                '<button id="ok" type="submit"><p>Ajout</p></button> </form>')
        } else if (val == "SSD"){
            $(".ajout-container").append('<form method="post" action="../controller/routeur.php">' +
                '<h3> Solide State Drive <h3>' +
                '<input type="hidden" class="ajout-input" name="action" value="ajoutProduit" required>' +
                '<input type="hidden" class="ajout-input" name="categorie" value="SSD" required>' +
                '<input type="text" class="ajout-input" placeholder="Nom du produit" name="nom" required>' +
                '<input type="text" class="ajout-input" placeholder="Marque du produit" name="nomMarque" required>' +
                '<input type="number" min="0" step="any" class="ajout-input" placeholder="Prix du produit" name="prix" required>' +
                '<input type="number" min="0" class="ajout-input" placeholder="Quantité de stock" name="stock" required>' +
                '<input type="url" class="ajout-input" placeholder="Url de l\'image du produit" name="Url" required>' +
                '<input type="text" class="ajout-input" placeholder="Format SSD" name="format" required>' +
                '<input type="number" min="0" class="ajout-input" placeholder="Capacite SSD" name="capacite" required>' +
                '<input type="text" class="ajout-input" placeholder="Interface SSD" name="interface" required>' +
                '<input type="number" min="0" class="ajout-input" placeholder="Vitesse de lecture" name="lecture" required>' +
                '<input type="number" min="0" step="any" class="ajout-input" placeholder="Vitesse d\'écriture" name="ecriture" required>' +
                '<button id="ok" type="submit"><p>Ajout</p></button> </form>')
        } else if (val == "Alimentation"){
            $(".ajout-container").append('<form method="post" action="../controller/routeur.php">' +
                '<h3> Alimentation <h3>' +
                '<input type="hidden" class="ajout-input" name="action" value="ajoutProduit" required>' +
                '<input type="hidden" class="ajout-input" name="categorie" value="Alimentation" required>' +
                '<input type="text" class="ajout-input" placeholder="Nom du produit" name="nom" required>' +
                '<input type="text" class="ajout-input" placeholder="Marque du produit" name="nomMarque" required>' +
                '<input type="number" min="0" step="any" class="ajout-input" placeholder="Prix du produit" name="prix" required>' +
                '<input type="number" min="0" class="ajout-input" placeholder="Quantité de stock" name="stock" required>' +
                '<input type="url" class="ajout-input" placeholder="Url de l\'image du produit" name="Url" required>' +
                '<input type="number" min="0" step="any" class="ajout-input" placeholder="Puissance" name="puissance" required>' +
                '<input type="text" class="ajout-input" placeholder="Modularité" name="modularite" required>' +
                '<button id="ok" type="submit"><p>Ajout</p></button> </form>')
        }
    });

    $('#select3').change(function() {
        var val = $("#select3 option:selected").text();
        $(".prix-total").html(currentPrice*val + "€");
    });

    getCardInfo().then(function (value) {
        if(!window.location.href.includes('routeur')){
            var produit = value;
            console.log(produit);
            var tabProduit = produit.split('£');
            for (var i = 0; i < tabProduit.length - 1; i++){
                nbcard++;
                $('.container').append( '<div class="card"> <form  class="card-form"  method="get" action="PHP/view/Participant/preLobby.php"> <button id="card'+nbcard+'" type="submit" class="img-container">' +
                    ' <input type="hidden" name="id_produit" value="' + tabProduit[i] + '"></button></form> <div class="description-container"><p class="marque">' + tabProduit[i+2] + '<p/>' +
                    '<p class="description">' + tabProduit[i+1] + '<p/>' +
                    ' <p class="prix">' + tabProduit[i+3] + ' €<p/><div class="rond"><p><input class="id" type="hidden" name="id_produit" value="' + tabProduit[i] + '"><i class="add-icon material-icons buy-icon">add_shopping_cart</i></p></div></div></div>');
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
                console.log(id);
                getAchatInfo(id).then(function (value) {
                    var produit = value;
                    console.log(produit);
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

            var tabProduit = produit.split('-');
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

    getMarque().then(function (value) {
        var marque = value;
        var tabMarque = marque.split(' ');
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
        if(window.location.href.includes('Recherche')){
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