<?php
session_start();
include "../../database/database.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $sql1 = "SELECT * FROM admin WHERE nom_utilisateur = '$username' AND mot_passe = '$password'";
    $result1 = mysqli_query($connect, $sql1);
    if (mysqli_num_rows($result1) > 0) {
        $admin_data = mysqli_fetch_assoc($result1);
        if ($admin_data["nom_utilisateur"] == $username && $admin_data["mot_passe"] == $password) {
            $_SESSION["admin_id"] = $admin_data["id"];
            echo json_encode(["admin" => true]);
            exit();
        }
    }
    $sql2 = "SELECT * FROM adherents WHERE nomUtilisateur = '$username' AND motPasse = '$password'";
    $result2 = mysqli_query($connect, $sql2);
    if (mysqli_num_rows($result2) > 0) {
        $adherent_data = mysqli_fetch_assoc($result2);
        if ($adherent_data["nomUtilisateur"] == $username && $adherent_data["motPasse"] == $password) {
            $_SESSION["adhérent_id"] = $adherent_data["idAdherent"];
            echo json_encode(["adherent" => true]);
            exit();
        }

    }
    echo json_encode(["success" => false,"message" => "nom de utilisateur ou mot de passe incorrect."]);
    exit();
}
