async function getMarque(){
    var retour;

    await $.ajax({
        url : 'php/controller/marque-ajax.php',
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
        url : 'php/controller/result-ajax.php',
        type : 'GET',
        data : 'result=' + result,
        dataType : 'text',
        success : function(text, statut){
            retour = text;
        },
    });
    return retour;
}