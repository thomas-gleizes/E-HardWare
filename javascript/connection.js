$(document).ready(() => {
    $("#new").click(function () {
        window.location = "./creation.php";
    });

    $("#connect").click(function () {
        window.location = "./connection.php";
    });

    $('#mdp2').bind('input', function() {
        if ($(this).val() != $("#mdp1").val() && $(this).val() != ''){
            $("#ok").css('display','none');
            $("#error").css('display','block');
        } else {
            $("#ok").css('display','block');
            $("#error").css('display','none');
        }
    });
});