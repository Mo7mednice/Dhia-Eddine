<?php
include "../../database/database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $searchName = $_POST['searchName'];

    if (isset($searchName) && !empty($searchName)) {
        $searchName = mysqli_real_escape_string($connect, $searchName);
        $check_adherent = "SELECT * FROM adherents WHERE nom = '$searchName'";
        $check_result = mysqli_query($connect, $check_adherent);

        if (mysqli_num_rows($check_result) > 0) {
            $delete_adherent = "DELETE FROM adherents WHERE nom = '$searchName'";
            $delete_result = mysqli_query($connect, $delete_adherent);

            if ($delete_result && mysqli_affected_rows($connect) > 0) {
                echo json_encode(['success' => true, 'message' => "Adhérent supprimé avec succès"]);
                exit();
            } else {
                echo json_encode(['success' => false, 'message' => "Erreur lors de la suppression de l'adhérent."]);
                exit();
            }
        } else {
            echo json_encode(['success' => false, 'message' => "Tapez le nom complet de l'adhérent à supprimer."]);
            exit();
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Paramètre de recherche manquant.']);
        exit();
    }
}