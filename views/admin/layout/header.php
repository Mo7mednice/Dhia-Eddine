<?php
session_start();
$id_admin = $_SESSION["admin_id"];
if(!isset($id_admin)){
    header("Location: ../login/Login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles/header.css">
    <link rel="stylesheet" href="../../frameworks/node_modules/sweetalert2/dist/sweetalert2.min.css">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/256/926/926321.png">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="../../frameworks/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../frameworks/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <title>Gestion des prêts de livres dans Bibliothèque</title>
    <script>
        $(document).ready(function () {
            $("#li-déconnecter").click(function () {
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
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "../../views/login/logout.php";
                    }
                });
            });
        });
    </script>
</head>

<body>
    <nav class="header">
        <a href="./home.php"><img src="../../images/logo.png" alt="Logo icon"></a>
        <ul>
            <li id="li-home">
                <a href="./home.php">Accueil</a>
            </li>
            <li id="li-adherents">
                <a href="./adherents.php">Adhérents</a>
            </li>
            <li id="li-livres">
                <a href="./livres.php">Livres</a>
            </li>
            <li id="li-emprunts">
                <a href="./emprunts.php">Emprunts</a>
            </li>
            <li id="profile-menu">
                <img src="../../images/profile.jpg" alt="profile icon">
                <ion-icon name="chevron-down-outline"></ion-icon>
                <ul id="profile-dropdown">
                    <li id="li-profile">
                        <a href="./profile.php">Profil</a>
                        <span class="icon"><ion-icon name="person-circle-outline"></ion-icon></span>
                    </li>
                    <li id="li-déconnecter">
                        <a href="#">Se déconnecter </a>
                        <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <main>