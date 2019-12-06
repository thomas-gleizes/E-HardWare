async function getMarque(){
    var retour;

    await $.ajax({
        url : 'php/controller/routeur.php',
        type : 'GET',
        data : 'action=ajax&control=marque',
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
        url : 'php/controller/routeur.php',
        type : 'GET',
        data : 'action=ajax&control=result&result=' + result,
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
        url : 'php/controller/routeur.php',
        type : 'GET',
        data : 'action=ajax&control=card',
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
        url : 'php/controller/routeur.php',
        type : 'GET',
        data : 'action=ajax&control=add&id=' + id,
        dataType : 'text',
        success : function(text, statut){
            retour = text;
        },
    });
    return retour;
}