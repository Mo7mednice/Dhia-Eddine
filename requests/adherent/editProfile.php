<?php
session_start();
include "../../database/database.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idAdherent = $_SESSION["adhérent_id"];
    if (isset($idAdherent)) {
        $adresse = $_POST["adresse"];
        $telephone = $_POST["telephone"];
        $nomUtilisateur = $_POST["nomUtilisateur"];
        $motPasse = $_POST["motPasse"];
        $edit_profile =
            "UPDATE adherents SET adresse = '$adresse', telephone = '$telephone',
            nomUtilisateur = '$nomUtilisateur', motPasse = '$motPasse'
            WHERE idAdherent = $idAdherent";
        $result = mysqli_query($connect,$edit_profile);
        if($result){
            echo json_encode(["success" => true , "message"  => "Votre profil a été modifié."]);
            exit();
        }else{
            echo json_encode(["success" => false , "message"  => "Une erreur s'est produite lors de la modification de votre profil."]);
            exit();
        }
    }
}