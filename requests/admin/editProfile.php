<?php
session_start();
include "../../database/database.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idAdmin = $_SESSION["admin_id"];
    if (isset($id)) {
        $nomUtilisateur = $_POST["nomUtilisateur"];
        $motPasse = $_POST["motPasse"];
        $edit_profile =
            "UPDATE admin SET 
            nom_utilisateur = '$nomUtilisateur', mot_passe = '$motPasse'
            WHERE id = $idAdmin";
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