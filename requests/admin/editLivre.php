<?php
include "../../database/database.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idLivre = $_POST['idLivre'];
    $idAuteur = $_POST['idAuteur'];
    $idPays = $_POST['idPays'];
    if (isset($idLivre, $idAuteur, $idPays)) {
        $titre = $_POST["titre"];
        $annee = $_POST["annee"];
        $resume = $_POST["resume"];
        $nomAuteur = $_POST["nomAuteur"];
        $prenomAuteur = $_POST["prenomAuteur"];
        $paysAuteur = $_POST["paysAuteur"];
        $edit_livre =
            "UPDATE livres SET 
            titre = '$titre', annee = '$annee', resume = '$resume'
            WHERE idLivre = $idLivre";
        $edit_auteur =
            "UPDATE auteurs SET 
            nom = '$nomAuteur', prenom = '$prenomAuteur'
            WHERE idAuteur = $idAuteur";
        $edit_paysAuteur =
            "UPDATE pays SET 
            nomPays = '$paysAuteur'
            WHERE idPays = $idPays";
        $result1 = mysqli_query($connect, $edit_livre);
        $result2 = mysqli_query($connect, $edit_auteur);
        $result3 = mysqli_query($connect, $edit_paysAuteur);
        if ($result1 && $result2 && $result3) {
            echo json_encode(['success' => true, 'message' => "Livre modifié avec succès"]);
            exit();
        } else {
            echo json_encode(['success' => false, 'message' => "Livre non modifié."]);
            exit();
        }
    } else {
        echo json_encode(['success' => false, 'message' => "id est vide."]);
        exit();
    }
}
