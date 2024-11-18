<?php
include "../../database/database.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    if (isset($id)) {
        $delete_livre = "DELETE FROM livres WHERE idLivre = $id";
        $result = mysqli_query($connect, $delete_livre);
        if ($result) {
            echo json_encode(['success' => true, 'message' => "Livre supprimé avec succès"]);
            exit();
        } else {
            echo json_encode(['success' => false, 'message' => "Livre non supprimé."]);
            exit();
        }
    } else {
        echo json_encode(['success' => false, 'message' => "id est vide."]);
        exit();
    }
}
