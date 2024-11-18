<?php
include "../../database/database.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $dateNaissance = $_POST['dateNaissance'];
    $adresse = $_POST['adresse'];
    $telephone = $_POST['telephone'];
    $nomUtilisateur = $_POST['nomUtilisateur'];
    $motPasse = $_POST['motPasse'];
    $set_adherent = "INSERT INTO adherents (nom, prenom, dateNaissance, adresse, telephone, nomUtilisateur, motPasse) 
                    VALUES ('$nom', '$prenom', '$dateNaissance', '$adresse', '$telephone', '$nomUtilisateur', '$motPasse')";
    $result = mysqli_query($connect, $set_adherent);
    if ($result) {
        echo json_encode(['success' => true, 'message' => "Adhérent ajouté avec succès"]);
        exit();
    } else {
        echo json_encode(['success' => false, 'message' => "Adhérent non ajouté."]);
        exit();
    }
}
