<?php
include "../../database/database.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idExemplaire = $_POST["idExemplaire"];
    if (isset($idExemplaire)) {
        $delete_emprunt = "DELETE FROM emprunts WHERE idExemplaire = $idExemplaire";
        $result = mysqli_query($connect, $delete_emprunt);
        if ($result) {
            echo json_encode(['success' => true]);
            exit();
        } else {
            echo json_encode(['success' => false]);
            exit();
        }
    } else {
        echo json_encode(['success' => false, 'message' => "Il y a une valeur nulle dans l'un des identifiants."]);
        exit();
    }
}