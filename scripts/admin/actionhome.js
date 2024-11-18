$(document).ready(function () {
    let isHighlighted = false;
    const intervalId = setInterval(function () {
        if (isHighlighted) {
            $('#show-hide').css('background-color', '');
            $('#show-hide').css('color', '#ff9d00');
        } else {
            $('#show-hide').css('background-color', '#ff9d00');
            $('#show-hide').css('color', 'white');
        }
        isHighlighted = !isHighlighted;
    }, 1000);
    $("#show-hide").click(function () {
        if ($(this).text() == "Afficher la Liste des Retards") {
            $(this).text("Masquer la Liste des Retards");
            $(".table-container").slideDown(300);
            clearInterval(intervalId);
            $('#show-hide').css('background-color', '');
            $('#show-hide').css('color', '#ff9d00');
        } else {
            $(this).text("Afficher la Liste des Retards");
            clearInterval(intervalId);
            $(".table-container").slideUp(300);
        }

    });

});