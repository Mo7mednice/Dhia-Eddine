<?php
include "../../database/database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $searchName = $_POST['searchName'];

    if (isset($searchName) && !empty($searchName)) {
        $check_livre = "SELECT * FROM livres WHERE titre = '$searchName'";
        $check_result = mysqli_query($connect, $check_livre);
        if (mysqli_num_rows($check_result) > 0) {
            $row = mysqli_fetch_assoc($check_result);
            $delete_exemplaires = "DELETE FROM exemplaires WHERE idLivre = (SELECT idLivre FROM livres WHERE titre = '$searchName')";
            $delete_exemplaires_result = mysqli_query($connect, $delete_exemplaires);

            $delete_livre = "DELETE FROM livres WHERE titre = '$searchName'";
            $delete_livre_result = mysqli_query($connect, $delete_livre);

            $delete_auture = "DELETE FROM auteurs WHERE idAuteur = (SELECT idAuteur FROM livres WHERE titre = '$searchName')";
            $delete_auture_result = mysqli_query($connect, $delete_auture);

            $delete_pays = "DELETE FROM pays WHERE idPays = (SELECT auteurs.idPays FROM auteurs JOIN livres ON livres.idAuteur = auteurs.idAuteur WHERE livres.titre = '$searchName')";
            $delete_pays_result = mysqli_query($connect, $delete_pays);

            if ($delete_exemplaires_result && $delete_livre_result && $delete_auture_result && $delete_pays_result) {
                echo json_encode(['success' => true, 'message' => "Le livre intitulé <<" . $row['titre'] . ">> a été supprimé avec succès."]);
                exit();
            } else {
                echo json_encode(['success' => false, 'message' => "Erreur lors de la suppression de livre."]);
                exit();
            }
        } else {
            echo json_encode(['success' => false, 'message' => "Tapez le nom complet de livre à supprimer."]);
            exit();
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Paramètre de recherche manquant.']);
        exit();
    }
}