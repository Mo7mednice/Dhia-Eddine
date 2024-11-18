$(document).ready(function () {
    $("#icon-edit ").click(function () {
        var adresse = $("#adresse").val();
        var telephone = $("#telephone").val();
        var username = $("#username").val();
        var password = $("#password").val();
        Swal.fire({
            title: 'Ajouter un Livre',
            allowOutsideClick: false,
            html:
                '<label for="ad" class="swal2-label">Adresse:</label>' +
                '<input type="text" id="ad" value="' + adresse + '" class="swal2-input" placeholder="Enter nouvelle Adresse ">' +
                '<label for="tel" class="swal2-label">Téléphone:</label>' +
                '<input type="text" id="tel" value="' + telephone + '" class="swal2-input" placeholder="Enter nouvelle Téléphone">' +
                '<label for="nomUtilisateur" class="swal2-label">Nom de Utilisatuer:</label>' +
                '<input type="text" id="nomUtilisateur" value="' + username + '" class="swal2-input" placeholder="Enter nouvelle Nom de Utilisatuer">' +
                '<label for="motPasse" class="swal2-label">Mot de Passe:</label>' +
                '<input type="password" id="motPasse" value="' + password + '"class="swal2-input" placeholder="Enter nouvelle Mot de Passe">',
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonText: 'Ajouter',
            cancelButtonText: 'Annuler',
            confirmButtonColor: "#6aff3d",
            cancelButtonColor: "#d33",
            showLoaderOnConfirm: true,
            preConfirm: () => {
                var adresse = $('#ad').val();
                var telephone = $('#tel').val();
                var nomUtilisateur = $('#nomUtilisateur').val();
                var motPasse = $('#motPasse').val();

                if (adresse.trim() == '' || telephone.trim() == '' || nomUtilisateur.trim() == '' || motPasse.trim() == '') {
                    Swal.showValidationMessage('Il y a quelque chose de vide dans lequel tu n\'es pas entré');
                    return false;
                }

                return $.ajax({
                    url: '../../requests/adherent/editProfile.php',
                    type: 'POST',
                    dataType: "json",
                    data: {
                        adresse: adresse,
                        telephone: telephone,
                        nomUtilisateur: nomUtilisateur,
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
    $('.icon-show').click(function () {
        const passwordField = $('#password');
        const icon = $(this).find('ion-icon');

        if (passwordField.attr('type') === 'password') {
            passwordField.attr('type', 'text');
            icon.attr('name', 'eye-off-outline');
        } else {
            passwordField.attr('type', 'password');
            icon.attr('name', 'eye-outline');
        }
    });
    $('.icon-show').click(function () {
        const inputField = $(this).prev('input');
        inputField.css('pointer-events', isReadOnly ? 'auto' : 'none');
    });

});