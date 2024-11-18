<?php
include "../../database/database.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idAdherent = $_POST["idAdherent"];
    $idExemplaire = $_POST["idExemplaire"];
    if (isset($idAdherent, $idExemplaire)) {
        $set_retard = "INSERT INTO retards (numJour) VALUE (0)";
        $result_retard = mysqli_query($connect, $set_retard);
        $idRetard = mysqli_insert_id($connect);

        $send_emprunt = "INSERT INTO emprunts (dateCommande, idAdherent, idExemplaire, idRetard)
                        VALUES (NOW(), $idAdherent, $idExemplaire, $idRetard)";
        $result_emprunt = mysqli_query($connect, $send_emprunt);
        if ($result_emprunt) {
            echo json_encode(['success' => true, 'message' => "Votre demande de prêt de livre a été envoyée."]);
            exit();
        } else {
            echo json_encode(['success' => false, 'message' => "Erreur s'est produite lors de l'envoi de la demande de prêt."]);
            exit();
        }
    } else {
        echo json_encode(['success' => false, 'message' => "Il y a une valeur nulle dans l'un des identifiants."]);
        exit();
    }
}
