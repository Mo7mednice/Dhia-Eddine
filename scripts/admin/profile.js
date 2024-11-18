$(document).ready(function () {
    $("#icon-edit ").click(function () {
        var username = $("#username").val();
        var password = $("#password").val();
        Swal.fire({
            title: 'Ajouter un Livre',
            allowOutsideClick: false,
            html:
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
                var nomUtilisateur = $('#nomUtilisateur').val();
                var motPasse = $('#motPasse').val();

                if (nomUtilisateur.trim() == '' || motPasse.trim() == '') {
                    Swal.showValidationMessage('Il y a quelque chose de vide dans lequel tu n\'es pas entré');
                    return false;
                }

                return $.ajax({
                    url: '../../requests/admin/editProfile.php',
                    type: 'POST',
                    dataType: "json",
                    data: {
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