<?php
include "../../database/database.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idExemplaire = $_POST["idExemplaire"];
    if (isset($idExemplaire)) {
        $set_retour = "UPDATE emprunts SET etatEmprunt = 'Retour', dateRetour = NOW() WHERE idExemplaire = $idExemplaire";
        $result = mysqli_query($connect, $set_retour);
        if ($result) {
            echo json_encode(['success' => true, 'message' => " L'Exemplaire du Livre a été Renvoyée avec succès."]);
            exit();
        } else {
            echo json_encode(['success' => false, 'message' => "Une erreur s'est produite lors du retour de l'Exemplaire du Livre."]);
            exit();
        }
    } else {
        echo json_encode(['success' => false, 'message' => "Il y a une valeur nulle dans l'un des identifiants."]);
        exit();
    }
}