$(document).ready(function () {
    $(".countdown").each(function () {
        const $this = $(this);
        const dateEmprunt = $(this).closest("td").data("dateemprunt");

        if (!dateEmprunt) {
            $this.text("+00 +00:00:00");
            return;
        }

        const initialDate = new Date(dateEmprunt).getTime();
        const countdownDuration = 15 * 24 * 60 * 60;
        const currentDate = new Date().getTime();
        const elapsedSeconds = Math.floor((currentDate - initialDate) / 1000);

        let timerValue;
        if (elapsedSeconds <= countdownDuration) {
            timerValue = countdownDuration - elapsedSeconds;
        } else {
            timerValue = elapsedSeconds - countdownDuration;
        }

        function updateTimer() {
            if (timerValue >= 0 && elapsedSeconds <= countdownDuration) {
                const days = Math.floor(timerValue / (24 * 60 * 60));
                const hours = Math.floor((timerValue % (24 * 60 * 60)) / (60 * 60));
                const minutes = Math.floor((timerValue % (60 * 60)) / 60);
                const seconds = timerValue % 60;

                $this.text(`-${days < 10 ? `0${days}` : days} -${hours < 10 ? `0${hours}` : hours}:${minutes < 10 ? `0${minutes}` : minutes}:${seconds < 10 ? `0${seconds}` : seconds}`);
                timerValue--;
            } else {
                const days = Math.floor(timerValue / (24 * 60 * 60));
                const hours = Math.floor((timerValue % (24 * 60 * 60)) / (60 * 60));
                const minutes = Math.floor((timerValue % (60 * 60)) / 60);
                const seconds = timerValue % 60;

                $this.text(`+${days < 10 ? `0${days}` : days} +${hours < 10 ? `0${hours}` : hours}:${minutes < 10 ? `0${minutes}` : minutes}:${seconds < 10 ? `0${seconds}` : seconds}`);
                timerValue++;
            }
        }
        setInterval(updateTimer, 1000);
    });
    $(".btn-retourner").click(function () {
        var idExemplaire = $(this).data("id");
        $.ajax({
            url: "../../requests/adherent/retournerExemplaire.php",
            type: "POST",
            dataType: "json",
            data: { idExemplaire: idExemplaire },
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
    });
    const tdClass = $('.row-rejete').parent();
    if (tdClass.length) {
        tdClass.hover(function () {
                $(this).find(".icon-remove").show();
            },
            function () {
                $(this).find(".icon-remove").hide();
            }
        )
    }
    $(".icon-remove").click(function () { 
        var idExemplaire = $(this).data("id");
        $.ajax({
            url: "../../requests/adherent/deleteEmprunt.php",
            type: "POST",
            dataType: "json",
            data: { idExemplaire: idExemplaire },
            success: function (response) {
                if (response.success) {
                    location.reload();
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
    });
});
