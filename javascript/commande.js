$(document).ready(()=>{
    $(".edit").click(function () {
        window.location = "../view/account.php";
    });

    $(".url").each(function () {
        $(this).parent(".image-container").css("background-image","url("+$(this).val()+")");
    });
});