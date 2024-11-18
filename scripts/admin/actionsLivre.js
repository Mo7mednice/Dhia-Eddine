$(document).ready(function () {
    $("#add").click(function () {
        Swal.fire({
            title: 'Ajouter un Livre',
            allowOutsideClick: false,
            html:
                '<label for="titre" class="swal2-label">Titre:</label>' +
                '<input type="text" id="titre" class="swal2-input" placeholder="Enter Titre du Livre">' +
                '<label for="annee" class="swal2-label">Année du Livre:</label>' +
                '<input type="number" min="1830" max="2030" id="annee" class="swal2-input" placeholder="Enter Année du Livre">' +
                '<label for="resume" class="swal2-label">Resumé du Livre:</label>' +
                '<textarea id="resume" class="swal2-textarea" placeholder="Enter Resumé du Livre"></textarea>' +
                '<label for="descreption" class="swal2-label">Descreption du Livre:</label>' +
                '<textarea id="descreption" class="swal2-textarea" placeholder="Enter descreption du Livre"></textarea>' +
                '<label for="nomAuteur" class="swal2-label">Nom de l\'Auteur:</label>' +
                '<input type="text" id="nomAuteur" class="swal2-input" placeholder="Enter nom de l\'Auteur du Livre">' +
                '<label for="prenomAuteur" class="swal2-label">Prénom de l\'Auteur:</label>' +
                '<input type="text" id="prenomAuteur" class="swal2-input" placeholder="Enter prénom de l\'Auteur du Livre">' +
                '<label for="dateNaissAuteur" class="swal2-label">Date de Naissance de l\'Auteur:</label>' +
                '<input type="date" id="dateNaissAuteur" class="swal2-input" placeholder="Enter Date de Naissance de l\'Auteur ">' +
                '<label for="paysAuteur" class="swal2-label">Pays de l\'Auteur:</label>' +
                '<input type="text" id="paysAuteur" class="swal2-input" placeholder="Enter Pays de l\'Auteur">'+
                '<label for="numexmp" class="swal2-label">Nombre De Exemplaire du Livre:</label>' +
                '<input type="number" min="1" max="20" id="numexmp" class="swal2-input" placeholder="Enter nombre de exemplaire\'Auteur">',
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonText: 'Ajouter',
            cancelButtonText: 'Annuler',
            confirmButtonColor: "#6aff3d",
            cancelButtonColor: "#d33",
            showLoaderOnConfirm: true,
            preConfirm: () => {
                var titre = $('#titre').val();
                var annee = $('#annee').val();
                var resume = $('#resume').val();
                var descreption = $('#descreption').val();
                var nomAuteur = $('#nomAuteur').val();
                var prenomAuteur = $('#prenomAuteur').val();
                var dateNaissAuteur = $('#dateNaissAuteur').val();
                var paysAuteur = $('#paysAuteur').val();
                var numexmp = $('#numexmp').val();
                if (titre.trim() == '' || annee.trim() == '' || resume.trim() == ''|| descreption.trim()=='' || nomAuteur.trim() == '' || prenomAuteur.trim() == '' || dateNaissAuteur.trim() == '' || paysAuteur.trim() == '' || numexmp.trim() =='') {
                    Swal.showValidationMessage('Il y a quelque chose de vide dans lequel tu n\'es pas entré');
                    return false;
                }

                return $.ajax({
                    url: '../../requests/admin/addLivre.php',
                    type: 'POST',
                    dataType: "json",
                    data: {
                        titre: titre,
                        annee: annee,
                        resume: resume,
                        nomAuteur: nomAuteur,
                        descreption: descreption,
                        prenomAuteur: prenomAuteur,
                        dateNaissAuteur: dateNaissAuteur,
                        paysAuteur: paysAuteur,
                        numexmp: numexmp
                    },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'Succès',
                                text: response.message,
                                icon: 'success',
                                confirmButtonColor: "green",
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
                                text: response.message,
                            });
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            },
        });
    });


    $(".update").click(function () {
        var idLivre = $(this).data('id1');
        var idAuteur = $(this).data('id2');
        var idPays = $(this).data('id3');
        Swal.fire({
            title: 'Modifier un Livre',
            allowOutsideClick: false,
            html:
                '<label for="titre" class="swal2-label">Titre:</label>' +
                '<input type="text" id="titre" class="swal2-input" placeholder="Enter Titre du Livre" value="' + $('td:eq(1)', $(this).closest('tr')).text().trim() + '">' +
                '<label for="annee" class="swal2-label">Année du Livre:</label>' +
                '<input type="number" min="1830" max="2030" id="annee" class="swal2-input" placeholder="Enter Année du Livre" value="' + $('td:eq(2)', $(this).closest('tr')).text().trim() + '">' +
                '<label for="resume" class="swal2-label">Resumé du Livre:</label>' +
                '<textarea id="resume" class="swal2-textarea" placeholder="Enter Resumé du Livre">' + $('td:eq(3)', $(this).closest('tr')).text().trim() + '</textarea>' +
                '<label for="nomAuteur" class="swal2-label">Nom de l\'Auteur:</label>' +
                '<input type="text" id="nomAuteur" class="swal2-input" placeholder="Enter nom de l\'Auteur du Livre" value="' + $('td:eq(4)', $(this).closest('tr')).text().trim() + '">' +
                '<label for="prenomAuteur" class="swal2-label">Prénom de l\'Auteur:</label>' +
                '<input type="text" id="prenomAuteur" class="swal2-input" placeholder="Enter prénom de l\'Auteur du Livre" value="' + $('td:eq(5)', $(this).closest('tr')).text().trim() + '">'+
                '<label for="paysAuteur" class="swal2-label">Pays de l\'Auteur:</label>' +
                '<input type="text" id="paysAuteur" class="swal2-input" placeholder="Enter pays de l\'Auteur du Livre" value="' + $('td:eq(6)', $(this).closest('tr')).text().trim() + '">',
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonText: 'Modifier',
            cancelButtonText: 'Annuler',
            confirmButtonColor: "#0095df",
            cancelButtonColor: "#d33",
            showLoaderOnConfirm: true,
            preConfirm: () => {
                var titre = $('#titre').val();
                var annee = $('#annee').val();
                var resume = $('#resume').val();
                var nomAuteur = $('#nomAuteur').val();
                var prenomAuteur = $('#prenomAuteur').val();
                var paysAuteur = $('#paysAuteur').val();
                if (titre.trim() == '' || annee.trim() == '' || resume.trim() == '' || nomAuteur.trim() == '' || prenomAuteur.trim() == '' || paysAuteur.trim() == '') {
                    Swal.showValidationMessage('Il y a quelque chose de vide dans lequel tu n\'es pas entré');
                    return false;
                }
                return $.ajax({
                    url: '../../requests/admin/editLivre.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        idLivre: idLivre,
                        idAuteur: idAuteur,
                        idPays: idPays,
                        titre: titre,
                        annee: annee,
                        resume: resume,
                        nomAuteur: nomAuteur,
                        prenomAuteur: prenomAuteur,
                        paysAuteur: paysAuteur,
                    },
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
            }
        });
    });

    $(".delete").click(function () {
        var id = $(this).data("id");
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
                return $.ajax({
                    url: '../../requests/admin/deleteLivre.php',
                    type: 'POST',
                    dataType: "json",
                    data: { id: id },
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
                                icon: 'error',
                                title: 'Oops...',
                                text: response.message
                            });
                        }
                    },
                    error: function (error) {
                        console.log(error.responseText);
                    }
                });
            },
        })
    });

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
                        $('table tbody').empty();
                        response.data.forEach(function (livre) {
                            $('table tbody').append(`
                                <tr>
                                    <td>${livre.idLivre}</td>
                                    <td>${livre.titre}</td>
                                    <td>${livre.annee}</td>
                                    <td>${livre.resume}</td>
                                    <td>${livre.nom}</td>
                                    <td>${livre.prenom}</td>
                                    <td>${livre.pays}</td>
                                    <td>${livre.numexem}</td>
                                    <td>
                                        <button type="button" title="Modifier" class="update" data-id1='${livre.idLivre} data-id2='${livre.idAuteur}'>
                                            <ion-icon name="create-outline"></ion-icon>
                                        </button>
                                        <button type="button" title="Supprimer" class="delete" data-id='${livre.idLivre}'>
                                            <ion-icon name="trash-outline"></ion-icon>
                                        </button>
                                    </td>
                                </tr>
                                <script src="../../scripts/admin/actionsLivre.js"></script>
                            `);
                        });
                    } else {
                        $('table tbody').html(`<tr><td colspan="9" class="message-text">${response.message}</td></tr>`);
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
});
