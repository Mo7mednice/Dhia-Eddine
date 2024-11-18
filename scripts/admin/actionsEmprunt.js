$(document).ready(function () {
    $(".accepter").click(function () {
        var idEmprunt = $(this).data("id1");
        var idAdherent = $(this).data("id2");
        var idExemplaire = $(this).data("id3");
        $.ajax({
            url: '../../requests/admin/accepterEmprunt.php',
            type: 'POST',
            dataType: 'json',
            data: { idEmprunt: idEmprunt, idAdherent: idAdherent, idExemplaire: idExemplaire },
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: "success",
                        title: 'Succès',
                        text: response.message,
                        confirmButtonColor: 'green',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'info',
                        title: 'Remarque importante',
                        text: response.message,
                        confirmButtonColor: "#0095df",
                    });
                }
            },
            error: function (error) {
                console.log(error);
            }

        });
    });
    $(".rejeter").click(function () {
        var id = $(this).data("id");
        $.ajax({
            url: '../../requests/admin/rejeterEmprunt.php',
            type: 'POST',
            dataType: 'json',
            data: { id: id },
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: "success",
                        title: 'Succès',
                        text: response.message,
                        confirmButtonColor: 'green',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.message
                    });
                }
            },
            error: function (error) {
                console.log(error);
            }

        });
    });
    $(".retour").click(function () {
        var idAdherent = $(this).data("id1");
        var idExemplaire = $(this).data("id2");
        $.ajax({
            url: '../../requests/admin/retourEmprunt.php',
            type: 'POST',
            dataType: 'json',
            data: { idAdherent: idAdherent, idExemplaire: idExemplaire },
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: "success",
                        title: 'Succès',
                        text: response.message,
                        confirmButtonColor: 'green',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.message
                    });
                }
            },
            error: function (error) {
                console.log(error);
            }

        });
    });
})