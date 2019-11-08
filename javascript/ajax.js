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

    console.log(retour);
}