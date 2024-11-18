<?php
include "../../database/database.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    if (isset($id)) {
        $delete_adherent = "DELETE FROM adherents WHERE idAdherent = $id";

        $result = mysqli_query($connect, $delete_adherent);

        if ($result) {
            echo json_encode(['success' => true, 'message' => "Adhérent supprimé avec succès"]);
            exit();
        } else {
            echo json_encode(['success' => false, 'message' => "Adhérent non supprimé."]);
            exit();
        }
    } else {
        echo json_encode(['success' => false, 'message' => "id est vide."]);
        exit();
    }
}
