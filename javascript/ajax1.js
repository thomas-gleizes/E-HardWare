async function getMarque(){
    var retour;

    await $.ajax({
        url : '../controller/marque-ajax.php',
        type : 'GET',
        data : '',
        dataType : 'text',
        success : function(text, statut){
            retour = text;
        },
    });
    return retour;
}

async function getResult(result){
    var retour;

    await $.ajax({
        url : '../controller/result-ajax.php',
        type : 'GET',
        data : 'result=' + result,
        dataType : 'text',
        success : function(text, statut){
            retour = text;
        },
    });
    return retour;
}

async function getCardInfo(){
    var retour;

    await $.ajax({
        url : '../controller/card-ajax.php',
        type : 'GET',
        data : '',
        dataType : 'text',
        success : function(text, statut){
            retour = text;
        },
    });
    return retour;
}

async function getAchatInfo(id){
    var retour;

    await $.ajax({
        url : '../controller/add-ajax.php',
        type : 'GET',
        data : 'id=' + id,
        dataType : 'text',
        success : function(text, statut){
            retour = text;
        },
    });
    return retour;
}