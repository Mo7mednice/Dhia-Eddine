$(document).ready(function () {
    $("#add").click(function () {
        Swal.fire({
            title: 'Ajouter un Adhérent',
            allowOutsideClick: false,
            html:
                '<label for="nom" class="swal2-label">Nom:</label>' +
                '<input type="text" id="nom" class="swal2-input" placeholder="Enter Nom de Adhérent">' +
                '<label for="prenom" class="swal2-label">Prénom:</label>' +
                '<input type="text" id="prenom" class="swal2-input" placeholder="Enter Prénom de Adhérent">' +
                '<label for="dateNaissance" class="swal2-label">Date de Naissance:</label>' +
                '<input type="date" id="dateNaissance" class="swal2-input" placeholder="Enter Date de Naissance de Adhérent">' +
                '<label for="adresse" class="swal2-label">Adresse:</label>' +
                '<input type="text" id="adresse" class="swal2-input" placeholder="Enter Adresse de Adhérent">' +
                '<label for="telephone" class="swal2-label">Téléphone:</label>' +
                '<input type="text" id="telephone" class="swal2-input" placeholder="Enter Téléphone de Adhérent">' +
                '<label for="nomUtilisateur" class="swal2-label">Nom d\'Utilisateur:</label>' +
                '<input type="text" id="nomUtilisateur" class="swal2-input" placeholder="Enter Nom d\'Utilisateur de Adhérent">' +
                '<label for="motPasse" class="swal2-label">Mot de Passe:</label>' +
                '<input type="password" id="motPasse" class="swal2-input" placeholder="Enter Mot de Passe">' +
                '<label for="confirmerMotDePasse" class="swal2-label">Confirmer Mot de Passe:</label>' +
                '<input type="password" id="confirmerMotDePasse" class="swal2-input" placeholder="Confirmer Mot de Passe">',
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonText: 'Ajouter',
            cancelButtonText: 'Annuler',
            confirmButtonColor: "#6aff3d",
            cancelButtonColor: "#d33",
            showLoaderOnConfirm: true,
            preConfirm: () => {
                var nom = $('#nom').val();
                var prenom = $('#prenom').val();
                var dateNaissance = $('#dateNaissance').val();
                var adresse = $('#adresse').val();
                var telephone = $('#telephone').val();
                var nomUtilisateur = $('#nomUtilisateur').val();
                var motPasse = $('#motPasse').val();
                var confirmerMotDePasse = $('#confirmerMotDePasse').val();

                if (nom.trim() == '' || prenom.trim() == '' || dateNaissance.trim() == '' || adresse.trim() == '' || telephone.trim() == '' || nomUtilisateur.trim() == '' || motPasse.trim() == '' || confirmerMotDePasse.trim() == '') {
                    Swal.showValidationMessage('Il y a quelque chose de vide dans lequel tu n\'es pas entré');
                    return false;
                }
                if (motPasse.trim() !== confirmerMotDePasse.trim()) {
                    Swal.showValidationMessage('Le mot de passe de confirmation ne correspond pas au mot de passe saisi');
                    return false;
                }
                return $.ajax({
                    url: '../../requests/admin/addAdherent.php',
                    type: 'POST',
                    dataType: "json",
                    data: {
                        nom: nom, prenom: prenom,
                        dateNaissance: dateNaissance, adresse: adresse,
                        telephone: telephone, nomUtilisateur: nomUtilisateur,
                        motPasse: motPasse,
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
        var id = $(this).data('id');
        Swal.fire({
            title: 'Modifier un Adhérent',
            allowOutsideClick: false,
            html:
                '<label for="adresse" class="swal2-label">Adresse:</label>' +
                '<input type="text" id="adresse" class="swal2-input" placeholder="Enter Adresse de Adhérent" value="' + $('td:eq(4)', $(this).closest('tr')).text().trim() + '">' +
                '<label for="telephone" class="swal2-label">Téléphone:</label>' +
                '<input type="text" id="telephone" class="swal2-input" placeholder="Enter Téléphone de Adhérent" value="' + $('td:eq(5)', $(this).closest('tr')).text().trim() + '">' +
                '<label for="nomUtilisateur" class="swal2-label">Nom d\'Utilisateur:</label>' +
                '<input type="text" id="nomUtilisateur" class="swal2-input" placeholder="Enter Nom d\'Utilisateur de Adhérent" value="' + $('td:eq(6)', $(this).closest('tr')).text().trim() + '">' +
                '<label for="motPasse" class="swal2-label">Mot de Passe:</label>' +
                '<input type="password" id="motPasse" class="swal2-input" placeholder="Enter Mot de Passe" value="' + $('td:eq(7)', $(this).closest('tr')).text().trim() + '">',
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonText: 'Modifier',
            cancelButtonText: 'Annuler',
            confirmButtonColor: "#0095df",
            cancelButtonColor: "#d33",
            showLoaderOnConfirm: true,
            preConfirm: () => {
                var adresse = $('#adresse').val();
                var telephone = $('#telephone').val();
                var nomUtilisateur = $('#nomUtilisateur').val();
                var motPasse = $('#motPasse').val();

                if (adresse.trim() === '' || telephone.trim() === '' || nomUtilisateur.trim() === '' || motPasse.trim() === '') {
                    Swal.showValidationMessage('Il y a quelque chose de vide dans lequel tu n\'es pas entré');
                    return false;
                }

                return $.ajax({
                    url: '../../requests/admin/editAdherent.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: id,
                        adresse: adresse,
                        telephone: telephone,
                        nomUtilisateur: nomUtilisateur,
                        motPasse: motPasse
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
                    url: '../../requests/admin/deleteAdherent.php',
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
            $("message-empty").hide();
            $.ajax({
                url: '../../requests/admin/searchAdherent.php',
                type: 'POST',
                dataType: 'json',
                data: { searchName: searchName },
                success: function (response) {
                    if (response.success && response.data.length > 0) {
                        $('table tbody').empty();
                        response.data.forEach(function (adherent) {
                            $('table tbody').append(`
                                <tr>
                                    <td>${adherent.idAdherent}</td>
                                    <td>${adherent.nom}</td>
                                    <td>${adherent.prenom}</td>
                                    <td>${adherent.dateNaissance}</td>
                                    <td>${adherent.adresse}</td>
                                    <td>${adherent.telephone}</td>
                                    <td>${adherent.nomUtilisateur}</td>
                                    <td>${adherent.motPasse}</td>
                                    <td>
                                        <button type="button" title="Modifier" class="update" data-id='${adherent.idAdherent}'>
                                            <ion-icon name = "create-outline"></ion-icon>
                                        </button>
                                        <button type="button" title="Supprimer" class="delete" data-id='${adherent.idAdherent}'>
                                            <ion-icon name ="trash-outline"></ion-icon>
                                        </button>
                                    </td>
                                </tr>
                                <script src="../../scripts/admin/actionsAdherent.js"></script>
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
                    $("message-text").hide();
                    return $.ajax({
                        url: '../../requests/admin/deletesearchAdherent.php',
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
