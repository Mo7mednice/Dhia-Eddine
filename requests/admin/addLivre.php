<?php
include "../../database/database.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST["titre"];
    $annee = $_POST["annee"];
    $resume = $_POST["resume"];
    $descreption = $_POST["descreption"];
    $nomAuteur = $_POST["nomAuteur"];
    $prenomAuteur = $_POST["prenomAuteur"];
    $dateNaissAuteur = $_POST["dateNaissAuteur"];
    $paysAuteur = $_POST["paysAuteur"];
    $numexmp = $_POST["numexmp"];
    $set_pays = "INSERT INTO pays (nomPays) VALUES ('$paysAuteur')";
    $result_pays = mysqli_query($connect, $set_pays);
    if (!$result_pays) {
        echo json_encode(['success' => false, 'message' => "Erreur lors de l'ajout du pays."]);
        exit();
    }
    $idPays = mysqli_insert_id($connect);
    $set_auteur = "INSERT INTO auteurs (nom, prenom, dateNaissance, idPays)
                    VALUES ('$nomAuteur', '$prenomAuteur', '$dateNaissAuteur', $idPays)";
    $result_auteur = mysqli_query($connect, $set_auteur);
    if (!$result_auteur) {
        echo json_encode(['success' => false, 'message' => "Erreur lors de l'ajout de l'auteur."]);
        exit();
    }
    $idAuteur = mysqli_insert_id($connect);
    $set_livre = "INSERT INTO livres (titre, annee, resume, descreption, idAuteur) 
                    VALUES ('$titre', '$annee', '$resume', '$descreption', $idAuteur)";
    $result = mysqli_query($connect, $set_livre);
    
    $idLivre = mysqli_insert_id($connect);
    for ($i=0; $i<$numexmp; $i++){
        $set_exemplaires = "INSERT INTO exemplaires (etat, idLivre) 
        VALUES ('Disponible',$idLivre)";
    $result_exemplaires = mysqli_query($connect, $set_exemplaires);

    }
    if ($result) {
        echo json_encode(['success' => true, 'message' => "Livre ajouté avec succès"]);
        exit();
    } else {
        echo json_encode(['success' => false, 'message' => "Livre non ajouté."]);
        exit();
    }
}
