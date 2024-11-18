$(document).ready(function () {
    $("#btn-emprunt").click(function () {
        var idAdherent = $(this).data("id1");
        var idExemplaire = $(this).data("id2");
        $.ajax({
            url: "../../requests/adherent/sendEmprunt.php",
            type: "POST",
            dataType: "json",
            data: { idAdherent: idAdherent, idExemplaire: idExemplaire },
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Succès',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: "Retour à la page d'Accueil",
                        confirmButtonColor: 'green',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "../../views/adherent/home.php";
                        }
                    });
                } else {
                    alert(response.message);
                }
            },
            error: function (error) {
                console.log(error);
            }
        });
    });
});