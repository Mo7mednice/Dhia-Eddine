$(document).ready(function () {
    $("#username").click(function () {
        $("#p1").slideDown(500);
        $("#p2").slideUp(500);
    });
    $("#password").click(function () {
        $("#p2").slideDown(500);
        $("#p1").slideUp(500);
    });
    $("button").click(function () {
        $("#p1").slideUp(500);
        $("#p2").slideUp(500);
    });

    $("#formLogin").submit(function (event) {
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: '../../requests/login/login.php',
            type: 'POST',
            dataType: 'json',
            data: formData,
            success: function (response) {
                if (response.admin) {
                    window.location.href = "../../views/admin/home.php";
                } else if (response.adherent) {
                    window.location.href = "../../views/adherent/home.php";
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.message,
                    }).then(() => {
                        $('#password').val('');
                    });
                }
            },
            error: function (error) {
                console.log(error)
            }
        });
    });
});