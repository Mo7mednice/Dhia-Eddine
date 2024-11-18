<?php
include "../../database/database.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST["id"];
    if (isset($id)) {
        $rejeter = "UPDATE emprunts SET etatEmprunt = 'Rejeté' WHERE idEmprunt = $id ";
        $result = mysqli_query($connect, $rejeter);
        if ($result) {
            echo json_encode(['success' => true, 'message' => "Votre demande de emprunt a été rejeté."]);
            exit();
        } else {
            echo json_encode(['success' => false, 'message' => "La demande de emprunt a été modifiée."]);
            exit();
        }
    }

}
