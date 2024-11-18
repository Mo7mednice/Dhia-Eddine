$("#search-click").click(function () {
    var searchName = $("#search-input").val().trim();
    if (searchName.trim() !== '') {
        $("#message-empty").hide();
        $.ajax({
            url: '../../requests/admin/searchLivre.php',
            type: 'POST',
            dataType: 'json',
            data: { searchName: searchName },
            success: function (response) {
                if (response.success && response.data.length > 0) {
                    $('.content').empty();
                    response.data.forEach(function (livre) {
                        $('.content').append(`
                        <div class="card" style="width: 18rem;">
                            <img src="../../images/book.png" class="card-img-top" alt="Couverture du livre">
                                <h3 class="card-title">${livre.titre}</h3>
                                <p class="card-text">${livre.resume}</p>
                                <p><font>Auteur du Livre: </font> ${livre.nom} ${livre.prenom}</p>
                                <p><font>Nombre des Exemplaires:</font> ${livre.numexem}</p>
                                <a href="confirmeEmprunt.php?idLivre=${livre.idLivre}">
                                <button type="submit" class="btn btn-success">Emprunter livre</button>
                                </a>
                            
                        </div>
                        `);
                    });
                } else {
                    $('.content').html(` <p class="message-text">${response.message}</p>`);
                }
            },
            error: function (error) {
                console.log(error);
            }
        });
    } else {
        $("#message-empty").show();
        $("#search-input").val("");
    }
});

$("#search-delete").click(function () {
    var searchName = $("#search-input").val().trim();
    Swal.fire({
        title: "Avertissement",
        text: "Etes-vous sûr de vouloir supprimer ce compte ? ",
        icon: "warning",
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: "Oui, supprimer!",
        cancelButtonText: "Non, annuler!",
        confirmButtonColor: "red",
        cancelButtonColor: "green",
        showLoaderOnConfirm: true,
        preConfirm: () => {
            if (searchName.trim() !== '') {
                $("#message-text").hide();
                return $.ajax({
                    url: '../../requests/admin/deletesearchLivre.php',
                    type: 'POST',
                    dataType: "json",
                    data: { searchName: searchName },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'Succès',
                                text: response.message,
                                icon: 'success',
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
                                title: 'Information',
                                text: response.message
                            });
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            } else {
                $("#message-empty").show();
                $("#search-input").val("");
            }

        },
    });
});