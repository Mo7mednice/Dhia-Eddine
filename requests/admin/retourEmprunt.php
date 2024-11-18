<?php
include "../../database/database.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idAdherent = $_POST["idAdherent"];
    $idExemplaire = $_POST["idExemplaire"];
    if (isset($idAdherent, $idExemplaire)) {
        $retour =
            "UPDATE retards 
        JOIN emprunts ON retards.idRetard = emprunts.idRetard 
        SET retards.numJour = DATEDIFF(emprunts.dateRetour, emprunts.dateEmprunt) - 15
        WHERE emprunts.idAdherent = $idAdherent AND emprunts.idExemplaire = $idExemplaire";
        $result = mysqli_query($connect, $retour);
        if ($result) {
            $get_retard = "SELECT *
                FROM emprunts
                JOIN retards ON emprunts.idRetard = retards.idRetard
                WHERE emprunts.idAdherent = $idAdherent AND emprunts.idExemplaire = $idExemplaire";
            $resultRet = mysqli_query($connect, $get_retard);
            $row = mysqli_fetch_array($resultRet);
            $update = "UPDATE exemplaires,emprunts SET exemplaires.etat ='Disponible' ,emprunts.etatEmprunt = 'Renvoyé' WHERE emprunts.idExemplaire = $idExemplaire ";
            $resultUpd = mysqli_query($connect, $update);
            if ($row["numJour"] > 0 && $resultUpd) {
                echo json_encode(['success' => true, 'message' => "Il a été renvoyé avec un peu de retard (" . $row["numJour"] . ")."]);
                exit();
            } else {
                echo json_encode(['success' => true, 'message' => "Le retour s'est effectué avec succès sans aucun délai"]);
                exit();
            }
        } else {
            echo json_encode(['success' => false, 'message' => "Une erreur s'est produite lors du processus de retour."]);
            exit();
        }
    }
}