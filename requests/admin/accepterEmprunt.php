<?php
include "../../database/database.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idEmprunt = $_POST["idEmprunt"];
    $idAdherent = $_POST["idAdherent"];
    $idExemplaire = $_POST["idExemplaire"];
    if (isset($idEmprunt, $idAdherent,$idExemplaire)) {
        $verify = "SELECT adherents.nom,adherents.prenom,retards.numJour,COUNT(*) AS delay_count FROM Emprunts 
                JOIN retards ON Emprunts.idRetard = retards.idRetard
                JOIN adherents ON emprunts.idAdherent = adherents.idAdherent
                WHERE Emprunts.idAdherent = $idAdherent AND retards.numJour > 0";
        $resultVer = mysqli_query($connect, $verify);
        $row = mysqli_fetch_assoc($resultVer);
        if ($row["numJour"] > 0) {
            echo json_encode(['success' => false, 'message' => "Il n'est pas possible de emprunter, il y a un retard sur ce adhérent \"".$row["nom"]." ".$row["prenom"]."\"."]);
        } else {
            $accepter = "UPDATE emprunts SET etatEmprunt = 'Accepté',dateEmprunt = NOW() WHERE idEmprunt = $idEmprunt ";
            $result_acc = mysqli_query($connect, $accepter);
            $exmplaire = "UPDATE exemplaires SET etat = 'Utilisé' WHERE idExemplaire = $idExemplaire ";
            $result_exmp = mysqli_query($connect, $exmplaire);
            if ($result_acc && $result_exmp) {
                echo json_encode(['success' => true, 'message' => "Votre demande de emprunt a été acceptée"]);
                exit();
            } else {
                echo json_encode(['success' => false, 'message' => "La demande de emprunt a été modifiée."]);
                exit();
            }
        }
    }

}
