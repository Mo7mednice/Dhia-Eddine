<?php
include "../../database/database.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    if (isset($id)) {
        $adresse = $_POST['adresse'];
        $telephone = $_POST['telephone'];
        $nomUtilisateur = $_POST['nomUtilisateur'];
        $motPasse = $_POST['motPasse'];
        $edit_adherent =
            "UPDATE adherents SET 
            adresse = '$adresse', telephone = '$telephone', nomUtilisateur = '$nomUtilisateur', motPasse = '$motPasse'
            WHERE idAdherent = $id";

        $result = mysqli_query($connect, $edit_adherent);

        if ($result) {
            echo json_encode(['success' => true, 'message' => "Adhérent modifié avec succès"]);
            exit();
        } else {
            echo json_encode(['success' => false, 'message' => "Adhérent non modifié."]);
            exit();
        }
    } else {
        echo json_encode(['success' => false, 'message' => "id est vide."]);
        exit();
    }
}
